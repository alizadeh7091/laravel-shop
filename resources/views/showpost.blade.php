<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            /*direction: rtl;*/
        }

        .container {
            width: 60%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .post {
            margin-bottom: 20px;
        }

        .post-id {
            font-size: 14px;
            color: #888;
        }

        .post-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .post-content {
            font-size: 18px;
            line-height: 1.6;
        }

        .comment-section h3 {
            margin-bottom: 10px;
        }

        .comments {
            margin-bottom: 20px;
        }

        .comment {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .comment p {
            margin: 5px 0;
        }

        .comment .comment-id {
            font-size: 14px;
            color: #888;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        button {
            display: inline-block;
            padding: 10px 20px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #218838;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="post">
        <div class="post-id">{{$post->id}}</div>
        <h2 class="post-title">{{$post->title}}</h2>
        <p class="post-content">{{$post->content}}</p>
    </div>
    <div class="comment-section">
        <h3>comment please</h3>
        <form action="{{route('insert.comment',$post->id)}}" method="post">
            @csrf
            <textarea name="comment" id="comment" rows="4" placeholder="your comment"></textarea>
            <button>submit</button>
        </form>
    </div>

    <div class="comments">
        <h3>Comments</h3>
        @foreach($comments as $_comment)
            <div class="comment">
                <div class="comment-id">User : {{$_comment->user_id}}</div>
                <p>{{$_comment->comment}}</p>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
