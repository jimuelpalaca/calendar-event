<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Event;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventsController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
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

        return response()->json($event);
    }
}
