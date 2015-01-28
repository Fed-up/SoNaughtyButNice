@extends('tmpl.admin')

@section('title')
    {{ $title }}
@stop

@section('_head') 
	<script type="text/javascript" src="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/css/no-theme/jquery-ui-1.10.4.custom.min.css"/> 
    
      <script>
	  $(function() {
		  
		$( "._mySortable" ).sortable({ 
			axis: "y", 
			opacity: 0.5,
			placeholder: "sortable-placeholder",
			// callback function
			update: function( event, ui ) {
				ui.item.css({'background':'#f0f'})
			},
		});
		$( "._mySortable" ).disableSelection();
		
		$('#counterIngredients').val( $('#_ListIngredients li').length );
		
		$('#btnActionAddIngredient').click(function(e) {
			e.preventDefault();
			
			var currentID = $('#counterIngredients').val();
			
			var ingredientsArray = [];
			<?php
			
			$ix = 0;
			foreach ($ingredients as $i=>$v) {
				echo 'ingredientsArray['.$ix.'] = ["'.$i.'","'.$v.'"]'."\n";
				$ix++;
			}; 

			?>
			
			var SelectList	= $('<select>',{
						'name':'ingredients[][x]',
						'id':'ingredients_'+currentID,
						'class':'form-control',
					});
			
			$.each(ingredientsArray, function(key,value) {
				SelectList
					.append($('<option></option>')
					.attr('value',value[0])
					.text(value[1])); 
			});
			
			var metricArray = [];
			<?php
			
			$ix = 0;
			foreach ($metric as $i=>$v) {
				echo 'metricArray['.$ix.'] = ["'.$i.'","'.$v.'"]'."\n";
				$ix++;
			}; 

			?>
			
			var SelectListM	= $('<select>',{
						'name':'metric[][x]',
						'id':'metric_'+currentID,
						'class':'form-control',
					});
			
			$.each(metricArray, function(key,value) {
				SelectListM
					.append($('<option></option>')
					.attr('value',value[0])//Returns first element in the array
					.text(value[1])); //Returns second element in the array
			});
			
			var deleteButton	= $('<button>',{
										'class':'glyphicon glyphicon-remove btn btn-danger'
									});
			deleteButton.bind('click', function(e){
				e.preventDefault();
				$(this).parent('li').remove().unbind('click');
			});
			
			$('#_ListIngredients')
				.append( $('<li>') 
				
					.append( SelectList )
					.append( '&nbsp;' )
					.append( $('<input>',{
						'name':'amount[][x]',
						'id':'amount_'+currentID,
						'class':'form-control',
					}) )
					.append( '&nbsp;' )
					.append( SelectListM )
					.append( '&nbsp;' )

					.append( deleteButton )
					.append( '&nbsp;' )
					.append( $('<span>',{
						'class':'glyphicon glyphicon-sort btn btn-default disabled'
					}) )
					
				)
			;
			
			$('#counterIngredients').val( parseInt(currentID, 10) + 1 );
			
		});
		
	  });
	  </script>
@stop

