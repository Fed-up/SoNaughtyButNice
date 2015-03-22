<?php

class Admin_PackagesController extends BaseController {

	public function getPackages(){
		//Finds every record that does not equal 9
		$data = Catering::where('active', '!=', 9)->get();
		return View::make('admin.packages.index')
			->with(array('data' => $data));
	}
	
	public function getAddPackages(){
		$recipes = MenuRecipes::orderBy('name','ASC')->where('active', '=', '1')->get();

		$mRep = array();
		$mRep[0]	= '- Select Recipe -';	
		foreach ($recipes as $recipe) {
			$mRep[$recipe->id]	= $recipe->name;
		};
		// echo '<pre>'; print_r($mRep); echo '</pre>'; 	exit;

		return View::make('admin.packages.form')
			->with(array(
				'title' => 'Create New Catering Package',
				'recipes' => $mRep,
			)
		);	
	}
	
	public function postAddPackages(){
		
		$input = Input::all();
		//dd($input);
		$rules = array(
			'name' 		=> 'required',
			'summary'	=> 'required',
			'package_type' 		=> 'required', //Look at adding a table like 
			'quantity' 		=> 'required',
			'price' 		=> 'required'
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator);
		}
			//$mCatUp = MenuCategories::findOrFail('id');
		else{
			$data	= new Catering();
			
			$data->name 	= Input::get('name');
			$data->summary 	= Input::get('summary');
			$data->package_type 	= Input::get('package_type');
			$data->quantity 	= Input::get('quantity');
			$data->price 	= Input::get('price');
			$data->active  = (Input::get('active')) ? 1 : 0;
			if($data->save()){
				if(isset($input['recipes']) && isset($input['amount'])){			
					$catering_recipes = Input::get('recipes');
					$amount = Input::get('amount');
					$last_amount = 0;
					for($i=0; $i<count($catering_recipes); $i++){
					  $catering_recipe_pivot_id = array_keys($catering_recipes[$i]);
					  $catering_recipe_pivot_id = $catering_recipe_pivot_id[0];
					  $catering_recipe_id = $catering_recipes[$i][$catering_recipe_pivot_id];

					  $last_amount = $last_amount + $amount[$i]['x'];
					  print_r($last_amount); echo '</pre>'; 	exit;
					    if(isset($input['ddi'])){
							$ddi = $input['ddi'];							
							foreach($ddi as $_delete){
								DB::table('catering_recipes')->where('id', '=', $_delete)->delete();
							};
						};		

					    if (isset($catering_recipes[$i]['x']) && $catering_recipes[$i]['x'] > 0) {
					  		$data->MenuRecipes()->attach($catering_recipes[$i]['x'], array( 'catering_id' => $data->id, 'amount' => $amount[$i]['x'], 'ordering' => $i+1 ));
					    }else{

						  	$attributes = array(
			                    'menu_recipes_id' => $catering_recipe_id, 
			                    'catering_id' => $data->id, 
			                    'amount' => $amount[$i][$catering_recipe_pivot_id], 
			                    'ordering' => $i+1);
					            
						    $findrecipes = DB::table('catering_recipes')->where('id', '=', $catering_recipe_pivot_id)->update($attributes) ;

					    };
					    						
					  
					};
					exit;
					// echo '<pre>'; print_r($input['ddi']); echo '</pre>';
						
				};

				if(isset($input['images'])){
					$p_count = count($input['images']);
					$p=0;
					foreach($input['images'] as $image){
						if($p <= $p_count){
							foreach($image as $i_photo=>$photo){
								if($i_photo == 'x'){
									$_image = new Images();
									$_image->name = $photo;
									$_image->summary = $input['img_des'][$p]['x'];
									$_image->link_id = $input['id'];
									$_image->ordering = $p;
									$_image->section = 'CATERING';
									$_image->active = 1;
								}else{
										$_image = Images::find($i_photo);
										$_image->name = $photo;
										$_image->summary = $input['img_des'][$p][$i_photo];
										$_image->link_id = $input['id'];
										$_image->ordering = $p;
										$_image->section = 'CATERING';
										$_image->active = 1;
								};
								$data->Images()->save($_image);
							};
						$p++;
						};
					};
					if(isset($input['ddp'])){
						$ddp = $input['ddp'];
						//echo '<pre>'; print_r($ddp); echo '</pre>'; 	exit;
						
						foreach($ddp as $dp_delete){
						
							$dp = Images::find($dp_delete);
							$dp->delete();
						};
					};
				};
			};	
		}; 
		
