<?php

class AuthController extends BaseController {
		
	public function getIndex(){
		return View::make('index');	
	}
	
	public function getLogin(){
		
		if (Auth::user()) return Redirect::to('/admin');
				
		//$password = Hash::make('727887');
		//$decrypt = Hash::check('727887', $password);
		
		return View::make('admin.login')
			//->with(array('password' => $password, 'decrypt' => $decrypt))
			;	
	}
	
	public function postLogin(){
		
		$input = Input::all();
		//echo '<pre>'; print_r($input); echo '</pre>'; exit;
		$rules = array(
			'email' 		=> 'required',
			'password'	=> 'required'
		);
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::to('login')
				->withErrors($validator);	
		}else{
			$credentials = array(
				'email' =>	$input['email'],
				'password' =>	$input['password'],
				'active' => 1
			);
			if(Auth::attempt($credentials)){
				//return Redirect::to('admin');
				
				//echo '<pre>'; print_r( Auth::user()->user_type); echo '</pre>';
				//exit;
				
				switch (Auth::user()->user_type) {
					case 'ADMIN':
						return Redirect::to('admin');
						break;
					case 'MANAGER':
						return Redirect::to('admin');
						break;
					case 'B2B':
						return Redirect::to('profile');
						break;
					case 'REGISTERED':
						return Redirect::to('profile');
						break;
					case 'GUEST':
						return Redirect::to('profile');
						break;
					default:
						return $this->_doLogout();
				};
				
					
			}else{
				return Redirect::to('login');	
			}
		}	
	}
	
	public function logout(){
		return $this->_doLogout();
	}
	
	private function _doLogout() {
		Auth::logout();
		return Redirect::to('/');
	}
	
	
	
}