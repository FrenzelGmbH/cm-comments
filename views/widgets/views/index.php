<?php
/**
 * Comment list view.
 *
 * @var \yii\web\View $this View
 * @var \net\frenzel\comment\models\frontend\Comment[] $models Comment models
 * @var \net\frenzel\comment\models\frontend\Comment $model New comment model
 */
use net\frenzel\comment\Module;
?>

<div id="comment">
    <div id="comment-list" data-comment="list">
        <?= $this->render('_index_item', ['models' => $models]) ?>
    </div>
    <!--/ #comment-list -->

    <?php if (Yii::$app->user->can('createComment')) : ?>
        <h3><?= Module::t('comment', 'FRONTEND_WIDGET_COMMENTS_FORM_TITLE') ?></h3>
        <?= $this->render('_form', ['model' => $model]); ?>
    <?php endif; ?>
</div>