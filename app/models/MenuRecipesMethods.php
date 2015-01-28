<?php
class MenuRecipesMethods extends Eloquent {

    protected $table = 'menu_recipes_methods';
	
	/*
		CREATE TABLE IF NOT EXISTS `menu_recipes_methods` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `description` text NOT NULL,
		  `menu_recipes_id` tinyint(4) NOT NULL,
		  `active` tinyint(11) NOT NULL,
		  `created_at` datetime NOT NULL,
		  `updated_at` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;
	*/

	public function MenuRecipes(){ // Should be the 
		return $this->hasOne('MenuRecipes', 'id', 'menu_recipes_id');	
	}

}