@section('content')

  
  <div class="row">
  	<h1 class="page-header">@yield('title')</h1>
    @if(isset($data->id))
    	{{ Form::open(array('action' => 'Admin_RecipesController@postUpdateRecipes', 'class' => 'form-horizontal')) }} 
   	@else
  		{{ Form::open(array('action' => 'Admin_RecipesController@postAddRecipes', 'class' => 'form-horizontal')) }} 
    @endif
    
    <ul id="myTab" class="nav nav-tabs">
      <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
      <li><a href="#images" data-toggle="tab">Images</a></li>
      <li><a href="#facts" data-toggle="tab">Fresh Facts</a></li>
      <li><a href="#ingredients" data-toggle="tab">Ingredients</a></li>
      <li><a href="#method" data-toggle="tab">Method</a></li>
      <li><a href="#extras" data-toggle="tab">Little Extra</a></li>
    </ul>
    
    <div id="myTabContent" class="tab-content">
    
      <div class="tab-pane fade in" id="info">
  		<div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' ; }}">
     	{{ Form::label('name', 'Name: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ ($errors->has('name'))? '<p>'. $errors->first('name') .'</p>' : '' }}
                {{ Form::text('name', (isset($input['name'])? Input::old('name') : (isset($data->name)? $data->name : '' )), array('class' => 'form-control')) }} 
            </div>
		</div>
    	<div class="form-group {{ ($errors->has('summary')) ? 'has-error' : '' ; }}">
     	{{ Form::label('summary', 'Summary: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ ($errors->has('summary'))? '<p>'. $errors->first('summary') .'</p>' : '' }}
                {{ Form::textarea('summary', (isset($input['summary'])? Input::old('summary') : (isset($data->summary)? $data->summary : '' )), array('class' => 'form-control', 'rows' => '2')) }} 
            </div>
		</div>
        <div class="form-group">
            {{ Form::label('active', 'Active: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::checkbox('active', 1, (isset($input['active'])? Input::old('active') : (isset($data->active)? $data->active : '' )), array('class' => '')) }}
            </div>
        </div>        
        <div class="form-group {{ ($errors->has('categories')) ? 'has-error' : '' ; }}">
     	{{ Form::label('categories', 'Categories: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-3">
                {{ ($errors->has('categories'))? '<p>'. $errors->first('categories') .'</p>' : '' }}
                {{ Form::select('categories', $categories, (isset($input['categories'])? Input::old('categories') : (isset($data->categories_id)? $data->categories_id : 0 )), array('class'=>'form-control')) }} 
            </div>
		</div>
      </div>
      <div class="tab-pane fade in" id="images">
        <div class="form-group {{ ($errors->has('pictures')) ? 'has-error' : '' ; }}">
     	{{ Form::label('pictures', 'Images: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-9">
                {{ Form::text('pictures', '', array('class' => 'form-control', 'placeholder' => 'Add as many images as you want,  by clicking add')) }} 
            </div>
            <div class="col-sm-1">
            	{{ Form::button('+ Add', array('class' => 'btn btn-primary')) }}
            </div>
		</div>
      </div>
      <div class="tab-pane fade in" id="facts">
        <div class="form-group {{ ($errors->has('fact')) ? 'has-error' : '' ; }}">
     	{{ Form::label('fact', 'Fresh Fact: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-9">
                {{ ($errors->has('fact'))? '<p>'. $errors->first('fact') .'</p>' : '' }}
                {{ Form::textarea('fact', (isset($input['fact'])? Input::old('fact') : (isset($data->fact)? $data->fact : '' )), array('class' => 'form-control', 'rows' => '2', 'placeholder' => 'If dynamic data iis the goal, split this input and have the text come up in random order on the page. With this you could also have it on the home page, click to see the recipe with this fact')) }} 
            </div>
            <div class="col-sm-1">
            	{{ Form::button('+ Add', array('class' => 'btn btn-primary')) }}
            </div>
		</div>
      </div>
      <div class="tab-pane fade in active" id="ingredients">
        <div class="col-sm-1">
          	{{-- Form::button('+ Add', array('id' => 'btnActionAddIngredient','class' => 'btn btn-primary')) --}}
          	<a href="#" id="btnActionAddIngredient" class="btn btn-primary">+ Add</a>
          	{{ Form::hidden('counterIngredients',null,array('id'=>'counterIngredients')) }} 

        </div>
        <hr/>
        <div class="form-group {{ ($errors->has('ingredients')) ? 'has-error' : '' ; }}">
           	{{ ($errors->has('ingredients'))? '<p>'. $errors->first('ingredients') .'</p>' : '' }}
          	<ul id="_ListIngredients" class="_mySortable">
            
            	<?php /*
            	<li>
                    {{ Form::select('ingredients', $ingredients, (isset($input['ingredients'])? Input::old('ingredients') : (isset($data->ingredients_id)? $data->ingredients_id : 0 )), array('class'=>'form-control')) }}
                     {{ Form::text('amount', (isset($input['amount'])? Input::old('amount') : (isset($data->amount)? $data->amount : '' )), array('class' => 'form-control', 'placement' => 'Amount')) }} 
                     {{ Form::select('metric', $metric, (isset($input['metric'])? Input::old('metric') : (isset($data->metric_id)? $data->metric_id : 0 )), array('class'=>'form-control')) }}
                     {{ Form::button('', array('class' => 'glyphicon glyphicon-remove btn btn-danger')) }}
                     <span class="glyphicon glyphicon-sort btn btn-default disabled"></span>
                </li>
				*/ ?>
                
         	</ul>
		</div>
      </div>
      <div class="tab-pane fade in" id="method">
            <div class="col-sm-1">
            	{{-- Form::button('+ Add', array('id' => 'btnActionAddMethod','class' => 'btn btn-primary')) --}}
                <a href="#" id="btnActionAddMethod" class="btn btn-primary">+ Add</a>
                {{ Form::hidden('counterMethods',null,array('id'=>'counterMethods')) }}
            </div>
            <hr/>
           <div class="form-group {{ ($errors->has('method')) ? 'has-error' : '' ; }}">
           	{{ ($errors->has('ingredients'))? '<p>'. $errors->first('ingredients') .'</p>' : '' }}
          	<ul id="_ListIngredients" class="_mySortable">
            	<li>
            		{{ Form::textarea('method', (isset($input['method'])? Input::old('method') : (isset($data->method)? $data->method : '' )), array('class' => 'form-control', 'rows' => '2', 'placeholder' => 'Add another method until all are there, change the order if you do not add it in the correct order')) }}
                    {{ Form::button('', array('class' => 'glyphicon glyphicon-remove btn btn-danger')) }}
                     <span class="glyphicon glyphicon-sort btn btn-default disabled"></span>
            	</li>   
            </ul>
          </div>
      </div>
            <?php /*
          	<ul id="_ListIngredientss" class="_mySortable">
            	<li>
                    {{ Form::select('ingredients', $ingredients, (isset($input['ingredients'])? Input::old('ingredients') : (isset($data->ingredients_id)? $data->ingredients_id : 0 )), array('class'=>'form-control')) }}
                     {{ Form::text('amount', (isset($input['amount'])? Input::old('amount') : (isset($data->amount)? $data->amount : '' )), array('class' => 'form-control', 'placement' => 'Amount')) }} 
                     {{ Form::select('metric', $metric, (isset($input['metric'])? Input::old('metric') : (isset($data->metric_id)? $data->metric_id : 0 )), array('class'=>'form-control')) }}
                     {{ Form::button('', array('class' => 'glyphicon glyphicon-remove btn btn-danger')) }}
                     <span class="glyphicon glyphicon-sort btn btn-default disabled"></span>
                </li>
            	
         	</ul>
			*/ ?>
            
            
		
      <div class="tab-pane fade in" id="extras">
        <div class="form-group {{ ($errors->has('extra')) ? 'has-error' : '' ; }}">
     	{{ Form::label('extra', 'Little Extra: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-9">
                {{ ($errors->has('extra'))? '<p>'. $errors->first('extra') .'</p>' : '' }}
                {{ Form::textarea('extra', (isset($input['extra'])? Input::old('extra') : (isset($data->extra)? $data->extra : '' )), array('class' => 'form-control', 'rows' => '2', 'placeholder' => 'Add another little extra until all are there, change the order if you do not add it in the correct order. This will be hidden from the guest members and only displayed to the signed in members')) }} 
            </div>
            <div class="col-sm-1">
            	{{ Form::button('+ Add', array('class' => 'btn btn-primary')) }}
            </div>
		</div>
      </div>
      
    </div>
        
        	{{ Form::hidden('id', (isset($input['id'])? Input::old('id') : (isset($data->id)? $data->id : '' ))) }}
            
            <hr/>
            
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              {{ Form::submit('Save', array('class' => 'btn btn-success')) }}
            <a href="/admin/menu/recipes/">
                {{ Form::button('Cancel' ,array('class' => 'btn btn-danger')) }}
            </a>
            </div>
        </div>
    {{ Form::close() }}
    	        	
  </div>

@stop


@section('_tail')

@stop

<?php /* {{ ($errors->has('method'))? '<p>'. $errors->first('method') .'</p>' : '' }}
                {{ Form::textarea('method', (isset($input['method'])? Input::old('method') : (isset($data->method)? $data->method : '' )), array('class' => 'form-control', 'rows' => '2', 'placeholder' => 'Add another method until all are there, change the order if you do not add it in the correct order')) }}  */?>