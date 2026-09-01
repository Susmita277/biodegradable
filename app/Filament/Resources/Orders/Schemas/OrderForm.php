<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                // Fixed: Replaced Placeholder with disabled TextInput
                                TextInput::make('id')
                                    ->label('Order ID')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->formatStateUsing(fn ($record) => "#{$record?->id}"),
                                
                                Select::make('user_id')
                                    ->relationship('user', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->disabled()
                                    ->required(),
                                
                                Select::make('district_id')
                                    ->relationship('district', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->disabled()
                                    ->required(),
                                
                                TextInput::make('full_name')
                                    ->required()
                                    ->maxLength(255),
                                
                                TextInput::make('phone')
                                    ->required()
                                    ->maxLength(20),
                            ]),
                    ])
                    ->collapsible(),
                
                Section::make('Address Details')
                    ->schema([
                        Textarea::make('address')
                            ->required()
                            ->rows(3),
                        
                        Textarea::make('notes')
                            ->rows(2),
                    ])
                    ->collapsible(),
                
                Section::make('Order Summary')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('subtotal')
                                    ->numeric()
                                    ->prefix('NPR')
                                    ->disabled(),
                                
                                TextInput::make('delivery_charge')
                                    ->numeric()
                                    ->prefix('NPR')
                                    ->disabled(),
                                
                                TextInput::make('total')
                                    ->numeric()
                                    ->prefix('NPR')
                                    ->disabled(),
                                
                                Select::make('payment_method')
                                    ->options([
                                        'cod' => 'Cash on Delivery',
                                        'esewa' => 'eSewa',
                                        'khalti' => 'Khalti',
                                    ])
                                    ->required(),
                                
                                Select::make('status')
                                    ->options([
                                        'pending' => 'Pending',
                                        'processing' => 'Processing',
                                        'shipped' => 'Shipped',
                                        'delivered' => 'Delivered',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->required()
                                    ->native(false)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->collapsible(),
                
                Section::make('Order Items')
                    ->schema([
                        Repeater::make('items')
                            ->relationship('items')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('product_name')
                                            ->disabled(),
                                        
                                        TextInput::make('quantity')
                                            ->numeric()
                                            ->disabled(),
                                        
                                        TextInput::make('price')
                                            ->numeric()
                                            ->prefix('NPR')
                                            ->disabled(),
                                        
                                        TextInput::make('subtotal')
                                            ->numeric()
                                            ->prefix('NPR')
                                            ->disabled()
                                            ->columnSpanFull(),
                                        
                                    
                                            TextInput::make('current_stock')
    ->label('Current Stock')
    ->disabled()
    ->dehydrated(false)
    ->formatStateUsing(function ($record) {
        if (!$record?->product) return 'N/A';
        
        // Show the real current stock + the quantity in this specific order
        // (Because the global stock was already decremented when the order was created)
        return $record->product->stock + $record->quantity;
    })
    ->columnSpanFull(),
                                    ]),
                            ])
                            ->disabled()
                            ->collapsible(),
                    ])
                    ->collapsible(),
            ]);
    }
}