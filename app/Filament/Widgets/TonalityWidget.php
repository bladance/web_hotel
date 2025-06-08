<?php

namespace App\Filament\Widgets;

use App\Models\ReviewGoogle;
use App\Models\ReviewOstrovok;
use App\Models\ReviewYt;
use Filament\Widgets\ChartWidget;

class TonalityWidget extends ChartWidget
{
    protected static ?string $heading = 'Тональность отзывов';

    public ?string $hotel = null;
    protected $listeners = ['hotelSelected' => 'updateSelectedHotel'];


    protected function getData(): array
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
            'labels' => ['Положительные', 'Нейтральные', 'Отрицательные'],
            'datasets' => [
                [
                    'label' => 'Тональность',
                    'data' => [$query->where('tonality', '>', 0.75)->count(), $query->where('tonality', '<', 0.75)->where('tonality', '>', 0.4)->count(), $query->where('tonality', '<', 0.4)->count()],
                    'backgroundColor' => ['#007bff', '#6c757d', '#dc3545'],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    public function updateSelectedHotel($hotel)
    {
        $this->hotel = $hotel;
    }
}
