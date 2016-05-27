<?php

namespace App\Models;

use T4\Orm\Model;
use T4\Core\Exception;

/**
 * Class Product
 * Схема для сущности Продукты (products)
 * Тип связи: товар принадлежит категории (self::BELONGS_TO)
 * @package App\Models
 */
class Product extends Model
{
    static protected $schema = [
        'table' => 'products',
        'columns' => [
            'title' => ['type' => 'string'],
            'price' => ['type' => 'int'],
            'stock' => ['type' => 'bool'],
        ],
        'relations' => [
            'category' => ['type' => self::BELONGS_TO, 'model' => Category::class],
        ],
    ];

    protected function validateTitle($val) {
        if (!preg_match('~[a-zа-я]~i', $val)) {
            yield new Exception('Некорректные символы для названия');
        }
        if (strlen($val) < 3) {
            yield new Exception('Слишком короткое название');
        }
        return true;
    }

    protected function sanitizeTitle($val) {
        return preg_replace('~\s+~', ' ', $val);
    }

    protected function validatePrice($val) {
        if (!preg_match('~\d~', $val)) {
            yield new Exception('Цена должна содержать только цифры');
        }
        if ($val <= 0) {
            yield new Exception('Цена должна быть больше 0');
        }
        return true;
    }

    protected function sanitizePrice($val) {
        return preg_replace('~\s+~', '', $val);
    }

    protected function validateStock($val) {
        if (!preg_match('~(0|1|null)~i', $val)) {
            throw new Exception('Некорректное значение');
        }
        return true;
    }

    protected function sanitizeStock($val) {
        return (1 == $val) ? 1 : 0;
    }
}