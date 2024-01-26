<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Settings extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255,'unique' => true,],
            'class' 		=> ['type' => 'VARCHAR','constraint' => 255,],
            'key' 			=> ['type' => 'VARCHAR','constraint' => 255,],
            'value' 		=> ['type' => 'VARCHAR','constraint' => 255,],
            'type' 			=> ['type' => 'VARCHAR','constraint' => 255,],
            'context' 		=> ['type' => 'VARCHAR','constraint' => 500,],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],
			
        ]);

        $this->forge->addKey('id', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('settings', false, $attributes);
		
    }

    public function down()
    {
        //
		$this->forge->dropTable('settings');
    }
}
