<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id =  request()->query('user_id');
        return View('pages.profiles.add',['user_id'=>$user_id]);
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
            'avatar' => 'nullable|mimes:jpg,jpeg,png,xlx,xls,pdf|max:2048',
            'birthday'=>'nullable|date',
            'phone' => 'required',
            'full_name' =>'required',
            'address' =>'required'
        ]);
        if($validate){
            $user =  DB::table('users')->where('id',$request->input('user_id'))->first();
            if($user ==  null){
                return View('pages.failed');
            }
            $profile  = new Profile();
            $profile->full_name = $request->input('full_name');
            $profile->user_id = $user->id;
            $profile->phone = $request->input('phone');
            $profile->address = $request->input('address');
            $profile->birthday = $request->input('birthday');
            if ($request->file()) {
                $fileName = $request->file('avatar')->getClientOriginalName();
                $filePath = $request->file('avatar')->storeAs('uploads', $fileName, 'public');
                //tham số thứ 3 là chỉ lưu trên disk 'public', tham số thứ 1:  lưu trong thư mục 'uploads' của disk 'public'
                $profile->avatar = '/storage/' . $filePath;
                // $filepath='uploads/'+$fileName --> $profile->avatar = 'storage/uploads/tenfile --> đường dẫn hình trong thư mục public
            }
            $affected = DB::table('profiles')->insert([
                'full_name' => $profile->full_name,
                'user_id' =>$profile->user_id,
                'phone' => $profile->phone,
                'address' => $profile->address,
                'avatar' => $profile->avatar,
                'birthday' => $profile->birthday
            ]);
            return View('pages.profiles.show',['profile'=>$profile]);
        }
        return back()->with('error','cap nhat that bai');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile =  DB::table('profiles')->where('user_id',$id)->first();
        $user =  DB::table('users')->where('id',$id)->first();
        if($profile == null){
            return  View('pages.profiles.nothing',['user_id' => $id,'user'=>$user]);
        }
        return View('pages.profiles.show',['profile'=>$profile,'user_id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile =  DB::table('profiles')->where('user_id',$id)->first();
        return View('pages.profiles.edit',['profile'=>$profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'avatar' => 'nullable|mimes:jpg,jpeg,png,xlx,xls,pdf|max:2048',
			'birthday'=>'nullable|date',
            'phone' => 'required',
            'full_name' =>'required',
            'address' =>'required'
        ]);
        if($validate){
            $profile = Profile::find($id);//eloquent
            $profile->full_name = $request->input('full_name');
            $profile->address = $request->input('address');
            $profile->phone = $request->input('phone');
            $profile->birthday = $request->input('birthday');
            $fileName = "";
            if ($request->file()) {
                $fileName = $request->file('avatar')->getClientOriginalName();
                $filePath = $request->file('avatar')->storeAs('uploads', $fileName, 'public');
                //tham số thứ 3 là chỉ lưu trên disk 'public', tham số thứ 1:  lưu trong thư mục 'uploads' của disk 'public'
                $profile->avatar = '/storage/' . $filePath;
                // $filepath='uploads/'+$fileName --> $profile->avatar = 'storage/uploads/tenfile --> đường dẫn hình trong thư mục public
            }
            $profile->save();
            return  View('pages.profiles.show',['profile'=>$profile,'user_id'=>$id]);
        }
        return back()->with('error','cap nhat that bai');
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
