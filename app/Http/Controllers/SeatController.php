<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Seat;
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

        $event = Event::where('id', $id)->where('team_id', 1)->first();

        // Start the transaction
        DB::beginTransaction();

        //try {
            $seats = [
                1 => 2,
                2 => 2,
            ];
            $start = 1679308200;
            $end = 1679326200;

            // Query to select available seats within the specified time range
            $availableSeats = DB::table('seats')
                ->selectRaw('seats.id, seats.max_capacity as max, count(seat_bookings.seat_id) as count')
                ->leftJoin('seat_bookings', function ($leftJoin) {
                    $leftJoin->on('seats.id', 'seat_bookings.seat_id')
                        ->on('seats.event_id', 'seat_bookings.event_id');
                })
                ->where('seats.event_id', $event->id)
                ->where('seats.id', [1, 2])
                ->where(function ($query) use ($start, $end) {
                    $query->whereBetween('seat_bookings.start_date', [$start, $end])
                        ->orWhereBetween('seat_bookings.end_date', [$start, $end]);
                })
                ->groupBy(['seats.id', 'seats.max_capacity'])
                ->get();
            /*    ->selectRaw('seats.id')
                ->leftJoin('seat_bookings', 'seat_bookings.seat_id', '=', 'seats.id')
                ->where(function ($query) use ($start, $end) {
                    $query->whereNull('seat_bookings.id')
                        ->orWhereNotBetween('seat_bookings.start_date', [$start, $end])
                        ->orWhereNotBetween('seat_bookings.end_date', [$start, $end]);
                })
                ->groupBy('seats.id')
                ->havingRaw('COUNT(seats.id) >= 5')
                ->orderByRaw('RAND()')
                ->limit(5);*/

            // Get the available seats
            //$availableSeats = $availableSeatsQuery->pluck('id')->toArray();
var_dump($availableSeats);
 /*           if (count($availableSeats) < 5) {
                throw new Exception('Not enough seats available');
            }

            // Insert seat bookings
            foreach ($availableSeats as $seatId) {
                DB::table('seat_bookings')->insert([
                    'session_id' => 1, // replace with the actual session id
                    'seat_id' => $seatId,
                    'user_id' => 1, // replace with the actual user id
                    'start_date' => $start,
                    'end_date' => $end,
                    'seat_number' => 1, // replace with the actual seat number
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Commit the transaction
            DB::commit();

            echo 'Seat bookings created successfully';
        } catch (Exception $e) {
            // Rollback the transaction on error
            DB::rollback();

            echo 'Error creating seat bookings: ' . $e->getMessage();
        }

        $event = Event::where('id', $id)->where('team_id', 1)->first();
        $seats = Seat::where('event_id', $id)->where('team_id', 1)->orderBy('order')->get();*/
/*
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
*/
        return response()->json([
            'message' => 'win',
        ], 202);
    }
}

