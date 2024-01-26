<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Settings extends Seeder
{
    public function run()
    {
		
		// Generate a UUID version 5
		$namespace = Uuid::NAMESPACE_DNS; // You can use other namespaces as needed
		$name = 'your_custom_string'; // Replace with your logic for generating a custom string
		$uuid = Uuid::uuid5($namespace, $name)->toString();		

        $data = [
            [
                'id'         => 1,
                'uid'        => $uuid,
                'class'      => 'system_name',
                'key'        => 'system_name',
                'value'      => 'Laboratory Management and Service Delivery System (LMSDS)',
                'type'       => 'string',
                'context'    => 'Laboratory Management and Service Delivery System (LMSDS)',
                'created_by' => '',
                'created_at' => '2024-01-13 09:12:11',
                'updated_at' => '2024-01-13 09:12:11',
                'deleted_at' => null,
            ],
            // Add more rows as needed
        ];

        $this->db->table('settings')->insertBatch($data);
	}
}
