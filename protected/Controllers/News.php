<?php

namespace App\Controllers;

use T4\Mvc\Controller;
use T4\Http\Uploader;
use App\Models\Article;
use App\Models\News as MNews;

/**
 * Class News класс новостей
 * @package App\Controllers
 */
class News extends Controller
{
    public function actionDefault()
    {
        $this->data->news = MNews::findAll();
    }

    public function actionOne(int $id = 0)
    {
        $this->data->article = MNews::findByPK($id);
    }

    public function actionLast()
    {
        $this->data->article = MNews::find(['order' => '__id DESC']);
    }

    public function actionAdd($__id = null, $title = null, $text = null, $pubday = null, $image = null)
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
                $article = new Article([
                    'title' => trim($title),
                    'text' => trim($text),
                    'pubday' => empty($pubday) ? null : $pubday,
                    'image' => empty($image) ? '' : $image,
                ]);
                $this->add($article);

            // Редактирование имеющейся новости
            } else {
                $article = MNews::findByPK($__id);
                $article->title = trim($title);
                $article->text = trim($text);
                $article->pubday = empty($pubday) ? null : $pubday;
                $article->image = empty($image) ? '' : $image;
                $article->save();
            }

            $this->redirect('/news');
        }
    }

    protected function add(Article $data)
    {
        $article = new MNews($data->toArray());
        $article->save();
    }

    public function actionDelete(int $id)
    {
        MNews::findByPK($id)->delete();
        $this->redirect('/news');
    }

    public function actionEdit($id)
    {
        $this->data->article = MNews::findByPK($id);
    }
}