<?php
class RecipePageController  extends BaseController {

	public function getRecipe($id){
			if(Auth::user()){
				$user = Auth::user();
				$user_id = $user->id;
				if($user->user_type == 'B2B'){
					$sales_data = SalesData::where('menu_recipe_id', '=', $id)->get();
					$sales_count = count($sales_data);
					if($sales_count == 0){
						$sales_count = 0;
					}else{
						$sales_count = 1;
						foreach($sales_data as $sd){
							if($sd->sales_amount == 0){
								$sales_count = 0;
								// echo '<pre>'; print_r($sd->sales_amount); echo '</pre>';exit;
							}
							$sd->sales_amount = number_format($sd->sales_amount,0);
							$sd->total_recipe_grams = number_format($sd->total_recipe_grams,2);
							$sd->B2B_total_recipe_revenue = number_format($sd->B2B_total_recipe_revenue,2);
							$sd->total_grams_per_piece = number_format($sd->total_grams_per_piece,2);
							$sd->B2B_sales_price = number_format($sd->B2B_sales_price,2);
						}
					}
					
				}else{
					$sales_data = 0;
					$sales_count = 0;
				}
			}else{
				$user_id = 0;
				$sales_count = 0;
				$sales_data = 0;
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

			$exrData = MenuRecipes::where('id', '=', $id)
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
				$count = count($recipe->menuRecipesIngredients);
				if($count > 0){
					foreach ($recipe->menuRecipesIngredients as $rIngredient) {
						$mCount = count($rIngredient->metric);
						$iCount = count($rIngredient->MenuIngredients);
						if(($mCount > 0 ) && ($iCount > 0)){
							$rnIngredient[] = $rIngredient;
						}else{
							$rnIngredient[] = '';
						}
					}
				}else{}
				$count = count($recipe->MenuCategories);
				if($count > 0){
					$category = $recipe->MenuCategories;
					$count = count($recipe->Images);
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


			// echo '<pre>'; print_r($sales_data); echo '</pre>';exit;

			
			return View::make('public.recipe_page')->with(array(
				'rData' => $rData,
				'hImage' => $header_image,
				'category' => $category,
				'rImage' => $recipe_image,
				'crImage' => $cRecipe_image,
				'rIngredients' => $rnIngredient,
				'sales_data' => $sales_data,
				'sales_count' => $sales_count,
				)
			);
		}
	}
