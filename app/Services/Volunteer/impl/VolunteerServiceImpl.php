<?php

namespace App\Services\Volunteer\impl;

use App\Http\Requests\Volunteer\CreateVolunteerRequest;
use App\Http\Requests\Volunteer\DeleteVolunteerRequest;
use App\Http\Requests\Volunteer\GetOneVolunteerRequest;
use App\Http\Requests\Volunteer\UpdateVolunteerRequest;
use App\Models\Volunteer;
use App\Services\Volunteer\VolunteerService;
use App\Shareds\BaseService;

class VolunteerServiceImpl extends BaseService implements VolunteerService
{

    public function __construct(private readonly Volunteer $volunteer)
    {
        parent::__construct($volunteer);
    }

    public function findByEventID(int $id)
    {
        $data = $this->volunteer
                ->with(
                    ['user', 'event']
                )
                ->where('event_id', $id)
                ->get();

        return $data;
    }

    public function show(GetOneVolunteerRequest $request)
    {
        $data = $this->volunteer
                ->with(
                    ['user', 'event']
                )
                ->where('id', $request?->id)
                ->firstOrFail();
            
        return $data;
    }

    public function find(int $id)
    {
        return $this->volunteer
                ->where('id', $id)
                ->firstOrFail();
    }

    public function creates(CreateVolunteerRequest $request)
    {
        $data = $this->volunteer->create($request->all());

        return $data; 
    }

    public function updates(UpdateVolunteerRequest $request)
    {
        $data = $this->find($request->id);
        
        if ($data->user_id != $request->user_id && $data->event_id != $request->event_id) {
            return (object) [
                'data' => null,
                'tradable' => true,
                'Message' => 'Cannot change user while also changing event',
                'statusCode' => 422
            ];
        }
        
        $data->update($request->all());
        
        return $data;
    }
    
    public function deletes(DeleteVolunteerRequest $request)
    {
        $data = $this->find($request->id);
        $data->delete($request->id);

        return $data;
    }
}