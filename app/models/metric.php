<?php
class Metric extends Eloquent {
 
    protected $table = 'metric';
	
	/*
		CREATE TABLE IF NOT EXISTS `metric` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(255) NOT NULL,
		  `active` tinyint(4) NOT NULL,
		  `created_at` datetime NOT NULL,
		  `updated_at` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 
			*/
	public function menurecipes(){
		//MenuCategories->hasmany('menurecipes')
		return $this->belongsTo('MenuRecipes');	
	}
	
	public function MenuRecipesIngredients(){
		return $this->belongsTo('MenuRecipesIngredients');	
	}
	
	public function MenuIngredients(){ //One recipe belongs to many catering
		return $this->belongsToMany('MenuIngredients', 'ingredient_metric')->withPivot('id','metric_grams','metric_amount');
	}
}