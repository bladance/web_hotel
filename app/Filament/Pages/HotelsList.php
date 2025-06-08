<?php

namespace App\Filament\Pages;

use App\Models\Hotel;
use App\Models\HotelGoogle;
use App\Models\HotelOstrovok;
use App\Models\HotelYt;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class HotelsList extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.hotels-list';

    protected static ?string $navigationLabel = "Список отелей";

    protected static ?string $title = "Список отелей";



    public function table(Table $table): Table
    {
        return $table->query(
            Hotel::query()

        )->columns([
            TextColumn::make('source')->label('Источник'),
            TextColumn::make('unified_name')->label('Название'),
            TextColumn::make('location')->label('Локация'),
            TextColumn::make('rating')->label('Рейтинг'),
            TextColumn::make('stars')->label('Количество звезд'),
        ]);
    }
}
