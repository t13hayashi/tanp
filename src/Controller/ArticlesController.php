<?php

// /articles/index
// /articles
// /(controller)/(action)/(options)

namespace App\Controller;

class ArticlesController extends AppController {

    public function index() {
        $articles = $this->Articles->find('all');
        // $this->set('articles', $articles);
        $this->set(compact('articles'));
    }

    public function add() {
        // articleを新しく作る
        //articlesテーブルのレコードの中のMaxIDを取得
        $query = $this->Articles->find();
        $ret = $query->select(['max_id' => $query->func()->max('id')])->first();
        //新規作成するarticleのidを$idに代入
        $id = $ret->max_id + 1;
        $this->redirect(['action'=>'edit', $id]);
    }

    public function edit($id) {
        if ($this->Articles->exists(['id' => $id])) {
            $article = $this->Articles->get($id);
        } else {
            $article = $this->Articles->newEntity();
            $article->user_id = $this->Auth->user('id');
        }
        $article_id = $id;
        $this->set(compact('article_id'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            $this->Articles->save($article);
        }
        $this->set(compact('article'));
    }

    public function view($id) {
        $article = $this->Articles->get($id);
        $this->loadModel('Items');
        $items = $this->Items->find('all', array(
            'conditions' => array ('Items.article_id' => $article->id),
            'order' => 'FIELD(Items.id,'.$article->item_order.')'
        ));
        $this->set(compact('article'));
        $this->set(compact('items'));
    }
}