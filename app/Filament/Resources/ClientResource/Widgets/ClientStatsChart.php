<?php

namespace App\Filament\Resources\ClientResource\Widgets;

use Filament\Widgets\LineChartWidget;

class ClientStatsChart extends LineChartWidget
{
    protected static ?string $heading = 'Monthly sales';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Monthly sales 2022',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                    'borderColor'=> [
                        'green',
                    ]
                ],
                [
                    'label' => 'Monthly sales 2021',
                    'data' => [0, 20, 35, 21, 29, 35, 40, 76, 60, 69, 73, 92],
                    'borderColor'=> [
                        'red',
                    ]
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
