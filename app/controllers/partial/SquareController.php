<?php

class SquareController extends BaseController {

	public function getSquare(){

	// $response = http_get(string $url, array("timeout=>1"), $info);

	$token = 'fdTz46il7_nnV4DZOVRycQ';
	$merchant_id = 'BJ1N8SWR4W8EH';
	$info = 0;

	$data = '{
	  "name": "Carl",
	  "variations": [
	    {
	      "name": "Small",
	      "pricing_type": "FIXED_PRICING",
	      "price_money": {
	        "currency_code": "AUD",
	        "amount": 400
	      }
	    }
	  ]
	}';

	echo '<pre>'; print_r($merchant_id); echo '</pre>';    exit;

	// $data_string = json_encode($data)

	// create curl resource 
    $curl_instance = curl_init(); 

    // set url 
    curl_setopt($curl_instance, CURLOPT_URL, "https://connect.squareup.com/v1/".$merchant_id."/items"); 

    curl_setopt($curl_instance, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl_instance, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl_instance, CURLOPT_SSL_VERIFYPEER, false);
	// curl_setopt($curl_instance, CURLOPT_SSL_VERIFYHOST, 2);
	// curl_setopt($curl_instance, CURLOPT_CAINFO, getcwd() . "/certs/square.pem");

    //return the transfer as a string 
    // curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($curl_instance, CURLOPT_HTTPHEADER, array(
	    'Authorization: Bearer '.$token,
	    'Accept : application/json',
        'Content-Type : application/json',
    ));


    // echo '<pre>'; print_r($curl_instance); echo '</pre>';    
    // $output contains the output string 
    $output = curl_exec($curl_instance); 

    // close curl resource to free up system resources 
    curl_close($curl_instance);  

    echo 'return: '; 
    print $output;
	exit;




	return View::make('partial.square');
	

	}



	public function getPay(){

		// $response = http_get(string $url, array("timeout=>1"), $info);

		$token = 'fdTz46il7_nnV4DZOVRycQ';
		$merchant_id = 'BJ1N8SWR4W8EH';
		$info = 0;
		// $parameters = urlencode("{
		// 	'begin_time': '2014-10-21 04:59:05',
  //          	'end_time'  : '2015-10-21 04:59:05',
  //          	'order'     : 'DESC'
		// }");
		$parameters = urlencode("{'begin_time': '2015-01-01T00:00:00-08:00',
                               'end_time'  : '2015-13-05T00:00:00-08:00',
                               'order'     : 'DESC'}");

		$url ="https://connect.squareup.com/v1/".$merchant_id."/payments?".$parameters;
		$error = "no read";
		// create a new cURL resource
		$ch = curl_init();

		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Bearer '.$token,
		    'Accept : application/json',
	        'Content-Type : application/json',
	    ));

		// grab URL and pass it to the browser
		

		 

		// close cURL resource, and free up system resources
		
		if(curl_exec($ch) === false)
		{
		    echo 'Curl error: ' . curl_error($ch);
		}
		else
		{
		    echo 'Operation completed without any errors';
		    $output = curl_exec($ch);
		    $status = curl_getinfo($ch);
		}
				   
		$end = 'Done';	
		curl_close($ch);


		// print $output;
		$o = $output;
		// echo '<pre>'; print_r($status); echo '</pre>';   
		$o = json_decode($output);
		$response = json_encode($o);
		
		// echo '<pre>'; print_r($response); echo '</pre>';   

		foreach ($o as $value) {
			echo '<pre> Created at:'; print_r(isset($value->created_at)?$value->created_at : ''); echo '</pre>';
			echo '<pre> Device:'; print_r($value->device->name); echo '</pre>';
			echo '<pre> Inclusive_tax name:'; print_r(isset($value->inclusive_tax[0]->name)?$value->inclusive_tax[0]->name : ''); echo '</pre>';
			echo '<pre> Inclusive_tax rate:'; print_r(isset($value->inclusive_tax[0]->rate)?$value->inclusive_tax[0]->rate : ''); echo '</pre>';
			echo '<pre> Inclusive_tax inclusive type:'; print_r(isset($value->inclusive_tax[0]->inclusion_type)?$value->inclusive_tax[0]->inclusion_type : ''); echo '</pre>';
			echo '<pre> Inclusive_tax currency_code:'; print_r(isset($value->inclusive_tax[0]->applied_money->currency_code)?$value->inclusive_tax[0]->applied_money->currency_code : ''); echo '</pre>';
			echo '<pre> Inclusive_tax amount:'; print_r(isset($value->inclusive_tax[0]->applied_money->amount)?$value->inclusive_tax[0]->applied_money->amount : ''); echo '</pre>';
			echo '<pre> gross_sales_money currency_code:'; print_r(isset($value->gross_sales_money->currency_code)?$value->gross_sales_money->currency_code : ''); echo '</pre>';
			echo '<pre> gross_sales_money amount:'; print_r(isset($value->gross_sales_money->amount)?$value->gross_sales_money->amount : ''); echo '</pre>';
			echo '<pre> processing_fee_money currency_code:'; print_r(isset($value->processing_fee_money->currency_code)?$value->processing_fee_money->currency_code : ''); echo '</pre>';
			echo '<pre> processing_fee_money amount:'; print_r(isset($value->processing_fee_money->amount)?$value->processing_fee_money->amount : ''); echo '</pre>';
			echo '<pre> net_sales_money currency_code:'; print_r(isset($value->net_sales_money->currency_code)?$value->net_sales_money->currency_code : ''); echo '</pre>';
			echo '<pre> net_sales_money amount:'; print_r(isset($value->net_sales_money->amount)?$value->net_sales_money->amount : ''); echo '</pre>';
			echo '<pre> discount_money currency_code:'; print_r(isset($value->discount_money->currency_code)?$value->discount_money->currency_code : ''); echo '</pre>';
			echo '<pre> discount_money amount:'; print_r(isset($value->discount_money->amount)?$value->discount_money->amount : ''); echo '</pre>';
			echo '<pre> total_collected_money currency_code:'; print_r(isset($value->total_collected_money->currency_code)?$value->total_collected_money->currency_code : ''); echo '</pre>';
			echo '<pre> total_collected_money amount:'; print_r(isset($value->total_collected_money->amount)?$value->total_collected_money->amount : ''); echo '</pre>';
			echo '<pre> net_total_money currency_code:'; print_r(isset($value->net_total_money->currency_code)?$value->net_total_money->currency_code : ''); echo '</pre>';
			echo '<pre> net_total_money amount:'; print_r(isset($value->net_total_money->amount)?$value->net_total_money->amount : ''); echo '</pre>';
			echo '<pre> gross_sales_money currency_code:'; print_r(isset($value->gross_sales_money->currency_code)?$value->gross_sales_money->currency_code : ''); echo '</pre>';
			echo '<pre> gross_sales_money amount:'; print_r(isset($value->gross_sales_money->amount)?$value->gross_sales_money->amount : ''); echo '</pre>';
			echo "<br/><br/>";
		}

		foreach ($o as $value) {
			echo '<pre>'; print_r($value); echo '</pre>';
		}

		exit;
		




		// echo '<pre>'; print_r($url); echo '</pre>';    exit;

		// $curl_instance = curl_init();
		// curl_setopt($curl_instance, CURLOPT_URL, $url);
		// curl_setopt($curl_instance, CURLOPT_CUSTOMREQUEST, "GET");
		// curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, true);

  //   	curl_setopt($curl_instance, CURLOPT_SSL_VERIFYPEER, false);	
		// curl_setopt($curl_instance, CURLINFO_HEADER_OUT, true);
		// curl_setopt($curl_instance, CURLOPT_HTTPHEADER, array(
		//     'Authorization: Bearer '.$token,
		//     'Accept : application/json',
	 //        'Content-Type : application/json',
	 //    ));

	 //    // echo '<pre>'; print_r($curl_instance); echo '</pre>';    
	 //    // $output contains the output string 
	 //    $output = curl_exec($curl_instance); 
		// curl_close($curl_instance); 
		// $result = var_dump(curl_getinfo($ch));


		


		// //  Initiate curl
		// $curl_instance = curl_init();
		// // Disable SSL verification
		// curl_setopt($curl_instance, CURLOPT_SSL_VERIFYPEER, false);
		// // Will return the response, if false it print the response
		// curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, true);
		// // Set the url
		// curl_setopt($curl_instance, CURLOPT_URL,$url);
		// // Execute
		// $result=curl_exec($curl_instance);
		// // Closing'

		

		// curl_close($curl_instance);

		// Will dump a beauty json :3
		// $output = var_dump(json_decode($result, true));

		// $output = file_get_contents($result);
		// Will dump a beauty json :3
		// var_dump(json_decode($result, true));exit;


		// echo '<pre>'; print_r($result); echo '</pre>';    exit;









		// urllib.urlencode({'begin_time': '2014-01-01T00:00:00-08:00',
  //                              'end_time'  : '2015-01-01T00:00:00-08:00',
  //                              'order'     : 'DESC'});

		// echo '<pre>'; print_r($parameters); echo '</pre>';    exit;

		// $data_string = json_encode($data)

		// create curl resource 
	 //    $curl_instance = curl_init(); 

	 //    // set url 
	 //    curl_setopt($curl_instance, CURLOPT_URL, "https://connect.squareup.com/v1/me/payments?".$parameters); 

	 //    curl_setopt($curl_instance, CURLOPT_CUSTOMREQUEST, "GET");
	 //    // curl_setopt($curl_instance, CURLOPT_POSTFIELDS, $parameters);
	 //    curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, true);

	 //    curl_setopt($curl_instance, CURLOPT_SSL_VERIFYPEER, false);
		// curl_setopt($curl_instance, CURLOPT_SSL_VERIFYHOST, 2);
		// curl_setopt($curl_instance, CURLOPT_CAINFO, getcwd() . "/certs/square.pem");

	 //    //return the transfer as a string 
	 //    // curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, 1); 
	 //    curl_setopt($curl_instance, CURLOPT_HTTPHEADER, array(
		//     'Authorization: Bearer '.$token,
		//     'Accept : application/json',
	 //        'Content-Type : application/json',
	 //    ));


	 //    // echo '<pre>'; print_r($curl_instance); echo '</pre>';   exit; 
	 //    // $output contains the output string 
	 //    $output = curl_exec($curl_instance); 

	 //    // close curl resource to free up system resources 
	 //    curl_close($curl_instance);  

	 //    echo 'return: '; 
	 //    print $output;
		// exit;




		return View::make('partial.square')->with(array(
				'output' => $output,
				'error' => $error,
				'end' => $end,
				)
			);
	

	}

}



// {"id":"BJ1N8SWR4W8EH","name":"Fed Up Project","email":"fedupproject@gmail.com","country_code":"AU","language_code":"en-US","business_name":"Fed Up Project","business_type":"OTHER","account_type":"LOCATION","currency_code":"AUD","account_capabilities":[]}return: 1