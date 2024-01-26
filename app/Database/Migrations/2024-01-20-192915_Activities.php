<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Activites extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255],
            'name' 			=> ['type' => 'VARCHAR','constraint' => 255,],
            'service_id' 	=> ['type' => 'INTEGER','constraint' => 11,],
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
		$this->forge->addForeignKey('service_id', 'services', 'id');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('activities', false, $attributes);
    }

    public function down()
    {
        //
		$this->forge->dropTable('activities');
    }
}
