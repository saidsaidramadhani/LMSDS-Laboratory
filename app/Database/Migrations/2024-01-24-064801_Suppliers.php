<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Suppliers extends Migration
{
    public function up()
    {
		
        // suppliers Table
		
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255,'unique' => true,],
            'name' 			=> ['type' => 'VARCHAR','constraint' => 255,],
            'description' 	=> ['type' => 'VARCHAR','constraint' => 255,],
            'address' 		=> ['type' => 'VARCHAR','constraint' => 255,],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],
			
        ]);

        $this->forge->addKey('id', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('suppliers', false, $attributes);
    }

    public function down()
    {
        //
		$this->forge->dropTable('suppliers');
    }
}

