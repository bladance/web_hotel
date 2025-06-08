<?php

namespace App\Filament\Widgets;

use App\Models\ReviewGoogle;
use App\Models\ReviewOstrovok;
use App\Models\ReviewYt;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class RevieByDate extends ChartWidget
{
    protected static ?string $heading = 'Отзывы по месяцам';

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

        $months = $query->get()->groupBy(function ($item) {
            return Carbon::parse($item->date_publication)->format('Y-m');
        })
            ->map(function ($items, $key) {
                return [
                    'month' => $key,
                    'count' => $items->count(),
                    'month_name' => Carbon::parse($key)->format('F') . ' ' . Carbon::parse($key)->format('Y'),
                ];
            })
            ->sortBy('month')
            ->values();
        return [
            'labels' => $months->pluck('month_name'),
            'datasets' => [
                [
                    'label' => 'Количество отзывов',
                    'data' => $months->pluck('count'),
                    'backgroundColor' => '#007bff',
                ],
            ],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true,
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public function updateSelectedHotel($hotel)
    {
        $this->hotel = $hotel;
    }
}
