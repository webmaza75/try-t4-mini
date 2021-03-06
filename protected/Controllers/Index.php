<?php

namespace App\Controllers;

//use T4\Core\Config;
use T4\Mvc\Controller;
use App\Models\Category as MCategory;

class Index
    extends Controller
{

    public function actionDefault()
    {
        /** Запуск кода для сохранения значений в файл конфига
        $config = new Config(ROOT_PATH_PROTECTED . '/config.php');
        $config->toptitle = 'Моя первая работа с фреймворком T4';
        $config->extensions = ['bootstrap' => ['theme' => 'cosmo']];
        $config->save();
        */
    }

    public function actionAbout()
    {
        $this->data->toptitle = $this->app->config->toptitle;
    }

    /**
     * Вывод всех товаров категории с конкретным $id, сгруппированных по подкатегориям
     * @param $id
     */
    public function actionGetProducts($id)
    {
        $cat = MCategory::findByPK($id);
        $cats = $cat->findAllChildren(); // для подкатегорий выбранной категории
        $this->data->cats = $cats; // для выбранной категории
        $this->data->cats->maincat = $cat;
    }
}