<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\BlockRegistry;
use App\PageStatus;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('General')
                    ->columnSpanFull()
                    ->tabs([
                        self::getBuildingBlocksTab(),
                        self::getPageInformationTab(),
                        self::getSeoInformationTab(),
                    ]),
            ]);
    }

    public static function getPageInformationTab()
    {
        return Tab::make('PAGE INFORMATION')
            ->schema([
                TextInput::make('title')
                    ->afterStateUpdatedJs(<<<'JS'
                        $set('slug', ($state ?? '').toLowerCase().trim().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-'))
                    JS)
                    ->datalist(function () {
                        $livewirePath = resource_path('content');

                        $files = glob($livewirePath.'/*.md');

                        return collect($files)
                            ->flatMap(fn ($file) => [
                                Str::lower(pathinfo($file, PATHINFO_FILENAME)) => pathinfo($file, PATHINFO_FILENAME),
                            ])
                            ->toArray();
                    })
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                ToggleButtons::make('status')
                    ->inline()
                    ->options(PageStatus::class)
                    ->required(),
            ])
            ->columns(2)
            ->columnSpanFull();
    }

    public static function getBuildingBlocksTab()
    {
        return Tab::make('BUILDING BLOCKS')
            ->schema([
                Repeater::make('blocks')
                    ->compact(false)
                    ->defaultItems(1)
                    ->hiddenLabel()
                    ->addActionLabel('Add new section')
                    ->schema([
                        ToggleButtons::make('type')
                            ->inline()
                            ->inlineLabel()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->options(collect(BlockRegistry::all())->mapWithKeys(fn ($v, $k) => [$k => $v['label']]))
                            ->afterStateUpdated(function ($state, Set $set) {
                                $set('data', [
                                    [
                                        'type' => $state,
                                        'data' => [],
                                    ],
                                ]);
                            })
                            ->live(),
                        Builder::make('data')
                            ->label(fn ($get) => ucfirst($get('type')))
                            ->maxItems(1)
                            ->addable(false)
                            ->reorderable(false)
                            ->deletable(false)
                            ->blockLabels(false)
                            ->blocks(function (Get $get) {
                                if (! $get('type')) {
                                    return [];
                                }

                                return [
                                    BlockRegistry::all()[$get('type')]['schema'],
                                ];
                            }),
                    ]),
            ])
            ->columnSpanFull();
    }

    public static function getSeoInformationTab()
    {
        return Tab::make('SEO INFORMATION')
            ->schema([
                Tabs::make('SEO Settings')
                    ->contained(false)
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Basic SEO')
                            ->schema([
                                TextInput::make('seo.meta_title')
                                    ->label('Meta Title')
                                    ->maxLength(70)
                                    ->helperText('50-70 characters recommended.')
                                    ->required(),

                                Textarea::make('seo.meta_description')
                                    ->label('Meta Description')
                                    ->maxLength(160)
                                    ->helperText('150-160 characters recommended.')
                                    ->required(),

                                TextInput::make('seo.meta_keywords')
                                    ->label('Meta Keywords')
                                    ->placeholder('comma, separated, keywords')
                                    ->helperText('Separate keywords with commas.'),

                                TextInput::make('seo.canonical_url')
                                    ->label('Canonical URL')
                                    ->url()
                                    ->helperText('Optional canonical link.'),

                                Select::make('seo.robots')
                                    ->label('Robots Directives')
                                    ->options([
                                        'index, follow' => 'Index, Follow',
                                        'noindex, follow' => 'No Index, Follow',
                                        'index, nofollow' => 'Index, No Follow',
                                        'noindex, nofollow' => 'No Index, No Follow',
                                    ])
                                    ->default('index, follow'),
                            ]),

                        Tab::make('Open Graph / Social')
                            ->schema([
                                TextInput::make('seo.og_title')
                                    ->label('OG Title')
                                    ->maxLength(70),

                                Textarea::make('seo.og_description')
                                    ->label('OG Description')
                                    ->maxLength(200),

                                FileUpload::make('seo.og_image')
                                    ->label('OG Image')
                                    ->image()
                                    ->helperText('Recommended: 1200x630px'),

                                Select::make('seo.og_type')
                                    ->label('OG Type')
                                    ->options([
                                        'website' => 'Website',
                                        'article' => 'Article',
                                        'profile' => 'Profile',
                                    ])
                                    ->default('website'),

                                TextInput::make('seo.og_url')
                                    ->label('OG URL')
                                    ->url(),

                                TextInput::make('seo.og_site_name')
                                    ->label('OG Site Name'),
                            ]),

                        Tab::make('Twitter Card')
                            ->schema([
                                TextInput::make('seo.twitter_title')
                                    ->label('Twitter Title')
                                    ->maxLength(70),

                                Textarea::make('seo.twitter_description')
                                    ->label('Twitter Description')
                                    ->maxLength(200),

                                FileUpload::make('seo.twitter_image')
                                    ->label('Twitter Image')
                                    ->image()
                                    ->helperText('Recommended: 1200x600px'),

                                Select::make('seo.twitter_card')
                                    ->label('Twitter Card Type')
                                    ->options([
                                        'summary' => 'Summary',
                                        'summary_large_image' => 'Summary with Large Image',
                                        'app' => 'App',
                                        'player' => 'Player',
                                    ])
                                    ->default('summary_large_image'),

                                TextInput::make('seo.twitter_site')
                                    ->label('Twitter Site (@username)'),

                                TextInput::make('seo.twitter_creator')
                                    ->label('Twitter Creator (@username)'),
                            ]),

                        Tab::make('Advanced / Extras')
                            ->schema([
                                TextInput::make('seo.author')
                                    ->label('Author'),

                                TextInput::make('seo.viewport')
                                    ->label('Viewport')
                                    ->default('width=device-width, initial-scale=1'),

                                TextInput::make('seo.charset')
                                    ->label('Charset')
                                    ->default('UTF-8'),

                                ColorPicker::make('seo.theme_color')
                                    ->label('Theme Color')
                                    ->placeholder('#ffffff'),

                                TextInput::make('seo.robots_meta')
                                    ->label('Extra Robots Meta')
                                    ->placeholder('e.g., max-snippet:-1, max-image-preview:large'),

                                TextInput::make('seo.refresh')
                                    ->label('Meta Refresh')
                                    ->helperText('Optional, e.g., 30; url=https://example.com'),

                                Textarea::make('seo.json_ld')
                                    ->label('JSON-LD / Structured Data')
                                    ->helperText('Rich snippets for Google / Schema.org.'),
                            ]),

                        Tab::make('Custom Meta Tags')
                            ->schema([
                                KeyValue::make('seo.custom_meta')
                                    ->label('Custom Meta Tags')
                                    ->addActionLabel('Add Meta Tag')
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }
}
