@extends('tmpl.admin')


@section('content')

  <h1 class="page-header">All Recipes      {{ link_to('admin/website/allrecipes/makeactive', 'Make Active', array('class' => 'btn btn-primary pull-right')) }}</h1>
    @if (Session::has('message'))
       <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
  <div class="row">
       <table class="table table-striped">
            <thead>
            	<tr>
                    <th>#</td>
                    <th>Recipe Name</th>
                    <th></th>
                    <th class="admin__col">Fed Up</th>
                    <th class="admin__col">Selection</th>
                    <th class="admin__col">So Naughty</th>
                </tr>
            </thead>
            <tbody>

            @foreach($data as $recipe)  
            <tr>
                <td>{{ $recipe->id }}</td>
                <td>{{ $recipe->name }}</td>
                <td></td>
                <td>@if($recipe->fedup_active == 1)
                        {{ link_to('/admin/website/recipes/active/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok disabled')) }}
                    @else
                        {{ link_to('/admin/website/recipes/active/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove disabled')) }}
                    @endif
                </td>
                <td>
                	@if($recipe->selection_active == 1)
                       	{{ link_to('/admin/website/allrecipes/active/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok disabled')) }}
                    @else
                		{{ link_to('/admin/website/allrecipes/active/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove disabled')) }}
                	@endif
                </td>
                <td> 
                	@if($recipe->naughty_active == 1)
                        {{ link_to('admin/website/allrecipes/active/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                    @else
                        {{ link_to('admin/website/allrecipes/active/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                    @endif
                </td>
                <td>
                    {{ link_to('/admin/menu/recipes/confirmdelete/'.$recipe->id, 'Delete', array('class' => 'btn btn-danger')) }}
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
    