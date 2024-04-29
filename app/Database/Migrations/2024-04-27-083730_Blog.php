<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Blog extends Migration
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
            "user_id"=>[
                'type'=>'INT',
                'constraint'=>5,
                "null"=>true,
            ],
            "title"=>[
                'type'=>"VARCHAR",
                "CONSTRAINT"=>120,
                "null"=>true
            ],
            "description"=>[
                'type'=>"VARCHAR",
                "CONSTRAINT"=>120,
                "null"=>false
            ],
            "img"=>[
                'type'=>"VARCHAR",
                "CONSTRAINT"=>120,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addPrimaryKey("id");
        $this->forge->createTable("Blog");
    }

    public function down()
    {
        $this->forge->dropTable("Blog");
    }
}
