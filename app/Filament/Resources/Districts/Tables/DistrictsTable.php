<?php

namespace App\Filament\Resources\Districts\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class DistrictsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('province')->badge(),
                TextColumn::make('delivery_charge')->money('NPR')->sortable(),
                IconColumn::make('is_active')->boolean(),
            ])
            ->filters([
                SelectFilter::make('province')->options([
                    'Koshi' => 'Koshi', 'Madhesh' => 'Madhesh', 'Bagmati' => 'Bagmati',
                    'Gandaki' => 'Gandaki', 'Lumbini' => 'Lumbini', 'Karnali' => 'Karnali',
                    'Sudurpashchim' => 'Sudurpashchim',
                ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
