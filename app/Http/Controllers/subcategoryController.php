<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Http\Resources\Subcategories\subcategoryResource;
use Validator;

class subcategoryController extends Controller
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
    public function store(Request $req)
    {
        $rules = array(
            "category_id" => "required",
            "name" => "required",
            "description" => "required"
        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()) {
            return $validator->errors();
        }
        else {
            $category = Category::find($req->category_id);
            $subcategory = new subCategory;
            //$subcategory->category_id = $req->category_id;
            $subcategory->name = $req->name;
            $subcategory->description = $req->description;
            //$result = $subcategory->save();
            $result = $category->subcategory()->save($subcategory);
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
    public function show(Subcategory $subcategory)
    {
        return new subcategoryResource($subcategory);
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
    public function update(Request $req, $id)
    {
        $subcategory = subCategory::find($id);
        $subcategory->category_id = $req->category_id;
        $subcategory->name = $req->name;
        $subcategory->description = $req->description;
        $result = $subcategory->save();
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
        $subcategory = Subcategory::find($id);
        $result = $subcategory->delete();
        if($result) {
            return "Record has been Deleted";
        }
        else {
            return "Delete operation has been failed!";
        }
    }
}
