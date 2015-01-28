<?php
class Admin_HeaderController extends BaseController {
	//Ingredients
	
	public function getHeader(){
		$header = Header::where('active', '!=', 9)->get();
		//echo '<pre>'; print_r($header); echo '</pre>'; 	exit;
		return View::make('admin.header.index')
			->with(array('header' => $header));
	}
	public function getAddHeader(){
		return View::make('admin.header.form')
			->with(array('title' => 'Create New Header'));
	}
	
	public function postAddHeader(){
		$input = Input::all();
		$rules = array(
			'name' 		=> 'required|unique:header,name',
			'link'	=> 'required',
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);	
		}else{
			$data	= new Header();
			$data->name 	= Input::get('name');
			$data->link 	= Input::get('link');
			$data->active 	= (Input::get('active')) ? 1 : 0;
			if($data->save()){
				if(isset($input['images'])){
					$p_count = count($input['images']);
					$p=0;
					foreach($input['images'] as $image){
						if($p <= $p_count){
							foreach($image as $i_photo=>$photo){
								if($i_photo == 'x'){
									$_image = new Images();
									$_image->name = $photo;
									$_image->summary = $input['img_des'][$p]['x'];
									$_image->menu_recipes_id = 0;
									$_image->header_id = $input['id'];
									$_image->ordering = $p;
									$_image->section = 'HEADER';
									$_image->active = 1;
								}else{
										$_image = Images::find($i_photo);
										$_image->name = $photo;
										$_image->summary = $input['img_des'][$p][$i_photo];
										$_image->menu_recipes_id = 0;
										$_image->header_id = $input['id'];
										$_image->ordering = $p;
										$_image->section = 'HEADER';
										$_image->active = 1;
								};
								$data->Images()->save($_image);
							};
						$p++;
						};
					};
				};
			};
			//echo '<pre>'; print_r($mIng->id); echo '</pre>'; 	exit;	
		};
		return Redirect::action('Admin_HeaderController@getHeader');
	}
	
	public function getEditHeader($id){
		//echo $id; exit;
			$data = Header::findOrFail($id);
			$header_images = $data->Images()->orderBy('ordering','ASC')->where('section', '=', 'HEADER')->get();
				
		return View::make('admin.header.form')
			->with(array(
				'data' => $data,
				'h_images' => $header_images,
				'title' => 'Edit Header: '. $data->name));
	}

	
	public function postUpdateHeader(){
		
		$input = Input::all();
		$rules = array(
			'name' 		=> 'required|unique:header,name,'.Input::get('id'),
			'link'	=> 'required',
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);	
		}
		else{
			$data = Header::findOrFail($input['id']);//Find the row in Menu Categories where ID = the input and attatch the object to the variable $mCatUp 
			$data->name 	= $input['name'];
			$data->link 	= $input['link'];
			$data->active  = (isset($input['active'])) ? 1 : 0;
			if($data->save()){
				if(isset($input['images'])){
					$p_count = count($input['images']);
					$p=0;
					foreach($input['images'] as $image){
						if($p <= $p_count){
							foreach($image as $i_photo=>$photo){
								if($i_photo == 'x'){
									$_image = new Images();
									$_image->name = $photo;
									$_image->summary = $input['img_des'][$p]['x'];
									$_image->link_id = $input['id'];
									$_image->ordering = $p;
									$_image->section = 'HEADER';
									$_image->active = 1;
								}else{
										$_image = Images::find($i_photo);
										$_image->name = $photo;
										$_image->summary = $input['img_des'][$p][$i_photo];
										$_image->link_id = $input['id'];
										$_image->ordering = $p;
										$_image->section = 'HEADER';
										$_image->active = 1;
								};
								$data->Images()->save($_image);
							};
						$p++;
						};
					};
					if(isset($input['ddp'])){
						$ddp = $input['ddp'];
						//echo '<pre>'; print_r($ddp); echo '</pre>'; 	exit;
						
						foreach($ddp as $dp_delete){
						
							$dp = Images::find($dp_delete);
							$dp->delete();
						};
					};
				};
			};
			//This code gets the data from the input and attaches it to the object in the variable $data
			//echo '<pre>'; print_r($data); echo '</pre>'; 	exit;
		}; 
		return Redirect::action('Admin_HeaderController@getHeader');
	}
	
	public function getActiveHeader($id){
		$data = Header::findOrFail($id);
		$data->active = ($data->active == 0)? 1 : 0; //If it is == 0 thats true so change the value to 1, else if its false the value is 1 so change it to 0
		$data->save();
		return Redirect::action('Admin_HeaderController@getHeader');
	}
	
	public function getDeleteHeader($id){
		$data = Header::findOrFail($id);
		$data->active = 9;
		$data->save();
		return Redirect::action('Admin_HeaderController@getHeader');
	}
}	
	
	
	
	
	
	
	
	