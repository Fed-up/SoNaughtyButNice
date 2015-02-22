<?php
class Admin_IngredientsController extends BaseController {
	//Ingredients
	
	public function getIngredients(){
		$mIng = MenuIngredients::where('active', '!=', 9)->orderBy('name','ASC')->get();

		// foreach ($mIng as $i) {
		// 	echo '<pre>'; print_r($i->name); echo '</pre>'; 	
		// }exit;
		

		return View::make('admin.ingredients.index')
			->with(array('data' => $mIng));
	}
	public function getAddIngredients(){
		return View::make('admin.ingredients.form')
			->with(array('title' => 'Create New Ingredients'));
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
			};
			//echo '<pre>'; print_r($mIng->id); echo '</pre>'; 	exit;	
		};
		return Redirect::action('Admin_IngredientsController@getIngredients');
	}
	
	public function getEditIngredients($id){
		//echo $id; exit;
			$data = MenuIngredients::findOrFail($id);
			$ingredient_images = $data->Images()->orderBy('ordering','ASC')->where('section', '=', 'INGREDIENT')->get();
			//$recipes_images = $data->Images()->orderBy('ordering','ASC')->get();
			//echo '<pre>'; print_r($ingredient_images); echo '</pre>'; 	exit;	
		return View::make('admin.ingredients.form')
			->with(array(
				'data' => $data,
				'i_images' => $ingredient_images,
				'title' => 'Edit Ingredients: '. $data->name));
	}

	
	public function postUpdateIngredients(){
		
		//Variable is holding the object
		$input = Input::all();
		//echo '<pre>'; print_r($input); echo '</pre>'; 	exit;
		$rules = array(
			'name' 		=> 'required|unique:menu_ingredients,name,'.Input::get('id'),
			'summary'	=> 'required',
			
			// 'price'	=> 'required|regex:/^[+-]?\d+\.\d+, ?[+-]?\d+\.\d+$/'
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
					$data->save();
					// echo '<pre>'; print_r($data); echo '</pre>'; 	exit;
				};
			};
			//This code gets the data from the input and attaches it to the object in the variable $data
			//echo '<pre>'; print_r($data); echo '</pre>'; 	exit;
		}; 
		return Redirect::action('Admin_IngredientsController@getIngredients');
	}
	
	public function getActiveIngredients($id){
		$data = MenuIngredients::findOrFail($id);
		$data->active = ($data->active == 0)? 1 : 0; //If it is == 0 thats true so change the value to 1, else if its false the value is 1 so change it to 0
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
	
	
	
	
	
	
	
	