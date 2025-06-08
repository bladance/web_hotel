<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\ReviewList;
use App\Models\Hotel;
use App\Models\ReviewGoogle;
use App\Models\ReviewOstrovok;
use App\Models\ReviewYt;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Tables\Columns\Concerns\InteractsWithTableQuery;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CountsWidget extends BaseWidget implements HasForms
{
    use InteractsWithForms;

    public ?string $hotel = null;
    protected $listeners = ['hotelSelected' => 'updateSelectedHotel'];

    protected function getStats(): array
    {
        if (!$this->hotel) {
            return [];
        }
        [$id, $source] = explode(';', $this->hotel);

        $query = match ($source) {
            'Google' => ReviewGoogle::query()->where('id_hotel', $id)->where('content', '!=', null),
            'Ostrovok' => ReviewOstrovok::query()->where('id_hotel', $id)->where('positive_content', '!=', null)->orWhere('negative_content', '!=', null),
            'Yt' => ReviewYt::query()->where('id_hotel', $id)->where('content', '!=', null),
            default => ReviewGoogle::query()->where('id_hotel', $id)->where('content', '!=', null),
        };
        return [
            Stat::make('Количество отзывов', $query->count()),
            Stat::make('Рейтинг отеля', Hotel::where('id', $id)->where('source', $source)->first()->rating),
            Stat::make('Средняя оценка', $source == 'Yt' ? number_format($query->avg('stars_count'), 1) : number_format($query->avg('rating'), 1)),
        ];
    }

    public function updateSelectedHotel($hotel)
    {
        $this->hotel = $hotel;
    }
}
