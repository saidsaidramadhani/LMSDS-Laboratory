<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Items extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255],
            'name' 			=> ['type' => 'VARCHAR','constraint' => 255,],
            'description' 	=> ['type' => 'VARCHAR','constraint' => 255,],
            'storage_condition' 	=> ['type' => 'VARCHAR','constraint' => 500,],
            'user_id' 		=> ['type' => 'INTEGER','constraint' => 11,],
            'location_id' 	=> ['type' => 'INTEGER','constraint' => 11,],
            'status' 		=> ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'expire_at' 	=> ['type' => 'TIMESTAMP','null' => true,],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],

        ]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('uid');
		// Add foreign key relationship
		$this->forge->addForeignKey('user_id', 'users', 'id');
		//$this->forge->addForeignKey('location_id', 'item_locations', 'id');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('samples', false, $attributes);
    }

    public function down()
    {
        //
		$this->forge->dropTable('samples');
    }
}
