<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
<div>
    <p>New Product Created Successfully, Here's It's Detail:</p>

    <p>Product Name: {{ $product->name }}</p>
    <p>Product Created by: {{ $product->admin->email }}</p>
    <p>Product Inventory: {{ $product->inventory }}</p>
    <p>Product Price: {{ $product->price }}</p>
</div>
</body>
</html>
