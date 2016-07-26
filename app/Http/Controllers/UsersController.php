<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use App\Role;
use Session;
use DB;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function sendEmailReminder(Request $request, $id)
  {
      $user = User::findOrFail($id);

      Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
          $m->from('terry.ferreira@nwu.ac.za', 'IVD IT Support');

          $m->to($user->email, $user->name)->subject('Your Reminder!');
      });
  }

  public function index()
  {
    $pageTitle = 'Users';
    $users = User::all();
    $usersRoles = DB::table('role_user')->get();
    $roles = Role::all();
    return view('admin.users.index', compact('pageTitle', 'users', 'usersRoles', 'roles'));
  }

  public function store(StoreUserRequest $request)
  {
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->api_token = str_random(60);

    $user->save();

    // Assign the 'Customer' role to the new user by default
    $userRole = Role::where('name', '=', 'user')->first();
    $user->attachRole($userRole);

    // Toastr popup upon successful user creation
    Session::flash('status', 'success');
    Session::flash('title', 'User: ' . $request->name);
    Session::flash('message', 'Successfully created');

    return redirect('admin/users');
  }

  public function edit(User $user)
  {
    $pageTitle = 'Edit User - ' . $user->name;
    $usersRoles = DB::table('role_user')->get();
    $roles = Role::all();
    return view('admin.users.edit', compact('pageTitle', 'user', 'usersRoles', 'roles'));
  }

  public function update(UpdateUserRequest $request, User $user)
  {
    if ($request->password != '' && $request->password_confirmation != '') {
      if ($request->password === $request->password_confirmation) {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->update();
      }
    } else {
      $user->name = $request->name;
      $user->email = $request->email;
      $user->update();
    }

    // If only one user is a Super Admin, don't allow the Super Admin to change role
    $usersRole = DB::table('role_user')
                          ->where('user_id', $user->id)
                          ->first();
    $superAdminRole = Role::where('name', '=', 'super-admin')->first();
    $superAdminCount = DB::table('role_user')
                                ->where('role_id', $superAdminRole->id)
                                ->count();

    // Check if the user being edited, is not already a Super Admin
    if ($usersRole->role_id == $superAdminRole->id && $usersRole->role_id != $request->role_id) {
      if ($superAdminCount == 1) {
        // Toastr popup
        Session::flash('status', 'warning');
        Session::flash('title', 'User: ' . $request->name);
        Session::flash('message', 'Cannot change role as there must be one (1) or more users with the role of ' . $superAdminRole->display_name . '.');

        return redirect('/admin/users/' . $user->id . '/edit');
      } else {
        // Update the user's role
        DB::table('role_user')
                 ->where('user_id', $user->id)
                 ->update(['role_id' => $request->role_id]);

        // Toastr popup upon successful user update
        Session::flash('status', 'success');
        Session::flash('title', 'User: ' . $request->name);
        Session::flash('message', 'Successfully updated');
      }
    } else {
      // Update the user's role
      DB::table('role_user')
               ->where('user_id', $user->id)
               ->update(['role_id' => $request->role_id]);

      // Toastr popup upon successful user update
      Session::flash('status', 'success');
      Session::flash('title', 'User: ' . $request->name);
      Session::flash('message', 'Successfully updated');
    }

    return redirect('/admin/users');
  }
}
