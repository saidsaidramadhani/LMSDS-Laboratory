<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Roles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255],
            'name' 			=> ['type' => 'VARCHAR','constraint' => 255,],
            'display_name' 	=> ['type' => 'VARCHAR','constraint' => 255,],
            'description' 	=> ['type' => 'VARCHAR','constraint' => 255,],
            'status' 		=> ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],

        ]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('uid');
		// Add foreign key relationship
		//$this->forge->addForeignKey('section_id', 'sections', 'id');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('roles', false, $attributes);
    }

    public function down()
    {
        //
		$this->forge->dropTable('roles');
    }
}
