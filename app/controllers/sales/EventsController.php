<?php

class EventsController  extends BaseController {

	public function getEvents(){

		// echo '<pre>'; print_r($eData); echo '</pre>';exit;

		if(Auth::user()){
			$user = Auth::user();
			$user_id = $user->id;
		}else{
			$user_id = 0;
		}

		$eData = Events::orderBy('date','ASC')->where('active', '=', 1)
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

		foreach($eData as $event){
			
			 echo '<pre>'; print_r($event); echo '</pre>';exit;

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
		}

		if($event == 'eData'){
			$event_image = 'event.png';	
			$e_count = 'empty';
		}
		
		// echo '<pre>'; print_r($event); echo '</pre>';exit;


		if(isset($paid_events)){
			return View::make('sales.events')->with(array(
				'eData' => $eData,
				'event_image' => $event_image,
				'paid' =>	$paid,
				'confirm_paid' => $confirm_paid,
				'pEvents' => $paid_events,
				'e_count' => $e_count,
			));	

		}else{
			return View::make('sales.events')->with(array(
				'eData' => $eData,
				'event_image' => $event_image,
				'paid' =>	$paid,
				'confirm_paid' => $confirm_paid,
				'e_count' => $e_count,
			));	
		}
		
	}
}
