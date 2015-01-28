<?php
class MenuCategories extends Eloquent {

    protected $table = 'menu_categories';
	
	/*
		CREATE TABLE IF NOT EXISTS `menu_categories` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  
		  `name` varchar(255) NOT NULL,
		  `summary` varchar(255) NOT NULL,
		  `ordering` tinyint(11) NOT NULL,
		  `active` tinyint(11) NOT NULL,
		  
		  `created_at` datetime NOT NULL,
		  `updated_at` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	*/

	public function MenuRecipes(){
		//MenuCategories->hasmany('menurecipes')
		return $this->hasmany('MenuRecipes');	
	}
	
	public function Images()
    {
        return $this->hasManyThrough('Images', 'MenuRecipes');
    }

}