@extends('tmpl.admin')


@section('content')

  <h1 class="page-header">All Recipes      {{ link_to('admin/menu/recipes/add', '+ Add', array('class' => 'btn btn-primary pull-right')) }}</h1>
    @if (Session::has('message'))
       <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
  <div class="row">
       <table class="table table-striped">
            <thead>
            	<tr>
                    <th>#</td>
                    <th>Recipe Name</th>
                    <th>Category Name</th>
                    <th>Summmary</th>
                    <th>Active</th>
                    <th>Edit / Delete</th>
                </tr>
            </thead>
            <tbody>

            @foreach($data as $recipe)  
            <tr>
                <td>{{ $recipe->id }}</td>
                <td>{{ $recipe->name }}</td>
                <td>{{ $recipe->MenuCategories['name'] }}</td>
                <td>{{ $recipe->summary }}</td>
                <td>
                	@if($recipe->active == 1)
                    	{{ link_to('/admin/menu/recipes/active/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                    @else
                		{{ link_to('/admin/menu/recipes/active/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                	@endif
                
                </td>
                <td>
                	{{ link_to('/admin/menu/recipes/edit/'.$recipe->id, 'Edit', array('class' => 'btn btn-success')) }}
                	{{ link_to('/admin/menu/recipes/delete/'.$recipe->id, 'Delete', array('class' => 'btn btn-danger')) }}
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
    