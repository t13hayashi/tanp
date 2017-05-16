<!DOCTYPE html>
<html lang="ja">
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->css('styles.css') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->script('edit.js') ?>
</head>
<body>
<?= $this->element('header'); ?>
<?= $this->Flash->render(); ?>

<div class="wrapper">
    <?= $this->fetch('content') ?>
</div>
</body>
</html>
