<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Queue;
use App\Models\Follow;
use Auth;
class UserController extends Controller
{
    public function dashboard()
    {
        $queues = Queue::where('user_id', Auth::user()->id)->get();
        return view('dashboard', ['queues' => $queues]);
    }

    public function index($username)
    {
        $user = User::where('username', $username)->first(); 
        $count = $user->count();
        if($count == 1)
            return view('user.profile',['user'=>$user, 'users' => User::where('id', '!=', Auth::id())->get(), 'followers' => Follow::where('target_id', $user->id)->count(),
            'following' => Follow::where('user_id', $user->id)->count()]);
        else
            return view('error.404');
    }

    public function update()
    {
        return view('user.edit');
    }

    public function infoUpdate(Request $request)
    {
        $data = User::find(Auth::user()->id);

        $data->firstname  = $request->firstname;
        $data->lastname  = $request->lastname;
        $data->bio  = $request->bio;
        $data->company  = $request->company;
        $data->location  = $request->location;

        if ($data->save()) {

            $request->session()->flash('alert-green', 'New Subject Successfully added...');
            return redirect()->back();
        }
        else
        {
            $request->session()->flash('alert-red', 'New Subject adding failed. Try again...');
            return redirect()->back();
        }

    }

    public function imageRemove()
    {
        $data = User::find(Auth::user()->id);

        $data->profile_image = '';

        if ($data->save()) {
            return redirect()->back();
        }
    }

    public function imageUpdate(Request $request)
    {
        if($request->hasFile('profile_image')){
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('profile_image')->move('uploads/images/users', $fileNameToStore);
        } else {
            $fileNameToStore = null;
        }

        $data = User::find(Auth::user()->id);

        $data->profile_image = $fileNameToStore;

        if ($data->save()) {

            $request->session()->flash('alert-green', 'New Subject Successfully added...');
            return redirect()->back();
        }
        else
        {
            $request->session()->flash('alert-red', 'New Subject adding failed. Try again...');
            return redirect()->back();
        }
    }

    public function darkMode(Request $request, $state)
    {
        $data = User::find(Auth::user()->id);
        if($state == 'enable')
            $data->isDark = 1;
        else if($state == 'disable')
            $data->isDark = 0;
        else
            return redirect()->back();

        if ($data->save())
            return redirect()->back();
    }

    public function store(Request $request) {

        $request->validate(
            [
                'username'          =>      'required|string|max:30|unique:users',
                'email'             =>      'required|email|unique:users,email',
                'password'          =>      'required|alpha_num|min:6',
            ]
        );

        $dataArray      =       array(
            "username"      =>          $request->username,
            "email"         =>          $request->email,
            "firstname"     =>          $request->username,
            "lastname"      =>          $request->username,
            "password"      =>          Hash::make($request->password)
        );

        $user  =  User::create($dataArray);

        if(!is_null($user)) {
            return back()->with("success", "Success! Registration completed");
        }

        else {
            return back()->with("failed", "Alert! Failed to register");
        }
    }
}
