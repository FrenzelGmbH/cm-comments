<?php
namespace net\frenzel\comment\widgets;
use net\frenzel\comment\Asset;
use net\frenzel\comment\models\frontend\Comment;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Json;
class Comment extends Widget
{
    /**
     * @var \yii\db\ActiveRecord|null Widget model
     */
    public $model;
    
    /**
     * @var array comment Javascript plugin options
     */
    public $jsOptions = [];
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->model === null) {
            throw new InvalidConfigException('The "model" property must be set.');
        }
        $this->registerClientScript();
    }
    
    /**
     * @inheritdoc
     */
    public function run()
    {
        $class = $this->model;
        $class = Yii::$app->base->crc32($class::className());
        $models = Comment::getTree($this->model->id, $class);
        $model = new Comment(['scenario' => 'create']);
        $model->entity = $class;
        $model->entity_id = $this->model->id;
        return $this->render('index', [
            'models' => $models,
            'model' => $model
        ]);
    }
    /**
     * Register widget client scripts.
     */
    protected function registerClientScript()
    {
        $view = $this->getView();
        $options = Json::encode($this->jsOptions);
        Asset::register($view);
        $view->registerJs('jQuery.comment(' . $options . ');');
    }
}