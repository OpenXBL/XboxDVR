<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Players_model extends CI_Model {

    public function insert_or_update($player)
    {

        $query = $this->db->get_where('players', array('xuid' => $player['xuid']));

        if($query->row() != null)
        {
            $this->db->update('players', $player);
        }
        else
        {
            $this->db->insert('players', $player);
        }

    }

}