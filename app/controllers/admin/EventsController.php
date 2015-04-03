<?php

class Admin_EventsController extends BaseController {

	public function getEvents(){
		//Finds every record that does not equal 9
		$data = Events::where('active', '!=', 9)->get();
		return View::make('admin.events.index')
			->with(array('data' => $data));
	}
	public function getAddEvents(){
		return View::make('admin.events.form')
			->with(array('title' => 'Create New Event'));	
	}
	public function postAddEvents(){
		
		$input = Input::all();
		//dd($input);
		$rules = array(
			'name' 		=> 'required',
			'date' 		=> 'required', //Date picker
			'time' 		=> 'required', //Jquery time
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInnput($input);
		}
			//$mCatUp = MenuCategories::findOrFail('id');
		else{
			$data	= new Events();
			//echo '<pre>'; print_r(); echo '</pre>'; 	exit;
			$data->name 	= Input::get('name');
			$data->summary 	= Input::get('summary');
			$data->date 	= Input::get('date');
			$data->time 	= Input::get('time');
			$data->bring 	= Input::get('bring');
			$data->who 	= Input::get('who');
			$data->why 	= Input::get('why');
			$data->map 	= Input::get('map');
			$data->youtube 	= Input::get('youtube');
			$data->price 	= Input::get('price');
			$data->ticket_amount 	= Input::get('ticket_amount');
			$data->active  = (Input::get('active')) ? 1 : 0;
			$data->past  = (Input::get('past')) ? 1 : 0;
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
									$_image->section = 'EVENT';
									$_image->active = 1;
								}else{
										$_image = Images::find($i_photo);
										$_image->name = $photo;
										$_image->summary = $input['img_des'][$p][$i_photo];
										$_image->link_id = $input['id'];
										$_image->ordering = $p;
										$_image->section = 'EVENT';
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
			//echo '<pre>'; print_r($mCat); echo '</pre>'; 	exit;	
		}; 
		
		// $data = Packages::all();	
		return Redirect::action('Admin_EventsController@getEvents')
			->with(array('data' => $data));
	}
	
	public function getEditEvents($id){
		
		$data = Events::findOrFail($id);
		$event_images = $data->Images()->orderBy('ordering','ASC')->where('section','=','EVENT')->get();
		// echo '<pre>'; print_r($event_images); echo '</pre>'; exit;
		return View::make('admin.events.form')
			->with(array(
				'data' => $data,
				'e_images' => $event_images,
				'title'		=> 'Edit Event : '.$data->name));
	}
	
	public function postUpdateEvents(){
		
		//Variable is holding the object
		$input = Input::all();
		$rules = array(
			'name' 		=> 'required',
			'summary'	=> 'required',
			'date' 		=> 'required', //Date picker
			'time' 		=> 'required', //Jquery time
			'bring' 		=> 'required',
			'who' 		=> 'required',
			'why'	=> 'required',
			'price' 		=> 'required'
		);
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()){
			return Redirect::back()
				->withErrors($validator)
				->withInput($input);
		}
			//$mCatUp = MenuCategories::findOrFail('id');
		else{
			$data = Events::findOrFail($input['id']);
			
			$data->name 	= Input::get('name');
			$data->summary 	= Input::get('summary');
			$data->date 	= Input::get('date');
			$data->time 	= Input::get('time');
			$data->bring 	= Input::get('bring');
			$data->who 	= Input::get('who');
			$data->why 	= Input::get('why');
			$data->map 	= Input::get('map');
			$data->youtube 	= Input::get('youtube');
			$data->price 	= Input::get('price');
			$data->ticket_amount 	= Input::get('ticket_amount');
			$data->active  = (Input::get('active')) ? 1 : 0;
			$data->past  = (Input::get('past')) ? 1 : 0;
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
									$_image->section = 'EVENT';
									$_image->active = 1;
								}else{
										$_image = Images::find($i_photo);
										$_image->name = $photo;
										$_image->summary = $input['img_des'][$p][$i_photo];
										$_image->link_id = $input['id'];
										$_image->ordering = $p;
										$_image->section = 'EVENT';
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
			//echo '<pre>'; print_r($mCat->id); echo '</pre>'; 	exit;	
		}; 
		
		return Redirect::action('Admin_EventsController@getEvents');
	}
	
	public function getActiveEvents($id){
		$data = Events::findOrFail($id);
		$data->active  = ($data->active == 0) ? 1 : 0;
		$data->save();
		return Redirect::action('Admin_EventsController@getEvents');
	}
	
	public function getDeleteEvents($id){
		$data = Events::findOrFail($id);
		$data->active = 9;
		$data->save();
		return Redirect::action('Admin_EventsController@getEvents')
			->with('message', 'Events Deleted');
	}
}

	


