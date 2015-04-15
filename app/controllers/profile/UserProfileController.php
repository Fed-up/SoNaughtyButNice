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



	public function postUpdateUser(){
		$input = Input::all();
		$id = Auth::User()->id;
		
		// echo '<pre>'; print_r($input); echo '</pre>'; 	exit;
		// echo '<pre>'; print_r($id); echo '</pre>'; 	exit;
		// $id = 7;

		if(isset($input->password) || isset($input->password_match)){
			$rules = array(
				'fname' => 'required',
				'email' => 'required|email|unique:users,email,'.$id,
				'password' => 'required|min:6',
				'password_match' => 'required|min:6|same:password',
				
			);
		}else{
			$rules = array(
				'fname' => 'required', 
				'email' => 'required|email|unique:users,email,'.$id,
			);
		}

		$validator = Validator::make($input, $rules);

		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}else{

			// echo '<pre>'; print_r($id); echo '</pre>'; 	exit;

			$user	= User::find($id);
			// echo '<pre>'; print_r($data); echo '</pre>'; 	exit;
			$user->fname 	= Input::get('fname');
			$user->email 	= Input::get('email');
			$user->password 	= Hash::make(Input::get('password'));
			// $user->user_type 	= 'GUEST';
			$user->active  = (isset($input['unsubscribe'])) ? 0 : 1;
			$user->save();
			// echo '<pre>'; print_r($data); echo '</pre>'; 	exit;	
		}; 
		if($user->active == 0){
				$message = 'Sorry to know you want to leave.. =('.'<br>'.'If this is a mistake? Quickly change your unsubscription status in your account settings, before you logout =)';
			}else{
				$message = 'Your account information has been updated =)';
			}

		//$data = User::all();	
		return Redirect::action('ProfileController@getProfile')
			->with(array('message' => $message));	
	}















}