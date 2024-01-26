<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PermissionRoles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' 			=> ['type' => 'INTEGER','constraint' => 11,'auto_increment' => true,],
            'uid' 			=> ['type' => 'VARCHAR','constraint' => 255],
            'role_id' 		=> ['type' => 'INTEGER','constraint' => 11,],
            'permission_id' => ['type' => 'INTEGER','constraint' => 11,],
            'created_by' 	=> ['type' => 'VARCHAR','constraint' => 255,],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' 	=> ['type' => 'TIMESTAMP','null' => true,],

        ]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('uid');
		// Add foreign key relationship
		$this->forge->addForeignKey('role_id', 'roles', 'id','','RESTRICT');
		$this->forge->addForeignKey('permission_id', 'permissions', 'id','','RESTRICT');
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('permission_roles', false, $attributes);
    }

    public function down()
    {
        //
		$this->forge->dropTable('permission_roles');
    }
}
