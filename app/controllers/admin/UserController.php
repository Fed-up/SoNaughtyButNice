<?php

class Admin_UserController extends BaseController {
		
	public function getMembers(){
		if(Auth::user()->user_type == 'ADMIN'){
			$members = User::where('active', '!=', 9)->where('id','!=',Auth::user()->id)->get();
		}elseif(Auth::user()->user_type == 'MANAGER'){
			$members = User::where('active', '!=', 9)->where('id','!=',Auth::user()->id)->where('user_type', '!=', 'ADMIN')->get();
		}else{
			return View::make('public.index');	
		}
		return View::make('admin.members.index')
			->with(array('data' => $members));
	}
	
	public function getAddMembers(){
		return View::make('admin.members.form')
			->with(array('title' => 'Create New Member'));
	}
	
	public function postAddMembers(){
		$input = Input::all();
		//dd($input);
		$rules = array(
			'fname' => 'required',
			'lname' => 'required',
			'username' => 'required|unique:user,username,'.Input::get('id'),
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
			$data	= new User();
			//echo '<pre>'; print_r($input); echo '</pre>'; 	exit;
			$data->fname 	= Input::get('fname');
			$data->lname 	= Input::get('lname');
			$data->username 	= Input::get('username');
			$data->email 	= Input::get('email');
			$data->password 	= Hash::make(Input::get('password'));
			$data->user_type 	= Input::get('user_type');
			$data->active  = (Input::get('active')) ? 1 : 0;	
			$data->save();
			//echo '<pre>'; print_r($data); echo '</pre>'; 	exit;	
		}; 
		
		//$data = User::all();	
		return Redirect::action('Admin_UserController@getMembers');
			//->with(array('data' => $data));
	}
	
	public function getEditMembers($id){
		if ($id == Auth::user()->id)return Redirect::action('Admin_UserController@getMembers');
		$data = User::findOrFail($id);
		//echo '<pre>'; print_r($data); echo '</pre>'; 	exit;
		return View::make('admin.members.form')
			->with(array(
				'data' => $data,
				'title' => 'Edit Member: '. $data->fname
			));
	}

	public function postUpdateMembers(){
		$input = Input::all();
		//dd($input);
		$rules = array(
			'fname' => 'required',
			'lname' => 'required',
			'username' => 'required',
			'email' => 'required|email|unique:users,email,'.Input::get('id'),
			//'password' => 'required|min:6',
			//'password_match' => 'required|min:6|same:password',
		);
		
		if (Input::get('password')) {
			$rules['password']	=	'required|min:6';
			$rules['password_match']	=	'required|min:6|same:password';
		};
		
		$validator = Validator::make($input, $rules);	
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}else{
			$data = User::findOrFail($input['id']);
			//echo '<pre>'; print_r($input); echo '</pre>'; 	exit;
			$data->fname 	= Input::get('fname');
			$data->lname 	= Input::get('lname');
			$data->username 	= Input::get('username');
			$data->email 	= Input::get('email');
			if($input['password']){
				$data->password 	= Hash::make(Input::get('password'));
			};
			$data->user_type 	= Input::get('user_type');
			$data->active  = (Input::get('active')) ? 1 : 0;
			$data->save();

			return Redirect::action('Admin_UserController@getMembers');
			
		}
	}
	
	public function getActiveMembers($id){
		$data = User::findOrFail($id);
		$data->active = ($data->active == 0) ? 1 : 0;
		$data->save();
		return Redirect::action('Admin_UserController@getMembers');
	}
	
	public function getDeleteMembers($id){
		$data = User::findOrFail($id);
		$data->active = 9;
		$data->save();
		return Redirect::action('Admin_UserController@getMembers');	
	}

	
}
