<?php
/**
 * Comment item view.
 *
 * @var \yii\web\View $this View
 * @var \net\frenzel\comment\models\frontend\Comment[] $models Comment models
 */
use yii\helpers\Url;
?>
<?php if ($models !== null) : ?>
    <?php foreach ($models as $comment) : ?>
        <div class="media" data-comment="parent" data-comment-id="<?= $comment->id ?>">
            <div class="media-left">
                <img src="http://gravatar.com/avatar/<?= $comment->author->profile->gravatar_id ?>?s=50" alt="" class="img-rounded" />
            </div>
            <div class="media-body">
                <div data-comment="append">
                    <div class="media-heading">
                        <h4><?= $comment->author->username ?>&nbsp;
                        <small><?= \Yii::$app->formatter->asRelativeTime($comment->created_at) ?></small></h4>
                        <?php if ($comment->parent_id) { ?>
                            &nbsp;
                            <a href="#comment-<?= $comment->parent_id ?>" data-comment="ancor" data-comment-parent="<?= $comment->parent_id ?>"><i class="fa fa-arrow-up"></i></a>
                        <?php } ?>
                        <?php if (is_null($comment->deleted_at)) { ?>
                            <div class="media-right" data-comment="tools">
                                <?php if (!Yii::$app->user->isGuest) { ?>
                                    <a href="#" data-comment="reply" data-comment-id="<?= $comment->id ?>">
                                        <i class="fa fa-reply"></i> <?= \Yii::t('comment', 'antworten') ?>
                                    </a>
                                <?php } ?>
                                <?php if (Yii::$app->user->identity->isAdmin) { ?>
                                    &nbsp;
                                    <a href="#" data-comment="update" data-comment-id="<?= $comment->id ?>" data-comment-url="<?= Url::to([
                                        '/comment/default/update',
                                        'id' => $comment->id
                                    ]) ?>">
                                        <i class="fa fa-pencil"></i> <?= \Yii::t('comment', 'bearbeiten') ?>
                                    </a>
                                <?php } ?>
                                <?php if (Yii::$app->user->identity->isAdmin) { ?>
                                    &nbsp;
                                    <a href="#" data-comment="delete" data-comment-id="<?= $comment->id ?>" data-comment-url="<?= Url::to([
                                        '/comment/default/delete',
                                        'id' => $comment->id
                                    ]) ?>" data-comment-confirm="<?= \Yii::t('comment', 'FRONTEND_WIDGET_COMMENT_DELETE_CONFIRMATION') ?>">
                                        <i class="fa fa-remove"></i> <?= \Yii::t('comment', 'entfernen') ?>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if (!is_null($comment->deleted_at)) { ?>
                        <?= \Yii::t('comment', 'entfernt') ?>
                    <?php } else { ?>
                        <div class="content" data-comment="content"><?= $comment->text ?></div>
                    <?php } ?>
                </div>
                <?php if ($comment->children) { ?>
                    <?= $this->render('_index_item', ['models' => $comment->children]) ?>
                <?php } ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>