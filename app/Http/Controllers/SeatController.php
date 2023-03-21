<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Seat;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                'error_message' => '',
                'minimum_order' => $seat->minimum_order,
                'max_capacity' => $seat->max_capacity,
                'prices' => $prices,
                'quantity' => 0,
            ];
        });

        return Inertia::render('Seats/Index', [
            'event_id' => $event->id,
            'seats' => $seats,
            'language' => $event->language,
            'schedule' => $event->schedule,
            'schedule_exceptions' => $event->schedule_exceptions,
            'options' => $event->options,
        ]);
    }
/*
check availability
SELECT seat_id, start_date, end_date, count(seat_id) as count FROM seat_bookings WHERE event_id = 1 AND seat_id IN (1,2) AND ((start_date <= 1679326200 AND start_date >= 1679308200) OR (end_date <= 1679326200 AND end_date >= 1679308200)) GROUP BY seat_id, start_date, end_date
*/
    public function reserve(Request $request, $id) {

        $seats = [
            2 => 2,
            3 => 2,
        ];
        $start = 1679308200;
        $end = 1679326200;

        $event = Event::where('id', $id)->where('team_id', 1)->first();

        $customer = new Customer();
        $customer->ip = ip2long($_SERVER['REMOTE_ADDR']);
        $customer->save();

        $max_capacity = DB::table('seats')
                ->selectRaw('id, max_capacity')
                ->where('seats.event_id', $event->id)
                ->where('seats.id', array_keys($seats))
                ->get();

        // Query to select available seats within the specified time range
        $availableSeats = DB::table('seat_bookings')
            ->selectRaw('seat_id, count(seat_id) as count')
            ->where('event_id', $event->id)
            ->where('seat_id', array_keys($seats))
            ->where('was_reserved', array_keys($seats))
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end]);
            })
            ->groupBy('seat_id')
            ->get();

        // build inserts
        $inserts = [];

        // Insert seat bookings
        foreach ($seats as $seat_id => $seat_count) {
            for ($i = 0; $i < $seat_count; $i++) {
                $inserts[] = [
                    'event_id' => $event->id, // replace with the actual session id
                    'seat_id' => $seat_id,
                    'customer_id' => $customer->id, // replace with the actual user id
                    'start_date' => $start,
                    'end_date' => $end,
                    'seat_number' => 1, // replace with the actual seat number
                    'was_reserved' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Start the transaction
        DB::beginTransaction();

        try {

            DB::table('seat_bookings')->insert($inserts);

            // Query to select available seats within the specified time range
            $availableSeats = DB::table('seat_bookings')
                ->selectRaw('seat_id, count(seat_id) as count')
                ->where('event_id', $event->id)
                ->where('seat_id', array_keys($seats))
                ->where('customer_id', '<>', 0)
                ->where(function ($query) use ($start, $end) {
                    $query->whereBetween('start_date', [$start, $end])
                        ->orWhereBetween('end_date', [$start, $end]);
                })
                ->groupBy('seat_id')
                ->get();

            // Commit the transaction
            DB::commit();

            echo 'Seat bookings created successfully';
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollback();

            echo 'Error creating seat bookings: ' . $e->getMessage();
        }

        return response()->json([
            'message' => 'win',
        ], 202);
    }
}

