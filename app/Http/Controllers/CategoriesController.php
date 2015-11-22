<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Categories;
use Validator;

class CategoriesController extends Controller
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
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }


    public function getCreate(){
        $page_title = 'Add Category';

        $categories = Categories::all();

        $data = compact('page_title','categories');
        return view('categories.create',$data);

    }

    public function postCreate(Request $request){
        $page_title = 'Add Category';
        

        $all = $request->all();
        $validator = Validator::make($all, [
            'name' => 'required|max:255|unique:categories,name'
        ]);



        if ($validator->fails()) {

            $categories = Categories::all();
            $data = compact('page_title','categories');

            return view('categories.create',$data)
                ->withErrors($validator->errors());
   
        }

        Categories::create([
            'name' => $all['name']
        ]); 

        return redirect(route('getCategoryCreate'));       

    }

    public function getAllCategory(){
        $page_title = 'All Categories';
        $categories = Categories::all();
        $data = compact('page_title','categories');
        return view('categories.index',$data);


    }
}
