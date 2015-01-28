<?php

class CateringController  extends BaseController {

	public function getCatering(){

		$cData = Catering::orderBy('name','ASC')->where('active', '=', '1')
			->with(array('Images' => function($query){
					$query->orderBy('ordering','ASC')->where('section', '=', 'CATERING')->take(1)->get();
				}))
		->get();

		foreach($cData as $package)
		$p_count = count($package->Images);
			// echo '<pre>'; print_r($event->Images[$e_count-1]->name); echo '</pre>';exit;
			
			if($p_count > 0){
				$package_image[$package->id] = $package->Images[$p_count-1]->name;
			}else{
				$package_image[$package->id] = 'catering.png';
			}	

		// echo '<pre>'; print_r($package_image[$package->id]); echo '</pre>';exit;

		return View::make('public.catering')->with(array(
			'cData' => $cData,
			'catering_image' => $package_image)
		);
	}



	public function getPackage($id)
	{
		$pData = Catering::where('active', '=', '1')
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
		// echo '<pre>'; print_r($package_image); echo '</pre>';exit;	
			
			

		// echo '<pre>'; print_r($package_image); echo '</pre>';exit;

		return View::make('sales.package')->with(array(
			'pData' => $pData,
			'recipe_image' => $recipe_image)
		);
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