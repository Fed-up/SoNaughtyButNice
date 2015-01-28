@extends('tmpl.admin')

@section('title')yeah boi!@stop

@section('_head')
    
    <script type="text/javascript" src="/packages/jquery-1.11.1.min/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css"/>
    
@stop

@section('content')

  <h1 class="page-header">All Analytics</h1>
  <div class="row">
       <table class="table table-striped">
            <thead>
            	<tr>
                    <th>#</td>
                    <th>Event Name</th>
                    <th>Summmary</th>
                    <th>Visible</th>
                    <th>Postion</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Cheesecakes</td>
                <td>This menu has all our Cheesecakes</td>
                <td>yes</td>
                <td>drag me</td>
                <td>{{ link_to('/admin/analytics/edit', 'Edit', array('class' => 'btn btn-success')) }}</td>
                <td><button type="button" class="btn btn-danger">Delete</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Muffins</td>
                <td>This menu has all our Muffins</td>
                <td>yes</td>
                <td>drag me</td>
                <td><button type="button" class="btn btn-success">Edit</button></td>
                <td><button type="button" class="btn btn-danger">Delete</button></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Raw Desserts</td>
                <td>This menu has all our Raw Desserts</td>
                <td>yes</td>
                <td>drag me</td>
                <td><button type="button" class="btn btn-success">Edit</button></td>
                <td><button type="button" class="btn btn-danger">Delete</button></td>
            </tr>
            </tbody>
            <tfoot>
            	<tr>
                	<td colspan="20">
                    	3 Items
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
    