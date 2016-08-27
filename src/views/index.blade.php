<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="Kajifat/SampleProducts/SampleProducts.css">
    <title>Products</title>
</head>
<body>
<div class="container">
    <h1>Products</h1>
    <div class="pull-right">
        <a href="{{route('products.create')}}" class="btn btn-primary">Create Product</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Art</th>
                <th>Name</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->art}}</td>
                    <td>{{$product->name}}</td>
                    <td>
                        <a href="{{route('products.edit', ['id' => $product->id])}}" class="btn btn-primary">Edit</a>
                        @can('delete', Kajifat\SampleProducts\Product::class)
                            <form action="{{route('products.destroy',['id' => $product->id]) }}" method="POST">
                                {{method_field('delete')}}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-primary">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>