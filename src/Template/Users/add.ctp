<div class="clearfix" style="padding:60px 15px 0px 15px;max-width:100%;">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend style="text-align: center;"><?= __('ユーザー名とパスワードを入力してください') ?></legend>
        <div class="form-group" style="text-align: center">
        <?= $this->Form->control('username', [
            'label' => 'ユーザー名'
        ]) ?>
        </div>
        <div class="form-group" style="text-align: center">
        <?= $this->Form->control('password', [
            'label' => 'パスワード'
        ]) ?>
        </div>
        <div class="form-group" style="text-align: center">
        <?= $this->Form->control('role', [
            'label' => '権限',
            'options' => ['admin' => 'Admin', 'author' => 'Author']
        ]) ?>
        </div>
    </fieldset>
    <div class="submit" style="width:81px;margin-right:auto;margin-left: auto;">
        <?= $this->Form->button('サインアップ', [
                'class' => 'btn btn-primary'
        ]); ?>
    </div>
    <?= $this->Form->end() ?>
</div>