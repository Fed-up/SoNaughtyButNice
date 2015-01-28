@extends('tmpl.admin')

@section('_head')
@stop

@section('content')

  <h1 class="page-header">All Packages   {{ link_to('/admin/products/catering/packages/add', '+ Add', array('class' => 'btn btn-primary pull-right')) }} </h1>
    @if (Session::has('message'))
       <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
  <div class="row">
       <table class="table table-striped">
            <thead>
            	<tr>
                    <th>#</td>
                    <th>Package Name</th>
                    <th>Summmary</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Active</th>
                    <th>Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
            
            @foreach($data as $package)           
            <tr>
                <td>{{ $package->id }}</td>
                <td>{{ $package->name }}</td>
                <td>{{ $package->summary }}</td>
                <td>{{ $package->package_type }}</td>
                <td>{{ $package->quantity }}</td>
                <td>${{ $package->price }}</td>
                <td>
                	@if($package->active == 1)
                    	{{ link_to('/admin/products/catering/packages/active/'.$package->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                    @else
                		{{ link_to('/admin/products/catering/packages/active/'.$package->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                	@endif
                
                </td>
                <td>
                	{{ link_to('/admin/products/catering/packages/edit/'.$package->id, 'Edit', array('class' => 'btn btn-success')) }}
                	{{ link_to('/admin/products/catering/packages/delete/'.$package->id, 'Delete', array('class' => 'btn btn-danger')) }}
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
    