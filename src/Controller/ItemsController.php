<?php


namespace App\Controller;

use Cake\ORM\TableRegistry;

class ItemsController extends AppController {


    /*public function index() {
        $articles = $this->Articles->find('all');
        // $this->set('articles', $articles);
        $this->set(compact('articles'));
    }*/

    public function add() {
        if($this->request->is('ajax')) {


            $this->autoRender = FALSE; //ページの自動レンダリング機能をオフにする

            /*$article_id = htmlspecialchars($_POST['article_id']); //POSTで受け取ったtype
            $content = htmlspecialchars($_POST['content']); //POSTで受け取ったcontent
            $content_type = htmlspecialchars($_POST['content_type']); //POSTで受け取ったtype*/

            /*$items_table = TableRegistry::get('Items'); //テーブルを取得
            $query = $items_table->query(); //テーブルでクエリ文を使用することを宣言
            $query->insert(['ARTICLE_ID', 'CONTENT', 'CONTENT_TYPE'])//カラムにデータを挿入する文
                ->values(['ARTICLE_ID' => $article_id, 'CONTENT' => $content, 'CONTENT_TYPE' => $content_type])
                ->execute(); //実行*/

            $item = $this->Items->newEntity();
            $item = $this->Items->patchEntity($item, $this->request->data);
            $this->Items->save($item);

            $id = $item->id;
            $content_type = $item->content_type;
            $content = $item->content;

            /*$query = $this->Items->find();
            $ret = $query->select(['max_id' => $query->func()->max('id')])->first();
            $id = $ret->max_id;*/

            $this->getItemDom($id, $content_type, $content);

        }
    }

    public function update() {
        if($this->request->is('ajax')) {
            $this->autoRender = FALSE;

            $id = $_POST['id'];
            $content = htmlspecialchars($_POST['content']); //POSTで受け取ったcontent
            $type = htmlspecialchars($_POST['content_type']); //POSTで受け取ったtype

            $item = $this->Items->get($id);
            $item = $this->Items->patchEntity($item, $this->request->data);

            $this->Items->save($item);

            $this->getItemDom($id, $type, $content);
        }
        return;
    }

    public function delete() {
        if($this->request->is('ajax')) {
            $this->autoRender = FALSE;

            $id = $_POST['id'];
            $item = $this->Items->get($id);
            $this->Items->delete($item);
        }
        return;
    }

    public function cancel() {
        if($this->request->is('ajax')) {
            $this->autoRender = FALSE;

            $id = $_POST['id'];
            $item = $this->Items->get($id);
            $content_type = $item->content_type;
            $content = $item->content;

            $this->getItemDom($id, $content_type, $content);
        }
        return;
    }


    private function getItemDom($id, $content_type, $content) {

        $itemDomStart = '<div class="item" id="'.$id.'">';
        $itemDomEnd =  '<ul class="editpager clearfix unvisible">
                            <li class="first_order">一番上へ</li>
                            <li class="minus_order">上へ</li>
                            <li class="plus_order">下へ</li>
                            <li class="last_order">一番下へ</li>
                            <li class="edit_item">編集</li>
                            <li class="delete_item">削除</li>
                        </ul>
                       </div>';

        switch($content_type) {
            case 'headline_big':
                $itemDom = $itemDomStart.'<p class="headline_big">'.$content.'</p>'.$itemDomEnd;
                echo $itemDom;
                break;
            case 'headline_small':
                $itemDom = $itemDomStart.'<p class="headline_small">'.$content.'</p>'.$itemDomEnd;
                echo $itemDom;
                break;
            case 'text':
                $itemDom = $itemDomStart.'<p class="text">'.$content.'</p>'.$itemDomEnd;
                echo $itemDom;
                break;
        }
    }


    /*public function edit($article_id) {
        $article = $this->Articles->newEntity();
        $this->set(compact('article_id'));
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            $this->Articles->save($article);
            return $this->redirect(['action'=>'index']);
        }
        $this->set(compact('article'));
    }*/
}

?>