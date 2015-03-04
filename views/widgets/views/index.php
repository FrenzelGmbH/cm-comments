<?php
/**
 * Comment list view.
 *
 * @var \yii\web\View $this View
 * @var \net\frenzel\comment\models\frontend\Comment[] $models Comment models
 * @var \net\frenzel\comment\models\frontend\Comment $model New comment model
 */

?>

<div id="comment">
    <div id="comment-list" data-comment="list">
        <?= $this->render('_index_item', ['models' => $models]) ?>
    </div>
    <!--/ #comment-list -->

    <?php if (!\Yii::$app->user->isGuest) : ?>
        <h3><?= \Yii::t('comment', 'Comments') ?></h3>
        <?= $this->render('_form', ['model' => $model]); ?>
    <?php endif; ?>
</div>