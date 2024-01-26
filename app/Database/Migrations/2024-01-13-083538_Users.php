<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
		
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255],
            'name' 			=> ['type' => 'VARCHAR','constraint' => 255,],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],

        ]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('uid');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('user_types', false, $attributes);

		
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255],
            'firstname' 	=> ['type' => 'VARCHAR','constraint' => 255,],
            'midname' 		=> ['type' => 'VARCHAR','constraint' => 255,],
            'surname' 		=> ['type' => 'VARCHAR','constraint' => 255,],
            'phone' 		=> ['type' => 'VARCHAR','constraint' => 255,'null' => 0, 'default' => 0],
            'gender' 		=> ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'registered' 	=> ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'status' 		=> ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'user_type_id' 	=> ['type' => 'INTEGER','constraint' => 11,],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],

        ]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('uid');
		// Add foreign key relationship\
		//$this->forge->addForeignKey('user_id', $this->tables['users'], 'id', '', 'CASCADE');
		$this->forge->addForeignKey('user_type_id', 'user_types', 'id','','RESTRICT');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('users', false, $attributes);
    }

    public function down()
    {
        //
		$this->forge->dropTable('users');
		$this->forge->dropTable('user_types');
    }
}
