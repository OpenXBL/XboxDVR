<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shares extends CI_Controller {

	public function index()
	{

		$this->load->model('share', '', TRUE);

		$view = array(
			'title' => config_item('title') . ' :: Community Showcase',
			'media' => $this->share->get_all()
		);
		
		$this->load->view('showcase/shares', $view);
	}

	public function item($share_id)
	{

		$this->load->model('share', '', TRUE);

		$share = $this->share->get_media_by_id($share_id);

		$view = array(
			'title' => config_item('title') . ' :: ' . $share->title,
			'media' => $share
		);

		$this->load->view('showcase/item', $view);
	}

}
