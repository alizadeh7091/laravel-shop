<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function showPost($id)
    {
        $post = Post::query()->findOrFail($id);
        $comments = Comment::query()->where('post_id', $post->id)->get();
        return view('showpost')->with(
            [
                'post' => $post,
                'comments' => $comments
            ]
        );
    }

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
        if (Auth::check()) {
            $user_id = getUserId();
            $user = User::query()->findOrFail($user_id);
            if ($user->role_id == 1) {
                $post = Post::query()->findOrFail($id);
                $post->delete();
                return redirect()->route('all.post');
            }
        }
        $post = Post::query()->findOrFail($id);
        $post->delete();
        return redirect()->route('all.post');
    }

    public function editPost($id)
    {
        if (Auth::check()) {
            $user_id = getUserId();
            $user = User::query()->findOrFail($user_id);
            if ($user->role_id == 1) {
                $post = Post::query()->findOrFail($id);
                return view('panel.editpost')->with(
                    [
                        'post' => $post,
                    ]
                );
            }
        }
    }

    public function updatePost(Request $request, $id)
    {
        if (Auth::check()) {
            $user_id = getUserId();
            $user = User::query()->findOrFail($user_id);
            if ($user->role_id == 1) {
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
    }

    public function insertPosts()
    {
        try {
            $response = Http::get('https://jsonplaceholder.typicode.com/posts');
//            $response = Post::query()->findOrFail(2000000);
//            dd($response);
            $posts = $response->json();
            foreach ($posts as $_post) {
                Post::query()->create(
                    [
                        'user_id' => $_post['userId'],
                        'title' => $_post['title'],
                        'content' => $_post['body']
                    ]
                );
            }
        } catch (\Exception $exception) {
            Log::error('Error inserting posts ' . $exception->getMessage());
            return \response()->json(['massage' => 'failed to insert posts'], 500);
        }


    }
}
