<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{

    public function index()
    {
        $this->set('users', $this->Users->find('all'));
    }

    public function mypage($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Articles']
        ]);
        $this->set(compact('user'));
    }


    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('登録しました。'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('登録に失敗しました'));
        }
        $this->set('user', $user);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.


        $this->Auth->allow(['add', 'login' ,'logout']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('ユーザー名またはパスワードが正しくありません'));
        }
    }

    public function logout()
    {
        $this->request->session()->destroy(); // セッションの破棄
        return $this->redirect($this->Auth->logout());
    }

    public function isAuthorized($user = null)
    {
        $id = $this->request->params['pass'][0];

        //他人のマイページは見れないようにする
        if ($this->request->getParam('action') === 'mypage' && $id == $user['id']) {
            return true;
        }

        // adminだったら許可
        if($user['role'] === 'admin')
        {
            return true;
        }

        // 抜けたものはとりあえず非許可
        return false;
    }

}