<?php
class MenuRecipesIngredients extends Eloquent {

    protected $table = 'menu_recipes_ingredients';
	
	/*
		CREATE TABLE IF NOT EXISTS `menu_recipes_ingredients` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `menu_recipes_id` tinyint(4) NOT NULL,
		  `menu_ingredients_id` tinyint(4) NOT NULL,
		  `amount` int(11) NOT NULL,
		  `metric_id` tinyint(4) NOT NULL,
		  `active` tinyint(11) NOT NULL,
		  `created_at` datetime NOT NULL,
		  `updated_at` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;
	*/

	public function MenuRecipes(){ // Should be the 
		return $this->belongsTo('MenuRecipes');	
	}
	
	public function MenuIngredients(){ // Should be the 
		return $this->hasOne('MenuIngredients', 'id', 'menu_ingredients_id');	
	}
	
	public function Metric(){ // Should be the 
		return $this->hasOne('Metric', 'id', 'metric_id');	
	}


}