@extends('tmpl.admin')

@section('_head')
@stop

@section('content')

  <h1 class="page-header">All Products   {{ link_to('/admin/products/cart/add', '+ Add', array('class' => 'btn btn-primary pull-right')) }} </h1>
    @if (Session::has('message'))
       <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
  <div class="row">
       <table class="table table-striped">
            <thead>
            	<tr>
                    <th>#</td>
                    <th>Product Name</th>
                    <th>Summmary</th>
                    <th>Decription</th>
                    <th>Price</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
            
            @foreach($data as $product)           
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->summary }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>
                	@if($product->active == 1)
                    	{{ link_to('/admin/products/cart/active/'.$product->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                    @else
                		{{ link_to('/admin/products/cart/active/'.$product->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                	@endif
                
                </td>
                <td>
                	{{ link_to('/admin/products/cart/edit/'.$product->id, 'Edit', array('class' => 'btn btn-success')) }}
                	{{ link_to('/admin/products/cart/delete/'.$product->id, 'Delete', array('class' => 'btn btn-danger')) }}
                </td>
            </tr>
            @endforeach   
            
            </tbody>
            <tfoot>
            	<tr>
                	<td colspan="20">
                    	Total: {{ $data->count() }} 
                    </td>
               	</tr>
            </tfoot>
       </table> 
        	
  </div>

@stop


@section('_tail')

    
@stop
    