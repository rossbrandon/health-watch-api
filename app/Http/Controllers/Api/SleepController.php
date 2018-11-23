<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use App\Sleep;
use Auth;

class SleepController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->isAdmin()) {
            $sleepData = Sleep::all();
        } else {
            $sleepData = Sleep::where('user_id', Auth::id())->get();
        }
        return $this->sendResponse($sleepData, Response::HTTP_OK);
    }

    /**
     * Return the current user's sleep information
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        $sleepData = Sleep::where('user_id', Auth::id())->get();
        return $this->sendResponse($sleepData, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->isAdmin()) {
            $sleepData = Sleep::find($id);
        } else if (Auth::id() == Sleep::find($id)->user_id) {
            $sleepData = Sleep::find($id);
        } else {
            return $this->sendError('Forbidden.', ['You cannot access this user\'s data'], Response::HTTP_FORBIDDEN);
        }
        return $this->sendResponse($sleepData, Response::HTTP_OK);
    }
}
