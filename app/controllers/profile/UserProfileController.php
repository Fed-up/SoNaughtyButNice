<?php

class UserProfileController extends BaseController {

public function getAddUser(){


		// echo '<pre>'; print_r('hi'); echo '</pre>'; 	exit;

		return View::make('profile.signup')
			->with(array('title' => 'Welcome'));
	}
	
	public function postAddUser(){
		$input = Input::all();
		// echo '<pre>'; print_r($input); echo '</pre>'; 	exit;
		$rules = array(
			'fname' => 'required',
			'email' => 'required|email|unique:users,email,'.Input::get('id'),
			'password' => 'required|min:6',
			'password_match' => 'required|min:6|same:password',
		);


		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}else{

			// echo '<pre>'; print_r($input); echo '</pre>'; 	exit;

			$data	= new User();
			//echo '<pre>'; print_r($input); echo '</pre>'; 	exit;
			$data->fname 	= Input::get('fname');
			$data->email 	= Input::get('email');
			$data->password 	= Hash::make(Input::get('password'));
			$data->user_type 	= 'GUEST';
			$data->active  = 1;	
			$data->save();
			// echo '<pre>'; print_r($data); echo '</pre>'; 	exit;	
		}; 

		//$data = User::all();	
		return Redirect::action('ProfileController@getProfile');
			//->with(array('data' => $data));
	}
}