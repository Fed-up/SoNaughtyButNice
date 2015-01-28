<?php

class CollectionController  extends BaseController {

	public function getCollections(){

		$cData = MenuCategories::orderBy(DB::raw('RAND()'))->where('active', '=', 1)->take(12)
			->with(array('menuRecipes' => function($query)
			{
				$query->where('menu_recipes.active', '=', 1)
					->with(array('Images' => function($query)
					{
						$query->where('ordering', '=', 0)->where('section', '=', 'RECIPE');
					}));
			}))
		->get();

		// echo '<pre>'; print_r($cData); echo '</pre>';exit;

		foreach($cData as $category){
			$count = count($category->menuRecipes);
			if($count > 0){
				$cnData[] = $category;
				
				foreach ($category->menuRecipes as $recipe) {

					$count = count($recipe->Images);
					if($count < 1){
						
						$category_image[$category->id] = 'recipe.png';
					}else{

						foreach($recipe->Images as $image){

					        if(file_exists('uploads/'.$image->name)){
					            $category_image[$category->id] = $image->name;
					        }else{
					           	$category_image[$category->id] = 'recipe.png';
					        }
						}
					}
					// echo '<pre>'; print_r($recipe_image); echo '</pre>';
				}

			}else{
				$cnData[] = '';
			}			
		}
		
		return View::make('public.collections')->with(array(
			'collections' => $cnData,
			'cImage' => $category_image)
		);
	}
}
