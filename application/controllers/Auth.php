<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function callback()
	{

		if( !$this->input->get('code') )
		{
			show_error("Well this is embarrassing...", 404, $heading = 'Loss for words.');
		}

	    $payload = array(
	        "code" => $this->input->get('code'),
	        "app_key" => $this->config->item('xblio_key')
	    );

	    $crl = curl_init("https://xbl.io/app/claim");
	    $header = array();
	    $header[] = 'X-Contract: 2';
	    $header[] = 'Content-Type: application/json';
	    $header[] = 'Content-Length: ' . strlen(json_encode($payload));
	    curl_setopt($crl, CURLOPT_HTTPHEADER,$header);
	    curl_setopt( $crl, CURLOPT_POSTFIELDS, json_encode($payload) );
	    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($crl, CURLOPT_POST,true);
	    $result = curl_exec($crl);
	    curl_close($crl); 	
	    $result = json_decode( $result, true );

	    $this->session->set_userdata(array(
	    	'openxbl' => array(
		    	'app_key' => $result['data'][0]['app_key'], 
		    	'xuid' => $result['data'][0]['xuid'],
		    	'gamertag' => $result['data'][0]['gamertag'],
		    	'level' => $result['data'][0]['level']
		    )
	    ));

		redirect('/library', 'refresh');

	}

	public function logout()
	{

		$this->session->unset_userdata('openxbl');

		redirect('/', 'refresh');

	}

}