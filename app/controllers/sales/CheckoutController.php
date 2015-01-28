<?php

class CheckoutController extends BaseController {
	// public function getCheckout(){
	// 	$user = Auth::user();
	// 	$recipe = MenuRecipes::where('menu_recipes.id', '=', 38);
	// 	//echo '<pre>'; print_r($recipe); echo '</pre>'; exit;
	// 	return View::make('sales.cart')
	// 		->with(array(
	// 			'user' => $user,
	// 			'recipe' => $recipe
	// 		));

	// }

	
	public function getCart(){
		// echo '<pre>'; print_r(Cart::totalItems()); echo '</pre>';exit;
		$confirm_cart = 1;
		if(Cart::totalItems() == 0){
			$products = null;
			$cart = 0;
		}else{
			$products = Cart::Contents();
			$cart = 1;	
		}

		// echo '<pre>'; print_r($products); echo '</pre>';exit;
		return View::make('sales.checkout')
			->with(array(
				'products' => $products,
				'cart' => $cart,
				'confirm_cart' => $confirm_cart)
			);
	}

	public function postAddToCart(){
		$input = Input::all();
		$recipe_id = Input::get('recipe_id');
		$collection_id = Input::get('collection_id');
		$event_id = Input::get('event_id');
		$type = Input::get('section');
		
		// echo '<pre>'; print_r($input); echo '</pre>';exit;

		if(isset($recipe_id)){
			// $subtotal = (Input::get('quantity') * Input::get('price'));
			// echo '<pre>'; print_r($subtotal); echo '</pre>';exit;
			$items = array(
			    'id' => Input::get('recipe_id'),
				'name' => Input::get('name'),
				'price' => Input::get('price'),
				'quantity' => Input::get('quantity'),
				'image' => Input::get('image'),
				'type' => Input::get('section'),
			);
			Cart::insert($items);	
		
		}elseif(isset($collection_id)){
			$items = array(
			    'id' => Input::get('collection_id'),
				'name' => Input::get('name'),
				'price' => Input::get('price'),
				'quantity' => Input::get('quantity'),
				'image' => Input::get('image'),
				'type' => Input::get('section'),
			);
			Cart::insert($items);
		}elseif(isset($event_id)){
			$items = array(
			    'id' => Input::get('event_id'),
				'name' => Input::get('name'),
				'price' => Input::get('price'),
				'quantity' => Input::get('quantity'),
				'image' => Input::get('image'),
				'type' => Input::get('section'),
			);
			Cart::insert($items);
		}

		
		// $product = Recipe::find(Input::get('id'));
		// $quantity = Input::get('quantity');

		

		return Redirect::action('CheckoutController@getCart');
	}

