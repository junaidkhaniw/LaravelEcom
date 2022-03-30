@extends('admin.master')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All Orders</h2>
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
            <th>Product Name</th>
            <th>Slug</th>
            <th width="280px">Action</th>
        </tr>
        {{-- @foreach ($data as $category) --}}
        <tr>
            <td>1</td>
            <td>JK</td>
            <td>jk</td>
            <td>
                <form action="" method="POST" >
   
                    <a class="btn btn-info" href="">Show</a>
    
                    <a class="btn btn-primary" href="">Edit</a>
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        {{-- @endforeach --}}
    </table>
  
    {{-- {!! $data->links() !!} --}}
      
@endsection