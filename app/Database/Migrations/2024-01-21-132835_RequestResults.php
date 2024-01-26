<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RequestResults extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255],
            'name' 	=> ['type' => 'VARCHAR','constraint' => 500,],
            'description' 	=> ['type' => 'VARCHAR','constraint' => 500,],
            'result_document' 	=> ['type' => 'VARCHAR','constraint' => 500,],
            'request_id' 	=> ['type' => 'INTEGER','constraint' => 11,],
            'status' 		=> ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],

        ]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('uid');
		// Add foreign key relationship
		$this->forge->addForeignKey('request_id', 'requests', 'id');
		//$this->forge->addForeignKey('activity_id', 'activities', 'id');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('request_results', false, $attributes);
    }

    public function down()
    {
        //
		$this->forge->dropTable('request_results');
    }
}

