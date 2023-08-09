<?php

namespace App\Services\Event;

use App\Http\Requests\DataTableRequest;

interface EventService
{
    public function fetch(DataTableRequest $request);
}