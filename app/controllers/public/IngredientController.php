<?php

class IngredientController  extends BaseController {

	public function getIngredients(){
		$iData = MenuIngredients::with(array('Images' => function($query)
			{
				$query->where('section', '=', 'INGREDIENT')->orderBy(DB::raw('RAND()'))->where('active', '=', 1);
			}))
		->orderBy(DB::raw('RAND()'))->where('active', '=', 1)->take(18)->get();
		
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


		


		
		return View::make('public.ingredients')->with(array(
			'iData' => $iData,
			'iImage' => $ingredient_image)
		);
	}
}
