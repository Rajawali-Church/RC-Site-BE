<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataTableRequest;
use App\Http\Requests\Event\GetEventRequest;
use App\Http\Resources\Event\DetailResource;
use App\Http\Resources\Event\IndexCollection;
use App\Services\Event\EventService;
use App\Shareds\ResponseStatus;
use Error;
use Illuminate\Http\Request;

class EventController extends Controller
{

    const ALLOW_TO_SORT_AND_SEARCH = [
        'name',
        'status',
        'category'
    ];

    public function __construct(
        private EventService $eventService,
    )
    {
    }

    public function index(DataTableRequest $request) 
    {
        try {
            $data = $this->eventService->fetch($request);

            return ResponseStatus::response(['items' => new IndexCollection($data->items), 'meta' => $data->meta]);
        } catch (Error $err) {
            return ResponseStatus::response(['Message' => $err->getMessage()], 'Server Internal Error', 500);
        }
    }

    public function getOneById(GetEventRequest $request)
    {
        try {
            $data = $this->eventService->find($request?->id);

            return ResponseStatus::response(new DetailResource($data));
        } catch (Error $err) {
            return ResponseStatus::response(['Message' => $err->getMessage()], 'Server Internal Error', 500);
        }
    }
}
