<?php

namespace App\Traits;

use App\Models\Page;
use Illuminate\Support\Str;

trait HasPageBlocks
{
    public $page;

    public $seo;

    public $blocks;

    public function mount()
    {
        $className = Str::kebab((new \ReflectionClass($this))->getShortName());

        $this->hydratePageProperties($className);
    }

    public function hydratePageProperties($page)
    {
        $data = Page::where('title', $page)->firstOrFail();

        $this->seo = $data->seo;

        $this->blocks = collect($data->blocks)
            ->map(fn ($block) => [
                'type' => $block['type'],
                'data' => $block['data'][0]['data'] ?? [],
            ])
            ->toArray();

        $this->page = $data;
    }
}
