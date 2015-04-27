<?php

class SquareController extends BaseController {

	public function getSquare(){

	// $response = http_get(string $url, array("timeout=>1"), $info);

	$token = 'fdTz46il7_nnV4DZOVRycQ';
	$merchant_id = 'BJ1N8SWR4W8EH';
	$info = 0;

	$data = '{
	  "name": "ham",
	  "variations": [
	    {
	      "name": "Small",
	      "pricing_type": "FIXED_PRICING",
	      "price_money": {
	        "currency_code": "USD",
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

}



// {"id":"BJ1N8SWR4W8EH","name":"Fed Up Project","email":"fedupproject@gmail.com","country_code":"AU","language_code":"en-US","business_name":"Fed Up Project","business_type":"OTHER","account_type":"LOCATION","currency_code":"AUD","account_capabilities":[]}return: 1