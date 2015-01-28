@extends('tmpl.admin')

@section('_head')
@stop

@section('content')

  <h1 class="page-header">All Metrics   {{ link_to('/admin/menu/metric/add', '+ Add', array('class' => 'btn btn-primary pull-right')) }} </h1>
    @if (Session::has('message'))
       <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
  <div class="row">
       <table class="table table-striped">
            <thead>
            	<tr>
                    <th width="50px">#</td>
                    <th>Metric Name</th>
                    <th width="1%">Action</th>
                </tr>
            </thead>
            <tbody>
            
            @foreach($data as $metric)           
            <tr>
                <td>{{ $metric->id }}</td>
                <td>{{ $metric->name }}</td>
                <td nowrap="nowrap">
                	{{ link_to('/admin/menu/metric/edit/'.$metric->id, 'Edit', array('class' => 'btn btn-success')) }}
                	{{ link_to('/admin/menu/metric/delete/'.$metric->id, 'Delete', array('class' => 'btn btn-danger')) }}
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
    