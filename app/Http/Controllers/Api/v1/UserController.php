<?php

namespace App\Http\Controllers\Api\v1;

use Throwable;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Api\ApiController;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::all();

            if ($users->isEmpty()) {
                return $this->failed('Users not found', Response::HTTP_NOT_FOUND);
            }

            return $this->successful(UserResource::collection($users), Response::HTTP_OK, 'Users fetched');

        } catch (Throwable $th) {
            return $this->failed($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create($request->validated());

            return $this->successful(new UserResource($user), Response::HTTP_CREATED, 'User created successfully');

        } catch (Throwable $th) {
            return $this->failed($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {
            return $this->successful(new UserResource($user), Response::HTTP_OK, 'User data');

        } catch (Throwable $th) {
            return $this->failed($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update($request->validated());

            return $this->successful(new UserResource($user), Response::HTTP_OK, 'User updated successfully');

        } catch (Throwable $th) {
            return $this->failed($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            return $this->successful([], Response::HTTP_OK, 'User deleted successfully');

        } catch (Throwable $th) {
            return $this->failed($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
