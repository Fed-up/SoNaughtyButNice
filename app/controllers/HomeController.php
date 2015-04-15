<?php

class HomeController extends BaseController {

	public function getIndex(){
		if(Auth::user()){
			$user = Auth::user();
			if($user->user_type == 'B2B'){
				$B2B = 1;
			}else{
				$B2B = 0;
			}
		}else{
			$B2B = 0;
		}
		
		// Header Image
		$hData = Header::orderBy(DB::raw('RAND()'))->where('active', '=', 1)->take(3)
			->with(array('Images' => function($query){
					$query->where('section', '=', 'HEADER');
				}))
		->get();
		foreach($hData as $data){
			$h_object = Header::findOrFail($data->id);
			$header_images[] = $h_object->Images()->where('section', '=', 'HEADER')->orderBy(DB::raw('RAND()'))->take(1)->get();

			
			foreach ($header_images as $header) {
				if(empty($header->first()->name)){
					$header_image[$data->id] = 'eventheader.jpg';
			    }else{
			        if(file_exists('uploads/'.$header->first()->name)){
			            $header_image[$data->id] = $header->first()->name;
			        }else{
			           	$header_image[$data->id] = 'eventheader.jpg';
			        }
			    }
			    // echo '<pre>'; print_r($header_image); echo '</pre>';
			} 



		};
		
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
					// echo '<pre>'; print_r($recipe_image); echo '</pre>';
				}

			}else{
				$cnData[] = '';
				$collection_check = 0;
				$category_image = 'collection.png';
			}			
		}
		
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

			// echo '<pre>'; print_r($ingredient->name); echo '</pre>';

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
		// exit;

		$iData = MenuIngredients::with(array('Images' => function($query)
			{
				$query->where('section', '=', 'INGREDIENT')->orderBy(DB::raw('RAND()'))->where('active', '=', 1);
			}))
		->orderBy(DB::raw('RAND()'))->where('active', '=', 1)->take(1)->get();
		
		// echo '<pre>'; print_r($iData); echo '</pre>';
		// 		echo '<hr>';

		foreach ($iData as $ingredient) {

			// echo '<pre>'; print_r($ingredient->name); echo '</pre>';
			$count = count($ingredient->Images);
			if($count < 1){
				// echo '<pre>'; print_r($ingredient->id); echo '</pre>';
				$ingredient_image[$ingredient->id] = 'ingredient.png';
			}else{

				foreach($ingredient->Images as $image){

			        if(file_exists('uploads/'.$image->name)){
			            $ingredient_image[$ingredient->id] = $image->name;
			        }else{
			           	$ingredient_image[$ingredient->id] = 'ingredient.png';
			        }
				}
			}
			// echo '<pre>'; print_r($ingredient_image); echo '</pre>';
		}

		$eData = Events::orderBy('date','ASC')->where('active', '=', 1)->take(1)
			->with(array('Images' => function($query){
					$query->where('section', '=', 'EVENT')->where('ordering', '=', 0)->where('active', '=', 1);
				}))
		->get();

		// if(empty($eData)){
		// 	echo '<pre>'; print_r($eData); echo '</pre>'; exit;
		// }
		// exit;
		// // echo '<pre>'; print_r($iData); echo '</pre>'; exit;
		$event = 'eData';
		foreach ($eData as $event) {

			// echo '<pre>'; print_r($ingredient->name); echo '</pre>';
			$e_count = count($event->Images);
			$event_id = $event->id;






			if($e_count < 1){
				
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
			
		}
		if($event == 'eData'){
			$event_image = 'event.png';	
			$e_count = 'empty';
		}
		

		// echo '<pre>'; print_r($event_image); echo '</pre>';exit;


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

		// echo '<pre>'; print_r($ingredient_image); echo '</pre>';
		// echo '<pre>'; print_r($iData); echo '</pre>';
		// exit;



		return View::make('public.index')->with(array(
			'h_data' => $hData,
			'h_image' => $header_images,
			'collections' => $cnData,
			'rData' => $rData,
			'iData' => $iData,
			'eData' => $eData,
			'pData' => $pData,

			'hImage' => $header_image,
			'collection_check' => $collection_check,
			'cImage' => $category_image,
			'rImage' => $recipe_image,
			'iImage' => $ingredient_image,
			'eImage' => $event_image,
			'pImage' => $catering_image,

			'e_count' => $e_count,
			'B2B' => $B2B,
			)
		);
	}


	public function getMaps(){

	// // I'm creating an array with user's info but most likely you can use $user->email or pass $user object to closure later
	// $user = array(
	// 	'email'=>'tomcurphey12@gmail.com',
	// 	'name'=>'Tom'
	// );

	// // the data that will be passed into the mail view blade template
	// $data = array(
	// 	'detail'=>'You are awesome',
	// 	'name'=>'Samhj'
	// );

	//  echo '<pre>'; print_r($user['email']); echo '</pre>';exit;

	// // use Mail::send function to send email passing the data and using the $user variable in the closure
	// Mail::send('public.maps', $data, function($message) use ($user)
	// {
	//   $message->from('hello@sonaughtybutnice.com', 'Sarah and Tom');

	//   $message->to('tomcurphey12@gmail.com', 'Tom')->subject('Welcome to My Laravel app!');
	// });


	 Mail::send('public.maps', array('name' => 'Tom'), function($message){
		$message->to('hello@sonaughtybutnice.com', 'Tom Curphey')->subject('test email');
	}); 

	// echo '<pre>'; print_r($ingredient_image); echo '</pre>';
	// echo '<pre>'; print_r($iData); echo '</pre>';
	// exit;

	return View::make('public.maps');
		// ->with(array(
		// 'detail' => $detail, 
		// 'name' => $name,
		// ));
	

	}

}