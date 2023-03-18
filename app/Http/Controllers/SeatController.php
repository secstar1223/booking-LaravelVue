<?php
namespace App\Http\Controllers;

use App\Models\Event;
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
        $event = Event::where('id', $id)->where('team_id', 1)->first();
        $seats = Seat::where('event_id', $id)->where('team_id', 1)->orderBy('order')->get();

        $seats = $seats->map(function ($seat) {
            $prices = $seat->prices;

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
                'minimum_order' => $seat->minimum_order,
                'max_capacity' => $seat->max_capacity,
                'prices' => $prices,
                'quantity' => 0,
            ];
        });

        return Inertia::render('Seats/Index', [
            'seats' => $seats,
            'language' => $event->language,
            'schedule' => $event->schedule,
            'schedule_exceptions' => $event->schedule_exceptions,
            'options' => $event->options,
        ]);
    }
}

