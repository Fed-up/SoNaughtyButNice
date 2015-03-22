<?php
class Catering extends Eloquent {

    protected $table = 'catering';
	
	/*
		
	*/
	public function MenuRecipes(){ //One recipe has many recipe ingredients
		return $this->belongsToMany('MenuRecipes', 'catering_recipes')->withPivot('id','amount','ordering');
	}

	public function User(){ //One recipe has many recipe ingredients
		return $this->hasOne('User', 'user_id', 'id');	
	}

	public function Images(){ //One recipe has many images
		return $this->hasmany('Images', 'link_id', 'id');	
	}

}