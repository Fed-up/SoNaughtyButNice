<?php

class IngredientController  extends BaseController {

	public function getIngredients(){
		$iData = MenuIngredients::with(array('Images' => function($query)
			{
				$query->where('section', '=', 'INGREDIENT')->orderBy(DB::raw('RAND()'))->where('active', '=', 1);
			}))
		->orderBy(DB::raw('RAND()'))->where('active', '=', 1)->take(18)->get();

		$aeData = MenuIngredients::with(array('Images' => function($query)
			{
				$query->where('section', '=', 'INGREDIENT')->orderBy(DB::raw('RAND()'))->where('active', '=', 1);
			}))
		->orderBy('name','ASC')->where('name', 'LIKE', 'a%')->orWhere('name', 'LIKE', 'b%')->orWhere('name', 'LIKE', 'c%')->orWhere('name', 'LIKE', 'd%')->orWhere('name', 'LIKE', 'e%')->where('active', '=', 1)->get();
		
		$fjData = MenuIngredients::with(array('Images' => function($query)
			{
				$query->where('section', '=', 'INGREDIENT')->orderBy(DB::raw('RAND()'))->where('active', '=', 1);
			}))
		->orderBy('name','ASC')->where('name', 'LIKE', 'f%')->orWhere('name', 'LIKE', 'g%')->orWhere('name', 'LIKE', 'h%')->orWhere('name', 'LIKE', 'i%')->orWhere('name', 'LIKE', 'j%')->where('active', '=', 1)->get();
		
		$koData = MenuIngredients::with(array('Images' => function($query)
			{
				$query->where('section', '=', 'INGREDIENT')->orderBy(DB::raw('RAND()'))->where('active', '=', 1);
			}))
		->orderBy('name','ASC')->where('name', 'LIKE', 'k%')->orWhere('name', 'LIKE', 'l%')->orWhere('name', 'LIKE', 'm%')->orWhere('name', 'LIKE', 'n%')->orWhere('name', 'LIKE', 'o%')->where('active', '=', 1)->get();
		
		$ptData = MenuIngredients::with(array('Images' => function($query)
			{
				$query->where('section', '=', 'INGREDIENT')->orderBy(DB::raw('RAND()'))->where('active', '=', 1);
			}))
		->orderBy('name','ASC')->where('name', 'LIKE', 'p%')->orWhere('name', 'LIKE', 'q%')->orWhere('name', 'LIKE', 'r%')->orWhere('name', 'LIKE', 's%')->orWhere('name', 'LIKE', 't%')->where('active', '=', 1)->get();
		
		$uzData = MenuIngredients::with(array('Images' => function($query)
			{
				$query->where('section', '=', 'INGREDIENT')->orderBy(DB::raw('RAND()'))->where('active', '=', 1);
			}))
		->orderBy('name','ASC')->where('name', 'LIKE', 'u%')->orWhere('name', 'LIKE', 'v%')->orWhere('name', 'LIKE', 'w%')->orWhere('name', 'LIKE', 'x%')->orWhere('name', 'LIKE', 'y%')->orwhere('name', 'LIKE', 'z%')->where('active', '=', 1)->get();
		
		// echo '<pre>'; print_r($aeData); echo '</pre>';exit;
		// 		echo '<hr>';

		foreach ($iData as $ingredient) {
			$count = count($ingredient->Images);
			if($count < 1){
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
		}

		
		// echo '<pre>'; print_r($aeData); echo '</pre>';exit;

		foreach ($aeData as $ae) {
			// if($ae->active == 1){
			// 	unset($aeData[$ae->id]);
			// }else{
				// echo '<pre>'; print_r($ae); echo '</pre>';
				$count = count($ae->Images);
				if($count < 1){
					$ae_ingredient_image[$ae->id] = 'ingredient.png';
				}else{
					foreach($ae->Images as $ae_image){
				        if(file_exists('uploads/'.$ae_image->name)){
				            $ae_ingredient_image[$ae->id] = $ae_image->name;
				        }else{
				           	$ae_ingredient_image[$ae->id] = 'ingredient.png';
				        }
					}
				}
			// }
		}
		// echo '<pre>'; print_r($aeData); echo '</pre>';exit;

		foreach ($fjData as $fj) {
			// if($fj->active == 1){
			// 	unset($fjData[$fj->id]);
			// }else{
				$count = count($fj->Images);
				if($count < 1){
					$fj_ingredient_image[$fj->id] = 'ingredient.png';
				}else{
					foreach($fj->Images as $fj_image){
				        if(file_exists('uploads/'.$fj_image->name)){
				            $fj_ingredient_image[$fj->id] = $fj_image->name;
				        }else{
				           	$fj_ingredient_image[$fj->id] = 'ingredient.png';
				        }
					}
				}
			// }
		}

		foreach ($koData as $ko) {
			$count = count($ko->Images);
			if($count < 1){
				$ko_ingredient_image[$ko->id] = 'ingredient.png';
			}else{
				foreach($ko->Images as $ko_image){
			        if(file_exists('uploads/'.$ko_image->name)){
			            $ko_ingredient_image[$ko->id] = $ko_image->name;
			        }else{
			           	$ko_ingredient_image[$ko->id] = 'ingredient.png';
			        }
				}
			}
		}

		foreach ($ptData as $pt) {
			$count = count($pt->Images);
			if($count < 1){
				$pt_ingredient_image[$pt->id] = 'ingredient.png';
			}else{
				foreach($pt->Images as $pt_image){
			        if(file_exists('uploads/'.$pt_image->name)){
			            $pt_ingredient_image[$pt->id] = $pt_image->name;
			        }else{
			           	$pt_ingredient_image[$pt->id] = 'ingredient.png';
			        }
				}
			}
		}

		foreach ($uzData as $uz) {
			$count = count($uz->Images);
			if($count < 1){
				$uz_ingredient_image[$uz->id] = 'ingredient.png';
			}else{
				foreach($uz->Images as $uz_image){
			        if(file_exists('uploads/'.$uz_image->name)){
			            $uz_ingredient_image[$uz->id] = $uz_image->name;
			        }else{
			           	$uz_ingredient_image[$uz->id] = 'ingredient.png';
			        }
				}
			}
		}

		// echo '<pre>'; print_r($ae_ingredient_image); echo '</pre>';exit;


		
		return View::make('public.ingredients')->with(array(
			'iData' => $iData,
			'iImage' => $ingredient_image,
			'aeData' => $aeData,
			'aeImage' => $ae_ingredient_image,
			'fjData' => $fjData,
			'fjImage' => $fj_ingredient_image,
			'koData' => $koData,
			'koImage' => $ko_ingredient_image,
			'ptData' => $ptData,
			'ptImage' => $pt_ingredient_image,
			'uzData' => $uzData,
			'uzImage' => $uz_ingredient_image,
			)
		);
	}
}
