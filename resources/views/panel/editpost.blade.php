<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            resize: vertical; /* Allow vertical resizing of textarea */
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }


    </style>
</head>
<body>
<div class="container">
    <h1>new post</h1>
    <form action="{{route('update.post',$post->id)}}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="title">title:</label>
            <input type="text" id="title" name="title" value="{{old('title',$post->title)}}" required>
        </div>
        <div class="form-group">
            <label for="content">content:</label>
            <textarea id="content" name="content" rows="8" required>{{old('content',$post->content)}}</textarea>
        </div>
        <div class="form-group">
            <button type="submit">submit</button>
        </div>
    </form>
</div>
</body>
</html>
