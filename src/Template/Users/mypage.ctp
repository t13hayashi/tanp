<?php
$this->assign('title', 'マイページ');
?>


<h2 style="padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px solid #eee;"><?= $user->username; ?>さんのまとめ記事一覧</h2>
<ul>
    <?php foreach ($user->articles as $article): ?>
        <li style="margin-bottom : 10px; border-bottom: 1px solid #eee;" id="<?= $article->id; ?>">
            <div style="float: left; width: 800px;">
                <a class="my-article-thumb" href="<?= $this->Url->build(['controller'=>'Articles', 'action'=>'view', $article->id]) ?>">
                    <img  style="height: 130px; width: 130px;" src="<?= $article->image; ?>" alt="eeのサムネイル画像" onerror="this.src='http://image.topicks.jp/assets/noimage_100.png';">
                </a>
                <p style="font-size: 20px;" class="my-article-title">
                    <a href="<?= $this->Url->build(['controller'=>'Articles', 'action'=>'view', $article->id]) ?>"><?= $article->title ?></a>
                </p>
                <p class="my-article-body"><?= $article->description; ?></p>
                <p class="my-article-published"><?= $article->created;?></p>
            </div>
            <div style="float: right; margin-top: 40px; margin-right: 40px;">
                <button class="btn btn-danger delete">削除</button>
            </div>
            <div style="float: right;  margin-top: 40px; margin-right: 40px;">
                <a style="font-size: 20px;" href="<?= $this->Url->build(['controller'=>'Articles', 'action'=>'edit', $article->id]) ?>">
                    <button class="btn btn-primary">編集</button>
                </a>
            </div>
            <div class="clearfix"></div>
        </li>
    <?php endforeach; ?>
</ul>
<div class="clearfix"></div>

