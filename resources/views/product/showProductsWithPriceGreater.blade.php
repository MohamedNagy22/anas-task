<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <title>Product Page</title>
</head>
<body>
  <h3>Products Greater than {{$minPrice}}</h3>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Product_name</th>
        <th scope="col">price</th>
        <th scope="col">quantity</th>
        <th scope="col">category_id</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        @foreach ($product as $products)
        <td>{{$products->id}}</td>
        <td>{{$products->name}}</td>
        <td>{{$products->price}}</td>
        <td>{{$products->quantity}}</td>
        <td>{{$products->category_id}}</td>
    </tr>
    @endforeach
    </tbody>
    <form action="{{url("logout")}}" method="POST">
      @csrf
      <button type="submit" class="btn btn-danger">Lougout</button>
    </form>
      <br>
  </table>
    <script src="{{asset("js/bootstrap.min.js")}}"></script>
</body>
</html>