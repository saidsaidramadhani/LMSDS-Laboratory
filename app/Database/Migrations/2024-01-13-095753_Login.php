<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Login extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255],
            'user_id' 	=> ['type' => 'INTEGER','constraint' => 11,],
            'username' 		=> ['type' => 'VARCHAR','constraint' => 255,],
            'password' 		=> ['type' => 'VARCHAR','constraint' => 500,],
            'email' 		=> ['type' => 'VARCHAR','constraint' => 500,],
            'active' 		=> ['type' => 'INTEGER','constraint' => 0,],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],

        ]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('uid');
		// Add foreign key relationship
		$this->forge->addForeignKey('user_id', 'users', 'id','','RESTRICT');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('login', false, $attributes);
    }

    public function down()
    {
        //
		$this->forge->dropTable('login');
    }
}
