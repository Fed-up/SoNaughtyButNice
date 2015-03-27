<?php

class Admin_MetricController extends BaseController {

	public function getMetric(){
		//Finds every record that does not equal 9
		$metric = Metric::where('active', '!=', 9)->orderBy('name','ASC')->get(); 
		return View::make('admin.metric.index')
			->with(array('data' => $metric));
	}
	public function getAddMetric(){
		return View::make('admin.metric.form')
			->with(array('title' => 'Create New Metric'));	
	}
	public function postAddMetric(){
		
		$input = Input::all();
		//dd($input);
		$rules = array(
			'name' 		=> 'required|unique:metric,name,'.Input::get('id'),
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}
			//$mCatUp = MenuCategories::findOrFail('id');
		else{
			$data	= new Metric();
			//echo '<pre>'; print_r(); echo '</pre>'; 	exit;
			$data->name 	= Input::get('name');
			$data->active 	= 1;
			$data->save();
			//echo '<pre>'; print_r($mCat); echo '</pre>'; 	exit;	
		}; 
		return Redirect::action('Admin_MetricController@getMetric');
	}
	
	public function getEditMetric($id){
		
		$data = Metric::findOrFail($id);
		//echo '<pre>'; print_r($data); echo '</pre>'; exit;
		return View::make('admin.metric.form')
			->with(array(
				'data' => $data,
				'title'		=> 'Edit Metric : '.$data->name));
	}
	
	public function postUpdateMetric(){
		
		//Variable is holding the object
		$input = Input::all();
		$rules = array(
			'name' 		=> 'required|unique:metric,name,'.Input::get('id'),
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}
			//$mCatUp = MenuCategories::findOrFail('id');
		else{
			$data = Metric::findOrFail($input['id']);//Find the row in Menu Categories where ID = the input and attatch the object to the variable $mCatUp 
			$data->name 	= $input['name'];
			$data->active 	= 1;
			$data->save();
			//echo '<pre>'; print_r($mCat->id); echo '</pre>'; 	exit;	
		}; 
		
		return Redirect::action('Admin_MetricController@getMetric');
	}
	
	public function getActiveMetric($id){
		$data = Metric::findOrFail($id);
		$data->active  = ($data->active == 0) ? 1 : 0;
		$data->save();
		return Redirect::action('Admin_MetricController@getMetric');
	}
	
	public function getDeleteMetric($id){
		$data = Metric::findOrFail($id);
		$data->active = 9;
		$data->save();
		return Redirect::action('Admin_MetricController@getMetric')
			->with('message', 'Metric Deleted');
	}

}

	