	public function postCart(){
		
		// echo '<pre>'; print_r(Input::all()); echo '</pre>';exit;
		
		// echo "<hr/>";

		// Do any validation you like

		//Set your seccret key remember to change it when you go live



		Stripe::setApiKey(Config::get('stripe.sk'));
		$input = Input::all();
		

		//Get the crediet card details submitted by the form
		$token = Input::get('stripeToken');
		$user_email = Input::get('stripeEmail');
		$amount = Input::get('amount');
		$quantity = Input::get('quantity');
		$user = User::find(Auth::user()->id);
		$paid = Paid::where('user_id', '=', $user->id)->get();

		

		$pCount = count($paid);
		// echo '<pre>'; print_r($pCount); echo '</pre>';exit;

		if($pCount < 1){
			$customer = Stripe_Customer::create(array(
			   	"description" => $user->fname,
			  	"card" => $token, // obtained with Stripe.js
			  	"email" => $user->email,
			  	"id" => $user->id,
			));
		}else{
			// echo '<pre>'; print_r($pCount); echo '</pre>';exit;
			$customer = Stripe_Customer::retrieve($user->id);
		}

		// echo '<pre>'; print_r($customer); echo '</pre>';
		// echo '<pre>'; print_r($token); echo '</pre>';
		// echo '<pre>'; print_r($amount); echo '</pre>';
		// echo '<pre>'; print_r($quantity); echo '</pre>';
		// echo '<pre>'; print_r($user->email); echo '</pre>';exit;
		// 4242 4242 4242 4242
		
		try{
			$charge = Stripe_Charge::create(array(
				"amount" => $amount, //amount in cents
				"currency" => "aud",
				// "card" => $token,
				"description" => $user->email,
				"customer" => $customer->id,
				"receipt_email" => $user->email
				)
			);
		} catch (Stripe_CardError $e) {
    	// Since it's a decline, Stripe_CardError will be caught
		    $body = $e->getJsonBody();
		    $err  = $body['error'];

		    echo 'Status is:' . $e->getHttpStatus() . "\n";
		    echo 'Type is:' . $err['type'] . "\n";
		    echo 'Code is:' . $err['code'] . "\n";
		    // param is '' in this case
		    echo 'Param is:' . $err['param'] . "\n";
		    echo 'Message is:' . $err['message'] . "\n";
		} catch (Exception $e) {
		    echo $e->getMessage();
		} catch (ErrorException $e) {
		    echo $e->getMessage();
		}
		// ->card->fingerprint
		// echo '<pre>'; print_r($charge); echo '</pre>';
		// echo '<hr/>';
		
		if($charge->paid == 1){
			$products = Cart::Contents();

			// echo '<pre>'; print_r($products); echo '</pre>';exit;

			foreach ($products as $product) {
				

				$user = User::find(Auth::user()->id);
				
				if($product->type == 'EVENT'){				
					// $user->Events()->attach( $product->id, array('user_id' => $user->id,'type' => 'EVENT','paid' => 1) );

					
					// $pcount = count($pPaid);

					// if($pcount > 0){
					// 	echo '<pre>'; print_r('Delete'); echo '</pre>';exit;
					// }else{
					// 	echo '<pre>'; print_r('Save'); echo '</pre>';exit;
					// }
					$date = new \DateTime;

					DB::table('paid')->insert(
					    array(
					    	'link_id' => $product->id ,
					    	'user_id' => $user->id, 
					    	'stripe_id' => $charge->id, 
					    	'card_id' => $charge->card->id, 
					    	'transaction' => $charge->balance_transaction, 
					    	'type' => 'EVENT', 'quantity' => $quantity[$product->id], 
					    	'cost' => $charge->amount, 
					    	'paid' => 1,
					    	'created_at' => $date,
							'updated_at' => $date
						)
					);

					$user_purchase = Paid::where('user_id', '=', $user->id)->orderby('id','DESC')->take(1)->get();

					$ticket_id = $user_purchase[0]->id.''.$user->id;

					$pData = Paid::find($user_purchase[0]->id);
					$pData->ticket_id = $ticket_id;
					$pData->save();
					

					$edata = Events::findOrFail($product->id);
					$edata->ticket_amount 	= $edata->ticket_amount - $quantity[$product->id];
					$edata->save();

					// echo '<pre>'; print_r($edata->id); echo '</pre>';
					// echo '<pre>'; print_r($edata->price*$quantity[$product->id]); echo '</pre>';
					// echo '<pre>'; print_r($user_purchase[0]->id); echo '</pre>';exit;

					$messageData = array(
				        'name' => $user->fname,
				        'quantity' => $quantity[$product->id],
				        'ticket_id' => $ticket_id,
				        'product_id' => $product->id,

				        'event_id' => $edata->id,
				        'event_name' => $edata->name,
				        'event_date' => $edata->date,
				        'event_time' => $edata->time,
				        'event_cost' => $edata->price*$quantity[$product->id],
				        'event_map' => $edata->map,
				    );

					//5217295209632227

					// $c_message = 'We have just sent your confirmation an email to ' . $user->email . ' If you have not recieved it please click through to the event or call Tom on 0428 438 348';
					
					Mail::send('sales.event_email', $messageData, function($message) use ($user){
						$message->to( $user->email )->cc('sales@sonaughtybutnice.com')->subject('So Naughty But Nice - Event confirmation');
					}); //->cc('sales@sonaughtybutnice.com')
				}
			}

		}else{
			return Redirect::to('/checkout');
		}
				

		Cart::destroy();
		
		return Redirect::to('/profile');
		


	}

	public function getRemoveItem($identifier){

		// echo '<pre>'; print_r($identifier); echo '</pre>';exit;

		$item = Cart::item($identifier);
		$item->remove();
		return Redirect::to('/checkout');
	}
}

// if($product->type == 'RECIPE'){				
// 					// $user->MenuRecipes()->attach( $user->id, array('user_id' => $user->id,'type' => 'RECIPE','paid' => 1) );
// 					$pPaid = Paid::where('link_id', '=', $product->id)->where('user_id', '=', $user->id)->get();
// 					$pcount = count($pPaid);

// 					if($pcount > 0){
// 						echo '<pre>'; print_r('Save'); echo '</pre>';exit;
// 					}else{
// 						echo '<pre>'; print_r('Delete'); echo '</pre>';exit;
// 					}

// 					DB::table('paid')->insert(
// 					    array('link_id' => $product->id ,'user_id' => $user->id, 'type' => 'RECIPE', 'paid' => 1)
// 					);
					   


// 				}elseif ($product->type == 'COLLECTION') {
// 					$cData = MenuCategories::where('id', '=', $product->id)
// 						->with(array('menuRecipes' => function($query)
// 						{
// 							$query->where('menu_recipes.active', '=', 1);

// 						}))
// 					->get();
					
// 					foreach($cData as $collection){
// 	                   	foreach($collection->menuRecipes as $recipe){
	                   		
// 	                   		//echo '<pre>'; print_r($user->MenuRecipes); echo '</pre>';
// 	                   		if(!$user->MenuRecipes->contains($recipe->id)){
	                   		
// 	                   			// $user->MenuRecipes()->attach( $product->id, array('link_id' => $user->id,'type' => 'RECIPE','paid' => 1) );
// 	                   			DB::table('paid')->insert(
// 								    array('link_id' => $recipe->id ,'user_id' => $user->id, 'type' => 'RECIPE', 'paid' => 1)
// 								);
// 	                   		}
// 	                    }
// 	                }//exit;