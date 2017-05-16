<?php
$this->assign('title', '記事閲覧');
?>


<div class="article-container">
    <div class="article-header">
        <img class="article-thumb" src="<?= $article->image; ?>" onerror="this.src='http://image.topicks.jp/assets/noimage_100.png';">
        <div class="article-disp">
            <h1 class="article-title"><?= $article->title; ?></h1>
            <p class="article-body"><?= $article->description; ?></p>
            <p class="article-count">??? view</p>
        </div>
    </div>
    <div class="article-items">
        <?php foreach ($items as $item): ?>
        <div>
            <p class="article-item <?= $item->content_type; ?>"><?= $item->content; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="col_right">
    <h2 class="feature">おすすめ記事一覧</h2>
    <ul class="feature-articles">
        <li class="feature-article">
            <a style="float:left;" href="">
                <img style="float:left; width:60px; height:60px;" src="" alt="eeのサムネイル画像" onerror="this.src='http://image.topicks.jp/assets/noimage_100.png';">
            </a>
            <p class="feature-title">
                <a href=""></a>
            </p>
        </li>
    </ul>
</div>

