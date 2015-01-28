<?php

class StoreController extends BaseController {

	public function postAddToCart(){
		$input = Input::all();
		echo '<pre>'; print_r($input); echo '</pre>'; exit;
		
		$product = Recipe::find(Input::get('id'));
		$quantity = Input::get('quantity');

		Cart::insert(array(
			'id' => $product->id,
			'id' => $product->name,
			'id' => $product->price,
			'id' => $product->image,
		));

		retrun Redirect::to('sales.cart');	
	}

}