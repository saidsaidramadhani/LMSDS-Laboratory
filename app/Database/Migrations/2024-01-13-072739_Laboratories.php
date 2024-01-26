<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Laboratories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255],
            'name' 			=> ['type' => 'VARCHAR','constraint' => 255,],
            'description' 	=> ['type' => 'VARCHAR','constraint' => 255,],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],

        ]);

		$this->forge->addKey('id', true);
		//$this->forge->addUniqueKey('uid'); // Add this line for a unique index
		$this->forge->addUniqueKey('uid');
		// Add foreign key relationship
		//$this->forge->addForeignKey('school_id', 'schools', 'id');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('laboratories', false, $attributes);
		//$this->forge->createTable('laboratories');
		// Run a raw SQL query to enforce foreign keys (MySQL example)
		//$this->db->query('ALTER TABLE laboratories ADD CONSTRAINT fk_laboratories_schools FOREIGN KEY (school_id) REFERENCES schools(id)');
    }

    public function down()
    {
        //
		$this->forge->dropTable('laboratories');
    }
}
