<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $events = [];
        foreach (Event::where('team_id', 1)->get() as $event) {
            $events[] = [
                'id' => $event->id,
                'name' => $event->name,
//                'image' => $event->image,
                'description' => $event->description,
            ];
        }

        return Inertia::render('Events/Index', [
            'events' => $events,
        ]);
    }
}
