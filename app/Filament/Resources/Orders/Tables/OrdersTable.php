<?php

namespace App\Filament\Resources\Orders\Tables;


use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;


class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Order #')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('full_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('district.name')
                    ->label('District')
                    ->sortable()
                    ->toggleable(),
                
                TextColumn::make('total')
                    ->money('NPR')
                    ->sortable(),
                
                TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
                    ->sortable(),

                    TextColumn::make('current_stock')
                    ->label('Current Stock')
                    ->getStateUsing(function ($record) {
                        return $record->items
                            ->map(fn ($item) => $item->product?->stock . ' pcs')
                            ->join(', ');
                    }),
                                
            
                    TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'shipped' => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('payment_method')
                    ->label('Payment')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'cod' => '💵 COD',
                        'esewa' => '📱 eSewa',
                        'khalti' => '📱 Khalti',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn ($state) => $state === 'cod' ? 'gray' : 'success')
                    ->sortable(),
                
                TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime('M d, Y g:i A')
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ]),
                
                SelectFilter::make('payment_method')
                    ->options([
                        'cod' => 'Cash on Delivery',
                        'esewa' => 'eSewa',
                        'khalti' => 'Khalti',
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

