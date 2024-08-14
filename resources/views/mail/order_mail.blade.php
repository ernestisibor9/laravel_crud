<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Your Product Details Are Shown Below:</h1>

    <div>
        <ul>
            <li>{{$order['product_name']}}</li>
            <li>{{$order['price']}}</li>
            <li><img src="{{asset($order['product_image'])}}" alt=""></li>
        </ul>
    </div>
</body>
</html>
