<?php

namespace MyProject\Controllers;


use MyProject\Models\Articles\Article;
use MyProject\View\View;


class ArticlesController
{

    private $view;

 

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
     
    }

    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }
        
        
        // $articleAuthor = User::getById($article->getAuthorId()); так как возвращаем автора полностью со статьи выше

        // $this->view->renderHtml('articles/view.php', ['article' => $article]); так как теперь передаем еще автора
        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
        
        ]);
    }

    public function edit(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }
        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();

        var_dump($article);
    }

}