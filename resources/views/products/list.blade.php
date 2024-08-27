<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="text-center my-3">
        <h1>Products</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.create')}}" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-3">
            @if(Session::has('success'))
            <div class="col-md-10">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session::get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif


            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark text-white">
                        <h3>Products</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>    </th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            @if($products->isNotEmpty())
                                @php {{$sno = 0;}}  @endphp
                                @foreach ($products as $product)

                               @php {{$sno++;}} @endphp
                                <tr>
                                    <td> {{  $sno }} </td>
                                    <td>   

                                    @if ($product->image != "")
                                    <img width="50px;" src="{{ asset('uploads/products/'.$product->image) }}" alt="product-image">
                                    @endif

                                    </td>   
                                    <td> {{ $product->name}} </td>
                                    <td> {{ $product->sku}} </td>
                                    <td> {{ $product->price}} </td>
                                    <td> {{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y')}} </td>
                                    <td> <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>

                                        <a href="javascript:void(0);" onclick="deleteProduct({{$product->id}})" class="btn btn-danger">Delete</a>
                                        <form id="delete-product-from-{{ $product->id }}" action="{{ route('products.destroy', $product->id )}}" method="post">
                                            @csrf
                                            @method('delete')</form>
                                        @csrf
                                        @method('delete')
                                     </td>
    
                                </tr>
                                    
                                @endforeach

                            @endif
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>

<script>

    function deleteProduct(id){

        if(confirm("Are you sure you want to delete this product?")){

            document.getElementById("delete-product-from-"+id).submit();
        }
    }
</script>