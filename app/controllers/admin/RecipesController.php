<?php
//Recipes


// <inpu class="input--ingredient">


// $(".input--ingredient").on("blur", myfunc);

// function myfunc($event){
// 	$(this).text()

// 	$(this).attr("name")

// 	$("#outputfiled").val(3847293478);

// }


class Admin_RecipesController extends BaseController{

	public function getRecipes(){
		$data = MenuRecipes::where('active', '!=', 9)->get();
		return View::make('admin.recipes.index')
			->with(array(
				'data' => $data,
			));
	}
	
	public function getAddRecipes(){
		$categories = MenuCategories::orderBy('name','ASC')->where('active', '!=', '9')->get(); // Bring in data that has not been deleted
		$ingredients = MenuIngredients::orderBy('name','ASC')->get();
		$metrics = Metric::orderBy('name','ASC')->get();
		
		$mCat = array();
		$mCat[0]	= '- Select Category -';
		foreach ($categories as $category) {
			$mCat[$category->id]	= $category->name;
		};
		
		$mIng = array();
		$mIng[0]	= '- Select Ingredients -';
		foreach ($ingredients as $ingredient) {
			$mIng[$ingredient->id]	= $ingredient->name;
		};
		
		$mMetric = array();
		$mMetric[0]	= '- Select Metric -';
		foreach ($metrics as $metric) {
			$mMetric[$metric->id]	= $metric->name;
		};
		
		return View::make('admin.recipes.form')
			->with(array(
				'categories'	=> $mCat,
				'ingredients'	=> $mIng,
				'metric'	=> $mMetric,
				'title'		=> 'Create New Recipe'
			));	
	}
	
