<?php
namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SeatController extends Controller
{
    protected $currencies = [
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
    ];

    public function index(Request $request, $id)
    {
        $seats = Seat::where('event_id', $id)->where('team_id', 1)->orderBy('order')->get();

        $seats = $seats->map(function ($seat) {
            $prices = json_decode($seat->prices, true);

            usort($prices, function($a, $b) {
                return $a['order'] > $b['order'];
            });

            $prices = array_map(function($price) {
                return [
                    'id' => $price['id'],
                    'name' => $price['name'],
                    'price' => $price['price'],
                    'currency' => $price['currency'],
                    'symbol' => $this->currencies[strtoupper($price['currency'])] ?? $price['currency'],
                    'duration' => $price['duration'],
                    'checked' => false,
                ];
            }, $prices);

            return [
                'id' => $seat->id,
                'name' => $seat->name,
                'max_capacity' => $seat->max_capacity,
                'prices' => $prices,
                'quantity' => 0,
            ];
        });

        return Inertia::render('Seats/Index', [
            'seats' => $seats,
            'language' => [
                'seats_label' => 'Select Number of Waverunners(s)',
                'duration_label' => 'Duration:',
                'time_label' => 'Time:',
                'book_now' => 'Book now',
                'total_label' => 'Total: ',
            ],//
            'schedule' => [
                'repeats_every' => 7,
                'days' => [
                    0 => [39600, 41400, 43200, 45000, 46800],
                    1 => [36000, 37800, 39600, 41400, 43200, 45000, 46800],
                    2 => [],
                    3 => [],
                    4 => [36000, 37800, 39600, 41400, 43200, 45000, 46800],
                    5 => [36000, 37800, 39600, 41400, 43200, 45000, 46800],
                    6 => [36000, 37800, 39600, 41400, 43200, 45000, 46800],
                ],
            ],
            'schedule_exceptions' => [
            ],
            'options' => [
                'time' => 24, // or 12
            ]
        ]);
    }
}

