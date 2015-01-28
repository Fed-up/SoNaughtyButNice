<?php

class Admin_CategoriesController extends BaseController {

	public function getCategories(){
		//Finds every record that does not equal 9
		$mCat = MenuCategories::orderBy('ordering','ASC')->where('active', '!=', 9)->get();
		$count = count($mCat);
		//echo '<pre>'; print_r($count); echo '</pre>'; 	exit;
		return View::make('admin.categories.index')->with(array(
			'data' => $mCat,
			'count' => $count)
		);
	}
	public function getAddCategories(){
		return View::make('admin.categories.form')
			->with(array('title' => 'Create New Collection'));	
	}
	public function postAddCategories(){
		
		$input = Input::all();
		//dd($input);
		$rules = array(
			'name' 		=> 'required|unique:menu_categories,name',
			'summary'	=> 'required'
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator);
		}
			//$mCatUp = MenuCategories::findOrFail('id');
		else{
			$currentCategories = MenuCategories::orderBy('ordering','ASC')->where('active', '!=', 9)->get();
			$count = count($currentCategories);
			//echo '<pre>'; print_r($count); echo '</pre>'; 	exit;
			
			$mCat	= new MenuCategories();
			//echo '<pre>'; print_r(); echo '</pre>'; 	exit;
			$mCat->name 	= Input::get('name');
			$mCat->summary 	= Input::get('summary');
			$mCat->ordering = $count+1;
			$mCat->active  = (Input::get('active')) ? 1 : 0;
			$mCat->save();
			//echo '<pre>'; print_r($mCat); echo '</pre>'; 	exit;	
		}; 
		
		$mCat = MenuCategories::all();	
		return Redirect::action('Admin_CategoriesController@getCategories')
			->with(array('data' => $mCat));
	}
	
	public function getEditCategories($id){
		$data = MenuCategories::findOrFail($id);
		$recipes = MenuRecipes::where('menu_categories_id', '=', $id)->where('active', '!=', 9)->orderBy('ordering','ASC')->get();
		
		//echo '<pre>'; print_r($recipes); echo '</pre>'; exit;
		return View::make('admin.categories.form')
			->with(array(
				'data' => $data,
				'recipes' => $recipes,
				'title' => 'Edit Categories : '.$data->name));
	}
	
	public function postUpdateCategories(){
		$input = Input::all();
		//echo '<pre>'; print_r($input); echo '</pre>'; 	exit;
		$rules = array(
			'name' 		=> 'required|unique:menu_categories,name,'.Input::get('id'),
			'summary'	=> 'required'
		);
		$validator = Validator::make($input, $rules);
		
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}else{
			$mCatUp = MenuCategories::findOrFail($input['id']);//Find the row in Menu Categories where ID = the input and attatch the object to the variable $mCatUp 
			$mCatUp->name 	= $input['name'];
			$mCatUp->summary 	= $input['summary'];
			$mCatUp->active  = (isset($input['active'])) ? 1 : 0;
			if($mCatUp->save()){
				if(isset($input['recipe'])){
					//echo '<pre>'; print_r($input['recipe']); echo '</pre>'; 	exit;
					//$r_count = count($input['recipe']);
					$count = 0;
					foreach($input['recipe'] as $recipe){
						
						//We need the index = $i and $f is the value
						foreach($recipe as $i=>$r){
							
							$_recipe = MenuRecipes::find($i);
							
							$_recipe->ordering = $count;
							//echo '<pre>'; print_r($_recipe); echo '</pre>';
							$mCatUp->MenuRecipes()->save($_recipe);
						};
						$count++;
					};	
				}
				
			}
			//echo '<pre>'; print_r($mCatUp); echo '</pre>'; 	exit;	
		}; 
		
		return Redirect::action('Admin_CategoriesController@getCategories');
	}
	
	public function getActiveCategories($id){
		$data = MenuCategories::findOrFail($id);
		$data->active  = ($data->active == 0) ? 1 : 0;
		$data->save();
		return Redirect::action('Admin_CategoriesController@getCategories');
	}
	
	public function getDeleteCategories($id){
		$data = MenuCategories::findOrFail($id);
		$data->ordering = 0;
		$data->active = 9;
		$data->save();
		return Redirect::action('Admin_CategoriesController@getCategories')
			->with('message', 'Category Deleted');
	}

	public function getOrderCategories($id, $pos, $dir){
		
		if($dir == 'up'){
			$uprow = MenuCategories::find($id)->where('ordering', '=', $pos)->first(); 
			$uprow->ordering = $pos-1;
			$downrow = MenuCategories::find($id)->where('ordering', '=', $pos-1)->first(); 
			$downrow->ordering = $pos;
			$uprow->save(); 
			$downrow->save();
			return Redirect::action('Admin_CategoriesController@getCategories');
 		}
		
		if($dir == 'down'){
			$downrow = MenuCategories::find($id)->where('ordering', '=', $pos)->first(); 
			$downrow->ordering = $pos+1; 
			$uprow = MenuCategories::find($id)->where('ordering', '=', $pos+1)->first(); 
			$uprow->ordering = $pos;
			$downrow->save();
			$uprow->save();
			
			return Redirect::action('Admin_CategoriesController@getCategories');
		}		
	}
}

	


