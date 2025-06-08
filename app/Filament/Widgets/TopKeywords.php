<?php

namespace App\Filament\Widgets;

use App\Models\Keyword;
use App\Models\ReviewGoogle;
use App\Models\ReviewOstrovok;
use App\Models\ReviewYt;
use Filament\Widgets\ChartWidget;

class TopKeywords extends ChartWidget
{
    protected static ?string $heading = 'Топ-10 сущностей';

    public ?string $hotel = null;
    protected $listeners = ['hotelSelected' => 'updateSelectedHotel'];

    protected function getData(): array
    {
        if (!$this->hotel) {
            return [];
        }
        [$id, $source] = explode(';', $this->hotel);
        $topTen = match ($source) {
            'Google' => Keyword::query()->withCount('googleReviews')->orderByDesc('google_reviews_count')
                ->limit(10)
                ->get(),
            'Ostrovok' => Keyword::query()->withCount('ostrovokReviews')->orderByDesc('ostrovok_reviews_count')
                ->limit(10)
                ->get(),
            'Yt' => Keyword::query()->withCount('ytReviews')->orderByDesc('yt_reviews_count')
                ->limit(10)
                ->get(),
            default => ReviewGoogle::query()->where('id_hotel', $id)->where('content', '!=', null),
        };

        $prefix = match ($source) {
            'Google' => 'google',
            'Ostrovok' => 'ostrovok',
            'Yt' => 'yt',
            default => 'google',
        };

        $labels = $topTen->pluck('name');
        $data = $topTen->pluck($prefix . '_reviews_count');

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Количество отзывов',
                    'data' => $data,
                    'backgroundColor' => ['#007bff', '#6c757d', '#dc3545', '#28a745', '#ffc107', '#17a2b8', '#343a40', '#6f42c1', '#e83e8c', '#fd7e14'],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'polarArea';
    }

    public function updateSelectedHotel($hotel)
    {
        $this->hotel = $hotel;
    }
}
