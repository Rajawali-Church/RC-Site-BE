<?php

namespace App\Services\Volunteer;

use App\Http\Requests\Volunteer\CreateVolunteerRequest;
use App\Http\Requests\Volunteer\DeleteVolunteerRequest;
use App\Http\Requests\Volunteer\GetOneVolunteerRequest;
use App\Http\Requests\Volunteer\UpdateVolunteerRequest;

interface VolunteerService
{
    public function findByEventID(int $id);
    public function creates(CreateVolunteerRequest $request);
    public function show(GetOneVolunteerRequest $request);
    public function updates(UpdateVolunteerRequest $request);
    public function deletes(DeleteVolunteerRequest $request);
}