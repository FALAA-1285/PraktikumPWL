<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;


class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Tabs::make('Product Tabs')
                    ->tabs([
                        Tab::make('Product Details')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')
                                    ->color('primary'),
                                TextEntry::make('id')
                                    ->label('Product ID'),

                                TextEntry::make('sku')
                                    ->label('SKU')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('description')
                                    ->label('Description'),

                                TextEntry::make('created_at')
                                    ->label('Product Created Date')
                                    ->date('d M Y')
                                    ->color('info'),
                            ])
                            ->columnSpanFull(),
                        Tab::make('Product Pricing & Stock')
                            ->icon('heroicon-o-banknotes')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->icon('heroicon-o-currency-dollar')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
    
                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->icon('heroicon-m-archive-box')
                                    ->badge()
                                    ->color(fn ($state) => match (true) {
                                        $state <= 5 => 'danger',
                                        $state <= 20 => 'warning',
                                        default => 'success',
                                    }),

                            ])->columnSpanFull(),
                        Tab::make('Media & Status')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),
                                IconEntry::make('is_active')
                                    ->label('Is Active?')
                                    ->boolean(),
                                IconEntry::make('is_featured')
                                    ->label('Is Featured?')
                                    ->boolean(),
                            ])->columnSpanFull(),   
                    ])
                    ->columnSpanFull()
                    ->vertical(),
                
            ]);
    }
}
