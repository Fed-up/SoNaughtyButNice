<?php
class IngredientPageController  extends BaseController {

	public function getIngredient($id){
		$iData = MenuIngredients::where('id', '=', $id)
			->with(array('Images' => function($query)
			{
				$query->orderBy(DB::raw('RAND()'))->where('section', '=', 'INGREDIENT')->where('active', '=', 1);
			}))
		->orderBy(DB::raw('RAND()'))->where('active', '=', 1)->get();






		foreach ($iData as $ingredient) {
			
			$count = count($ingredient->Images);
			// echo '<pre>'; print_r($count); echo '</pre>';exit;




			if($count > 0){

				// echo '<pre>'; print_r($ingredient->Images[0]->name); echo '</pre>';exit;


				if(file_exists('uploads/'.$ingredient->Images[0]->name)){


		            $ingredient_image[$ingredient->id] = $ingredient->Images[0]->name;
		        }else{
		           	$ingredient_image[$ingredient->id] = 'ingredient.png';
		        }
		    }else{
				$ingredient_image[$ingredient->id] = 'ingredient.png';
		    }
		    // echo '<pre>'; print_r($ingredient_image); echo '</pre>';   
		}







		$rData = MenuRecipes::where('menu_recipes.active', '=', 1)->take(8)
			->with(array('MenuRecipesIngredients' => function($query) use ($id){
				$query->where('menu_recipes_ingredients.active', '=', 1)
					->with(array('MenuIngredients' => function($query) use ($id){
						$query->where('menu_ingredients.id', '=', $id);
					}));
			}))
			->with(array('Images' => function($query)
			{
				$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE');
			}))
		->orderBy('menu_recipes.name', '=', 'ASC')->where('active', '=', 1)->get();
		
		// $queries = DB::getQueryLog();
  // 		echo '<pre>'; print_r($queries); echo '</pre>';exit;
		
		foreach($rData  as $recipe){
			foreach($recipe->MenuRecipesIngredients as $ingredients){
				if(isset($ingredients->MenuIngredients)){
					$rnData[] = $recipe;
				}
			}	
		}
		// echo '<pre>'; print_r($rnData); echo '</pre>';exit;

		if(isset($rnData)){
			return View::make('public.ingredient_page')->with(array(
				'iData' => $iData,
				'rData' => $rnData,
				'iImage' => $ingredient_image)
			);
		}else{
			return View::make('public.ingredient_page')->with(array(
				'iData' => $iData,
				'iImage' => $ingredient_image)
			);
		}
	}
};