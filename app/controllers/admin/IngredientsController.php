<?php
class Admin_IngredientsController extends BaseController {
	//Ingredients
	
	public function getIngredients(){
		$mIng = MenuIngredients::where('active', '!=', 9)->orderBy('name','ASC')->get();

		// foreach ($mIng as $i) {
		// 	echo '<pre>'; print_r($i->name); echo '</pre>'; 	
		// }

		// exit;
		

		return View::make('admin.ingredients.index')
			->with(array('data' => $mIng));
	}
	public function getAddIngredients(){
		$metric = Metric::where('active', '!=', 9)->orderBy('name','ASC')->get();

		return View::make('admin.ingredients.form')
			->with(array(
				'title' => 'Create New Ingredients',
				'metrics' => $metric,
				'calculated' => 0,
			));
	}
	
	public function postAddIngredients(){
		$input = Input::all();
		$rules = array(
			'name' 		=> 'required|unique:menu_ingredients,name',
			'summary'	=> 'required',
			
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);	
		}else{
			$data	= new MenuIngredients();
			$data->name 	= Input::get('name');
			$data->summary 	= Input::get('summary');
			$data->description 	= Input::get('description');
			$data->grams 	= Input::get('grams');
			$data->price 	= Input::get('price');
			$data->fruit  = (isset($input['fruit'])) ? 1 : 0;
			$data->lowgi  = (isset($input['lowgi'])) ? 1 : 0;
			$data->nut_seed  = (isset($input['nut_seed'])) ? 1 : 0;
			$data->superfood  = (isset($input['superfood'])) ? 1 : 0;
			$data->sweetner  = (isset($input['sweetner'])) ? 1 : 0;
			$data->vegetable  = (isset($input['vegetable'])) ? 1 : 0;
			$data->active 	= (Input::get('active')) ? 1 : 0;
			if($data->save()){
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
									$_image->section = 'INGREDIENT';
									$_image->ordering = $p;
									$_image->active = 1;
								}else{
										$_image = Images::find($i_photo);
										$_image->name = $photo;
										$_image->summary = $input['img_des'][$p][$i_photo];
										$_image->link_id = $input['id'];
										$_image->section = 'INGREDIENT';
										$_image->ordering = $p;
										$_image->active = 1;
								};
								$data->Images()->save($_image);
							};
						$p++;
						};
					};
				}else{
					$data->active 	= 0;
				};

				if(isset($input['metric_amount']) && isset($input['metric_grams'])){

					$metric_amounts = $input['metric_amount'];
					$metric_grams = $input['metric_grams'];
					if(isset($input['imData_id'])){
						$imData_ids = $input['imData_id'];
					}
					
					$m_count = count($metric_amounts);
					$m_count = $m_count;
					$m = 0;

					foreach($metric_amounts as $ma){
						if($m <= $m_count){
							foreach($ma as $metric_id=>$metric_amount){
								
								// echo '<pre>'; print_r($metric_id); echo '</pre>'; 

								if($metric_id != 'x'){
										$attributes = array(
						                    'menu_ingredients_id' => $ingredient_id, 
						                    'metric_id' => $metric_id, 
						                    'metric_amount' => $input['metric_amount'][$m][$metric_id],
						                    'metric_grams' => $input['metric_grams'][$m][$metric_id]
						                );
						    			$imData_update = DB::table('ingredient_metric')->where('id', '=', $input['imData_id'][$m][$metric_id])->update($attributes) ;
								}else{
									$amount_key = array_keys($input['metric_amount'][$m]['x']);
									$amount_value = array_values($input['metric_amount'][$m]['x']);
									$grams_value = array_values($input['metric_grams'][$m]['x']);
									echo '<pre>'; print_r($amount_value[0]); echo '</pre>'; 


									DB::table('ingredient_metric')->insert(
				 				    	array(
				 				    		'menu_ingredients_id' => $ingredient_id,
					                    	'metric_id' => $amount_key[0],
					                    	'metric_amount' => $amount_value[0],
						                    'metric_grams' =>$grams_value[0]
				 				    	)
									);	

									
								}

							}
							$m++;
						}
					}
					// $queries = DB::getQueryLog();
					// echo '<pre>'; print_r($queries); echo '</pre>'; 
					// exit;
				}
				$data->save();
			};
			//echo '<pre>'; print_r($mIng->id); echo '</pre>'; 	exit;	
		};
		if(isset($input['sc'])){
			return Redirect::action('Admin_IngredientsController@getIngredients');
		}else{
			return Redirect::action('Admin_IngredientsController@getEditIngredients', array($data->id)); 
		}
		// return Redirect::action('Admin_IngredientsController@getIngredients');
	}
	
	public function getEditIngredients($id){
		//echo $id; exit;
			$data = MenuIngredients::findOrFail($id);
			$ingredient_images = $data->Images()->orderBy('ordering','ASC')->where('section', '=', 'INGREDIENT')->get();
			

			$imData = MenuIngredients::where('id', '=', $id)
				->with(array('Metric' => function($query) use ($id){
					
					$query->where('ingredient_metric.menu_ingredients_id', '=', $id);
				}))			
			->get();

			$metric = Metric::where('active', '!=', 9)->orderBy('name','ASC')->get();

			// if(!isset($imData->Metric)){
				// echo '<pre>'; print_r($imData); echo '</pre>'; 	exit;
			// }


			// foreach($metric as $met){
			// 	// echo '<pre>'; print_r($met->name); echo '</pre>'; 
			// 	// echo '<hr/>';

			// 	foreach($imData as $im){
			// 		if($im->Metric()->exists()){
			// 			if($pivot_metric->id == $metric->id){		
			// 				foreach ($im->metric as $pivot_metric){	
			// 					echo $pivot_metric->pivot->id.','.$pivot_metric->id.','.$met->id.'<br>'; 
			// 					// echo '<pre>'; print_r($pivot_metric->id); echo '</pre>'; 
			// 					// echo '<pre>'; print_r($met->id); echo '</pre>'; 
			// 					// 

			// 				}
			// 			}else{$metric->id;}
			// 		}else{
			// 			// echo '<pre>'; print_r($met->name); echo '</pre>'; 
			// 		}
			// 	}
			// 	// $person->getStudent()->exists();
					
			// }exit; 
			


		return View::make('admin.ingredients.form')
			->with(array(
				'data' => $data,
				'i_images' => $ingredient_images,
				'title' => 'Edit Ingredients: '. $data->name,
				'imData' => $imData,
				'metrics' => $metric,
				'calculated' => 0,
			)	
		);
	}

	
	public function postUpdateIngredients(){
		
		//Variable is holding the object
		$input = Input::all();


		$ingredient_id = $input['id'];

		$rules = array(
			'name' 		=> 'required|unique:menu_ingredients,name,'.Input::get('id'),
			'summary'	=> 'required',
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}
			//$mCatUp = MenuCategories::findOrFail('id');
		else{
			$data = MenuIngredients::findOrFail($input['id']);//Find the row in Menu Categories where ID = the input and attatch the object to the variable $mCatUp 
			$active_check = $data->active;
			$data->name 	= $input['name'];
			$data->summary 	= $input['summary'];
			$data->description = $input['description'];
			$data->grams 	= Input::get('grams');
			$data->price 	= Input::get('price');
			$data->fruit  = (isset($input['fruit'])) ? 1 : 0;
			$data->lowgi  = (isset($input['lowgi'])) ? 1 : 0;
			$data->nut_seed  = (isset($input['nut_seed'])) ? 1 : 0;
			$data->superfood  = (isset($input['superfood'])) ? 1 : 0;
			$data->sweetner  = (isset($input['sweetner'])) ? 1 : 0;
			$data->vegetable  = (isset($input['vegetable'])) ? 1 : 0;
			$data->active  = (isset($input['active'])) ? 1 : 0;
			if($data->save()){
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
									$_image->section = 'INGREDIENT';
									$_image->ordering = $p;
									$_image->active = 1;
								}else{
										$_image = Images::find($i_photo);
										$_image->name = $photo;
										$_image->summary = $input['img_des'][$p][$i_photo];
										$_image->link_id = $input['id'];
										$_image->section = 'INGREDIENT';
										$_image->ordering = $p;
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
				}else{
					$data->active 	= 0;
					
					
				};

				// echo '<pre>'; print_r($input); echo '</pre>'; 	exit;

				if(isset($input['metric_amount']) && isset($input['metric_grams'])){

					$metric_amounts = $input['metric_amount'];
					$metric_grams = $input['metric_grams'];
					if(isset($input['imData_id'])){
						$imData_ids = $input['imData_id'];
					}
					
					$m_count = count($metric_amounts);
					$m_count = $m_count;
					$m = 0;
					$Cup = 0;
					$gCup = 0;

					foreach($metric_amounts as $ma){
						if($m <= $m_count){
							foreach($ma as $metric_id=>$metric_amount){

								if($metric_id != 'x'){
									$input_metric = Metric::where('id','=', $metric_id)->get();
									
									if($input_metric[0]->name == 'Cup'){
										$gCup = $input['metric_grams'][$m][$metric_id];
									}
									
									switch ($input_metric[0]->name) {
										    case "-":
										    	$mAmount = $input['metric_amount'][$m][$metric_id];
										    	$mGrams = $input['metric_grams'][$m][$metric_id];
										        break;

										    case "Cup":
										        $mAmount = $Cup = $input['metric_amount'][$m][$metric_id];
										    	$mGrams = $gCup = $input['metric_grams'][$m][$metric_id];
										        break;

										    case "Cups":
										        $mAmount = $Cup;
										    	$mGrams = $gCup; 
										        break;

										    case "grams":
										        $mAmount = $input['metric_amount'][$m][$metric_id];
										    	$mGrams = $input['metric_grams'][$m][$metric_id];
										        break;

										    case "Handful":
										        $mAmount = $input['metric_amount'][$m][$metric_id];
										    	$mGrams = $gCup/3;
										        break;

										    // case "mL":
										    //     $mAmount = $input['metric_amount'][$m][$metric_id];
										    // 	$mGrams = $input['metric_grams'][$m][$metric_id];
										    //     break;

										    // case "Sheets":
										    //     $mAmount = $input['metric_amount'][$m][$metric_id];
										    // 	$mGrams = $input['metric_grams'][$m][$metric_id];
										    //     break;

										    // case "slice":
										    //     $mAmount = $input['metric_amount'][$m][$metric_id];
										    // 	$mGrams = $input['metric_grams'][$m][$metric_id];
										    //     break;

										   	case "Tablespoon":
										        $mAmount = $input['metric_amount'][$m][$metric_id];
										    	$mGrams = $gCup/16.67;
										        break;

										    case "Tablespoons":
										        $mAmount = $input['metric_amount'][$m][$metric_id];
										    	$mGrams = $gCup/16.67;
										        break;

										    case "teaspoon":
										        $mAmount = $input['metric_amount'][$m][$metric_id];
										    	$mGrams = $gCup/66.68;
										        break;

										    case "teaspoons":
										        $mAmount = $input['metric_amount'][$m][$metric_id];
										    	$mGrams = $gCup/66.68;
										        break;

										    case "mL":
										        $mAmount = $input['metric_amount'][$m][$metric_id];
										    	$mGrams = $gCup;
										        break;

										    default:
										        $mAmount = $input['metric_amount'][$m][$metric_id];
										    	$mGrams = $input['metric_grams'][$m][$metric_id];
									}
									
									

									// echo '<pre>'; print_r($input_metric[0]->name); echo '</pre>'; exit;



									$attributes = array(
					                    'menu_ingredients_id' => $ingredient_id, 
					                    'metric_id' => $metric_id, 
					                    'metric_amount' => $mAmount,
					                    'metric_grams' => $mGrams,
					                );
					    			$imData_update = DB::table('ingredient_metric')->where('id', '=', $input['imData_id'][$m][$metric_id])->update($attributes) ;
								}else{
									$amount_key = array_keys($input['metric_amount'][$m]['x']);
									$amount_value = array_values($input['metric_amount'][$m]['x']);
									$grams_value = array_values($input['metric_grams'][$m]['x']);
									// echo '<pre>'; print_r($amount_value[0]); echo '</pre>'; exit;


									DB::table('ingredient_metric')->insert(
				 				    	array(
				 				    		'menu_ingredients_id' => $ingredient_id,
					                    	'metric_id' => $amount_key[0],
					                    	'metric_amount' => $amount_value[0],
						                    'metric_grams' =>$grams_value[0]
				 				    	)
									);	

									
								}

							}
							$m++;
						}
					}
				}
				$data->save();
				// exit;
			};
			//This code gets the data from the input and attaches it to the object in the variable $data
			
		}; 

		if($active_check != $data->active){
			// echo '<pre>'; print_r($data->active); echo '</pre>'; 	exit; 

			$riData = MenuRecipesIngredients::where('menu_ingredients_id', '=', $input['id'])->get();
			// $data->active = ($data->active == 0)? 1 : 0;
			
			foreach ($riData as $recipe) {
				$recipe->active = $data->active; 
				$recipe->save();
				// echo '<pre>'; print_r($recipe->active); echo '</pre>'; 	
			}
			// exit;



		// $data = MenuIngredients::findOrFail($id);
		// $data->active = ($data->active == 0)? 1 : 0; //If it is == 0 thats true so change the value to 1, else if its false the value is 1 so change it to 0
		$data->save();







		}





		if(isset($input['sc'])){
			return Redirect::action('Admin_IngredientsController@getIngredients');
		}else{
			$input_ingredient_id = $input['id'];
			$data = MenuIngredients::findOrFail($input_ingredient_id);
			$ingredient_images = $data->Images()->orderBy('ordering','ASC')->where('section', '=', 'INGREDIENT')->get();
			$imData = MenuIngredients::where('id', '=', $input_ingredient_id)
				->with(array('Metric' => function($query) use ($input_ingredient_id){
					
					$query->where('ingredient_metric.menu_ingredients_id', '=', $input_ingredient_id);
				}))			
			->get();
			$metric = Metric::where('active', '!=', 9)->orderBy('name','ASC')->get();
			return View::make('admin.ingredients.form')
				->with(array(
					'data' => $data,
					'i_images' => $ingredient_images,
					'title' => 'Edit Ingredients: '. $data->name,
					'imData' => $imData,
					'metrics' => $metric,
					'calculated' => 1,
				)	
			);
		}
	}
	
	public function getActiveIngredients($id){

		$riData = MenuRecipesIngredients::where('menu_ingredients_id', '=', $id)->get();
		$data = MenuIngredients::findOrFail($id);
		$data->active = ($data->active == 0)? 1 : 0;
		
		foreach ($riData as $recipe) {
			$recipe->active = $data->active; 
			$recipe->save();
			// echo '<pre>'; print_r($recipe->active); echo '</pre>'; 	
		}
		// exit;



		// $data = MenuIngredients::findOrFail($id);
		// $data->active = ($data->active == 0)? 1 : 0; //If it is == 0 thats true so change the value to 1, else if its false the value is 1 so change it to 0
		$data->save();
		return Redirect::action('Admin_IngredientsController@getIngredients');
	}
	
	public function getDeleteIngredients($id){
		$data = MenuIngredients::findOrFail($id);
		$data->active = 9;
		$data->save();
		return Redirect::action('Admin_IngredientsController@getIngredients');
	}
}	
	
	
	
	
	
	
	
	