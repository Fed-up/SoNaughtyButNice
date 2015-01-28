<?php
class Images extends Eloquent {

    protected $table = 'images';
	
	/*
		CREATE TABLE IF NOT EXISTS images (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  
		  `name` varchar(255) NOT NULL,
		  `recipe_id` varchar(255) NOT NULL,
		  `ingredient_id` varchar() NOT NULL,
		  `active` tinyint(1) NOT NULL,
		  
		  `created_at` datetime NOT NULL,
		  `updated_at` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	*/
	
	public function MenuRecipes(){ // Should be the 
		return $this->hasOne('MenuRecipes', 'id', 'link_id');	
	}
	
	public function MenuIngredients(){ // Should be the 
		return $this->hasOne('MenuIngredients', 'id', 'link_id');	
	}	
	public function Header(){ // Should be the 
		return $this->hasOne('Header', 'id', 'link_id');	
	}
	public function Events(){ // Should be the 
		return $this->hasOne('Events', 'id', 'link_id');	
	}

	public function Catering(){ // Should be the 
		return $this->hasOne('Catering', 'id', 'link_id');	
	}

}

	