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
                $symbol = $this->currencies[strtoupper($price['currency'])] ?? $price['currency'];
                return [
                    'id' => $price['id'],
                    'name' => $price['name'],
                    'price' => $symbol . number_format($price['price'] / 100, 2),
                    'duration' => $price['duration'],
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
        ]);
    }
}

