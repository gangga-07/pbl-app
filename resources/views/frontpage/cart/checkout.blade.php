<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>



  
<body>

    <form action="{{url('checkout')}}" method="POST">
        <input type="hiden" name="name" value="2"> 
        <input type="hiden" price="price" value="{{('$item->price')}}">
    <button type="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart </button>
</form>


</body>
</html>