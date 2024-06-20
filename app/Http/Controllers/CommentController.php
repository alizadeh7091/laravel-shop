<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function insertComment(Request $request, $id)
    {
        if (Auth::check()) {
            $user_id = getUserId();
//            dd($user_id);
            $post = Post::query()->findOrFail($id);
            Comment::query()->create(
                [
                    'user_id' => $user_id,
                    'post_id' => $post->id,
                    'comment' => $request['comment'],
                ]
            );
        }

    }

}
