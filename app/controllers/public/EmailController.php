<?php

class EmailController extends BaseController {

	public function getEmail(){

	$user = Auth::user();


	$messageData = array(
        'name' => $user->fname,
    );

	$name = 'Tom';
	$email = $user->email;

	// $c_message = 'We have just sent your confirmation an email to ' . $user->email . ' If you have not recieved it please click through to the event or call Tom on 0428 438 348';
	
	Mail::send('sales.email', $messageData, function($message) use ($user){
		$message->to( $user->email )->cc('sales@sonaughtybutnice.com')->subject('So Naughty But Nice - Event confirmation');
	}); 

	//  Mail::send('public.maps', array('name' => 'Tom'), function($message){
	// 	$message->to('sales@sonaughtybutnice.com', 'hello')->subject('test email');
	// }); 

	// echo '<pre>'; print_r($ingredient_image); echo '</pre>';
	// echo '<pre>'; print_r($user); echo '</pre>';
	// exit;

	return View::make('sales.email')->with(array(
			'name' => $name,
		));
	

	}

}