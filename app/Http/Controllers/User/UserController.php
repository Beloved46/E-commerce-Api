<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->successResponse('users retrieved successfullly', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'verified' => User::UNVERIFIED_USER,
            'verification_token' => User::generateVerificationCode(),
            'admin' => User::REGULAR_USER,
        ]);
        return response()->json(['data' => $user], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json(['data' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        if($request->has('name'))
        {
            $user->name = $validated['name'];
        }
        if($request->has('email') && $user->email != $validated['email'])
        {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $validated['email'];
        }

        if($request->has('password'))
        {
            $user->password = Hash::make($validated['password']);
        }
        if($request->has('admin')){
            if(!$user->isVerified())
            {
                return response()->json(['error' => 'Only verified user can modify this field', 'code' => 409], 409);
            }
            $user->admin = $validated['admin'];
        }
        if($user->isDirty())
        {
            return response()->json(['error' => 'You need to specify a different value to update', 'code' => 422], 422);
        }

        $user->save();

        return response()->json(['data' => $user], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['data' => $user], 200);
    }
}
