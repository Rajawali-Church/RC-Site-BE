<?php

namespace App\Services\Event;

use App\Http\Requests\DataTableRequest;
use App\Http\Requests\Event\GetEventRequest;

interface EventService
{
    public function fetch(DataTableRequest $request);
    public function find(int $id);
}