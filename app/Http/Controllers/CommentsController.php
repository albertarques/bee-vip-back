<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    // public function index($entrepreneurship_id)
    // {
    //     $comments = Comment::all();
    //     return response()->json([
    //         'status' => 'success',
    //         'comments' => $comments,
    //     ]);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'entrepreneurship_id' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'score' => 'required|integer|max:1',
            'comment' => 'required|longText|max:500',
        ]);

        $comment = Comment::create([
            'entrepreneurship_id' => $request->entrepreneurship_id,
            'user_id' => $request->user_id,
            'score' => $request->score,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'comment created successfully',
            'comment' => $comment,
        ]);
    }

    public function show($id)
    {
        $comment = Comment::find($id);
        return response()->json([
            'status' => 'success',
            'comments' => $comment,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'entrepreneurship_id' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'score' => 'required|integer|max:1',
            'comment' => 'required|longText|max:500',
        ]);

        $comment = Comment::find($id);
        $comment->entrepreneurship_id = $request->entrepreneurship_id;
        $comment->user_id = $request->user_id;
        //$comment->score = $request->score;
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'comment updated successfully',
            'comment' => $comment,
        ]);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'comment deleted successfully',
            'comment' => $comment,
        ]);
    }
}
