<?php

class CateringController  extends BaseController {

	public function getCatering(){

		$cData = Catering::with(array('Images' => function($query)
			{
				$query->where('section', '=', 'CATERING')->orderBy(DB::raw('RAND()'))->where('active', '=', 1);
			}))
		->orderBy('name','ASC')->where('active', '=', 1)->get();




		foreach ($cData as $package) {
			// echo '<pre>'; print_r($npackage); echo '</pre>'; exit;

			$count = count($package->Images);
			if($count < 1){
				$package_image[$package->id] = 'ingredient.png';
			}else{
				foreach($package->Images as $image){
			        if(file_exists('uploads/'.$image->name)){
			            $package_image[$package->id] = $image->name;
			        }else{
			           	$package_image[$package->id] = 'ingredient.png';
			        }
				}
			}
		}
		// echo '<pre>'; print_r($cData); echo '</pre>'; exit;

		return View::make('public.catering')->with(array(
			'cData' => $cData,
			'catering_image' => $package_image)
		);
	}



	public function getPackage($id)
	{
		$pData = Catering::where('active', '=', '1')->where('id', '=', $id)
			->with(array('menuRecipes' => function($query) use ($id){
				
				$query->where('catering_recipes.catering_id', '=', $id)->orderBy('pivot_ordering','ASC')
				->with(array('Images' => function($query) use ($id){
					$query->where('ordering', '=', 0)->where('section', '=', 'RECIPE');
				}));
			}))			
		->get();

		foreach($pData as $package){
			foreach ($package->MenuRecipes as $recipe) {

				$iData = Images::where('active', '=', '1')
					->where('link_id', '=', $recipe->id)
					->where('ordering', '=', 0)
					->where('section', '=', 'RECIPE')
					->get();
				
				// echo '<pre>'; print_r($iData[0]->name); echo '</pre>';exit;	
				
				$i_count = count($iData);

				

				if($i_count > 0){
					$recipe_image[$recipe->id] = $iData[0]->name;
				}else{
					$recipe_image[$recipe->id] = 'recipe.png';
				}	
				
			}
		}
		// echo '<pre>'; print_r($pData); echo '</pre>';exit;	
			
			
		// foreach($pData as $package){
		// 	echo '<pre>'; print_r($package->id); echo '</pre>';
		// }exit;

		return View::make('sales.package')->with(array(
			'pData' => $pData,
			'recipe_image' => $recipe_image)
		);
	}



	public function packageEnquiry(){

		echo 'Done';exit;

		$messageData = array(
	        'name' => $user->fname,
	        'quantity' => $quantity[$product->id],
	        'ticket_id' => $ticket_id,
	        'product_id' => $product->id,

	        'event_id' => $edata->id,
	        'event_name' => $edata->name,
	        'event_date' => $edata->date,
	        'event_time' => $edata->time,
	        'event_cost' => $edata->price*$quantity[$product->id],
	        'event_map' => $edata->map,
	    );

		Mail::send('sales.package_email', $messageData, function($message) use ($user){
			$message->to( $user->email )->cc('sales@sonaughtybutnice.com')->subject('So Naughty But Nice - Event confirmation');
		}); //->cc('sales@sonaughtybutnice.com')
	}
}



	

























		// $rData = MenuRecipes::orderBy(DB::raw('RAND()'))->where('active', '=', 1)->get();
		// $r_count = 0;
		// foreach($rData as $data){
		// 	$r_object = MenuRecipes::findOrFail($data->id);
		// 	$rData[$r_count]['image'] = $r_object->Images()->where('ordering', '=', 0)->take(1)->get();
		// 	$r_count++;
		// };//echo '<pre>'; print_r($rData); echo '</pre>';exit;
		
		// $rData = MenuCategories::orderBy(DB::raw('RAND()'))->where('menu_categories.active', '=', 1)
		// ->with(array('menuRecipes' => function($query)
		// {
		// 	//while(mysqli_num_rows(MenuCategories) > 0){
		// 	$query->where('menu_recipes.active', '=', 1)->where('ordering', '=', 0)
		// 		->with(array('Images' => function($query)
		// 		{
		// 			$query->where('ordering', '=', 0);
		// 		}));
		// 	//}
		// }))->get();
		
		
		
		
		// $rData = MenuRecipes::orderBy('created_at','DESC')->where('active', '=', 1)
		// 		->with(array('MenuCategories' => function($query)
		// 		{
		// 			$query->where('menu_categories.active', '=', 1);
		// 		}))
				
		// 		->with(array('Images' => function($query){
		// 			$query->where('images.ordering', '=', 0);
		// 		}))
			
		// 	->get();
		// //echo '<pre>'; print_r($rData); echo '</pre>';exit;