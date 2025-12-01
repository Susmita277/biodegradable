<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class PageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page Information')
                    ->schema([
                        TextEntry::make('title')->label('Page Title'),
                        TextEntry::make('slug')->label('Slug'),
                        TextEntry::make('status')->label('Status'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                RepeatableEntry::make('blocks')
                    ->label('Page Sections')
                    ->schema([
                        TextEntry::make('type')
                            ->label('Section Type')
                            ->getStateUsing(fn ($record) => $record['type'] ?? '-')
                            ->placeholder('-'),

                        KeyValueEntry::make('data')
                            ->label('Section Data')
                            ->getStateUsing(fn ($record) => collect($record['data'] ?? [])->mapWithKeys(function ($block) {
                                return [$block['type'] ?? 'block' => json_encode($block['data'] ?? [])];
                            })->toArray())
                            ->placeholder('-'),
                    ])
                    ->columnSpanFull(),

                RepeatableEntry::make('seo_meta')
                    ->schema([
                        Tabs::make('SEO Settings')
                            ->tabs([
                                Tab::make('Basic SEO')->schema([
                                    TextEntry::make('meta_title')->label('Meta Title')->placeholder('-'),
                                    TextEntry::make('meta_description')->label('Meta Description')->placeholder('-'),
                                    TextEntry::make('meta_keywords')->label('Meta Keywords')->placeholder('-'),
                                    TextEntry::make('canonical_url')->label('Canonical URL')->placeholder('-'),
                                    TextEntry::make('robots')->label('Robots')->placeholder('-'),
                                ]),

                                Tab::make('Open Graph / Social')->schema([
                                    TextEntry::make('og_title')->label('OG Title')->placeholder('-'),
                                    TextEntry::make('og_description')->label('OG Description')->placeholder('-'),
                                    TextEntry::make('og_url')->label('OG URL')->placeholder('-'),
                                    TextEntry::make('og_type')->label('OG Type')->placeholder('-'),
                                    TextEntry::make('og_site_name')->label('OG Site Name')->placeholder('-'),
                                    SpatieMediaLibraryImageEntry::make('og_image')->collection('og_image')->label('OG Image')->placeholder('-'),
                                ]),

                                Tab::make('Twitter Card')->schema([
                                    TextEntry::make('twitter_title')->label('Twitter Title')->placeholder('-'),
                                    TextEntry::make('twitter_description')->label('Twitter Description')->placeholder('-'),
                                    TextEntry::make('twitter_card')->label('Card Type')->placeholder('-'),
                                    TextEntry::make('twitter_site')->label('@Site')->placeholder('-'),
                                    TextEntry::make('twitter_creator')->label('@Creator')->placeholder('-'),
                                    SpatieMediaLibraryImageEntry::make('twitter_image')->collection('twitter_image')->label('Twitter Image')->placeholder('-'),
                                ]),

                                Tab::make('Advanced / Extras')->schema([
                                    TextEntry::make('author')->label('Author')->placeholder('-'),
                                    TextEntry::make('viewport')->label('Viewport')->placeholder('-'),
                                    TextEntry::make('charset')->label('Charset')->placeholder('-'),
                                    TextEntry::make('theme_color')->label('Theme Color')->placeholder('-'),
                                    TextEntry::make('robots_meta')->label('Extra Robots Meta')->placeholder('-'),
                                    TextEntry::make('refresh')->label('Meta Refresh')->placeholder('-'),
                                    TextEntry::make('json_ld')->label('JSON-LD')->placeholder('-'),
                                ]),

                                Tab::make('Custom Meta Tags')->schema([
                                    KeyValueEntry::make('custom_meta')
                                        ->schema([
                                            TextEntry::make('name')->label('Custom Meta Tags')
                                                ->placeholder('-'),
                                            TextEntry::make('content')->label('Custom Meta Tags')
                                                ->placeholder('-'),
                                        ])
                                        ->columnSpanFull(),
                                ]),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Section::make('Timestamps')
                    ->schema([
                        TextEntry::make('created_at')->label('Created At')->dateTime()->placeholder('-'),
                        TextEntry::make('updated_at')->label('Updated At')->dateTime()->placeholder('-'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
