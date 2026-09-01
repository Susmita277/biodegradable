<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn ($state, $set) => $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),


                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rs.'),

                TextInput::make('unit')
                    ->placeholder('kg, pc, pack, set'),

                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),

                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->imageEditor(),

                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}