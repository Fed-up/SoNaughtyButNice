<?php
class Admin_ProductsController extends BaseController {
	//Ingredients
	
	public function getProducts(){
		$products = Products::where('active', '!=', 9)->get();
		return View::make('admin.products.index')
			->with(array('data' => $products));
	}
	public function getAddProducts(){
		return View::make('admin.products.form')
			->with(array('title' => 'Create New Product'));
	}
	
	public function postAddProducts(){
		$input = Input::all();
		//dd($input);
		//Remove the start of the dollar sign
		//dd($input['price']);
		$rules = array(
			'name' 		=> 'required|unique:products',
			'price'	=> 'required|integer',//Needs to be better defined
			'summary'	=> 'required',
			'description'	=> 'required'
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);	
		}else{
			$data	= new Products();
			$data->name 	= Input::get('name');
			$data->price 	= Input::get('price');
			$data->summary 	= Input::get('summary');
			$data->description 	= Input::get('description');
			$data->active 	= (Input::get('active')) ? 1 : 0;
			$data->save();
			//echo '<pre>'; print_r($data); echo '</pre>'; 	exit;	
		};
		return Redirect::action('Admin_ProductsController@getProducts');
	}
	
	public function getEditProducts($id){
		//echo $id; exit;
			$data = Products::findOrFail($id);
			//echo '<pre>'; print_r($data); echo '</pre>'; 	exit;	$data is holding the object Menu Ingredients
		return View::make('admin.products.form')
			->with(array(
				'data' => $data,
				'title' => 'Edit Products: '. $data->name));
	}

	
	public function postUpdateProducts(){
		
		//Variable is holding the object
		$input = Input::all();
		$rules = array(
			'name' 		=> 'required|unique:products,name,'.Input::get('id'),
			'price' 	   => 'required|integer',
			'summary'	=> 'required',
			'description' => 'required',
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}
			//$mCatUp = Products::findOrFail('id');
		else{
			$data = Products::findOrFail($input['id']);//Find the row in Menu Categories where ID = the input and attatch the object to the variable $mCatUp 
			$data->name 	= $input['name'];
			$data->price 	= $input['price'];
			$data->summary 	= $input['summary'];
			$data->description = $input['description'];
			$data->active  = (isset($input['active'])) ? 1 : 0;
			$data->save();
			//This code gets the data from the input and attaches it to the object in the variable $data
			//echo '<pre>'; print_r($data); echo '</pre>'; 	exit;
		}; 
		return Redirect::action('Admin_ProductsController@getProducts');
	}
	
	public function getActiveProducts($id){
		$data = Products::findOrFail($id);
		$data->active = ($data->active == 0)? 1 : 0; //If it is == 0 thats true so change the value to 1, else if its false the value is 1 so change it to 0
		$data->save();
		return Redirect::action('Admin_ProductsController@getProducts');
	}
	
	public function getDeleteProducts($id){
		$data = Products::findOrFail($id);
		$data->active = 9;
		$data->save();
		return Redirect::action('Admin_ProductsController@getProducts');
	}
}

	


