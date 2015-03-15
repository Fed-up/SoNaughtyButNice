<?php

class RecipeController  extends BaseController {

	public function getRecipes(){
		$rData = MenuRecipes::orderBy(DB::raw('RAND()'))->where('active', '=', 1)->where('exclusive', '!=', 1)->take(12)
			->with(array('MenuCategories' => function($query)
			{
				$query->where('menu_categories.active', '=', 1);
			}))
			
			->with(array('Images' => function($query){
				$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE')->where('active', '=', 1);
			}))
		
		->get();

		$exrData = MenuRecipes::orderBy(DB::raw('RAND()'))->where('active', '=', 1)->where('exclusive', '=', 1)->take(12)
			->with(array('MenuCategories' => function($query)
			{
				$query->where('menu_categories.active', '=', 1);
			}))
			
			->with(array('Images' => function($query){
				$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE')->where('active', '=', 1);
			}))
		
		->get();


		foreach ($rData as $recipe) {
			$count = count($recipe->MenuCategories);
			if($count > 0){
				$category[$recipe->id] = $recipe->MenuCategories;

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
			}else{
				$category[$recipe->id] = '';
				$recipe_image[$recipe->id] = 'recipe.png';
			}
		}



		foreach ($exrData as $exRecipe) {
			$count = count($exRecipe->MenuCategories);
			if($count > 0){
				$category[$exRecipe->id] = $exRecipe->MenuCategories;

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
			}else{
				$category[$exRecipe->id] = '';
				$exRecipe_image[$exRecipe->id] = 'recipe.png';
			}
		}
		// echo '<pre>'; print_r($exrData); echo '</pre>'; exit;
		
		if(isset($exrData) && isset($exRecipe_image))
			return View::make('public.recipes')->with(array(
				'rData' => $rData,
				'rImage' => $recipe_image,
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
