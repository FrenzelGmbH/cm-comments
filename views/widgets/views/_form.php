<?php
/**
 * Comment widget form view.
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \net\frenzel\comment\models\frontend\Comment $model New comment model
 */
use yii\helpers\Html;
?>
<?= Html::beginForm(['/comment/default/create'], 'POST', ['class' => 'form-horizontal', 'data-comment' => 'form', 'data-comment-action' => 'create']) ?>
    <div class="form-group" data-comment="form-group">
        <div class="col-sm-12">
            <?= Html::activeTextarea($model, 'text', ['class' => 'form-control']) ?>
            <?= Html::error($model, 'text', ['data-comment' => 'form-summary', 'class' => 'help-block hidden']) ?>
        </div>
    </div>
<?= Html::activeHiddenInput($model, 'parent_id', ['data-comment' => 'parent-id']) ?>
<?= Html::activeHiddenInput($model, 'entity') ?>
<?= Html::activeHiddenInput($model, 'entity_id') ?>
<?= Html::submitButton(\Yii::t('comment', 'senden'), ['class' => 'btn btn-success btn-sm']); ?>
<?= Html::endForm(); ?>
<div class="clearfix"></div>