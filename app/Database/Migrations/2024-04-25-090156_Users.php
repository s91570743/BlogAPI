<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
       $this->forge->addField([
           "id"=>[
               'type'=>'INT',
               'constraint'=>5,
               'auto_increment'=>true,
               'unsigned'=>true,
           ],
           "name"=>[
               'type'=>"VARCHAR",
               "CONSTRAINT"=>120,
               "null"=>true
           ],
           "email"=>[
               'type'=>"VARCHAR",
               "CONSTRAINT"=>120,
               "null"=>false
           ],
           "phone"=>[
               'type'=>"VARCHAR",
               "CONSTRAINT"=>120,
               "null"=>true
           ],
           "password"=>[
               'type'=>"VARCHAR",
               "CONSTRAINT"=>120,
               "null"=>false
           ],
           'created_at datetime default current_timestamp',
           'updated_at datetime default current_timestamp on update current_timestamp'
       ]);
       $this->forge->addPrimaryKey("id");
       $this->forge->createTable("Users");
    }

    public function down()
    {
        $this->forge->dropTable("Users");
    }
}
