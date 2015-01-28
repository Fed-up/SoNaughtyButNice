<?php

class Admin_QuotesController extends BaseController {
		
	public function getQuotes(){
		$quotes = Quotes::where('active', '!=', 9)->get();
		return View::make('admin.quotes.index')
			->with(array('data' => $quotes))
			->with(array('title' => 'All Quotes'));
	}
	
	public function getAddQuotes(){
		return View::make('admin.quotes.form')
			->with(array('title' => 'Create New Promo Quote'));
	}
	
	public function postAddQuotes(){
		$input = Input::all();
		//dd($input);
		$rules = array(
			'quote' => 'required',
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}else{
			$data	= new Quotes();
			//echo '<pre>'; print_r($input); echo '</pre>'; 	exit;
			$data->quote 	= Input::get('quote');
			$data->active  = (Input::get('active')) ? 1 : 0;	
			$data->save();
			//echo '<pre>'; print_r($data); echo '</pre>'; 	exit;	
		}; 
		
		//$data = User::all();	
		return Redirect::action('Admin_QuotesController@getQuotes');
			//->with(array('data' => $data));
	}

	public function getEditQuotes($id){
		
		$data = Quotes::findOrFail($id);
		//echo '<pre>'; print_r($data); echo '</pre>'; exit;
		return View::make('admin.quotes.form')
			->with(array(
				'data' => $data,
				'title'		=> 'Edit Promo Quote: '.$data->quote));
	}
	
	public function postUpdateQuotes(){
		
		//Variable is holding the object
		$input = Input::all();
		//echo '<pre>'; print_r($input); echo '</pre>'; 	exit;
		$rules = array(
			'quote' 		=> 'required',
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}
			//$mCatUp = MenuCategories::findOrFail('id');
		else{
			$data = Quotes::findOrFail($input['id']);
			$data->quote 	= Input::get('quote');
			$data->active  = (Input::get('active')) ? 1 : 0;
			$data->save();
			//echo '<pre>'; print_r($mCat->id); echo '</pre>'; 	exit;	
		}; 
		
		return Redirect::action('Admin_QuotesController@getQuotes');
	}
	
	public function getActiveQuotes($id){
		$data = Quotes::findOrFail($id);
		$data->active  = ($data->active == 0) ? 1 : 0;
		$data->save();
		return Redirect::action('Admin_QuotesController@getQuotes');
	}
	
	public function getDeleteQuotes($id){
		$data = Quotes::findOrFail($id);
		$data->active = 9;
		$data->save();
		return Redirect::action('Admin_QuotesController@getQuotes')
			->with('message', 'Quote Deleted');
	}
}
