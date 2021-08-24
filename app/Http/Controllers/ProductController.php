<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =  Product::all();
        return View('pages.products.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('pages.products.create');
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
            'price' => 'required',
            'type' =>'required',
            'name' =>'required'
        ]);
        if($validate){
            $product  = new Product();
            $product->name = $request->input('name');
            $product->type = $request->input('type');
            $product->price = $request->input('price');
            if ($request->file()) {
                $fileName = $request->file('avatar')->getClientOriginalName();
                $filePath = $request->file('avatar')->storeAs('uploads', $fileName, 'public');
                //tham số thứ 3 là chỉ lưu trên disk 'public', tham số thứ 1:  lưu trong thư mục 'uploads' của disk 'public'
                $product->avatar = '/storage/' . $filePath;
                // $filepath='uploads/'+$fileName --> $profile->avatar = 'storage/uploads/tenfile --> đường dẫn hình trong thư mục public
            }
            $affected = DB::table('products')->insert([
                'name' => $product->name,
                'type' => $product->type,
                'price' => $product->price,
                'avatar' =>$product->avatar,
            ]);
            return redirect()->route('products.index');
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
        $product =  DB::table('products')->find($id);
        return View('pages.products.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product =  DB::table('products')->where('id',$id)->first();
        return View('pages.products.edit',['product'=>$product]);
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
        $validate = $request->validate([
            'avatar' => 'nullable|mimes:jpg,jpeg,png,xlx,xls,pdf|max:2048',
            'price' => 'required',
            'name' =>'required',
            'type' =>'required'
        ]);
        if($validate){
            $product = Product::find($id);//eloquent
            $product->name = $request->input('name');
            $product->type = $request->input('type');
            $product->price = $request->input('price');
            $fileName = "";
            if ($request->file()) {
                $fileName = $request->file('avatar')->getClientOriginalName();
                $filePath = $request->file('avatar')->storeAs('uploads', $fileName, 'public');
                //tham số thứ 3 là chỉ lưu trên disk 'public', tham số thứ 1:  lưu trong thư mục 'uploads' của disk 'public'
                $product->avatar = '/storage/' . $filePath;
                // $filepath='uploads/'+$fileName --> $profile->avatar = 'storage/uploads/tenfile --> đường dẫn hình trong thư mục public
            }
            $product->save();
            return  View('pages.products.show',['product'=>$product]);
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
        DB::table('products')->where('id', '=', $id)->delete();
        return redirect()->route('products.index');
    }
}
