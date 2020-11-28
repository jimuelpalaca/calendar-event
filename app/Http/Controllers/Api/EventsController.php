<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\Event as EventResource;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventsController extends Controller
{
    /**
     * @param Request $request
     * @return EventResource
     * @throws Exception
     */
    public function store(Request $request)
    {
        $event = Event::query()->create([
            'name' => $request->get('name'),
            'days' => json_encode($request->get('days')),
            'starts_at' => new Carbon($request->get('starts_at')),
            'ends_at' => new Carbon($request->get('ends_at')),
        ]);

        return new EventResource($event);
    }
}
