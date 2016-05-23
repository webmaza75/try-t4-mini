<?php

namespace App\Modules\Admin\Controllers;

use T4\Mvc\Controller;
use App\Models\Category as MCategory;

/**
 * Class Category - категории товаров
 * @package App\Modules\Admin\Controllers
 */
class Category extends Controller
{
    public function actionDefault()
    {
        $this->data->cats = MCategory::findAllTree();
    }

    public function actionAdd()
    {
        $this->data->cats = MCategory::findAllTree();
    }

    public function actionSave($category)
    {
        $cat1 = new MCategory();
        $cat1->fill($category);
        $cat1->save();
        $this->redirect('/admin/category');
    }

    public function actionDelete($id)
    {
        $cat = MCategory::findByPK($id);
        if(!empty($cat)) {
            $cat->delete();
        }
        $this->redirect('/admin/category');
    }

    public function actionUp($id)
    {
        $cat = MCategory::findByPK($id);
        if (empty($cat)) {
            $this->redirect('/admin/category');
        }
        $sibling = $cat->getPrevSibling();
        if (!empty($sibling)) {
            $cat->insertBefore($sibling);
        }
        $this->redirect('/admin/category');
    }

    public function actionDown($id)
    {
        $cat = MCategory::findByPK($id);
        if (empty($cat))
            $this->redirect('/admin/category');
        $sibling = $cat->getNextSibling();
        if (!empty($sibling)) {
            $cat->insertAfter($sibling);
        }
        $this->redirect('/admin/category');
    }
}