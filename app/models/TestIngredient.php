<?php
class TestIngredient extends Eloquent {

    protected $table = 'test_ingredient';
	
	/*
			CREATE TABLE IF NOT EXISTS `test_ingredient` (
			  `ingredient_id` int(11) NOT NULL AUTO_INCREMENT,
			  `ingredient_name` varchar(100) NOT NULL,
			  `ingredient_summary` varchar(250) NOT NULL,
			  `ingredient_description` text NOT NULL,
			  `ingredient_visible` int(11) NOT NULL,
			  `ingredient_position` int(11) NOT NULL,
			  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`ingredient_id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=193 ;

	*/

}