<?php
/*
| -------------------------------------------------------------------------
| CODE FIRST
| -------------------------------------------------------------------------
| Run the migration to upload database tables
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_xboxdvr extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'share_id' => array(
                                'type' => 'INT',
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'xuid' => array(
                                'type' => 'BIGINT'
                        ),
                        'media_id' => array(
                                'type' => 'TEXT'
                        ),
                        'title_id' => array(
                                'type' => 'TEXT'
                        ),
                        'title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'media_type' => array(
                                'type' => 'TEXT'
                        ),
                        'shared_at' => array(
                                'type' => 'timestamp'
                        )
                ));
                $this->dbforge->add_key('share_id', TRUE);
                $this->dbforge->create_table('shares');

                $this->dbforge->add_field(array(
                        'title_id' => array(
                                'type' => 'BIGINT'
                        ),
                        'name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        )
                ));
                $this->dbforge->add_key('title_id', TRUE);
                $this->dbforge->create_table('titles');

                $this->dbforge->add_field(array(
                        'xuid' => array(
                                'type' => 'BIGINT'
                        ),
                        'gamertag' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '25',
                        )
                ));
                $this->dbforge->add_key('xuid', TRUE);
                $this->dbforge->create_table('players');

        }

        public function down()
        {
                $this->dbforge->drop_table('shares');
                $this->dbforge->drop_table('titles');
                $this->dbforge->drop_table('players');
                $this->dbforge->drop_table('comments');
        }
}