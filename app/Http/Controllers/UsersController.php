<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{
  public function sendEmailReminder(Request $request, $id)
    {
        $user = User::findOrFail($id);

        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $m->from('terry.ferreira@nwu.ac.za', 'IVD IT Support');

            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });
    }
}
