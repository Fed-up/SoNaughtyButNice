<?php
class Products extends Eloquent {

    protected $table = 'products';
	
	/*
		CREATE TABLE IF NOT EXISTS products (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  
		  `name` varchar(255) NOT NULL,
		  `summary` varchar(255) NOT NULL,
		  `description` text() NOT NULL,
		  `price` int(11) NOT NULL,
		  `active` tinyint(11) NOT NULL,
		  
		  `created_at` datetime NOT NULL,
		  `updated_at` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	*/

}
/* 
					
					
					[{"id":10,"menu_recipes_id":22,"menu_ingredients_id":6,"amount":6,"metric_id":6,"active":1,"created_at":"0000-00-00 00:00:00","updated_at":"2014-06-11 09:37:27"}] 
					*/