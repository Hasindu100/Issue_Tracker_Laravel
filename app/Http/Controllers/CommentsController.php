<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Issue;
use App\Http\Resources\Comments\CommentsResource;
use Validator;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CommentsResource::collection(Comment::all())->response();
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
            "issue_id" => "required",
            "body" => "required"
        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()) {
            return $validator->errors();
        }
        else {
            $issue = Issue::find($req->issue_id);
            $comments = new Comment;
            //$comments->issue_id = $req->issue_id;
            $comments->body = $req->body;
            //$result = $comments->save();
            $result = $issue->comments()->save($comments);
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
    public function show(Comment $comment)
    {
        return new CommentsResource($comment);
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
        $comment = Comment::find($id);
        $comment->issue_id = $req->issue_id;
        $comment->body = $req->body;
        $result = $comment->save();
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
        $comment = Comment::find($id);
        $result = $comment->delete();
        if($result) {
            return "Record has been Deleted";
        }
        else {
            return "Delete operation has been failed!";
        }
    }
}
