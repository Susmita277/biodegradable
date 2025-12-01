<?php

namespace App\Listeners;

use App\Models\Page;
use App\PageStatus;
use Exception;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LivewirePageCreated
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(CommandFinished $event): void
    {
        $command = $event->command;

        if ($command !== 'livewire:make' && $command !== 'make:livewire') {
            return;
        }

        $name = $event->input->getArgument('name');

        if (! $name) {
            return;
        }

        try {
            $this->registerPage($name);
            $this->addRoute($name);
        } catch (Exception $e) {
            logger($e->getMessage());
        }
    }

    private function registerPage($name)
    {
        $routeKey = Str::kebab(class_basename($name));

        $slug = Str::slug($routeKey);

        $page = Page::where('slug', $slug)->first();

        if ($page) {
            return;
        }

        $data = [];

        $data['title'] = $routeKey;

        $data['slug'] = $slug;

        $data['seo'] = [
            'meta_title' => $routeKey,
            'meta_description' => 'Description for '.$routeKey,
            'meta_keywords' => 'Keywords for '.$routeKey,
            'json_ld' => <<<'JSON'
                {
                "@context": "https://schema.org",
                "@type": "Organization",
                "name": "Byte Encoder",
                "url": "https://bytencoder.com.np",
                "logo": "https://bytencoder.com.np/images/bytelogo.webp",
                "sameAs": [
                    "https://www.facebook.com/ByteEncoder",
                    "https://www.linkedin.com/company/byte-encoder"
                ],
                "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "+977-9802313121",
                    "contactType": "Customer Service"
                },
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "Bhadrapur road",
                    "addressLocality": "Birtamode",
                    "addressRegion": "Jhapa",
                    "postalCode": "57204",
                    "addressCountry": "NP"
                }
                }
                JSON
        ];

        $data['blocks'] = [];

        $data['status'] = PageStatus::Draft->value;

        Page::toFile($data);
    }

    private function addRoute($name)
    {
        $filePath = base_path('routes/broccoli.php');

        $routeKey = Str::kebab(class_basename($name));

        $class = "\\App\\Livewire\\{$name}";

        $routeDefinition = "\nRoute::get('/{$routeKey}', {$class}::class);";

        $contents = File::exists($filePath) ? File::get($filePath) : "<?php\n\nuse Illuminate\\Support\\Facades\\Route;\n";

        if (! Str::contains($contents, "{$class}::class")) {
            File::append($filePath, $routeDefinition);
        }
    }
}
