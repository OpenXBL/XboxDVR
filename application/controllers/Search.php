<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function index()
	{

		$this->load->model('title', '', TRUE);

		$view = array(
			'title' => config_item('title') . ' :: Browse By Game',
			'titles' => $this->title->get_all()
		);
		
		$this->load->view('search/by_game', $view);
	}

	public function results($title_id)
	{

		$this->load->model('share', '', TRUE);

		$this->load->model('title', '', TRUE);

		$title = $this->title->get_by_id($title_id);

		if(!$title)
		{
			show_error("We cannot find this title. Try again.", 400, $heading = 'Bless this mess.');
		}

		$media = $this->share->get_all_by_title_id($title_id);

		$view = array(
			'title' => config_item('title') . ' :: Results',
			'title_name' => $title->name,
			'media' => $media
		);
		
		$this->load->view('search/results', $view);

	}

}
