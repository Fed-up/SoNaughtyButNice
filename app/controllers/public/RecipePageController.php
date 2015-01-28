<?php
class RecipePageController  extends BaseController {

	public function getRecipe($id){
			if(Auth::user()){
				$user = Auth::user();
				$user_id = $user->id;
			}else{
				$user_id = 0;
			}
			
			
			$rData = MenuRecipes::where('id', '=', $id)
				->with(array('MenuCategories' => function($query) use ($id)
				{
					$query->orderBy(DB::raw('RAND()'))
						->with(array('menuRecipes' => function($query) use ($id)
						{
							$query->where('menu_recipes.active', '=', 1)->where('menu_recipes.id', '!=', $id)
								->with(array('Images' => function($query)
								{
									$query->where('ordering', '=', 0)->where('section', '=', 'RECIPE');
								}));
						}));
				}))
				->with(array('MenuRecipesFacts' => function($query){
					$query->orderBy('menu_recipes_facts.ordering','ASC');
				}))
				->with(array('MenuRecipesIngredients' => function($query){
					$query->where('menu_recipes_ingredients.active', '=', 1)
						->with('MenuIngredients')
						->with('Metric');
				}))
				->with(array('MenuRecipesMethods' => function($query){
					$query->orderBy('menu_recipes_methods.ordering','ASC');
				}))
				->with(array('MenuRecipesExtras' => function($query){
					$query->orderBy('menu_recipes_extras.ordering','ASC');
				}))
				->with(array('Images' => function($query){
					$query->orderBy('images.ordering','DESC')->where('section', '=', 'RECIPE');
				}))
				->with(array('User' => function($query) use ($user_id){
					// echo '<pre>'; print_r($user_id); echo '</pre>';exit;
					$query->where('paid.user_id', '=', $user_id)->where('paid.type', '=', 'RECIPE');
				}))
			
			->orderBy(DB::raw('RAND()'))->where('active', '=', 1)->take(3)->get();
			
			   // $queries = DB::getQueryLog();

			foreach ($rData as $recipe) {

				
				$count = count($cRecipes = $recipe->MenuCategories->menuRecipes);
				if($count > 0){
					foreach($recipe->MenuCategories->menuRecipes as $cRecipe){

						
						foreach($cRecipe->Images as $image){
							
					        if(file_exists('uploads/'.$image->name)){
					            $cRecipe_image[$cRecipe->id] = $image->name;
					        }else{
					           	$cRecipe_image[$cRecipe->id] = 'recipe.png';
					        }
					    }
					}

				}else{
						$cRecipe_image = '';
				}

				// echo '<pre>'; print_r($rIngredient); echo '</pre>';exit;

				$count = count($recipe->menuRecipesIngredients);
				// echo '<pre>'; print_r($recipe->menuRecipesIngredients); echo '</pre>';exit;

				if($count > 0){

					foreach ($recipe->menuRecipesIngredients as $rIngredient) {

						$mCount = count($rIngredient->metric);
						$iCount = count($rIngredient->MenuIngredients);

						// echo '<pre>'; print_r('Ingredient'.$iCount); echo '</pre>';
						// echo '<pre>'; print_r('Metric'.$mCount); echo '</pre>';

						if(($mCount > 0 ) && ($iCount > 0)){
							// echo '<pre>'; print_r("Goog Good"); echo '</pre>';

							// $ingredients[$rIngredient->MenuIngredients->$id] = $rIngredient->amount.' '.$rIngredient->metric->name.' '.$rIngredient->MenuIngredients->name;

							$rnIngredient[] = $rIngredient;

						}else{
							$rnIngredient[] = '';
						}
						
					}



				}else{

				}
				// }

				// if(empty($rnIngredient[0])){
				// 	$i = 0;
				// 	foreach ($rnIngredient->MenuIngredients as $ingredient) {
				// 		echo '<pre>'; print_r($ingredient); echo '</pre>';
				// 		$i++;
				// 	}
				// 	exit;

				// }else{
				// echo '<pre>'; print_r($rnIngredient); echo '</pre>';exit;
				// }

				// if(empty($rnIngredient[0])){
				// 	echo '<pre>'; print_r($rnIngredient); echo '</pre>';
				// }exit;
				


				$count = count($recipe->MenuCategories);
				if($count > 0){
					$category = $recipe->MenuCategories;

					$count = count($recipe->Images);

					// echo '<pre>'; print_r($image); echo '</pre>';exit;

					if($count > 0){
						$i = 0;
						foreach($recipe->Images as $image){



						        if(file_exists('uploads/'.$image->name)){
						            $recipe_image[$i][$recipe->id] = $image->name;
						            if($i == $count-1){ $header_image = $image->name;}
						        }else{
						           	$recipe_image[$i][$recipe->id] = 'recipe.png';
						           	if($i == $count-1){ $header_image = 'recipe.png';} 
						        }


						    $i++;
						}
					}else{
						$recipe_image[0][$recipe->id] = 'recipe.png';
						$header_image = 'recipe.png';
					}

				}else{
					$category[$recipe->id] = '';
				}
			}
			
			return View::make('public.recipe_page')->with(array(
				'rData' => $rData,
				'hImage' => $header_image,
				'category' => $category,
				'rImage' => $recipe_image,
				'crImage' => $cRecipe_image,
				'rIngredients' => $rnIngredient,
				)
			);
		}
	}
