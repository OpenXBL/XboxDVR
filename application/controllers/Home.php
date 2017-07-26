<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{

		$this->load->model('share', '', TRUE);

		$view = array(
			'title' => 'Welcome to ' . config_item('title'),
			'media' => $this->share->get_last_ten_entries()
		);
		
		$this->load->view('home', $view);
	}

	public function policy()
	{
		$view = array(
			'title' => config_item('title') . ' :: Policies'
		);
		
		$this->load->view('policy', $view);		
	}
}
