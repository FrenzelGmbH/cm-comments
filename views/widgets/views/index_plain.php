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

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			<i class="fa fa-comments-o"></i> 
			<?= \Yii::t('comment', 'Kommentar') ?>
		</h4>
	</div>
	<div class="panel-body">
		<?php if (!\Yii::$app->user->isGuest) : ?>	        
	        <?= $this->render('_form_plain', ['model' => $model]); ?>
    	<?php endif; ?>		
		<!--/ #comment-list -->
		<div id="comment-list" data-comment="list">
	        <?= $this->render('_index_item', ['models' => $models]) ?>
	    </div>
    	<!--/ #comment-list -->		
	</div>	
</div>
    
</div>