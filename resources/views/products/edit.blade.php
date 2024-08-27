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
                <a href="{{ route('products.index')}}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark text-white">
                        <h3>Edit Products</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('products.update', $product->id )}}" method="post">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-table h5">Name</label>
                                <input type="text" value="{{ old('name', $product->name ) }}" name="name"
                                    class="@error('name') is-invalid @enderror form-control" placeholder="Name">
                                @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-table h5">Sku</label>
                                <input type="text" value="{{ old('sku', $product->sku ) }}" name="sku"
                                    class="@error('sku') is-invalid @enderror form-control" placeholder="Sku">
                                @error('sku')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-table h5">Price</label>
                                <input type="number" value="{{ old('price', $product->price ) }}" name="price"
                                    class="@error('price') is-invalid @enderror form-control" placeholder="Price">
                                @error('price')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label h5">Description</label>
                                <textarea class="form-control" placeholder="Description" name="description" id="exampleFormControlTextarea1" rows="3">{{ old('description', $product->description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-table h5">Image</label>
                                <input type="file" name="image" class="form-control">
                                @if ($product->image != "")
                                <img class="w-25" src="{{ asset('uploads/products/'.$product->image) }}" alt="product-image">
                                @endif
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>