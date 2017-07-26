<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiService extends CI_Controller {

	private $base_url = 'https://xbl.io/api/v1/';

	public function index()
	{
		$view = array(
			'title' => 'Welcome to ' . config_item('title')
		);
		
		$this->load->view('home', $view);
	}

	public function get_dvr_gameclips()
	{
		$clips = $this->get('dvr/gameclips');

        $this->load->model('share', '', TRUE);

        foreach($clips[0]['gameClips'] as $key => $value)
        {
            $clips[0]['gameClips'][$key]['is_shared'] = $this->share->is_shared($value['gameClipId']);
        }

	    $this->session->set_userdata(array(
	    	'clips' => $clips
	    ));

		return $this->output
		            ->set_content_type('application/json')
		            ->set_output((json_encode($clips)));

	}

    public function get_dvr_screenshots()
    {
    	$images = $this->get('dvr/screenshots');

        $this->load->model('share', '', TRUE);

        foreach($images[0]['screenshots'] as $key => $value)
        {
            $images[0]['screenshots'][$key]['is_shared'] = $this->share->is_shared($value['screenshotId']);
        }

	    $this->session->set_userdata(array(
	    	'images' => $images
	    ));

        return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($images));
    }

	public function get($path)
	{
    	return $this->call("GET", $path);
	}

    private function call($method, $url, $options = array())
    {
		if(! $this->input->is_ajax_request()) {
		    redirect('404');
		}
		
    	$key = $this->session->userdata('openxbl')['app_key'];

        $crl = curl_init($this->base_url . $url);
        
        $headr = array();
        if( !empty( $options['headers'] ) )
        {
            foreach( $options['headers'] as $header => $value )
            {
                $headr[] = $header . ':' . $value;
            }
        }

        $headr[] = 'X-Authorization: ' . $key;
        $headr[] = 'X-Contract: 100';
        curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
        if($method == 'POST')
        {
            if( !empty( $options['payload'] ) )
            {
                curl_setopt( $crl, CURLOPT_POSTFIELDS, json_encode( $options['payload'] ) );
            }
            
            curl_setopt($crl, CURLOPT_POST,true);           
        }
        else if( $method == 'GET' )
        {
            curl_setopt($crl, CURLOPT_POST,false);     
        }
        else
        {
            curl_setopt($crl, CURLOPT_CUSTOMREQUEST, $method);
        }

        $results = json_decode(curl_exec($crl), true);

        if(isset($results['error']))
        {
        	show_error($results['error']['message'], $results['error']['code'], $heading = 'We\'ve encountered an error.');
        }

        return $results['data'];
    }

}