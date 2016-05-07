<?php

namespace App\Controllers;

use T4\Core\Config;
use T4\Mvc\Controller;

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

}