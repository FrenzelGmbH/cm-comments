<?php
/**
 * Comment list view.
 *
 * @var \yii\web\View $this View
 * @var \net\frenzel\comment\models\Comment[] $models Comment models
 * @var \net\frenzel\comment\models\Comment $model New comment model
 */

?>

<div id="comment">
   <?php if (!\Yii::$app->user->isGuest) : ?>	        
   <?= $this->render('_form_plain', ['model' => $model]); ?>
   <?php endif; ?>		
    <!--/ #comment-list -->
    <div id="comment-list" data-comment="list">
    <?= $this->render('_index_item', ['models' => $models]) ?>
    </div>
    <!--/ #comment-list -->		    
</div>
