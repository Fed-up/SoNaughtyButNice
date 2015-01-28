@extends('tmpl.admin')

@section('title')yeah boi!@stop

@section('_head')
    
    <script type="text/javascript" src="/packages/jquery-1.11.1.min/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css"/>
    
@stop

@section('content')

  <h1 class="page-header">All Members {{ link_to('admin/user/members/add', '+ Add', array('class' => 'btn btn-primary pull-right'))  }}</h1>
  <div class="row">
       <table class="table table-striped">
            <thead>
            	<tr>
                    <th>#</td>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Active</th>
                    <th>Edit / Delete</th>
                </tr>
            </thead>
            <tbody>
            
            @foreach($data as $member)           
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->fname }}</td>
                <td>{{ $member->lname }}</td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->user_type }}</td>
                <td>
                	@if($member->active == 1)
                    	{{ link_to('/admin/user/members/active/'.$member->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                    @else
                		{{ link_to('/admin/user/members/active/'.$member->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                	@endif
                
                </td>
                <td>
                	{{ link_to('/admin/user/members/edit/'.$member->id, 'Edit', array('class' => 'btn btn-success')) }}
                	{{ link_to('/admin/user/members/delete/'.$member->id, 'Delete', array('class' => 'btn btn-danger')) }}
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
    