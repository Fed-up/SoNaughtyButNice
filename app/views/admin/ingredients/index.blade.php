@extends('tmpl.admin')

@section('_head')
@stop

@section('content')

   

  <h1 class="page-header">All Ingredients   {{ link_to('/admin/menu/ingredients/add', '+ Add', array('class' => 'btn btn-primary pull-right')) }} </h1>
  @if (Session::has('message'))
       <div class="alert alert-danger">{{ Session::get('message') }}</div>
  @endif
  <div class="row">
       <table class="table table-striped">
            <thead>
            	<tr>
                    <th>#</td>
                    <th>Ingredient Name</th>
                    <th>Summmary</th>
                    <th>Active</th>
                    <th>Edit / Delete</th>
                </tr>
            </thead>
            <tbody>
            
            @foreach($data as $mIng)
                <tr>
                    <td>{{ $mIng->id }}</td>
                    <td>{{ $mIng->name }}</td>
                    <td>{{ $mIng->summary }}</td>
                    <td>
                        @if($mIng->active == 1)
                            {{ link_to('/admin/menu/ingredients/active/'.$mIng->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                        @else
                            {{ link_to('/admin/menu/ingredients/active/'.$mIng->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                        @endif
                    </td>
                    <td>
                        {{ link_to('/admin/menu/ingredients/edit/'.$mIng->id, 'Edit', array('class' => 'btn btn-success')) }}
                        {{ link_to('/admin/menu/ingredients/delete/'.$mIng->id, 'Delete', array('class' => 'btn btn-danger')) }}
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
    