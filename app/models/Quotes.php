<?php
class Quotes extends Eloquent {

    protected $table = 'quotes';
	
	/*
			CREATE TABLE IF NOT EXISTS `quotes` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `quote` varchar(255) NOT NULL,
			  `active` tinyint(4) NOT NULL,
			  `created_at` datetime NOT NULL,
			  `updated_at` datetime NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

	*/

}