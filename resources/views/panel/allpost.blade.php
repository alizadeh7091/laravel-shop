<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: right;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .table-container {
            width: 80%;
            margin: 50px auto;
            overflow-x: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #007bff;
            color: #fff;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            font-size: 1.2em;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .order-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 7px 17px;
            cursor: pointer;
            font-size: 1em;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .order-button:hover {
            background-color: #218838;
        }

        .cart-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 15px 30px;
            cursor: pointer;
            font-size: 1.2em;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: block;
            margin: 20px auto;
            text-align: center;
        }

        .cart-button:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: white;
        }

    </style>
</head>
<body>
<div class="table-container">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>title</th>
            <th>content</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $_post)
            <tr>
                <td>{{$_post->id}}</td>
                <td>{{$_post->title}}</td>
                <td>{{$_post->content}}</td>
                <td>
                    <form action="{{route('delete.post',$_post->id)}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$_post->id}}">
                        <button class="order-button">delete</button>
                    </form>
                    <br>
                    <a href="{{route('edit.post',$_post->id)}}">
                        <button class="order-button">edit</button>
                    </a>
                    {{--                    <form action="{{route('edit.post',$_post->id)}}" method="post">--}}
                    {{--                        @csrf--}}
                    {{--                        <input type="hidden" value="{{$_post->id}}">--}}
                    {{--                        <button class="order-button">edit</button>--}}
                    {{--                    </form>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{--<button class="cart-button"><a href="{{route('all.cart.items')}}">show cart</a></button>--}}
</body>
</html>
