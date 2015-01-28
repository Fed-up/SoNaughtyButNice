@extends('tmpl.admin')

@section('_head')
@stop

@section('content')

  <h1 class="page-header">All Headers   {{ link_to('/admin/website/header/add', '+ Add', array('class' => 'btn btn-primary pull-right')) }} </h1>
  @if (Session::has('message'))
       <div class="alert alert-danger">{{ Session::get('message') }}</div>
  @endif
  <div class="row">
       <table class="table table-striped">
            <thead>
            	<tr>
                    <th>#</td>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Active</th>
                    <th>Edit / Delete</th>
                </tr>
            </thead>
            <tbody>
            
            @foreach($header as $h)           
            <tr>
                <td>{{ $h->id }}</td>
                <td>{{ $h->name }}</td>
                <td>{{ $h->link }}</td>
                <td>
                	@if($h->active == 1)
                    	{{ link_to('/admin/website/header/active/'.$h->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                    @else
                    	{{ link_to('/admin/website/header/active/'.$h->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                    @endif
                </td>
                <td>
                	{{ link_to('/admin/website/header/edit/'.$h->id, 'Edit', array('class' => 'btn btn-success')) }}
                	{{ link_to('/admin/website/header/delete/'.$h->id, 'Delete', array('class' => 'btn btn-danger')) }}
                </td>
            </tr>
            @endforeach   
            
            </tbody>
            <tfoot>
            	<tr>
                	<td colspan="20">
                    	Total: {{ $header->count() }} 
                    </td>
               	</tr>
            </tfoot>
       </table> 
        	
  </div>

@stop


@section('_tail')

    
@stop
    