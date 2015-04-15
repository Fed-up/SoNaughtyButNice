<?php

class RecipeController  extends BaseController {

	public function getRecipes(){
		if(Auth::user()){
			$user = Auth::user();
			if($user->user_type == 'B2B'){
				$rData = MenuRecipes::orderBy(DB::raw('RAND()'))->where('active', '=', 1)->take(18)
					->with(array('MenuCategories' => function($query)
					{
						$query->where('menu_categories.active', '=', 1);
					}))
					
					->with(array('Images' => function($query){
						$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE')->where('active', '=', 1);
					}))
				
				->get();
			}else{
				$rData = MenuRecipes::orderBy(DB::raw('RAND()'))->where('active', '=', 1)->where('exclusive', '!=', 1)->take(18)
					->with(array('MenuCategories' => function($query)
					{
						$query->where('menu_categories.active', '=', 1);
					}))
					
					->with(array('Images' => function($query){
						$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE')->where('active', '=', 1);
					}))
				
				->get();
			}
		}else{
			$rData = MenuRecipes::orderBy(DB::raw('RAND()'))->where('active', '=', 1)->where('exclusive', '!=', 1)->take(18)
				->with(array('MenuCategories' => function($query)
				{
					$query->where('menu_categories.active', '=', 1);
				}))
				
				->with(array('Images' => function($query){
					$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE')->where('active', '=', 1);
				}))
			
			->get();
		}


		$aeData = MenuRecipes::where('active', '=', 1)
			->with(array('MenuCategories' => function($query){$query->where('menu_categories.active', '=', 1);}))
			->with(array('Images' => function($query){$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE')->where('active', '=', 1);}))
		->orderBy('name','ASC')->where('name', 'LIKE', 'a%')->orWhere('name', 'LIKE', 'b%')->orWhere('name', 'LIKE', 'c%')->orWhere('name', 'LIKE', 'd%')->orWhere('name', 'LIKE', 'e%')->get();

		$fjData = MenuRecipes::where('active', '=', 1)
			->with(array('MenuCategories' => function($query){$query->where('menu_categories.active', '=', 1);}))
			->with(array('Images' => function($query){$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE')->where('active', '=', 1);}))
		->orderBy('name','ASC')->where('name', 'LIKE', 'f%')->orWhere('name', 'LIKE', 'g%')->orWhere('name', 'LIKE', 'h%')->orWhere('name', 'LIKE', 'i%')->orWhere('name', 'LIKE', 'j%')->get();

		$koData = MenuRecipes::where('active', '=', 1)
			->with(array('MenuCategories' => function($query){$query->where('menu_categories.active', '=', 1);}))
			->with(array('Images' => function($query){$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE')->where('active', '=', 1);}))
		->orderBy('name','ASC')->where('name', 'LIKE', 'k%')->orWhere('name', 'LIKE', 'l%')->orWhere('name', 'LIKE', 'm%')->orWhere('name', 'LIKE', 'n%')->orWhere('name', 'LIKE', 'o%')->get();

		$ptData = MenuRecipes::where('active', '=', 1)
			->with(array('MenuCategories' => function($query){$query->where('menu_categories.active', '=', 1);}))
			->with(array('Images' => function($query){$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE')->where('active', '=', 1);}))
		->orderBy('name','ASC')->where('name', 'LIKE', 'p%')->orWhere('name', 'LIKE', 'q%')->orWhere('name', 'LIKE', 'r%')->orWhere('name', 'LIKE', 's%')->orWhere('name', 'LIKE', 't%')->get();

		$uzData = MenuRecipes::where('active', '=', 1)
			->with(array('MenuCategories' => function($query){$query->where('menu_categories.active', '=', 1);}))
			->with(array('Images' => function($query){$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE')->where('active', '=', 1);}))
		->orderBy('name','ASC')->where('name', 'LIKE', 'u%')->orWhere('name', 'LIKE', 'v%')->orWhere('name', 'LIKE', 'w%')->orWhere('name', 'LIKE', 'x%')->orWhere('name', 'LIKE', 'y%')->orwhere('name', 'LIKE', 'z%')->get();

		

		foreach ($rData as $recipe) {
			$count = count($recipe->MenuCategories);
			if($count > 0){
				$category[$recipe->id] = $recipe->MenuCategories;
			}else{
				$category[$recipe->id] = '';
			}
			$count = count($recipe->Images);
			if($count < 1){
				$recipe_image[$recipe->id] = 'recipe.png';
			}else{
				foreach($recipe->Images as $image){
			        if(file_exists('uploads/'.$image->name)){
			            $recipe_image[$recipe->id] = $image->name;
			        }else{
			           	$recipe_image[$recipe->id] = 'recipe.png';
			        }
				}
			}
		}

		foreach ($aeData as $ae) {
			

			$count = count($ae->MenuCategories);
			if($count > 0){
				$category[$ae->id] = $ae->MenuCategories;
			}else{
				$category[$ae->id] = '';
			}
			$count = count($ae->Images);
			if($count < 1){
				$ae_recipe_image[$ae->id] = 'recipe.png';
			}else{
				foreach($ae->Images as $image){
			        if(file_exists('uploads/'.$image->name)){
			            $ae_recipe_image[$ae->id] = $image->name;
			        }else{
			           	$ae_recipe_image[$ae->id] = 'recipe.png';
			        }
				}
			}
		// echo '<pre>'; print_r($ae_recipe_image); echo '</pre>'; 
		}
		// exit;

		foreach ($fjData as $fj) {
			$count = count($fj->MenuCategories);
			if($count > 0){
				$category[$fj->id] = $fj->MenuCategories;
			}else{
				$category[$fj->id] = '';
			}
			$count = count($fj->Images);
			if($count < 1){
				$fj_recipe_image[$fj->id] = 'recipe.png';
			}else{
				foreach($fj->Images as $image){
			        if(file_exists('uploads/'.$image->name)){
			            $fj_recipe_image[$fj->id] = $image->name;
			        }else{
			           	$fj_recipe_image[$fj->id] = 'recipe.png';
			        }
				}
			}
		}

		foreach ($koData as $ko) {
			$count = count($ko->MenuCategories);
			if($count > 0){
				$category[$ko->id] = $ko->MenuCategories;
			}else{
				$category[$ko->id] = '';
			}
			$count = count($ko->Images);
			if($count < 1){
				$ko_recipe_image[$ko->id] = 'recipe.png';
			}else{
				foreach($ko->Images as $image){
			        if(file_exists('uploads/'.$image->name)){
			            $ko_recipe_image[$ko->id] = $image->name;
			        }else{
			           	$ko_recipe_image[$ko->id] = 'recipe.png';
			        }
				}
			}
		}

		foreach ($ptData as $pt) {
			$count = count($pt->MenuCategories);
			if($count > 0){
				$category[$pt->id] = $pt->MenuCategories;
			}else{
				$category[$pt->id] = '';
			}
			$count = count($pt->Images);
			if($count < 1){
				$pt_recipe_image[$pt->id] = 'recipe.png';
			}else{
				foreach($pt->Images as $image){
			        if(file_exists('uploads/'.$image->name)){
			            $pt_recipe_image[$pt->id] = $image->name;
			        }else{
			           	$pt_recipe_image[$pt->id] = 'recipe.png';
			        }
				}
			}
		}

		foreach ($uzData as $uz) {
			$count = count($uz->MenuCategories);
			if($count > 0){
				$category[$uz->id] = $uz->MenuCategories;
			}else{
				$category[$uz->id] = '';
			}
			$count = count($uz->Images);
			if($count < 1){
				$uz_recipe_image[$uz->id] = 'recipe.png';
			}else{
				foreach($uz->Images as $image){
			        if(file_exists('uploads/'.$image->name)){
			            $uz_recipe_image[$uz->id] = $image->name;
			        }else{
			           	$uz_recipe_image[$uz->id] = 'recipe.png';
			        }
				}
			}
		}
		// echo '<pre>'; print_r($uzData); echo '</pre>';  exit;




		// if($user->user_type != 'B2B'){
			$exrData = MenuRecipes::orderBy(DB::raw('RAND()'))->where('active', '=', 1)->where('exclusive', '=', 1)
				->with(array('MenuCategories' => function($query)
				{
					$query->where('menu_categories.active', '=', 1);
				}))
				
				->with(array('Images' => function($query){
					$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE')->where('active', '=', 1);
				}))
			
			->get();

			foreach ($exrData as $exRecipe) {
				$count = count($exRecipe->MenuCategories);
				if($count > 0){
					$category[$exRecipe->id] = $exRecipe->MenuCategories;
				}else{
					$category[$exRecipe->id] = '';
				}
				$count = count($exRecipe->Images);
				if($count < 1){
					$exRecipe_image[$exRecipe->id] = 'recipe.png';
				}else{
					foreach($exRecipe->Images as $image){
				        if(file_exists('uploads/'.$image->name)){
				            $exRecipe_image[$exRecipe->id] = $image->name;
				        }else{
				           	$exRecipe_image[$exRecipe->id] = 'recipe.png';
				        }
					}
				}
			}
		// }
		
		if(isset($exrData) && isset($exRecipe_image))
			return View::make('public.recipes')->with(array(
				'rData' => $rData,
				'rImage' => $recipe_image,
				'aeData' => $aeData,
				'aeImage' => $ae_recipe_image,
				'fjData' => $fjData,
				'fjImage' => $fj_recipe_image,
				'koData' => $koData,
				'koImage' => $ko_recipe_image,
				'ptData' => $ptData,
				'ptImage' => $pt_recipe_image,
				'uzData' => $uzData,
				'uzImage' => $uz_recipe_image,
				'category' => $category,
				'exr_image' => $exRecipe_image,
				'exrData' => $exrData,
				)
			);
		else{
			return View::make('public.recipes')->with(array(
				'rData' => $rData,
				'rImage' => $recipe_image,
				'category' => $category,
				)
			);
		}
	}
}
