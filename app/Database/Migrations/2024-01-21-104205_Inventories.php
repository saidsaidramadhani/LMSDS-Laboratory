<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Inventories extends Migration
{
    public function up()
    {
		
        // suppliers Table
		
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255,'unique' => true,],
            'name' 			=> ['type' => 'VARCHAR','constraint' => 255,],
            'description' 	=> ['type' => 'VARCHAR','constraint' => 255,],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],
			
        ]);

        $this->forge->addKey('id', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('suppliers', false, $attributes);		
		
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255],
            'item_id' 		=> ['type' => 'INTEGER','constraint' => 11,],
            'location_id' 	=> ['type' => 'INTEGER','constraint' => 11,],
            'supplier_id' 	=> ['type' => 'INTEGER','constraint' => 11,],
            'amount' 		=> ['type' => 'INTEGER','constraint' => 11,],
            'buy_price' 	=> ['type' => 'DECIMAL','constraint' => '10,2',],
            'description' 	=> ['type' => 'VARCHAR','constraint' => 255,],
            'serial_number' => ['type' => 'VARCHAR','constraint' => 255,],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],

        ]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('uid');
		// Add foreign key relationship
		$this->forge->addForeignKey('item_id', 'items', 'id');
		$this->forge->addForeignKey('location_id', 'item_locations', 'id');
		$this->forge->addForeignKey('supplier_id', 'suppliers', 'id');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('inventories', false, $attributes);
    }

    public function down()
    {
        //
		$this->forge->dropTable('suppliers');
		$this->forge->dropTable('inventories');
    }
}

