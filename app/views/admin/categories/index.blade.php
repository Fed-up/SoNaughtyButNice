@extends('tmpl.admin')

@section('_head')
@stop

@section('content')

  <h1 class="page-header">All Categories   {{ link_to('/admin/menu/categories/add', '+ Add', array('class' => 'btn btn-primary pull-right')) }} </h1>
    @if (Session::has('message'))
       <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
  <div class="row">
       <table class="table table-striped table-hover">
            <thead>
            	<tr>
                    <th>#</td>
                    <th>Category Name</th>
                    <th>Summmary</th>
                    <th>Active</th>
                    <th>Position</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            
            @foreach($data as $mCat)           
            <tr>
                <td>{{ $mCat->id }}</td>
                <td>{{ $mCat->name }}</td>
                <td>{{ $mCat->summary }}</td>
                <td>
                	@if($mCat->active == 1)
                    	{{ link_to('/admin/menu/categories/active/'.$mCat->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                    @else
                		{{ link_to('/admin/menu/categories/active/'.$mCat->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                	@endif
                
                </td>
                <td>
                	
                	<a href="{{ action('Admin_CategoriesController@getOrderCategories', array($mCat->id,$mCat->ordering,'up')) }}" class="btn btn-default glyphicon glyphicon-arrow-up {{ ($mCat->ordering == 1)? "disabled" : ""}} "></a>
                    <a href="{{ action('Admin_CategoriesController@getOrderCategories', array($mCat->id,$mCat->ordering,'down')) }}" 
                    class="btn btn-default glyphicon glyphicon-arrow-down {{ ($mCat->ordering == $count)? "disabled" : ""}} "></a>
					<a href="#" class="btn btn-default disabled"> {{ $mCat->ordering }} </a>
                	
                </td>
                <td>
                	{{ link_to('/admin/menu/categories/edit/'.$mCat->id, 'Edit', array('class' => 'btn btn-success')) }}
                	{{ link_to('/admin/menu/categories/delete/'.$mCat->id, 'Delete', array('class' => 'btn btn-danger')) }}
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
    