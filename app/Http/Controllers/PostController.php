<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function createPost()
    {
        return view('panel.createpost');
    }

    public function allPost()
    {
        $posts = Post::all();
        return view('panel.allpost')->with(
            [
                'posts' => $posts,
            ]
        );
    }

    public function insertPost(Request $request)
    {
        if (Auth::check()) {
            $user_id = getUserId();
            $user = User::query()->findOrFail($user_id);
            if ($user->role_id == 1) {
                $title = $request['title'];
                $content = $request['content'];
                $image = $request['image'];
                Post::query()->create(
                    [
                        'user_id' => $user_id,
                        'title' => $title,
                        'content' => $content,
                        'image' => $image
                    ]
                );
            }
        } else {
            //
        }
    }

    public function deletePost($id)
    {
        $post = Post::query()->findOrFail($id);
        $post->delete();
        return redirect()->route('all.post');
    }

    public function editPost($id)
    {
        $post = Post::query()->findOrFail($id);
//        dd($post);
        return view('panel.editpost')->with(
            [
                'post' => $post,
            ]
        );
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::query()->findOrFail($id);
        $title = $request['title'];
        $content = $request['content'];
        $attr = [
            'title' => $title,
            'content' => $content,
        ];
        $post->update($attr);
        return redirect()->route('all.post');
    }
}
