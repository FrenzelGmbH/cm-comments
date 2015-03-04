<?php
namespace net\frenzel\comment;

/**
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

use yii\web\AssetBundle;

/**
 * Module asset bundle.
 */
class CoreAsset extends AssetBundle
{
    
    /**
     * @inheritdoc
     */
    public $sourcePath = '@frenzelgmbh/cm-comments/assets';
    
    /**
     * @inheritdoc
     */
    public $js = [
        'js/comment.js'
    ];
    
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset'
    ];
}