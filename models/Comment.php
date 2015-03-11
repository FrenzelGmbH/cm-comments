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
 * @property integer $parent_id
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
     * @var null|array|\yii\db\ActiveRecord[] Comment children
     */
    protected $_children;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\BlameableBehavior::className(),
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'create' => ['parent_id', 'entity', 'entity_id', 'text'],
            'update' => ['text'],
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
            [['created_by', 'updated_by', 'created_at', 'updated_at','deleted_at','entity_id','parent_id'], 'integer'],
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
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        $Module = \Yii::$app->getModule('comment');
        return $this->hasOne($Module->userIdentityClass, ['id' => 'created_by']);
    }

    /**
     * Get comments tree.
     *
     * @param integer $model Model ID
     * @param integer $class Model class ID
     *
     * @return array|\yii\db\ActiveRecord[] Comments tree
     */
    public static function getTree($model, $class)
    {
        $models = self::find()->where([
            'entity_id' => $model,
            'entity' => $class,
            'deleted_at' => NULL,
        ])->orderBy(['parent_id' => 'DESC', 'created_at' => 'DESC'])->with(['author'])->all();
        if ($models !== null) {
            $models = self::buildTree($models);
        }
        return $models;
    }

    /**
     * Build comments tree.
     *
     * @param array $data Records array
     * @param int $rootID parent_id Root ID
     * @return array|\yii\db\ActiveRecord[] Comments tree
     */
    protected static function buildTree(&$data, $rootID = 0)
    {
        $tree = [];
        foreach ($data as $id => $node) {
            if ($node->parent_id == $rootID) {
                unset($data[$id]);
                $node->children = self::buildTree($data, $node->id);
                $tree[] = $node;
            }
        }
        return $tree;
    }
    
    /**
     * Delete comment.
     *
     * @return boolean Whether comment was deleted or not
     */
    public function deleteComment()
    {
        $this->touch('deleted_at');
        $this->text = '';
        return $this->save(false, ['deleted_at', 'text']);
    }

    /**
     * $_children getter.
     *
     * @return null|array|]yii\db\ActiveRecord[] Comment children
     */
    public function getChildren()
    {
        return $this->_children;
    }
    
    /**
     * $_children setter.
     *
     * @param array|\yii\db\ActiveRecord[] $value Comment children
     */
    public function setChildren($value)
    {
        $this->_children = $value;
    }

    /**
     * Model ID validation.
     *
     * @param string $attribute Attribute name
     * @param array $params Attribute params
     *
     * @return mixed
     */
    public function validateModelId($attribute, $params)
    {
        /** @var ActiveRecord $class */
        $class = Model::findIdentity($this->model_class);
        if ($class === null) {
            $this->addError($attribute, \Yii::t('comments', 'ERROR_MSG_INVALID_MODEL_ID'));
        } else {
            $model = $class->name;
            if ($model::find()->where(['id' => $this->model_id]) === false) {
                $this->addError($attribute, \Yii::t('comments', 'ERROR_MSG_INVALID_MODEL_ID'));
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(Model::className(), ['id' => 'entity']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        /** @var ActiveRecord $class */
        $class = Model::find()->where(['id' => $this->entity])->asArray()->one();
        $model = $class->name;
        return $this->hasOne($model::className(), ['id' => 'entity_id']);
    }
}
