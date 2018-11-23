<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use Auth;
use App\User;

class UsersController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->isAdmin()) {
            $userData = User::all();
        } else {
            return $this->sendError('Forbidden.', ['You cannot access all user data'], Response::HTTP_FORBIDDEN);
        }

        return $this->sendResponse($userData, Response::HTTP_OK);
    }

    /**
     * Return the current user's information
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        $userData = User::find(Auth::id());
        return $this->sendResponse($userData, Response::HTTP_OK);
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
            $userData = User::find($id);
        } else if ($id == Auth::id()) {
            $userData = User::find(Auth::id());
        } else {
            return $this->sendError('Forbidden.', ['You cannot access this user\'s data'], Response::HTTP_FORBIDDEN);
        }
        return $this->sendResponse($userData, Response::HTTP_OK);
    }
}
