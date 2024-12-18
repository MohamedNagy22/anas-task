<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <title>User Page</title>
</head>
<body>
  <h3>Hello User</h3>
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
        @foreach ($products as $product)
        <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->quantity}}</td>
        <td>{{$product->category_id}}</td>
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