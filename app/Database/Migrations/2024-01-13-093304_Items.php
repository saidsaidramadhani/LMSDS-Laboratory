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
            'item_type_id' 	=> ['type' => 'INTEGER','constraint' => 11,],
            'location_id' 	=> ['type' => 'INTEGER','constraint' => 11,],
            'capacity' 		=> ['type' => 'INTEGER','constraint' => 11,],
            'rent_amount' 	=> ['type' => 'DECIMAL','constraint' => '10,2',],
            'description' 	=> ['type' => 'VARCHAR','constraint' => 255,],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],

        ]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('uid');
		// Add foreign key relationship
		$this->forge->addForeignKey('item_type_id', 'item_types', 'id');
		$this->forge->addForeignKey('location_id', 'item_locations', 'id');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('items', false, $attributes);
    }

    public function down()
    {
        //
		$this->forge->dropTable('items');
    }
}
