<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Volunteer\CreateVolunteerRequest;
use App\Http\Requests\Volunteer\DeleteVolunteerRequest;
use App\Http\Requests\Volunteer\GetOneVolunteerRequest;
use App\Http\Requests\Volunteer\GetVolunteerByEventRequest;
use App\Http\Requests\Volunteer\UpdateVolunteerRequest;
use App\Http\Resources\Voluteer\DetailVolunteerResource;
use App\Http\Resources\Voluteer\GetManyVolunteerCollection;
use App\Services\Volunteer\VolunteerService;
use App\Shareds\ResponseStatus;
use Error;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function __construct(
        private VolunteerService $volunteerService,
    )
    {
    }

    public function findByID() {
        
    }

    public function findByEventID(GetVolunteerByEventRequest $request) {
        try {
            $data = $this->volunteerService->findByEventID($request?->id);

            return ResponseStatus::response(new GetManyVolunteerCollection($data));
        } catch (Error $err) {
            return ResponseStatus::response(['Message' => $err->getMessage()], 'Server Internal Error', 500);
        }
    }

    public function show(GetOneVolunteerRequest $request) {
        try {
            $data = $this->volunteerService->show($request);

            return ResponseStatus::response(new DetailVolunteerResource($data));
        } catch (Error $err) {
            return ResponseStatus::response(['Message' => $err->getMessage()], 'Server Internal Error', 500);
        }
    }

    public function create(CreateVolunteerRequest $request) {
        try {
            $data = $this->volunteerService->creates($request);

            return ResponseStatus::response(new DetailVolunteerResource($data));
        } catch (Error $err) {
            return ResponseStatus::response(['Message' => $err->getMessage()], 'Server Internal Error', 500);
        }
    }

    public function update(UpdateVolunteerRequest $request) {
        try {
            $data = $this->volunteerService->updates($request);

            if ($data?->statusCode == 422) 
                return ResponseStatus::response($data, 'Unprocessable', $data->statusCode);

            return ResponseStatus::response(new DetailVolunteerResource($data));
        } catch (Error $err) {
            return ResponseStatus::response(['Message' => $err->getMessage()], 'Server Internal Error', 500);
        }
    }

    public function delete(DeleteVolunteerRequest $request) {
        try {
            $data = $this->volunteerService->deletes($request);

            return ResponseStatus::response(new DetailVolunteerResource($data));
        } catch (Error $err) {
            return ResponseStatus::response(['Message' => $err->getMessage()], 'Server Internal Error', 500);
        }
    }
}
