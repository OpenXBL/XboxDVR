<?php

function asset_url($resource){

   return base_url().'assets/'.$resource;

}

function isAuth(){

	$ci = & get_instance();

	return $ci->session->userdata('openxbl');

}