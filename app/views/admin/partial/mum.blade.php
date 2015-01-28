@extends('tmpl.admin')

@section('title')Hi @stop
	
@section('_head')
@stop

@section('content')
  <h1>This is a report<h1>
   <div class="row">
       <table style="font-size:14px" class="table table-hover table-bordered mum">
            <thead>
            	<tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Summmary</th>
                    <th>Active</th>
                    <th>Postion</th>
                </tr>
            </thead>
            <tbody>
     
            
                <tr>
                	
                    <td><a href="www.google.com">1 </a></td>
                    <td><a href="www.apple.com">Apple </a></td>
                    <td>Apples are green</td>
                    <td>
                        Yes
                    </td>
                    <td>Top</td>
                    
                </tr>
            
            
            <a href="www.xenus.com">
                <tr>
                    <td>1</td>
                    <td>Apple</td>
                    <td>Apples are green</td>
                    <td>
                        Yes
                    </td>
                    <td>Top</td>
                </tr>
            </a>
                        
            </tbody>
            <tfoot>
            	<tr>
                	<td colspan="20">
                    	The table
                    </td>
               	</tr>
            </tfoot>
       </table>
  	</div>
    
    <div class="row well">
    	<h3>Grand sub heading</h3>
    </div> 
    
    <?php
		$array = array(
			"dinner" => array(
				"Pie" => "meat",
				"soup" => "hot",
			),
			"lunch" => array(
				"sandwich" => "square",
				"chicken" => "legs",
			),
		);
		foreach($array as $a){
			echo $a['dinner'][0];
			echo $a['lunch']['legs']; 	
		}
		foreach($array as $b1){
			echo print_r($b1).'<br/>';	
		}
		echo '<hr/>';
		foreach($array as $b1){
			//echo $array[2];	
			foreach($b1 as $key => $value){
				echo $value.'<br/>';
				
			}
		}
		echo '<hr/>';
		$array = array(
			1    => "a",
			"1"  => "b",
			1.5  => "c",
			true => "d",
		);
		var_dump($array);
		
		echo '<hr/>';

 ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
@stop

@section('_tail')
@stop