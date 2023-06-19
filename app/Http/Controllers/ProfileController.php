<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roles = Role::pluck('role', 'id');
        return view('profile.index', compact(['user', 'roles']));
    }
    public function update(UpdateUserRequest $request)
    {
        $id = Auth::id();
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('profile.index'));
        }
        $input = $request->all();
        if (!is_null($request->password)) {
            $input['password'] = bcrypt($input['password']);
        } else
            unset($input['password']);
        $user->fill($input);
        $user->save();

        Flash::success('User updated successfully.');

        return redirect(route('profile.index'));
    }
}