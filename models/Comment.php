<?php

namespace net\frenzel\comment\models;

/**
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

/**
 * Class Comment
 * @package net\frenzel\comment\models
 *
 * @property integer $id
 * @property string $entity
 * @property integer $entity_id
 * @property string $text
 * @property integer $deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \yii\db\ActiveRecord $author
 * @property \yii\db\ActiveRecord $lastUpdateAuthor
 *
 * @method scope\CommentQuery hasMany(string $class, array $link) see BaseActiveRecord::hasMany() for more info
 * @method scope\CommentQuery hasOne(string $class, array $link) see BaseActiveRecord::hasOne() for more info
 */
class Comment extends \yii\db\ActiveRecord
{
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\BlameableBehavior::class,
            \yii\behaviors\TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text','entity'], 'string'],
            [['created_by', 'updated_by', 'created_at', 'updated_at','deleted_at','entity_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app', 'ID'),
            'text' => \Yii::t('app', 'Text'),
            'entity' => \Yii::t('app', 'Entity'),
            'created_by' => \Yii::t('app', 'Created by'),
            'updated_by' => \Yii::t('app', 'Updated by'),
            'created_at' => \Yii::t('app', 'Created at'),
            'updated_at' => \Yii::t('app', 'Updated at'),
            'deleted_at' => \Yii::t('app', 'Updated at'),
        ];
    }

    /**
     * @return queries\CommentQuery
     */
    public function getAuthor()
    {
        /** @var Comments\Module $Module */
        $Module = \Yii::$app->getModule('comment');
        return $this->hasOne($Module->userIdentityClass, ['id' => 'created_by']);
    }
}
