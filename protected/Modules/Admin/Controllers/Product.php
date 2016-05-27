<?php

namespace App\Modules\Admin\Controllers;

use T4\Mvc\Controller;
use T4\Core\MultiException;
use App\Models\Category as MCategory;
use App\Models\Product as MProduct;

class Product extends Controller
{
    public function actionDefault()
    {
        $this->data->products = MProduct::findAll();
    }

    public function actionEdit($id = null, $product = null)
    {
        $this->data->cats = MCategory::findAllTree();

        if(!empty($id)) {
            $this->data->product = MProduct::findByPK($id);
            //var_dump($this->data->product); die;
        }

        if(!empty($product)) {
            try {
                if (!$product['id']) {
                    $prod = new MProduct();
                } else {
                    $prod = MProduct::findByPK($product['id']);
                }

                if (!isset($product->stock)) { // в БД хранится либо 0, либо 1
                    $product->stock = '0';
                }

                $prod->fill($product);
                $prod->save();
                $this->redirect('/admin/product');
            } catch (MultiException $e) {
                $this->data->errors = $e;
                $this->data->product = $product;
            }
        }
    }

    public function actionDelete($id)
    {
        $prod = MProduct::findByPK($id);
        if(!empty($prod)) {
            $prod->delete();
        }
        $this->redirect('/admin/product');
    }
}