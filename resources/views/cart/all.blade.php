<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>products</title>
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

        .pay-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 20px;
            cursor: pointer;
            font-size: 1.2em;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: block;
            margin: 20px auto;
            text-align: center;
        }

        .pay-button:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: white;
        }

        .discount-container {
            width: 80%;
            margin: 20px auto;
            text-align: center;
        }

        .discount-input {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 70%;
            margin-right: 10px;
        }

        .discount-button {
            background-color: #ffc107;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 1em;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .discount-button:hover {
            background-color: #e0a800;
        }

    </style>
</head>
<body>
<div class="table-container">
    <table>
        <thead>
        <tr>
            <th>name</th>
            <th>price</th>
            <th>quantity</th>
            <th>total price</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($cart_items as $_cart_item)
            <tr>
                <td>{{null}}</td>
                <td>{{$_cart_item->price}}</td>
                <td>{{$_cart_item->quantity}}</td>
                <td>{{$_cart_item->amount}}</td>
                <td>
                    <form action="{{route('delete.cart.item',$_cart_item->product_id)}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$_cart_item->product_id}}" name="id">
                        <button class="order-button">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3" style="text-align: right; font-weight: bold;">Total:</td>
            <td>{{ $total_price_sum }}</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: right; font-weight: bold;">Total with discount:</td>
            <td id="total_with_discount"></td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="discount-container">
    <form id="form" method="post">
        @csrf
        <input type="text" name="discount_code" class="discount-input" placeholder="Enter discount code">
        <button type="submit" class="discount-button">Apply</button>
    </form>
    <div id="response"></div>
</div>

<form action="{{route('add.order')}}" method="post">
    @csrf
    <button class="pay-button">pay</button>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('apply.discount') }}",
                method: "POST",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // console.log(response);
                    $('#response').html('<p>' + response.message + '</p>');
                    $('#total_with_discount').text(response.total_with_discount);
                },
                error: function (xhr) {
                    $('#response').html('<p>An error occurred: ' + xhr.responseText + '</p>');
                }
            });
        });
    });
</script>
</body>
</html>
