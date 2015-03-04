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

<div class="row">
	<div class="col-md-6">
<div class="panel panel-info">
	<div class="panel-body">
		<div id="comment-list" data-comment="list">
	        <?= $this->render('_index_item', ['models' => $models]) ?>
	    </div>
    	<!--/ #comment-list -->
    </div>
</div>
	</div>
	<div class="col-md-6">
<div class="panel">
	<div class="panel-body">
		<?php if (!\Yii::$app->user->isGuest) : ?>
	        <small><?= \Yii::t('comment', 'Kommentar') ?></small>
	        <?= $this->render('_form', ['model' => $model]); ?>
    	<?php endif; ?>
	</div>
</div>
	</div>	
</div>
    
</div>