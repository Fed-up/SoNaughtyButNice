<?php
class Admin_MenuController extends BaseController{

	public function getMenu(){
		$recipes = MenuRecipes::where('naughty_active', '=', 1)->orderBy('name','ASC')->get();
		$savoury = MenuRecipes::where('savoury', '=', 1)->orderBy('name','ASC')->get();
		$snack = MenuRecipes::where('snack', '=', 1)->orderBy('name','ASC')->get();
		$dessert = MenuRecipes::where('dessert', '=', 1)->orderBy('name','ASC')->get();
		$refreshment = MenuRecipes::where('refreshment', '=', 1)->orderBy('name','ASC')->get();
		$title = 'Cafe Menu';
		$tab_data = 'sav';
		

		return View::make('admin.menu.index')
		->with(array( 
			'recipes' => $recipes,
			'savoury' => $savoury,
			'snack' => $snack, 
			'dessert' => $dessert,
			'refreshment' => $refreshment,
			'title' => $title,
			'tab_data' => $tab_data,
		));
}

	public function getSavoury($id){
		$data = MenuRecipes::findOrFail($id);
		$data->savoury  = ($data->savoury == 0) ? 1 : 0;
		$data->save();
		$recipes = MenuRecipes::where('naughty_active', '=', 1)->orderBy('name','ASC')->get();
		$savoury = MenuRecipes::where('savoury', '=', 1)->orderBy('name','ASC')->get();
		$snack = MenuRecipes::where('snack', '=', 1)->orderBy('name','ASC')->get();
		$dessert = MenuRecipes::where('dessert', '=', 1)->orderBy('name','ASC')->get();
		$refreshment = MenuRecipes::where('refreshment', '=', 1)->orderBy('name','ASC')->get();
		$title = 'Cafe Menu';
		$tab_data = 'sav';
		

		return View::make('admin.menu.index')
		->with(array( 
			'recipes' => $recipes,
			'savoury' => $savoury,
			'snack' => $snack, 
			'dessert' => $dessert,
			'refreshment' => $refreshment,
			'title' => $title,
			'tab_data' => $tab_data,
		));
	}

	public function getSnack($id){
		$data = MenuRecipes::findOrFail($id);
		$data->snack  = ($data->snack == 0) ? 1 : 0;
		$data->save();
		$recipes = MenuRecipes::where('naughty_active', '=', 1)->orderBy('name','ASC')->get();
		$savoury = MenuRecipes::where('savoury', '=', 1)->orderBy('name','ASC')->get();
		$snack = MenuRecipes::where('snack', '=', 1)->orderBy('name','ASC')->get();
		$dessert = MenuRecipes::where('dessert', '=', 1)->orderBy('name','ASC')->get();
		$refreshment = MenuRecipes::where('refreshment', '=', 1)->orderBy('name','ASC')->get();
		$title = 'Cafe Menu';
		$tab_data = 'sna';
		

		return View::make('admin.menu.index')
		->with(array( 
			'recipes' => $recipes,
			'savoury' => $savoury,
			'snack' => $snack, 
			'dessert' => $dessert,
			'refreshment' => $refreshment,
			'title' => $title,
			'tab_data' => $tab_data,
		));
	}
	
	public function getDessert($id){
		$data = MenuRecipes::findOrFail($id);
		$data->dessert  = ($data->dessert == 0) ? 1 : 0;
		$data->save();
		$recipes = MenuRecipes::where('naughty_active', '=', 1)->orderBy('name','ASC')->get();
		$savoury = MenuRecipes::where('savoury', '=', 1)->orderBy('name','ASC')->get();
		$snack = MenuRecipes::where('snack', '=', 1)->orderBy('name','ASC')->get();
		$dessert = MenuRecipes::where('dessert', '=', 1)->orderBy('name','ASC')->get();
		$refreshment = MenuRecipes::where('refreshment', '=', 1)->orderBy('name','ASC')->get();
		$title = 'Cafe Menu';
		$tab_data = 'des';
		

		return View::make('admin.menu.index')
		->with(array( 
			'recipes' => $recipes,
			'savoury' => $savoury,
			'snack' => $snack, 
			'dessert' => $dessert,
			'refreshment' => $refreshment,
			'title' => $title,
			'tab_data' => $tab_data,
		));
	}

	public function getRefreshment($id){
		$data = MenuRecipes::findOrFail($id);
		$data->refreshment  = ($data->refreshment == 0) ? 1 : 0;
		$data->save();
		$recipes = MenuRecipes::where('naughty_active', '=', 1)->orderBy('name','ASC')->get();
		$savoury = MenuRecipes::where('savoury', '=', 1)->orderBy('name','ASC')->get();
		$snack = MenuRecipes::where('snack', '=', 1)->orderBy('name','ASC')->get();
		$dessert = MenuRecipes::where('dessert', '=', 1)->orderBy('name','ASC')->get();
		$refreshment = MenuRecipes::where('refreshment', '=', 1)->orderBy('name','ASC')->get();
		$title = 'Cafe Menu';
		$tab_data = 'ref';
		

		return View::make('admin.menu.index')
		->with(array( 
			'recipes' => $recipes,
			'savoury' => $savoury,
			'snack' => $snack, 
			'dessert' => $dessert,
			'refreshment' => $refreshment,
			'title' => $title,
			'tab_data' => $tab_data,
		));
	}
}



