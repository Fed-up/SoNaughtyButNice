<?php
class MenuIngredients extends Eloquent {

    protected $table = 'menu_ingredients';
	
	/* 
		CREATE TABLE IF NOT EXISTS `menu_ingredients` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(255) NOT NULL,
		  `summary` varchar(255) NOT NULL,
		  `description` text NOT NULL,
		  `active` int(11) NOT NULL,
		  `created_at` datetime NOT NULL,
		  `updated_at` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

	*/
	
	public function MenuRecipes(){
		//MenuCategories->hasmany('menurecipes')
		return $this->belongsTo('MenuRecipes');	
	}
	
	public function MenuRecipesIngredients(){
		return $this->belongsTo('MenuRecipesIngredients');	
	}
	
	public function MenuIngredientImages(){ //One recipe has many recipe ingredients
		return $this->hasmany('Images');	
	}
	
	public function Images(){ //One recipe has many recipe ingredients
		return $this->hasmany('Images', 'link_id', 'id');	
	}

	public function SalesDataIngredient(){
		return $this->hasOne('SalesDataIngredient', 'id', 'menu_ingredient_id');	
	}

	public function Metric(){ //One recipe belongs to many catering
		return $this->belongsToMany('Metric', 'ingredient_metric')->withPivot('id','metric_grams', 'metric_amount');
	}

}