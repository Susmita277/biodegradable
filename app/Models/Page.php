<?php

namespace App\Models;

use App\PageStatus;
use Illuminate\Database\Eloquent\Model;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Sushi\Sushi;
use Symfony\Component\Yaml\Yaml;

class Page extends Model
{
    use Sushi;

    protected $casts = [
        'seo' => 'array',
        'blocks' => 'array',
        'status' => PageStatus::class,
    ];

    public function getRows()
    {
        return self::getContent();
    }

    public static function getContent(): array
    {
        $files = glob(resource_path('content/*.md'));

        $contents = [];

        $count = 1;

        foreach ($files as $file) {
            $contents[] = self::fromFile(basename($file, '.md'), $count++);
        }

        return $contents;
    }

    public static function fromFile(string $slug, int $id): array
    {
        $filepath = resource_path("content/{$slug}.md");

        $raw = file_get_contents($filepath);

        $parsed = YamlFrontMatter::parse($raw);

        $matter = $parsed->matter();

        $matter['id'] = $id;

        $matter['seo'] = json_encode($matter['seo']);

        $matter['blocks'] = json_encode(
            collect($matter['blocks'])->map(fn ($block, $key) => [
                'type' => $key,
                'data' => [
                    [
                        'type' => $key,
                        'data' => $block,
                    ],
                ],
            ])->values()->toArray()
        );

        // Return the arrays directly. No JSON encoding.
        return $matter;
    }

    /**
     * Save the current model instance to a markdown file with YAML front‑matter.
     *
     * This method should be called on an *instance* of the model, not statically.
     */
    public static function toFile(array $data): void
    {
        // Flatten blocks: from Builder structure to key => block fields
        $blocksForYaml = collect($data['blocks'] ?? [])->mapWithKeys(function ($item) {
            $type = $item['type'];
            $innerData = $item['data'][0]['data'] ?? [];

            return [$type => $innerData];
        })->toArray();

        // Flatten status if it is an object
        $status = $data['status'] instanceof \App\PageStatus
            ? $data['status']->value
            : $data['status'];

        // Prepare front-matter array
        $meta = [
            'title' => $data['title'] ?? null,
            'slug' => $data['slug'] ?? null,
            'status' => $status,
            'seo' => $data['seo'] ?? [],
            'blocks' => $blocksForYaml,
        ];

        // If you have a body content field, include it, otherwise empty
        $body = $data['body'] ?? '';

        // Convert to YAML front-matter
        $yaml = Yaml::dump($meta, 4, 2, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);

        // Build full markdown
        $content = "---\n$yaml---\n\n$body";

        // Save to resources/content/{slug}.md
        file_put_contents(resource_path("content/{$data['slug']}.md"), $content);
    }

    public function delete()
    {
        unlink(resource_path("content/{$this->slug}.md"));

        parent::delete();
    }
}
