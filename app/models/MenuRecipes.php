<?php
class MenuRecipes extends Eloquent {

    protected $table = 'menu_recipes';
	
	/*
		CREATE TABLE IF NOT EXISTS `menu_recipes` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `categories_id` int(11) NOT NULL,
		  `name` varchar(255) NOT NULL,
		  `summary` varchar(255) NOT NULL,
		  `menu_recipes_ingredients_id` int(11) NOT NULL,
		  `active` tinyint(11) NOT NULL,
		  `created_at` datetime NOT NULL,
		  `updated_at` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;
	*/
	
	public function MenuCategories(){
		/*
		
		return $this->hasOne('ModelName', 'foreign_key', 'local_key');
		
		Take note that Eloquent assumes the foreign key of the relationship based on the model name. In this case, MenuRecipes model is assumed to use a id foreign key. If you wish to override this convention, you may pass a second argument to the hasOne method. Furthermore, you may pass a third argument to the method to specify which local column that should be used for the association:
		
		
		return $this->hasOne('MenuCategories', 'id = in forgein table', 'categories_id= 
				This must match the id in the forgign table and is the key stored in the recipes table');	
				
		return $this->hasOne('MenuCategories', 'menu_categories.id', 'menu_recipes.categories_id');	
				
		*/
		return $this->hasOne('MenuCategories', 'id', 'menu_categories_id');	
	}
	
	
	public function MenuIngredients(){
		return $this->hasOne('MenuIngredients', 'id', 'recipe_id');	
	}

	public function SalesDataIngredient(){
		return $this->hasOne('SalesDataIngredient', 'id', 'menu_recipe_id');	
	}
	
	public function Metric(){
		return $this->hasOne('Metric', 'id', 'recipe_id');	
	}
		
	public function MenuRecipesFacts(){
		return $this->hasmany('MenuRecipesFacts');	
	}
	
	public function MenuRecipesMethods(){ //Preferable to name thiis the model where it is tryign to read - One recipe hasmany Methods
		return $this->hasmany('MenuRecipesMethods');	
	}

	public function MenuRecipesExtras(){ //Preferable to name thiis the model where it is tryign to read - One recipe hasmany Methods
		return $this->hasmany('MenuRecipesExtras');	
	}
	
	public function MenuRecipesIngredients(){ //One recipe has many recipe ingredients
		return $this->hasmany('MenuRecipesIngredients');	
	}
	
	public function Images(){ //One recipe has many images
		return $this->hasmany('Images', 'link_id', 'id');	
	}

	public function User(){ //One recipe has many recipe ingredients
		return $this->belongsToMany('User', 'paid', 'link_id', 'user_id')->withPivot('paid','type');
	}

	public function Catering(){ //One recipe belongs to many catering
		return $this->belongsToMany('Catering', 'catering_recipes')->withPivot('id','amount','ordering');
	}

	public function SalesData(){
		return $this->hasOne('SalesData', 'id', 'menu_recipe_id');	
	}
	
	
}