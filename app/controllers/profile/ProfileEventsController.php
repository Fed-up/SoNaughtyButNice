<?php

class ProfileEventsController  extends BaseController {

	public function getProfileEvents(){

		// echo '<pre>'; print_r($eData); echo '</pre>';exit;

		if(Auth::user()){
			$user = Auth::user();
			$user_id = $user->id;
		}else{
			$user_id = 0;
		}

		$eData = Events::orderBy('date','ASC')->where('active', '!=', 9)
			->with(array('Images' => function($query){
					$query->where('images.ordering', '=', 0)->where('section', '=', 'EVENT');
				}))
			->with(array('User' => function($query) use ($user_id){
					// echo '<pre>'; print_r($user_id); echo '</pre>';exit;
					$query->where('paid.user_id', '=', $user_id)->where('paid.type', '=', 'EVENT');
				}))
		->get();
		// echo '<pre>'; print_r($eData); echo '</pre>';



		$paid = 0;
		$confirm_paid = 1;
		$event = 'eData';
		$active = 0;
		$confirm_active = 0;

		foreach($eData as $event){
			foreach($event->User as $pivot){
				$paid = $pivot->pivot->paid;
				
				if($paid == 1){
					$confirm_paid = 1;
					$paid_events[] = $event;
				}else{
					$confirm_paid = 1;
					$paid = 0;
				}
			}
			$e_count = count($event->Images);
			// echo '<pre>'; print_r($event->Images[$e_count-1]->name); echo '</pre>';exit;
			
			if($e_count > 0){
				$event_image[$event->id] = $event->Images[$e_count-1]->name;
			}else{
				$event_image[$event->id] = 'event.jpg';
			}
			$active = $event->active;
			if($active == 1){
				$confirm_active == 1;
			}	
		}

		if($event == 'eData'){
			$event_image = 'event.png';	
			$e_count = 'empty';
		}
		
		// echo '<pre>'; print_r($event); echo '</pre>';exit;


		if(isset($paid_events)){
			return View::make('profile.profile_events')->with(array(
				'eData' => $eData,
				'event_image' => $event_image,
				'paid' =>	$paid,
				'confirm_paid' => $confirm_paid,
				'pEvents' => $paid_events,
				'e_count' => $e_count,
				'confirm_active' => $confirm_active,
			));	

		}else{
			return View::make('profile.profile_events')->with(array(
				'eData' => $eData,
				'event_image' => $event_image,
				'paid' =>	$paid,
				'confirm_paid' => $confirm_paid,
				'e_count' => $e_count,
				'confirm_active' => $confirm_active,
			));	
		}
		
	}
}
