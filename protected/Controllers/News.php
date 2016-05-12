<?php

namespace App\Controllers;

use T4\Mvc\Controller;
use T4\Http\Uploader;
use App\Models\Article;
use App\Models\News as MNews;

class News extends Controller
{
    public function actionDefault()
    {
        $news = new MNews(ROOT_PATH_PROTECTED . '\news.php');
        $this->data->news = $news->findAll();
    }

    public function actionOne(int $id = 0)
    {
        $article = new MNews(ROOT_PATH_PROTECTED . '\news.php');
        $this->data->article = $article->findOne($id);
    }

    public function actionLast()
    {
        $article = new MNews(ROOT_PATH_PROTECTED . '\news.php');
        $this->data->article = $article->getLast();
    }

    public function actionAdd($title = null, $text = null, $image = null)
    {
        if (!empty($text)) {
            $request = $this->app->request;
            if ($request->isUploaded('image')) {
                $uploader = new Uploader('image',
                    ['jpg', 'jpeg', 'png', 'gif']);
                $uploader->setPath('/images');
                $image = $uploader();
            }
            $article = new Article([
                'title' => trim($title),
                'text' => trim($text),
                'image' => empty($image) ? '' : $image,
            ]);
            $this->add($article);

            header('Location: /news');
            exit;
        }
    }

    function add(Article $data)
    {
        $article = new MNews(ROOT_PATH_PROTECTED . '\news.php');
        $article->news[] = $data;
        $article->save();
    }
}