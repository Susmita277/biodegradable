<?php

namespace App\Filament\Resources\Districts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

class DistrictForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required()
                ->unique(ignoreRecord: true),

            Select::make('province')
                ->options([
                    'Koshi' => 'Koshi', 'Madhesh' => 'Madhesh', 'Bagmati' => 'Bagmati',
                    'Gandaki' => 'Gandaki', 'Lumbini' => 'Lumbini', 'Karnali' => 'Karnali',
                    'Sudurpashchim' => 'Sudurpashchim',
                ])
                ->required(),

            TextInput::make('delivery_charge')
                ->numeric()
                ->prefix('NPR')
                ->required()
                ->minValue(0),

            Toggle::make('is_active')
                ->default(true),
        ]);
    }
}
