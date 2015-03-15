<?php
class CollectionPageController  extends BaseController {

	public function getCollection($id){
			//$cData = MenuCategories::where('id', '=', $id)->with('menuRecipes')->with('Images')->get();
			
			$cData = MenuCategories::where('id', '=', $id)->with(array('menuRecipes' => function($query)
			{
				//while(mysqli_num_rows(MenuCategories) > 0){
				$query->where('menu_recipes.active', '=', 1)
					->with(array('Images' => function($query)
					{
						$query->where('ordering', '=', 0)->where('section', '=', 'RECIPE');
					}));
				//}
			}))->get();

			// foreach($cData as $collection){


   //             if(empty($collection->menuRecipes[0]->Images()->first()->name)){
			// 		$category_image[$collection->id] = 'recipe.png';
			//     }else{
			//         if(file_exists('uploads/'.$collection->menuRecipes[0]->Images()->first()->name)){
			//             $category_image[$collection->id] = $collection->menuRecipes[0]->Images()->first()->name;
			//         }else{
			//            $category_image[$collection->id] = 'recipe.png';
			//         }
			//     }

   //         	}

           	foreach($cData as $category){
				$count = count($category->menuRecipes);
				if($count > 0){
					$cnData[] = $category;
					
					foreach ($category->menuRecipes as $recipe) {

						$count = count($recipe->Images);
						if($count < 1){
							
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
						// echo '<pre>'; print_r($recipe_image); echo '</pre>';
					}

				}else{
					$cnData[] = '';
				}			
			}

			// echo '<pre>'; print_r($recipe_image); echo '</pre>';
			// exit;
			return View::make('public.collection_page')->with(array(
				'cData' => $cnData,
				// 'paid' =>	$paid,
				// 'confirm_paid' => $confirm_paid,
				'cImage' => $recipe_image)
			);
		}
	}
