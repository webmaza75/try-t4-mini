<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1463244599_createNews
    extends Migration
{

    public function up()
    {
        $this->createTable('news', [
            'title' => ['type' => 'string', 'length' => 100],
            'text' => ['type' => 'text'],
            'pubday' => ['type' => 'date'],
            'image' => ['type' => 'string'],
        ]);
    }

    public function down()
    {
        $this->dropTable('news');
    }
}