<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Categories\CategoryCollection;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::all())->response();
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
    public function store(Request $req)
    {
        $rules = array(
            "name" => "required",
            "description" => "required"
        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()) {
            return $validator->errors();
        }
        else {
            $category = new Category;
            $category->name = $req->name;
            $category->description = $req->description;
            $result = $category->save();
            if($result) {
                return ["Result"=>"Data has been saved"];
            }
            else {
                return ["Result"=>"Operation failed"];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
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
        $category = Category::find($id);
        $category->name = $req->name;
        $category->description = $req->description;
        $result = $category->save();
        if($result) {
            return ["Result"=>"Updated Successfully!"];
        }
        else {
            return ["Result"=>"Update operation has been failed!"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $result = $category->delete();
        if($result) {
            return "Record has been Deleted";
        }
        else {
            return "Delete operation has been failed!";
        }
    }
}
