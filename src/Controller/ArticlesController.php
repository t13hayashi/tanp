<?php

// /articles/index
// /articles
// /(controller)/(action)/(options)

namespace App\Controller;

use Cake\Datasource\ConnectionManager;

class ArticlesController extends AppController {

    public function index() {
        $articles = $this->Articles->find('all', [
            'contain' => ['Users']
        ]);
        // $this->set('articles', $articles);
        $this->set(compact('articles'));
    }

    public function add() {
        // articleを新しく作る

        //auto_incrementの次回値を取得
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT auto_increment FROM information_schema.tables WHERE table_name = \'articles\'')->fetchAll('assoc');
        $id = $results[0]['auto_increment'];

        $this->redirect(['action'=>'edit', $id]);
    }

    public function edit($id) {
        $this->loadModel('Items');
        if ($this->Articles->exists(['id' => $id])) {
            $article = $this->Articles->get($id);
            $items = $this->Items->find('all', array(
                'conditions' => array ('Items.article_id' => $article->id),
                'order' => 'FIELD(Items.id,'.$article->item_order.')'
            ));
        } else {
            $article = $this->Articles->newEntity();
            $article->user_id = $this->Auth->user('id');
            $items = "";
        }
        $this->set(compact('items'));
        /*$article_id = $id;
        $this->set(compact('article_id'));*/
        $this->set('article_id', $id);
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

        //閲覧数カウントアップ
        $counter = $article->counter;
        $counter++;
        $article->set('counter', $counter);
        $this->Articles->save($article);

        $this->set(compact('article'));
        $this->set(compact('items'));
    }


    public function delete() {
        $this->autoRender = FALSE;

        $id = $_POST['id'];
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        $this->Articles->delete($article);

        return;
    }

    public function isAuthorized($user = null)
    {
        // All registered users can add articles
        if (in_array($this->request->getParam('action'), ['index', 'add', 'edit'])) {
            return true;
        }

        //記事の持ち主のみ編集可能
        // The owner of an article can edit and delete it
        if ($this->request->getParam('action') === 'edit') {
            //
            //
            //
            //
            //
            return true;
        }

        // 役割がadminだったら許可
        if($user['role'] === 'admin')
        {
            return true;
        }

        // 抜けたものはとりあえず非許可
        return false;
    }



}