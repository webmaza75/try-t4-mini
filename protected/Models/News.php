<?php

namespace App\Models;

use T4\Orm\Model;

/**
 * Class News
 * Имя и схема таблицы
 *
 * @package App\Models
 */
class News extends Model
{
    static protected $schema = [
        'table' => 'news',
        'columns' => [
            'title' => ['type' => 'string'],
            'text' => ['type' => 'text'],
            'pubday' => ['type' => 'date'],
            'image' => ['type' => 'string'],
        ],
    ];
}