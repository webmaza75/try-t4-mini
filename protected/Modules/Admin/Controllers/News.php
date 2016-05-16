<?php

namespace App\Modules\Admin\Controllers;

use T4\Mvc\Controller;
use T4\Http\Uploader;
use App\Models\News as MNews;

/**
 * Class News
 * @package App\Modules\Admin\Controllers
 */
class News extends Controller
{
    public function actionDefault()
    {
        $this->data->news = MNews::findAll();
    }

    /**
     * @param null $__id
     * @param null $title
     * @param null $text
     * @param null $pubday
     * @param null $image
     */
    public function actionSave($__id = null, $title = null, $text = null, $pubday = null, $image = null)
    {
        if (!empty($text)) {
            $request = $this->app->request;
            // Загрузка изображения на сервер
            if ($request->isUploaded('image')) {
                $uploader = new Uploader('image',
                    ['jpg', 'jpeg', 'png', 'gif']);
                $uploader->setPath('/images');
                $image = $uploader();
            }

            // Добавление свежей новости
            if (empty($__id)) {
                $article = new MNews([
                    'title' => trim($title),
                    'text' => trim($text),
                    'pubday' => empty($pubday) ? null : $pubday,
                    'image' => empty($image) ? '' : $image,
                ]);

            // Редактирование имеющейся новости
            } else {
                $article = MNews::findByPK($__id);
                $article->title = trim($title);
                $article->text = trim($text);
                $article->pubday = empty($pubday) ? null : $pubday;
                $article->image = empty($image) ? '' : $image;
            }
            $article->save();
            $this->redirect('/admin/news');
        }
    }

    public function actionDelete(int $id)
    {
        MNews::findByPK($id)->delete();
        $this->redirect('/admin/news');
    }

    public function actionEdit($id = null)
    {
        $this->data->article = MNews::findByPK($id);
    }
}