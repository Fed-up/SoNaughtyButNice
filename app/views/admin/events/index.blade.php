@extends('tmpl.admin')

@section('_head')
@stop

@section('content')

  <h1 class="page-header">All Events   {{ link_to('/admin/products/events/add', '+ Add', array('class' => 'btn btn-primary pull-right')) }} </h1>
    @if (Session::has('message'))
       <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
  <div class="row">
       <table class="table table-striped">
            <thead>
            	<tr>
                    <th>#</td>
                    <th>Event Name</th>
                    <th>Seats</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Price</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
            
            @foreach($data as $event)           
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->name }}</td>
                <td>{{ $event->ticket_amount }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->time }}</td>
                <td>${{ $event->price }}</td>
                <td>
                	@if($event->active == 1)
                    	{{ link_to('/admin/products/events/active/'.$event->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                    @else
                		{{ link_to('/admin/products/events/active/'.$event->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                	@endif
                
                </td>
                <td>
                	{{ link_to('/admin/products/events/edit/'.$event->id, 'Edit', array('class' => 'btn btn-success')) }}
                	{{ link_to('/admin/products/events/delete/'.$event->id, 'Delete', array('class' => 'btn btn-danger')) }}
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
    