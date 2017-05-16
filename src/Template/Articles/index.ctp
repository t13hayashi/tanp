<?php
$this->assign('title', '記事一覧');
?>

<div class="col_center">
    <h2 class="mainbox-title">本日の最新まとめ記事一覧</h2>
    <ul class="mainbox-articles">
        <?php
        foreach($articles as $article) {
            echo '<li style="width: 380px; height: 180px; float: left;">';
            echo '<a class="article-thumb" href="'.$this->Url->build(['controller'=>'Articles', 'action'=>'view', $article->id]).'">';
            echo '<img src="'.$article->image.'" alt="eeのサムネイル画像" onerror="this.src=\'http://image.topicks.jp/assets/noimage_100.png\';"></a>';
            echo '<p class="article-title"><a href="'.$this->Url->build(['controller'=>'Articles', 'action'=>'view', $article->id]).'">';
            echo $article->title;
            echo '</a></p>';
            echo '<p class="article-body">';
            echo $article->description;
            echo '</p>';
            //echo '<p class="article-published">2015/10/05 01:05</p>';
            //echo '<p class="article-user"> | ';
            //echo '<span><a href="/user/6">test_user</a></span></p>';
            echo '<div class="clearfix"></div></li>';
        }
        ?>
    </ul>
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