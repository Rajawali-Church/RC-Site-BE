<?php

namespace App\Services\Event;

use App\Http\Requests\DataTableRequest;
use App\Http\Requests\Event\AddEventRequest;
use App\Http\Requests\Event\DeleteEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;

interface EventService
{
    public function fetch(DataTableRequest $request);
    public function find(int $id);
    public function add(AddEventRequest $request);
    public function updates(UpdateEventRequest $request);
    public function deletes(DeleteEventRequest $request);
}