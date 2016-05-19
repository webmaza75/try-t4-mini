<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1463639206_createProducts
    extends Migration
{

    public function up()
    {
        $this->createTable('products', [
            'title' => ['type' => 'string'],
            '__category_id' => ['type' => 'link'],
            'price' => ['type' => 'int'],
            'stock' => ['type' => 'bool'],
        ]);
    }

    public function down()
    {
        $this->dropTable('products');
    }
    
}