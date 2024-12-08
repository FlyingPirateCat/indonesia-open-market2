<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tableproduct extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'cover'          => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,],
            'name'           => ['type' => 'VARCHAR', 'constraint' => '255',],
            'slug'           => ['type' => 'VARCHAR', 'constraint' => '255',],
            'type'           => ['type' => 'VARCHAR', 'constraint' => '20',],
            'description'    => ['type' => 'VARCHAR', 'constraint' => '255',],
            'postalcode'     => ['type' => 'int', 'constraint' => '11', 'null' => TRUE,],
            'price'          => ['type' => 'INT', 'constraint' => '11',],
            'stock'          => ['type' => 'INT', 'constraint' => '11',],
            'weight'         => ['type' => 'INT', 'constraint' => '11',],
            'id_user'        => ['type' => 'INT', 'constraint' => '11', 'null' => TRUE,],
            'created_at'     => ['type' => 'DATETIME', 'null' => TRUE,],
            'updated_at'     => ['type' => 'DATETIME', 'null' => TRUE,],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tableproduct');
    }

    public function down()
    {
        $this->forge->dropTable('tableproduct');
    }
}
