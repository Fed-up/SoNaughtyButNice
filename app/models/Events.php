<?php
class Events extends Eloquent {

    protected $table = 'events';
	
	/*
			CREATE TABLE IF NOT EXISTS `events` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `summary` varchar(255) NOT NULL,
			  `what` text NOT NULL,
			  `time` time NOT NULL,
			  `date` date NOT NULL,
			  `place` text NOT NULL,
			  `why` text NOT NULL,
			  `who` text NOT NULL,
			  `map` varchar(255) NOT NULL,
			  `price` int(11) NOT NULL,
			  `prize` text NOT NULL,
			  `active` tinyint(4) NOT NULL,
			  `created_at` datetime NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

	*/

	public function Images(){ //One recipe has many recipe ingredients
		return $this->hasmany('Images', 'link_id', 'id');	
	}

	public function User(){ //One recipe has many recipe ingredients
		return $this->belongsToMany('User', 'paid', 'link_id', 'user_id')->withPivot('paid','type');
	}

}