		$data = Catering::all();	
		return Redirect::action('Admin_PackagesController@getPackages')
			->with(array('data' => $data));
	}
	
	public function getEditPackages($id){
		
		$data = Catering::findOrFail($id);
		$catering_images = $data->Images()->orderBy('ordering','ASC')->where('section', '=', 'CATERING')->get();

		$recipes = MenuRecipes::orderBy('name','ASC')->where('active', '=', '1')
			->with(array('Catering' => function($query) use ($id){
					$query->where('catering_recipes.catering_id', '=', $id);
				}))
		->get();
		

		$catering = Catering::where('id', '=', $id)
			->with(array('menuRecipes' => function($query) use ($id){
				
				$query->where('catering_recipes.catering_id', '=', $id)->orderBy('pivot_ordering','ASC');


			}))
		->get();
		
		foreach ($catering as $cat) {
			$catering_recipes = $cat->menuRecipes;
			// echo '<pre>'; print_r($catering); echo '</pre>'; exit;
		}; 

		
		
		// foreach ($catering_recipes as $rec) {
			// echo '<pre>'; print_r($catering->MenuRecipes); echo '</pre>'; exit;
		// }; 

		$mRep = array();
		$mRep[0]	= '- Select Recipe -';	
		foreach ($recipes as $recipe) {
			$mRep[$recipe->id]	= $recipe->name;
		};

		$queries = DB::getQueryLog();

		
		// echo '<pre>'; print_r($catering_recipes); echo '</pre>'; exit;

		
		return View::make('admin.packages.form')
			->with(array(
				'data' => $data,
				// 'ingredients'	=> $mIng,
				'c_images' => $catering_images,
				'recipes' => $mRep,
				'catering'	=> $catering,
				'catering_recipes' => $catering_recipes,
				// 'metric'	=> $mMetric,
				'title'		=> 'Edit Packages : '.$data->name
			)
		);
	}
	
	public function postUpdatePackages(){
		
		//Variable is holding the object
		$input = Input::all();
		

		$rules = array(
			'name' 		=> 'required',
			'summary'	=> 'required',
			'package_type' 		=> 'required', //Look at adding a table like 
			'quantity' 		=> 'required',
			'price' 		=> 'required'
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}
			//$mCatUp = MenuCategories::findOrFail('id');
		else{
			$data = Catering::findOrFail($input['id']);

			// $data = Catering::findOrFail($input['catering_recipe_pivot_id']);
			
			


			$data->name 	= Input::get('name');
			$data->summary 	= Input::get('summary');
			$data->package_type 	= Input::get('package_type');
			$data->quantity 	= Input::get('quantity');
			$data->price 	= Input::get('price');
			$data->active  = (Input::get('active')) ? 1 : 0;
			if($data->save()){

				if(isset($input['recipes']) && isset($input['amount'])){
					$catering_recipes = Input::get('recipes');
					$amount = Input::get('amount');
					$last_amount = 0;

					for($i=0; $i<count($catering_recipes); $i++){
					  $catering_recipe_pivot_id = array_keys($catering_recipes[$i]);
					  $catering_recipe_pivot_id = $catering_recipe_pivot_id[0];
					  $catering_recipe_id = $catering_recipes[$i][$catering_recipe_pivot_id];

					    if (isset($catering_recipes[$i]['x']) && $catering_recipes[$i]['x'] > 0) {
					   		$last_amount = $last_amount + $amount[$i]['x'];
					  		
					  		
					  		$data->MenuRecipes()->attach($catering_recipes[$i]['x'], array( 'catering_id' => $data->id, 'amount' => $amount[$i]['x'], 'ordering' => $i+1 ));
					    }else{
						    $last_amount = $last_amount + $amount[$i][$catering_recipe_pivot_id];
						  	$attributes = array(
			                    'menu_recipes_id' => $catering_recipe_id, 
			                    'catering_id' => $data->id, 
			                    'amount' => $amount[$i][$catering_recipe_pivot_id], 
			                    'ordering' => $i+1);				            
						    $findrecipes = DB::table('catering_recipes')->where('id', '=', $catering_recipe_pivot_id)->update($attributes) ;
					    };	

					    if(isset($input['ddi'])){
							$ddi = $input['ddi'];
		
							
							foreach($ddi as $_delete){
								$amount_key = array_keys($amount[$i]);
								if (isset($catering_recipes[$i]['x']) && $catering_recipes[$i]['x'] > 0) {
						   			$last_amount = $last_amount - $amount[$i]['x'];
						  		}else{
						  			if($_delete == $amount_key[0]){

							  			// print_r($last_amount); echo '</pre>';
							  			// print_r($amount[$i][$catering_recipe_pivot_id]); echo '</pre>';exit;
							  			$last_amount = $last_amount - $amount[$i][$catering_recipe_pivot_id];
							  		}
						  		}
								DB::table('catering_recipes')->where('id', '=', $_delete)->delete();
							};
						};					
					  
					};
					
					// echo '<pre>'; print_r($last_amount); echo '</pre>'; 	exit;
					$data->quantity = $last_amount;
					$data->save();
					
					// echo '<pre>'; print_r($input['ddi']); echo '</pre>';
						
				};

				if(isset($input['images'])){
					$p_count = count($input['images']);
					$p=0;
					foreach($input['images'] as $image){
						if($p <= $p_count){
							foreach($image as $i_photo=>$photo){
								if($i_photo == 'x'){
									$_image = new Images();
									$_image->name = $photo;
									$_image->summary = $input['img_des'][$p]['x'];
									$_image->link_id = $input['id'];
									$_image->ordering = $p;
									$_image->section = 'CATERING';
									$_image->active = 1;
								}else{
										$_image = Images::find($i_photo);
										$_image->name = $photo;
										$_image->summary = $input['img_des'][$p][$i_photo];
										$_image->link_id = $input['id'];
										$_image->ordering = $p;
										$_image->section = 'CATERING';
										$_image->active = 1;
								};
								$data->Images()->save($_image);
							};
						$p++;
						};
					};
					if(isset($input['ddp'])){
						$ddp = $input['ddp'];
						//echo '<pre>'; print_r($ddp); echo '</pre>'; 	exit;
						
						foreach($ddp as $dp_delete){
						
							$dp = Images::find($dp_delete);
							$dp->delete();
						};
					};
				};

				
			};


		}; 
		
		return Redirect::action('Admin_PackagesController@getPackages');
	}
	
	public function getActivePackages($id){
		$data = Catering::findOrFail($id);
		$data->active  = ($data->active == 0) ? 1 : 0;
		$data->save();
		return Redirect::action('Admin_PackagesController@getPackages');
	}
	
	public function getDeletePackages($id){
		$data = Catering::findOrFail($id);
		$data->active = 9;
		$data->save();
		return Redirect::action('Admin_PackagesController@getPackages')
			->with('message', 'Packages Deleted');
	}
}

	


