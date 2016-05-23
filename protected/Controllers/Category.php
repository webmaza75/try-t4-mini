<?php

namespace App\Controllers;

use App\Models\Category as MCategory;
use T4\Mvc\Controller;

class Category extends Controller
{
    public function actionDefault()
    {
        // Показать все категории товаров
        $this->data->cats = MCategory::findAllTree();
    }

    /**
     * Вывод всех товаров категории с конкретным $id, сгруппированных по подкатегориям
     * @param $id
     */
    public function actionProducts($id)
    {
        $cat = MCategory::findByPK($id);
        $cats = $cat->findAllChildren(); // для подкатегорий выбранной категории
        $this->data->cats = $cats; // для выбранной категории
        $this->data->cats->maincat = $cat;
    }
}