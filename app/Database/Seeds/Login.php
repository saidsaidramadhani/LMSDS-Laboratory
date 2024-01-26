<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Login extends Seeder
{
    public function run()
    {
		
		// Generate a UUID version 5
		$namespace = Uuid::NAMESPACE_DNS; // You can use other namespaces as needed
		$name = 'your_custom_string'; // Replace with your logic for generating a custom string
		$uuid = Uuid::uuid5($namespace, $name)->toString();		
		$current_time =	date('Y-m-d H:i:s');
		
		$password = password_hash('123456', PASSWORD_DEFAULT);
        $data = [
            [
                'id'         	=> 1,
                'uid'        	=> $uuid,
                'username'  	=> 'admin.admin',
                'password'    	=> $password,
                'email'    		=> 'admin@nm-aist.ac.tz',
                'active'     	=> 1,
                'user_id'  		=> 1,
                'created_by' 	=> 'Seeder Codeigniter',
                'created_at' 	=> $current_time,
                'updated_at' 	=> $current_time,
                'deleted_at' 	=> null,
            ],
            // Add more rows as needed
        ];

        $this->db->table('login')->insertBatch($data);
	}
}
