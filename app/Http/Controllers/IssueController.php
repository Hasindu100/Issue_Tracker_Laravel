<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Http\Resources\Issues\IssueResource;
use App\Http\Resources\Issues\IssueCollection;
use Validator;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        //return ["result"=>"data list"];
        //$issues = Issue::all();
        //return IssueCollection::collection($issues);
        return IssueResource::collection(Issue::all())->response();
        //CommentsResource::collection(Comment::all())->response();
        //return  IssueCollection::collection($issue);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        
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
            "title" => "required",
            "body" => "required"
        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()) {
            return $validator->errors();
        }
        else {
            $issue = new Issue;
            $issue->title = $req->title;
            $issue->body = $req->body;
            $issue->uuid = $req->uuid;
            $issue->slug = $req->slug;
            $result = $issue->save();
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
    public function show(Issue $issue)
    {
        return new IssueResource($issue);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $issue = Issue::find($id);
        $issue->title = $req->title;
        $issue->body = $req->body;
        $issue->uuid = $req->uuid;
        $issue->slug = $req->slug;
        $result = $issue->save();
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
        $issue = Issue::find($id);
        $result = $issue->delete();
        if($result) {
            return "Record has been Deleted";
        }
        else {
            return "Delete operation has been failed!";
        }
    }
}
