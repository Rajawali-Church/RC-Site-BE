<?php

namespace App\Services\Event\impl;

use App\Http\Requests\DataTableRequest;
use App\Http\Requests\Event\AddEventRequest;
use App\Models\Event;
use App\Services\Event\EventService;
use App\Shareds\BaseService;
use App\Shareds\Paginator;

class EventServiceImpl extends BaseService implements EventService
{

    public function __construct(private readonly Event $event)
    {
        parent::__construct($event);
    }

    public function fetch(DataTableRequest $request): Paginator
    {
        $order = $request->order ?? 'desc';
        $sort = $request->sort ?? 'id';

        $queryData = $this->event
                    ->with(
                        [
                            'createdBy' => function ($query) {
                                return $query->select(['id', 'full_name', 'username']);
                            }
                        ]
                    )
                    ->select([
                        'id',
                        'created_by',
                        'name',
                        'description',
                        'date',
                        'type',
                        'note',
                        'created_at',
                        'updated_at'
                    ])
                    ->when($request->search, function ($query) use ($request) {
                        $query->where('name', 'like', "%$request->search%");
                    })
                    ->when($request->type, function ($query) use ($request) {
                        return $query->where('type', $request->type);
                    })
                    ->orderBy($sort, $order);
        
        return Paginator::paginate($queryData, $request->page, $request->per_page);
    }

    public function find(int $id)
    {
        return $this->event
                ->where('id', $id)
                ->with(
                    [
                        'createdBy'
                    ]
                )
                ->firstOrFail();
    }

    public function add(AddEventRequest $request)
    {
        $data = $this->event->create($request->all());
        
        return $data; 
    }
}