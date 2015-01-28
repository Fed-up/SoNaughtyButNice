@extends('tmpl.admin')

@section('title'){{ $title }}@stop

@section('_head')
    
    <script type="text/javascript" src="/packages/jquery-1.11.1.min/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css"/>
    
@stop

@section('content')

  <h1 class="page-header">{{$title}} {{ link_to('admin/website/quotes/add', '+ Add', array('class' => 'btn btn-primary pull-right'))  }}</h1>
  @if (Session::has('message'))
       <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
  <div class="row">
       <table class="table table-striped">
            <thead>
            	<tr>
                    <th>#</td>
                    <th>Promo Quote</th>
                    <th>Active</th>
                    <th>Edit / Delete</th>
                </tr>
            </thead>
            <tbody>
            
            @foreach($data as $quote)           
            <tr>
                <td>{{ $quote->id }}</td>
                <td>{{ $quote->quote }}</td>
                <td>
                	@if($quote->active == 1)
                    	{{ link_to('/admin/website/quotes/active/'.$quote->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                    @else
                		{{ link_to('/admin/website/quotes/active/'.$quote->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                	@endif
                
                </td>
                <td>
                	{{ link_to('/admin/website/quotes/edit/'.$quote->id, 'Edit', array('class' => 'btn btn-success')) }}
                	{{ link_to('/admin/website/quotes/delete/'.$quote->id, 'Delete', array('class' => 'btn btn-danger')) }}
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

    <script>
	
		$('#tom').bind('click', function(event){
			event.preventDefault();
			alert('YOLO');
		});
	
	</script>
    
@stop
    