<?php
$this->assign('title', '記事編集');
?>

<!-- <?= $this->Form->create($article); ?>
<?= $this->Form->input('title'); ?>
<?= $this->Form->input('description'); ?>
<?= $this->Form->input('image'); ?>
<?= $this->Form->button('保存'); ?>
<?= $this->Form->end(); ?> -->

編集画面:
<form id="article_form" method="post" accept-charset="utf-8">
    <!--<input type="hidden" name="data[Article][id]" value="599" />-->
    <input type="hidden" name="item_order" value="" />
    <div id="article_form_header" class="clearfix">
        <div style="float: right;">
            <input class="btn btn-primary article_save" type="button" value="保存する">
        </div>
    </div>
    <div class="clearfix">
        <div id="articleThumb" style="margin-bottom: 10px;">
            <img id="thumb" src="" onerror="this.src='http://image.topicks.jp/assets/noimage.png';">
        </div>
        <div style="width:800px; float:left;">
            <div>
                <input id="articleTitle" class="form-control valid" name="title" placeholder="まとめのタイトル" value="<?= $article->title ?>" type="text" aria-required="true" aria-invalid="false">
                <p id="title_count"><span id="title_count_span" style="color: rgb(255, 0, 0);"></span>文字(推奨:28~32文字)</p>

            </div>
            <div>
                <textarea id="articleBody" class="form-control" name="description" placeholder="まとめの説明（160文字以内）" rows="4"></textarea>
                <p id="desc_count"><span id="desc_count_span" style="color: rgb(255, 0, 0);"></span>文字(推奨:110~130文字)</p>
            </div>
        </div>
        <div class="clearfix">
            <p style="display:inline-block;vertical-align: middle;">サムネイル画像：</p>
            <input id="thumb-form" class="form-control" name="image" placeholder="画像のURLを入力" type="url" value="">
        </div>
    </div>
</form>

<div class="item_box">
    <div style="margin: 10px;">
        <div class="edit_box">
            <legend>テキストを入力</legend>
            <form id="item_form">
                <select name="content_type" style="margin-bottom: 10px;">
                    <option value="headline_big">大見出し</option>
                    <option value="headline_small">小見出し</option>
                    <option value="text">本文</option>
                </select>
                <textarea class="form-control " name="content" style="width: 90%; height: 50px; margin-bottom:10px;"></textarea>
                <?php echo  '<input type="hidden" name="article_id" value="'.$article_id.'">';?>
                <div>
                    <input class="btn btn-primary item_submit" type="button" value="保存する">
                    <input class="btn btn-default" type="reset" value="キャンセル">
                </div>
            </form>
        </div>
        <div id="sortable">
        </div>
    </div>
</div>
