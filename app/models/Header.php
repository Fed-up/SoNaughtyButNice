<?php
class Header extends Eloquent {

    protected $table = 'header';
	
	/*
		CREATE TABLE IF NOT EXISTS `header` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `active` tinyint(4) NOT NULL,

		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

	*/
	
	public function Images()
    {
        return $this->hasmany('Images', 'link_id', 'id');	
    }


}