	public function postAddRecipes(){
		
		//echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
		
		$input = Input::all();
		// echo '<pre>'; print_r($input); echo '</pre>'; exit;

		$rules = array(
			'title' => 'required|Max:20|unique:menu_recipes,name',
			'summary' => 'required',
			'length' => 'required',
			'difficulty' => 'required',
			'serve' => 'required',
			'categories' => 'required|not_in:0'
		);
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}else{
			$data = new MenuRecipes();
			$data->name = Input::get('title');
			$data->summary = Input::get('summary');
			$data->menu_categories_id = Input::get('categories');
			$data->active = (isset($input['active'])) ? 1 : 0;
			$data->length 	= $input['length'];
			$data->difficulty 	= $input['difficulty'];
			$data->serve 	= $input['serve'];
			$data->df  = (isset($input['DF'])) ? 1 : 0;
			$data->ds  = (isset($input['DS'])) ? 1 : 0;
			$data->ef  = (isset($input['EF'])) ? 1 : 0;
			$data->fi  = (isset($input['FI'])) ? 1 : 0;
			$data->gf  = (isset($input['GF'])) ? 1 : 0;
			$data->nf  = (isset($input['NF'])) ? 1 : 0;
			$data->sf  = (isset($input['SF'])) ? 1 : 0;
			$data->ve  = (isset($input['VE'])) ? 1 : 0;
			$data->v  = (isset($input['V'])) ? 1 : 0;
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
									$_image->section = 'RECIPE';
									$_image->ordering = $p;
									$_image->active = 1;
									
								}else{
									$_image = Images::find($i_photo);
									$_image->name = $photo;
									$_image->summary = $input['img_des'][$p][$i_photo];
									$_image->link_id = $input['id'];
									$_image->section = 'RECIPE';
									$_image->ordering = $p;
									$_image->active = 1;
								};
								$data->Images()->save($_image);
							};
						$p++;
						}
					};
				};
				
				///echo '<pre>'; print_r($input['fact']); echo '</pre>'; 	exit;
				if(isset($input['fact'])){
					$f_count = count($input['fact']);
					$fc = 1;
					foreach($input['fact'] as $fact){
						if($fc <= $f_count){
							//We need the index = $i and $f is the value
							foreach($fact as $i=>$f){
								if ($i == 'x'){
									$_fact = new MenuRecipesFacts();
									$_fact->description = $f;
									$_fact->ordering = $fc;
									$_fact->active = 1;
									//echo '<pre>'; print_r($_fact); echo '</pre>'; 	exit;
								}else {
									$_fact = MenuRecipesFacts::find($i);
									$_fact->description = $f;
									$_fact->ordering = $fc;
								};
								$data->MenuRecipesFacts()->save($_fact);
							};
						$fc++;
						};
					};
				};
				
				if(isset($input['ingredients']) && isset($input['amount']) && isset($input['metric'])){
					
					$ingredient = $input['ingredients'];
					$amount = $input['amount'];
					$metric = $input['metric'];
					$grams = $input['grams'];

					$array_count = count($ingredient);
					for($i=0; $i<$array_count; $i++){
					  
					  $xx = array_keys($ingredient[$i]);
					  if($xx[0] == 'x'){
						  $r_i = new MenuRecipesIngredients();
						  $r_i->menu_ingredients_id = $ingredient[$i][$xx[0]];
						  $r_i->amount = $amount[$i][$xx[0]];
						  $r_i->metric_id = $metric[$i][$xx[0]];
						  $r_i->grams = $grams[$i][$xx[0]];
						  $r_i->ordering = $i;
						  $r_i->active = 1;  
					  }else{
						$r_i = MenuRecipesIngredients::find($xx[0]);
						$r_i->menu_ingredients_id = $ingredient[$i][$xx[0]];
						$r_i->amount = $amount[$i][$xx[0]];
						$r_i->metric_id = $metric[$i][$xx[0]]; 
						$r_i->grams = $grams[$i][$xx[0]];
						$r_i->ordering = $i;
					  };
					  
					  $data->MenuRecipesIngredients()->save($r_i);
					 	//echo '<pre>'; print_r($r_i); echo '</pre>';exit;
					};			
				};
				
				if(isset($input['method'])){
					$m_count = count($input['method']);
					$mc = 1;
					foreach($input['method'] as $method){
						if($mc <= $m_count){
							foreach($method as $i=>$m){
								if($i == 'x'){
									$_method = new MenuRecipesMethods();
									$_method->description = $m;
									$_method->ordering = $mc;
									$_method->active = 1;
								}else{
									$_method = MenuRecipesMethods::find($i);
									$_method->description = $m;
									$_method->ordering = $mc;
								}
								$data->MenuRecipesMethods()->save($_method);
							};
						$mc++;
						};
					};					
				};
				
				if(isset($input['extra'])){
					$e_count = count($input['extra']);
					$ec = 1;
					foreach($input['extra'] as $_extra){
						if($ec <= $e_count){
							foreach($_extra as $i=>$ex){
								if($i == 'x'){
									$_extra = new MenuRecipesExtras();
									$_extra->description = $ex;
									$_extra->ordering = $ec;
									$_extra->active = 1;
								}else{
									$_extra = MenuRecipesExtras::find($i);
									$_extra->description = $ex;
									$_extra->ordering = $ec;
								}
								$data->MenuRecipesExtras()->save($_extra);
							};
						$ec++;
						};
					};					
				};
				
			};
		}
		return Redirect::action('Admin_RecipesController@getRecipes');
	}
	
	public function getEditRecipes($id){
		$data = MenuRecipes::findOrFail($id);
		
		//->load('MenuRecipesFacts')
		
		// $ingredients = MenuIngredients::orderBy('name','ASC')->get();
		// $metrics = Metric::orderBy('name','ASC')->get();
		
		// $mCat = array();
		// $mCat[0]	= '- Select Category -';
		// foreach ($categories as $category) {
		// 	$mCat[$category->id]	= $category->name;
		// };
		
		// $mIng = array();
		// $mIng[0]	= '- Select Ingredients -';
		// foreach ($ingredients as $ingredient) {
		// 	$mIng[$ingredient->id]	= $ingredient->name;
		// };
		
		// $mMetric = array();
		// $mMetric[0]	= '- Select Metric -';
		// foreach ($metrics as $metric) {
		// 	$mMetric[$metric->id]	= $metric->name;
		// };


			
		$categories = MenuCategories::orderBy('name','ASC')->where('active', '!=', '9')->get(); // Bring in data that has not been deleted
		$ingredients = MenuIngredients::orderBy('name','ASC')->where('active', '=', '1')->get();
		$metrics = Metric::orderBy('name','ASC')->get();
		


		$recipes_images = $data->Images()->orderBy('ordering','ASC')->where('section', '=', 'RECIPE')->get();
		$recipes_facts = $data->MenuRecipesFacts()->orderBy('ordering','ASC')->get();
		$recipes_ingredients = $data->MenuRecipesIngredients()->orderBy('ordering','ASC')->get();
		$recipes_methods = $data->MenuRecipesMethods()->orderBy('ordering','ASC')->get();
		$recipes_extras = $data->MenuRecipesExtras()->orderBy('ordering','ASC')->get();
		
		// echo '<pre>'; print_r( $recipes_ingredients ); echo '</pre>'; 	exit;
		
		//$data = MenuRecipes::where('active', '!=', 9)->get();
		

		
		$mCat = array();
		$mCat[0]	= '- Select Category -';
		foreach ($categories as $category) {
			$mCat[$category->id]	= $category->name;
		};
		//

		$json_array = array();
		$mIng = array();
		$mIng[0]	= '- Select Ingredients -';	
		foreach ($ingredients as $ingredient) {
			$mIng[$ingredient->id]	= $ingredient->name;
			$json_array[$ingredient->id] = array('grams' => $ingredient->grams, 'price' => $ingredient->price);
		};

		$out = array_values($json_array);
		$json_calc = "var myingredientsdata = ". json_encode($json_array);
		
		$mMetric = array();
		$mMetric[0]	= '- Select Metric -';
		foreach ($metrics as $metric) {
			$mMetric[$metric->id]	= $metric->name;
		};
		
		


		//$data from the load function above holds all the data for facts to go into the form
		return View::make('admin.recipes.form')
			->with(array(
				'data' => $data,// This 
				'categories' => $mCat,
				'ingredients' => $mIng,
				'metric' => $mMetric,
				'r_images' => $recipes_images,
				'r_facts' => $recipes_facts,
				'r_ingredients' => $recipes_ingredients,
				'r_methods' => $recipes_methods,
				'r_extras' => $recipes_extras,
				'json_calc' => $json_calc,
				'title'		=> 'Edit Recipe:'.$data->name
			));	
		
	}
	
	public function postUpdateRecipes(){
		$input = Input::all();
		
		// echo '<pre> First exit to check for input '; print_r($input); echo '</pre>'; 	exit;
		
		
		$rules = array(
			'title' => 'required|Max:30|unique:menu_recipes,name,'.Input::get('id'),
			'summary' => 'required',
			'length' => 'required',
			
			'serve' => 'required',
			'categories' => 'required|not_in:0'
		);
		$validator = Validator::make($input, $rules);

		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}else{
			//die('Hi');
			//echo '<pre>'; print_r($input); echo '</pre>'; 	exit;
			
			$data = MenuRecipes::findOrFail($input['id']);
			$data->name 	= $input['title'];
			$data->summary 	= $input['summary'];
			$data->menu_categories_id 	= $input['categories'];
			$data->active = (isset($input['active'])) ? 1 : 0;
			$data->length 	= $input['length'];
			
			$data->difficulty 	= $input['difficulty'];
			$data->serve 	= $input['serve'];
			$data->df  = (isset($input['DF'])) ? 1 : 0;
			$data->ds  = (isset($input['DS'])) ? 1 : 0;
			$data->ef  = (isset($input['EF'])) ? 1 : 0;
			$data->fi  = (isset($input['FI'])) ? 1 : 0;
			$data->gf  = (isset($input['GF'])) ? 1 : 0;
			$data->nf  = (isset($input['NF'])) ? 1 : 0;
			$data->sf  = (isset($input['SF'])) ? 1 : 0;
			$data->ve  = (isset($input['VE'])) ? 1 : 0;
			$data->v  = (isset($input['V'])) ? 1 : 0;
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
									$_image->section = 'RECIPE';
									$_image->ordering = $p;
									$_image->active = 1;
									
								}else{
									$_image = Images::find($i_photo);
									$_image->name = $photo;
									$_image->summary = $input['img_des'][$p][$i_photo];
									$_image->link_id = $input['id'];
									$_image->section = 'RECIPE';
									$_image->ordering = $p;
									$_image->active = 1;
								};
								$data->Images()->save($_image);
							};
						$p++;
						}
					};
					if(isset($input['ddp'])){
						$ddp = $input['ddp'];
						// echo '<pre>'; print_r($ddp); echo '</pre>'; 	exit;
						
						foreach($ddp as $dp_delete){
						
							$dp = Images::find($dp_delete);
							$dp->delete();
						};
					};
				};

				if(isset($input['fact'])){
					//echo '<pre>'; print_r($input['fact']); echo '</pre>'; 	exit;
					$f_count = count($input['fact']);
					$fc = 1;
					foreach($input['fact'] as $fact){
						if($fc <= $f_count){
							//We need the index = $i and $f is the value
							foreach($fact as $i=>$f){
								if ($i == 'x'){
									$_fact = new MenuRecipesFacts();
									$_fact->description = $f;
									$_fact->ordering = $fc;
									$_fact->active = 1;
									//echo '<pre>'; print_r($_fact); echo '</pre>'; 	exit;
								}else {
									$_fact = MenuRecipesFacts::find($i);
									$_fact->description = $f;
									$_fact->ordering = $fc;
								};
								$data->MenuRecipesFacts()->save($_fact);
							};
						$fc++;
						};
					};
					if(isset($input['ddf'])){
						$ddf = $input['ddf'];
						//echo '<pre>'; print_r($ddf); echo '</pre>'; 	exit;
						
						foreach($ddf as $df_delete){
						
							$df = MenuRecipesFacts::find($df_delete);
							$df->delete();
						};
					};
											 
				};
				
				if(isset($input['ingredients']) && isset($input['amount']) && isset($input['metric'])){
					
					
					
					$ingredient = $input['ingredients'];
					$amount = $input['amount'];
					$metric = $input['metric'];
					$grams = $input['grams'];
					
					// echo '<pre>'; print_r($grams); echo '</pre>'; exit;

					//$recipe_ingredient = array($ingredient, $amount, $metric);
					//$array_count = count($recipe_ingredient);
					$array_count = count($ingredient);
					for($i=0; $i<$array_count; $i++){
					  
					  $xx = array_keys($ingredient[$i]);
					  /*echo '<pre>$xx[0] ... we need the value of the first index => this will give us the ID <br><br><strong>'; 
					  print_r($xx[0]); echo '</strong></pre>';
					  echo '<pre>$ingredient[$i][$xx[0]] ... injecting it into here will produce<br><br>$ingredient[0][10]<br>yielding the VALUE<br><br><strong>'; 
					  print_r($ingredient[$i][$xx[0]]); echo '</strong></pre><br/>';
					  echo '<pre>'; print_r($amount[$i][$xx[0]]); echo '</strong></pre><br/>';
					  echo '<pre>'; print_r($metric[$i][$xx[0]]); echo '</strong></pre><br/>';
					  
					  echo '<hr/>';*/
					  
					  
					  if($xx[0] == 'x'){
						  $r_i = new MenuRecipesIngredients();
						  $r_i->menu_ingredients_id = $ingredient[$i][$xx[0]];
						  $r_i->amount = $amount[$i][$xx[0]];
						  $r_i->metric_id = $metric[$i][$xx[0]];
						  $r_i->grams = $grams[$i][$xx[0]];
						  $r_i->ordering = $i;
						  $r_i->active = 1;  
					  }else{
						$r_i = MenuRecipesIngredients::find($xx[0]);
						$r_i->menu_ingredients_id = $ingredient[$i][$xx[0]];
						$r_i->amount = $amount[$i][$xx[0]];
						$r_i->metric_id = $metric[$i][$xx[0]];
						$r_i->grams = $grams[$i][$xx[0]]; 
						$r_i->ordering = $i;						
						
					  };
					  $data->MenuRecipesIngredients()->save($r_i);
				  
					};


					// $queries = DB::getQueryLog();
					//   echo '<pre>'; print_r($queries); echo '</pre>';
					  // echo '<pre>'; print_r($input['ddi']); echo '</pre>'; 	exit;


					if(isset($input['ddi'])){
						$ddi = $input['ddi'];
	
						
						foreach($ddi as $_delete){
							
							$di = MenuRecipesIngredients::find($_delete);
							//$di->active = 9;
							//$di->save();
							$di->delete();
						};
					};		
				};
				 
				if(isset($input['method'])){
					$m_count = count($input['method']);
					$mc = 1;
					foreach($input['method'] as $method){
						if($mc <= $m_count){
							foreach($method as $i=>$m){
								if($i == 'x'){
									$_method = new MenuRecipesMethods();
									$_method->description = $m;
									$_method->ordering = $mc;
									$_method->active = 1;
								}else{
									$_method = MenuRecipesMethods::find($i);
									$_method->description = $m;
									$_method->ordering = $mc;
								}
								$data->MenuRecipesMethods()->save($_method);
							};
						$mc++;
						};
					};
					if(isset($input['ddm'])){
						$ddm = $input['ddm'];
						//echo '<pre>'; print_r($ddm); echo '</pre>'; 	exit;
						
						foreach($ddm as $dm_delete){
						
							$dm = MenuRecipesMethods::find($dm_delete);
							$dm->delete();
						};
					};					
				};
				
				if(isset($input['extra'])){
					$e_count = count($input['extra']);
					$ec = 1;
					foreach($input['extra'] as $_extra){
						if($ec <= $e_count){
							foreach($_extra as $i=>$ex){
								if($i == 'x'){
									$_extra = new MenuRecipesExtras();
									$_extra->description = $ex;
									$_extra->ordering = $ec;
									$_extra->active = 1;
								}else{
									$_extra = MenuRecipesExtras::find($i);
									$_extra->description = $ex;
									$_extra->ordering = $ec;
								}
								$data->MenuRecipesExtras()->save($_extra);
							};
						$ec++;
						};
					};
					if(isset($input['dde'])){
						$dde = $input['dde'];
						//echo '<pre>'; print_r($dde); echo '</pre>'; 	exit;
						
						foreach($dde as $de_delete){
						
							$de = MenuRecipesExtras::find($de_delete);
							$de->delete();
						};
					};						
				};
			};
			//exit;	
			return Redirect::action('Admin_RecipesController@getRecipes'); 
		}
	}
	
	public function getActiveRecipes($id){
		$data = MenuRecipes::findOrFail($id);
		$data->active = ($data->active == 0)? 1 : 0; //If it is == 0 thats true so change the value to 1, else if its false the value is 1 so change it to 0
		$data->save();
		return Redirect::action('Admin_RecipesController@getRecipes');
	}
	
	public function getDeleteRecipes($id){
		$data = MenuRecipes::findOrFail($id);
		$data->active = 9;
		$data->save();
		return Redirect::action('Admin_RecipesController@getRecipes');
	}
}