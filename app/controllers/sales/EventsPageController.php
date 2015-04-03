<?php

class EventsPageController  extends BaseController {

	public function getEvents($id){

		

		if(Auth::user()){
			$user = Auth::user();
			$user_id = $user->id;
		}else{
			$user_id = 0;
		}

		// $ticket_id = Paid::where('user_id', '=', $user->id)->orderby('id','DESC')->take(1)->get();
		// $id = $ticket_id[0]->id.''.$user_id;
		// echo '<pre>'; print_r($ticket_id); echo '</pre>';exit;



		$eData = Events::orderBy('created_at','ASC')->where('active', '=', 1)->where('id', '=', $id)
			->with(array('Images' => function($query){
					$query->orderBy('images.ordering','DESC')->where('section', '=', 'EVENT');
				}))
			->with(array('User' => function($query) use ($user_id){
					// echo '<pre>'; print_r($user_id); echo '</pre>';exit;
					$query->where('paid.user_id', '=', $user_id)->where('paid.type', '=', 'EVENT');
				}))
		->get();

		$uData = User::where('id', '=', $user_id)->where('active', '=', 1)
			// ->with(array('Events' => function($query) use ($id, $user_id)
			// {
			// 	$query->where('paid.user_id', '=', $user_id)->where('paid.link_id', '=', $id);
			// }))
			->with('Events')
		->get();

		$pData = Paid::where('user_id', '=', $user_id)->where('link_id', '=', $id)->orderBy('created_at', 'ASC')->get();

		$pCount = 0;
		foreach ($pData as $p) {
			$purchase[$pCount] = $p->cost/100;
			$quantity[$pCount] = $p->quantity;

			$timestamp = $p->created_at;  //timestamp
			$date[$pCount] = date('F jS, Y', strtotime($timestamp));			
			$pCount ++;
		}

		$pCount = $pCount-1;

		$paid = 0;
		$confirm_paid = 1;
		$past = 0;
		$confirm_past = 0;
		foreach($eData as $event){
			foreach($event->User as $pivot){
				$paid = $pivot->pivot->paid;
				//
				if($paid == 1){
					$confirm_paid = 1;
				}else{
					$confirm_paid = 0;
					$paid = 1;
				}				
			}
			$images = $event->Images;
			$e_count = count($images);
			// echo '<pre>'; print_r($event->Images[$e_count-1]->name); echo '</pre>';exit;
			
			if($e_count > 0){
				$header_image = $event->Images[$e_count-1]->name;
			}else{
				$header_image = 'event.png';
			}	
			$past = $event->past;
			if($past == 1){
				$confirm_past = 1;
			}
		}

		// echo '<pre>'; print_r($pCount); echo '</pre>';exit;
		

		if($confirm_paid == $paid){
			return View::make('sales.events_page')->with(array(
				'hImage' => $header_image,
				'eData' => $eData,
				'paid' =>	$paid,
				'confirm_paid' => $confirm_paid,
				'purchase' => $purchase,
				'quantity' =>	$quantity,
				'date' => $date,
				'pCount' => $pCount,
				'confirm_past' => $confirm_past,
				)
			);
		}else{
			return View::make('sales.events_page')->with(array(
				'hImage' => $header_image,
				'eData' => $eData,
				'paid' =>	$paid,
				'confirm_paid' => $confirm_paid,
				'confirm_past' => $confirm_past,
				)
			);
		}
	}
}