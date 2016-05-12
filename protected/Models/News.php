<?php

namespace App\Models;

use T4\Core\Config;

class News extends Config
{
    public function findAll()
    {
        $arrNews = [];
        foreach ($this->news as $i => $v) {
            $arrNews[$i] = new Article($v->toArray());
        }
        return $arrNews;
    }

    public function findOne(int $id)
    {
        $arrArticle = [];
        foreach ($this->news as $i => $v) {
            if ($i == $id) {
                return $arrNews = new Article($v->toArray());
            }
        }
        return $arrArticle;
    }

    public function getLast()
    {
        return (end($this->news->toArray()));
    }
}