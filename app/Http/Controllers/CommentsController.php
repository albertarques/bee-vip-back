<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

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

  public function index_my()
  {

    $user_id = auth()->user()->id;
    $comments = Comment::find($user_id);

    // Verificar que el emprendimiento existe
    if (!$comments) {
      return response()->json([
        'message' => 'Emprendimiento no encontrado'
      ], 404);
    }

    return response()->json([
      'status' => 'success',
      'message' => 'List of your comments',
      'comments' => $comments
    ]);
  }

  public function create(Request $request, $entrepreneurship_id)
  {
    $user_id = auth()->user()->id;
    $request->validate([
      'comment' => 'nullable|string|max:500',       'score' => 'required'
    ]);
    $comment = new Comment;
    $comment->user_id = $user_id;
    $comment->entrepreneurship_id = $entrepreneurship_id;
    $comment->comment = $request->comment;
    $comment->score = $request->score;
    $comment->save();
    return response()->json([
      'status' => 'success',
      'message' => 'Comment created successfully.',
      'comment' => $comment,
    ]);
  }

  public function show($id)
  {
    $comment = Comment::find($id);
    return response()->json([
      'status' => 'success',
      'comments' => $comment
    ]);
  }

  public function update_my(Request $request, $id)
  {
    $comment = Comment::find($id);

    // Verificar que el emprendimiento existe
    if (!$comment) {
      return response()->json([
        'message' => 'Comentario no encontrado.'
      ], 404);
    }

    // Verificar que el usuario está autorizado para borrar el emprendimiento
    if (Auth::user()->id !== $comment->user_id) {
      return response()->json([
        'message' => 'No autorizado para editar este comentario.'
      ], 401);
    }

    $request->validate([
      'score' => 'required|integer|max:5',
      'comment' => 'required|string|max:500',
    ]);

    $comment = Comment::find($id);
    $comment->entrepreneurship_id = $comment->entrepreneurship_id;
    $comment->user_id = $comment->user_id;
    $comment->comment = $request->comment;
    $comment->score = $request->score;
    $comment->save();

    return response()->json([
      'status' => 'success',
      'message' => 'Comment updated successfully.',
      'comment' => $comment,
    ]);
  }

  public function delete_my($id)
  {
    $comment = Comment::find($id);

    // Verificar que el emprendimiento existe
    if (!$comment) {
      return response()->json([
        'message' => 'Comentario no encontrado.'
      ], 404);
    }

    // Verificar que el usuario está autorizado para borrar el emprendimiento
    if (Auth::user()->id !== $comment->user_id) {
      return response()->json([
        'message' => 'No autorizado para editar este comentario.'
      ], 401);
    }

    $comment = Comment::find($id);
    $comment->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'Comment deleted successfully.',
      'comment' => $comment,
    ]);
  }

  public function delete($id)
  {
    $comment = Comment::find($id);

    // Verificar que el emprendimiento existe
    if (!$comment) {
      return response()->json([
        'message' => 'Comentario no encontrado.'
      ], 404);
    }

    $comment = Comment::find($id);
    $comment->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'Comment deleted successfully.',
      'comment' => $comment,
    ]);
  }
}
