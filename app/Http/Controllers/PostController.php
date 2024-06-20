<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Comment;
=======
>>>>>>> origin/master
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Illuminate\Support\Facades\Http;

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
        if (Auth::check()) {
            return view('panel.createpost');
        }
=======

class PostController extends Controller
{
    public function createPost()
    {
        return view('panel.createpost');
>>>>>>> origin/master
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
<<<<<<< HEAD
        if (Auth::check()) {
            $user_id = getUserId();
            $user = User::query()->findOrFail($user_id);
            if ($user->role_id == 1) {
                $post = Post::query()->findOrFail($id);
                $post->delete();
                return redirect()->route('all.post');
            }
        }
=======
        $post = Post::query()->findOrFail($id);
        $post->delete();
        return redirect()->route('all.post');
>>>>>>> origin/master
    }

    public function editPost($id)
    {
<<<<<<< HEAD
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
=======
        $post = Post::query()->findOrFail($id);
//        dd($post);
        return view('panel.editpost')->with(
            [
                'post' => $post,
            ]
        );
>>>>>>> origin/master
    }

    public function updatePost(Request $request, $id)
    {
<<<<<<< HEAD
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
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
//        dd($response);
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
=======
        $post = Post::query()->findOrFail($id);
        $title = $request['title'];
        $content = $request['content'];
        $attr = [
            'title' => $title,
            'content' => $content,
        ];
        $post->update($attr);
        return redirect()->route('all.post');
>>>>>>> origin/master
    }
}
