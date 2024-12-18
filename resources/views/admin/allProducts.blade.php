<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
    <title>Admin Panel</title>
</head>
<body>
  <h3>Hello Admin</h3>
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
    <tbody id="products-list">
      @foreach ($products as $product)
        <tr>
          <td>{{$product->id}}</td>
          <td>{{$product->name}}</td>
          <td>{{$product->price}}</td>
          <td>{{$product->quantity}}</td>
          <td>{{$product->category_id}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <form action="{{ url("logout") }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
  </form>

  <br>
  <h2>Add New Product</h2>
  <form id="product-form">
      @csrf
      <input type="text" name="name" placeholder="Name" required><br><br>
      <input type="number" name="price" placeholder="Price" required><br><br>
      <input type="number" name="quantity" placeholder="Quantity" required><br><br>
      <button type="submit">Add Product</button><br><br>
  </form>
  <div id="message"></div>

  <script src="{{ asset("js/bootstrap.min.js") }}"></script>
  <script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        document.getElementById('product-form').addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
    
        fetch('{{ route('store.product') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.product) {
                const tbody = document.getElementById('products-list');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                  <td>${data.product.id}</td>
                  <td>${data.product.name}</td>
                  <td>${data.product.price}</td>
                  <td>${data.product.quantity}</td>
                  <td>${data.product.category_id}</td>
                `;
                tbody.appendChild(newRow);
                    document.getElementById('product-form').reset();
            } else {
                alert('Error adding product');
            }
        })
        .catch(error => console.error('Error:', error));
    });
  </script>
</body>
</html>
