<?php

class Migrate extends CI_Controller
{

        public function index()
        {

			$session = $this->session->userdata('openxbl');

			if(!$session){

				show_error("Please login before doing that.", 400, $heading = 'Woah there, Nelly.');

			}

			if(config_item('admin') !== $session['xuid']){
				show_error("You do not have permission to do that.", 400, $heading = 'Woah there, Nelly.');
			}

            $this->load->library('migration');

            if ($this->migration->current() === FALSE)
            {
                    show_error($this->migration->error_string());
            }


			$view = array(

				'title' => config_item('title') . ' :: Migrations'

			);

			$this->load->view('admin/migrate', $view);


        }

}