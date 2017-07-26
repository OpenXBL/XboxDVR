<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{

		redirect('/library/clips', 'refresh');

	}

	public function share()
	{


		$this->load->model('share', '', TRUE);

		$session = $this->session->userdata('openxbl');

		$sessionType = $this->input->post('type');

		if( $sessionType == 'video' )
		{
			$sessionMedia = $this->session->userdata('clips');

		}
		else if( $sessionType == 'image' )
		{
			$sessionMedia = $this->session->userdata('images');
		}

		if(!$sessionMedia){

			show_error("We slipped and fell. Please try your request again.", 400, $heading = 'Bless this mess.');

		}

		$shareId = $this->input->post('media_id');

		if($this->share->is_shared($shareId))
		{
			show_error("You cannot share the same media multiple times.", 400, $heading = 'It\'s done. Okay!');
		}

		$media = array();

		foreach ( ($sessionType=='video')?$sessionMedia[0]['gameClips']:$sessionMedia[0]['screenshots'] as $key => $val) {
			if ( (($sessionType=='video')?$val['gameClipId']:$val['screenshotId']) === $shareId) {
				$media = $val;
			}
		}

		if(empty($media))
		{
			show_error("We had trouble processing this request. Please try again.", 400, $heading = 'Bless this mess.');
		}

		$insert_id = $this->share->insert($media);

		if($this->input->post('type') == 'image')
		{
			$this->downloadMedia(array(
				'media_id' => $media['screenshotId'],
				'url' => $media['screenshotUris'][0]['uri'],
				'type' => 'image',
				'thumbnail' => $media['thumbnails'][0]['uri']
			));
		}
		else if($this->input->post('type') == 'video')
		{
			$this->downloadMedia(array(
				'media_id' => $media['gameClipId'],
				'url' => $media['gameClipUris'][0]['uri'],
				'type' => 'video',
				'thumbnail' => $media['thumbnails'][0]['uri']
			));	   	
		}

		$this->load->model('players', '', TRUE);

		$this->players->insert_or_update(array(
			'xuid' => $session['xuid'],
			'gamertag' => $session['gamertag']
		));

		$this->load->model('title', '', TRUE);

		$this->title->insert($media);

		return $this->output
		            ->set_content_type('application/json')
		            ->set_output((json_encode( $insert_id )));


	}

	public function clips()

	{

		$session = $this->session->userdata('openxbl');

		if(!$session){

			show_error("Please login before sharing media.", 400, $heading = 'Woah there, Nelly.');

		}

		$view = array(

			'title' => config_item('title') . ' :: Your Library'

		);

		$this->load->view('library/clips', $view);

	}

	public function screenshots()

	{

		$session = $this->session->userdata('openxbl');

		if(!$session){

			show_error("Please login before sharing media.", 400, $heading = 'Woah there, Nelly.');

		}

		$view = array(

			'title' => config_item('title') . ' :: Your Library'

		);

		$this->load->view('library/screenshots', $view);

	} 

	private static function downloadMedia($data)
	{

		// Save media source
		$media_source = file_get_contents($data['url']);
		$extension = ($data['type'] == 'video') ? '.mp4' : '.png';
		$fp = fopen(realpath(dirname(basename(__DIR__))) . "/uploads/media/" . $data['media_id'] . $extension, "w");
		fwrite($fp, $media_source);
		fclose($fp);

		// Save media thumbnail
		$media_thumbnail = file_get_contents($data['thumbnail']);
		$fp = fopen(realpath(dirname(basename(__DIR__))) . "/uploads/thumbnail/" . $data['media_id'] . ".png", "w");
		fwrite($fp, $media_thumbnail);
		fclose($fp);

	}


}

