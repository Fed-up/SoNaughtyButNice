<?php

class ProfileController extends BaseController {
	public function getProfile(){
		if(Auth::user()){
			$user = Auth::user();
			$user_id = $user->id;
		}else{
			$user_id = 0;
		}

		// Categories
		$cData = MenuCategories::orderBy(DB::raw('RAND()'))->where('active', '=', 1)->take(1)
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
				$collection_check = 1;
				foreach ($category->menuRecipes as $recipe) {

					$count = count($recipe->Images);
					if($count < 1){
						
						$category_image[$category->id] = 'collection.png';
					}else{

						foreach($recipe->Images as $image){

					        if(file_exists('uploads/'.$image->name)){
					            $category_image[$category->id] = $image->name;
					        }else{
					           	$category_image[$category->id] = 'collection.png';
					        }
						}
					}
					
				}

			}else{
				$cnData[] = '';
				$collection_check = 0;
				$category_image = 'collection.png';
			}			
		}
		// echo '<pre>'; print_r($collection_check); echo '</pre>';
		// echo '<pre>'; print_r($category_image); echo '</pre>';exit;

		// Recipe
		$rData = MenuRecipes::orderBy(DB::raw('RAND()'))->where('active', '=', 1)->take(1)
				->with(array('MenuCategories' => function($query)
				{
					$query->where('menu_categories.active', '=', 1);
				}))
				
				->with(array('Images' => function($query){
					$query->where('images.ordering', '=', 0)->where('section', '=', 'RECIPE')->where('active', '=', 1);
				}))
			
			->get();


		foreach ($rData as $recipe) {

			// echo '<pre>'; print_r($recipe->MenuCategories); echo '</pre>';

			$count = count($recipe->MenuCategories);
			if($count > 0){
				$category[$recipe->id] = $recipe->MenuCategories;

				$count = count($recipe->Images);
				if($count < 1){
					// echo '<pre>'; print_r($ingredient->id); echo '</pre>';
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

		$eData = Events::orderBy('date','ASC')->where('active', '=', 1)->take(1)
			->with(array('Images' => function($query){
					$query->where('section', '=', 'EVENT')->where('ordering', '=', 0)->where('active', '=', 1);
				}))
		->get();
		$event = 'eData';

		foreach ($eData as $event) {
			$count = count($event->Images);
			if($count < 1){
				// echo '<pre>'; print_r($event); echo '</pre>';exit;
				$event_image[$event->id] = 'event.png';

			}else{

				foreach($event->Images as $image){

			        if(file_exists('uploads/'.$image->name)){
			            $event_image[$event->id] = $image->name;
			        }else{
			           	$event_image[$event->id] = 'event.png';
			        }
				}
			}
			$e_count = $count;
		}

		if($event == 'eData'){
			$event_image = 'event.png';	
			$e_count = 'empty';
		}
		// echo '<pre>'; print_r($e_count); echo '</pre>';exit;





		$pData = Catering::orderBy(DB::raw('RAND()'))->where('active', '=', 1)->take(1)
			->with(array('Images' => function($query){
					$query->where('section', '=', 'CATERING')->where('ordering', '=', 0)->where('active', '=', 1);
				}))
		->get();
		 // echo '<pre> First exit to check for input '; print_r($eData); echo '</pre>'; 	exit;

		foreach ($pData as $catering) {

			// echo '<pre>'; print_r($ingredient->name); echo '</pre>';
			$count = count($catering->Images);
			if($count < 1){
				// echo '<pre>'; print_r($ingredient->id); echo '</pre>';
				$catering_image[$catering->id] = 'catering.png';
			}else{

				foreach($catering->Images as $image){

			        if(file_exists('uploads/'.$image->name)){
			            $catering_image[$catering->id] = $image->name;
			        }else{
			           	$catering_image[$catering->id] = 'catering.png';
			        }
				}
			}
			// echo '<pre>'; print_r($ingredient_image); echo '</pre>';
		}







		

		// 
		 // echo '<pre>'; print_r($events[0]->Images[0]->name); echo '</pre>';exit;


		return View::make('profile.profile')->with(array(
			// 'recipe_message' => $recipe_message,
			// 'rData' => $cRecipe,
			// 'recipe_paid' =>	$recipe_paid,
			// 'recipe_confirm_paid' => $recipe_confirm_paid,
			// 'event_message' => $event_message,
			// 'eData' => $events,
			// 'event_paid' =>	$event_paid,
			// 'event_confirm_paid' => $event_confirm_paid,
			'collections' => $cnData,
			'rData' => $rData,
			'eData' => $eData,
			'pData' => $pData,

			'cImage' => $category_image,
			'rImage' => $recipe_image,
			'eImage' => $event_image,
			'pImage' => $catering_image,

			'e_count' => $e_count,
			'collection_check' => $collection_check,
			)
		);
	}
}