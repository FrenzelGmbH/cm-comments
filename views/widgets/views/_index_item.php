<?php
/**
 * Comment item view.
 *
 * @var \yii\web\View $this View
 * @var \net\frenzel\comment\models\frontend\Comment[] $models Comment models
 */
use net\frenzel\comment\Module;
use yii\helpers\Url;
?>
<?php if ($models !== null) : ?>
    <?php foreach ($models as $comment) : ?>
        <div class="media" data-comment="parent" data-comment-id="<?= $comment->id ?>">
            <?php $avatar = $comment->author->profile->avatar_url ? $comment->author->profile->urlAttribute('avatar_url') : Yii::$app->assetManager->publish('@frenzelgmbh/cm-comments/assets/images/blog/avatar3.png')[1]; ?>
            <div class="pull-left">
                <img src="<?= $avatar ?>" class="avatar img-circle width-50" alt="<?= $comment->author->profile->fullName ?>"/>
            </div>
            <div class="media-body">
                <div class="well" data-comment="append">
                    <div class="media-heading">
                        <strong><?= $comment->author->profile->fullName ?></strong>&nbsp;
                        <small><?= $comment->created ?></small>
                        <?php if ($comment->parent_id) { ?>
                            &nbsp;
                            <a href="#comment-<?= $comment->parent_id ?>" data-comment="ancor" data-comment-parent="<?= $comment->parent_id ?>"><i class="icon-arrow-up"></i></a>
                        <?php } ?>
                        <?php if ($comment->isActive) { ?>
                            <div class="pull-right" data-comment="tools">
                                <?php if (Yii::$app->user->can('createComment')) { ?>
                                    <a href="#" data-comment="reply" data-comment-id="<?= $comment->id ?>">
                                        <i class="icon-repeat"></i> <?= Module::t('comment', 'FRONTEND_WIDGET_COMMENT_REPLY') ?>
                                    </a>
                                <?php } ?>
                                <?php if (Yii::$app->user->can('updateComment') || Yii::$app->user->can('updateOwnComment', ['model' => $comment])) { ?>
                                    &nbsp;
                                    <a href="#" data-comment="update" data-comment-id="<?= $comment->id ?>" data-comment-url="<?= Url::to([
                                        '/comment/default/update',
                                        'id' => $comment->id
                                    ]) ?>">
                                        <i class="icon-pencil"></i> <?= Module::t('comment', 'FRONTEND_WIDGET_COMMENT_UPDATE') ?>
                                    </a>
                                <?php } ?>
                                <?php if (Yii::$app->user->can('deleteComment') || Yii::$app->user->can('deleteOwnComment', ['model' => $comment])) { ?>
                                    &nbsp;
                                    <a href="#" data-comment="delete" data-comment-id="<?= $comment->id ?>" data-comment-url="<?= Url::to([
                                        '/comment/default/delete',
                                        'id' => $comment->id
                                    ]) ?>" data-comment-confirm="<?= Module::t('comment', 'FRONTEND_WIDGET_COMMENT_DELETE_CONFIRMATION') ?>">
                                        <i class="icon-trash"></i> <?= Module::t('comment', 'FRONTEND_WIDGET_COMMENT_DELETE') ?>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if ($comment->isDeleted) { ?>
                        <?= Module::t('comment', 'FRONTEND_WIDGET_COMMENT_DELETED_COMMENT_TEXT') ?>
                    <?php } else { ?>
                        <div class="content" data-comment="content"><?= $comment->content ?></div>
                    <?php } ?>
                </div>
                <?php if ($comment->children) { ?>
                    <?= $this->render('_index_item', ['models' => $comment->children]) ?>
                <?php } ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>