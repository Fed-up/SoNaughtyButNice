<?php
class IngredientPageController  extends BaseController {

	public function getIngredient($id){
		$iData = MenuIngredients::where('id', '=', $id)->where('active', '=', 1)
			->with(array('Images' => function($query)
			{
				$query->orderBy(DB::raw('RAND()'))->where('section', '=', 'INGREDIENT')->where('active', '=', 1);
			}))
		->orderBy(DB::raw('RAND()'))->where('active', '=', 1)->get();

		foreach ($iData as $ingredient) {			
			$count = count($ingredient->Images);
			// echo '<pre>'; print_r($count); echo '</pre>';exit;
			if($count > 0){
				if(file_exists('uploads/'.$ingredient->Images[0]->name)){
		            $ingredient_image[$ingredient->id] = $ingredient->Images[0]->name;
		        }else{
		           	$ingredient_image[$ingredient->id] = 'ingredient.png';
		        }
		    }else{
				$ingredient_image[$ingredient->id] = 'ingredient.png';
		    }
		    
		}
		
		// echo '<pre>'; print_r($iData); echo '</pre>';  exit; 

		$rData = MenuRecipes::where('menu_recipes.active', '=', 1)
			->with(array('MenuRecipesIngredients' => function($query) use ($id){
				$query->where('menu_ingredients_id', '=', $id);
			}))
			->with(array('Images' => function($query)
			{
				$query->where('ordering', '=', 0)->where('section', '=', 'RECIPE');
			}))

		->orderBy('menu_recipes.name', '=', 'ASC')->where('active', '=', 1)->get();






		
		// $queries = DB::getQueryLog();
  // 		echo '<pre>'; print_r($queries); echo '</pre>';exit;
		
		foreach($rData  as $recipe){
			// echo '<pre>'; print_r($recipe->MenuRecipesIngredients); echo '</pre>';
			$ri_count = count($recipe->MenuRecipesIngredients);
			if($ri_count > 0){
				// foreach($recipe->MenuRecipesIngredients as $ingredients){
				// // if($ingredients->MenuIngredients->id)
				// // echo '<pre>'; print_r($ingredients); echo '</pre>';

				// 	if(isset($ingredients->MenuIngredients)){
				// 			$rnData[] = $recipe;
				// 	}
					// $recipe_image = $recipe->images[0]->name;
					// echo '<pre>'; print_r($recipe->images); echo '</pre>';
					
				// }
				$rnData[] = $recipe;
				// echo '<pre>'; print_r($recipe->name); echo '</pre>';
			}
				
		}
		// exit;
		// echo '<pre>'; print_r($rnData); echo '</pre>';exit;
		
		if(isset($rnData)){
			return View::make('public.ingredient_page')->with(array(
				'iData' => $iData,
				'rData' => $rnData,
				'iImage' => $ingredient_image,
				// 'recipe_image' => $recipe_image,
				)
			);
		}else{
			return View::make('public.ingredient_page')->with(array(
				'iData' => $iData,
				'iImage' => $ingredient_image)
			);
		}
	}
};