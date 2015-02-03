<?php
class SalesData extends Eloquent {

    protected $table = 'sales_data';
	
	/*
		CREATE TABLE IF NOT EXISTS `sales_data` (
		`id` int(11) NOT NULL,
		  `menu_recipe_id` int(11) NOT NULL,
		  `staff_cost_per_hour` int(11) NOT NULL,
		  `price` int(11) NOT NULL,
		  `amount` int(11) NOT NULL,
		  `time` int(11) NOT NULL,
		  `staff_cost_to_make_recipe_batch` int(11) NOT NULL,
		  `staff_cost_per_piece` int(11) NOT NULL,
		  `total_recipe_cost` int(11) NOT NULL,
		  `total_cost_percentage` int(11) NOT NULL,
		  `total_ingredient_cost` int(11) NOT NULL,
		  `total_recipe_revenue` int(11) NOT NULL,
		  `total_ingredient_cost_per_piece` int(11) NOT NULL,
		  `total_markup_per_piece` int(11) NOT NULL,
		  `total_cost_per_piece` int(11) NOT NULL,
		  `total_profit` int(11) NOT NULL,
		  `staff_cost_percentage` int(11) NOT NULL,
		  `total_profit_per_piece` int(11) NOT NULL,
		  `ingredient_cost_percentage` int(11) NOT NULL,
		  `total_markup_percentage` int(11) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
	*/
	
	public function MenuRecipes(){
		return $this->belongsTo('MenuRecipes','menu_recipe_id');	
	}
	
}