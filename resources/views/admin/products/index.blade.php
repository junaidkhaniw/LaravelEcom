@extends('admin.master')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All Products</h2>
            </div>
            <div class="pull-right create_p_b">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>                 
            <th>Image</th>              
            <th>Name</th>               
            <th>SKU</th>                
            <th>Regular Price</th>      
            <th>Sale Price</th>         
            <th>Category</th>           
            <th>Details</th>            
            <th width="280px">Action</th>
        </tr>
        @foreach ($selected_cat as $product) 
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/images/{{ $product->image }}" width="50px"></td>
            <td>{{ $product->pname }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->regular_price }}</td>
            <td>{{ $product->sale_price }}</td>
            <td>{{ $product->cname }}</td>
            <td>{{ $product->details }}</td> 
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST" >
     
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {{-- {!! $products->links() !!} --}}
      
@endsection






































