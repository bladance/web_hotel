<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\CountsWidget;
use App\Filament\Widgets\RevieByDate;
use App\Filament\Widgets\TonalityWidget;
use App\Filament\Widgets\TopKeywords;
use App\Models\Hotel;
use App\Models\ReviewGoogle;
use App\Models\ReviewOstrovok;
use App\Models\ReviewYt;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Pages\Page;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class ReviewList extends Page implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.review-list';

    protected static ?string $navigationLabel = "Отзывы";

    protected static ?string $title = "Отзывы";

    public ?string $hotel = null;

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('hotel')->label('Отель')->options(
                Hotel::all()->map(function ($hotel) {
                    return ['key' => $hotel->id . ';' . $hotel->source, 'value' => $hotel->unified_name];
                })->pluck('value', 'key')->toArray()
            )
                ->live()
                ->afterStateUpdated(function ($state) {
                    $this->hotel = $state;
                    $this->resetTable();
                    $this->dispatch('hotelSelected', $state);
                }),
        ]);
    }

    public function table(Table $table): Table
    {
        if (!$this->hotel) {
            return $table->query(ReviewGoogle::query()->where('id', '<', 0))->emptyStateHeading('не найдено');
        }
        [$id, $source] = explode(';', $this->hotel);
        $query = match ($source) {
            'Google' => ReviewGoogle::query(),
            'Ostrovok' => ReviewOstrovok::query(),
            'Yt' => ReviewYt::query(),
            default => ReviewGoogle::query(),
        };

        $ostrovokContent = $source == 'Ostrovok' ? $this->ostrovokContent() : [TextColumn::make('content')->label('Отзыв')->formatStateUsing(function ($state) {
            return '<b>Отзыв: </b>' . $state;
        })->html()];

        return $table->query(
            $query->where('id_hotel', $id)->when($source == 'Ostrovok', function ($query) {
                $query->where('positive_content', '!=', null)->orWhere('negative_content', '!=', null);
            })->when($source != 'Ostrovok', function ($query) {
                $query->where('content', '!=', null);
            })
        )->columns([
            Panel::make([
                ...$ostrovokContent,
                TextColumn::make('date_publication')->label('Дата публикации')->formatStateUsing(function ($state) {
                    return '<b>Дата публикации: </b>' . $state;
                })->html(),
                $source == 'Yt' ? TextColumn::make('stars_count')->label('Оценка')->formatStateUsing(function ($state) {
                    return '<b>Оценка: </b>' . $state;
                })->html() : TextColumn::make('rating')->label('Оценка')->formatStateUsing(function ($state) {
                    return '<b>Оценка: </b>' . $state;
                })->html()
            ])

        ])->emptyStateHeading('не найдено');
    }

    public function ostrovokContent(): array
    {
        return [TextColumn::make('positive_content')->label('Позитивный отзыв')->formatStateUsing(function ($state) {
            return '<b>Позитивный отзыв: </b>' . $state;
        })->html(), TextColumn::make('negative_content')->label('Негативный отзыв')->formatStateUsing(function ($state) {
            return '<b>Негативный отзыв: </b>' . $state;
        })->html()];
    }

    protected function getHeaderWidgets(): array
    {
        $conditionalWidgets = $this->hotel ? [
            TonalityWidget::make(['hotel' => $this->hotel]),
            TopKeywords::make(['hotel' => $this->hotel]),
            RevieByDate::make(['hotel' => $this->hotel]),

        ] : [];
        return [
            CountsWidget::make(['hotel' => $this->hotel]),
            ...$conditionalWidgets,
        ];
    }
}
