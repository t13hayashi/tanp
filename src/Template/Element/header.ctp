<header>
    <div class="header_container">
        <p class="logo"><a href="/articles"><img class="logo_img" src="https://s3-ap-northeast-1.amazonaws.com/gracia.tamp/logo.png" alt="tanpのロゴマーク"></a></p>
        <ul class="header_menu">
            <li><?= $this->Html->link('まとめ作成', ['controller'=>'articles', 'action'=>'add']); ?><span>|</span></li>
            <li>
                <?php
                if ($auth->user()) {
                    echo $this->Html->link($auth->user('username'), ['controller'=>'Users', 'action'=>'mypage', $auth->user('id')]);
                } else {
                    echo $this->Html->link('会員登録', ['controller'=>'Users', 'action'=>'add']);
                }
                ?>
                <span>|</span>
            </li>
            <li>
                <?php
                if ($auth->user()) {
                    echo $this->Html->link('ログアウト', ['controller'=>'Users', 'action'=>'logout']);
                } else {
                    echo $this->Html->link('ログイン', ['controller'=>'Users', 'action'=>'login']);
                }
                ?>
                <span>|</span>
            </li>
        </ul>
    </div>
</header>