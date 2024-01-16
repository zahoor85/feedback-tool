<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    //
    public function index(Request $request)
    {
    }

    public function store(CommentStoreRequest $request)
    {
        $user = Auth::user();
        $request['user_id'] = $user->id;
        $comments = Comment::create($request->all());
        return new CommentResource($comments);
    }
}
