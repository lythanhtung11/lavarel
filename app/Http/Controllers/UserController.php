<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use function Sodium\add;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->where('role_id','>',1)->get();
        return View('pages.users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('pages.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email'=>'required',
            'password' => 'required'
        ]);
        if($validate){
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role_id = $request->input('role');
            $user->password = Hash::make($request->input('password'));
            $affected = DB::table('users')->insert([
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'password' => $user->password
            ]);
            return redirect()->route('users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =  DB::table('users')->find($id);
        return View('pages.users.profiles',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  DB::table('users')->where('id',$id)->first();
        return View('pages.users.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();
        DB::table('profiles')->where('user_id','=',$id)->delete();
        return redirect()->route('users.index');
    }
}
