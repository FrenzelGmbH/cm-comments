<?php

namespace net\frenzel\comment;

/**
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

class Module extends \yii\base\Module
{
    /** @var string|null */
    public $userIdentityClass = null;
    
    /**
     * [init description]
     * @return [type] [description]
     */
    public function init()
    {
        parent::init();
        if ($this->userIdentityClass === null) {
            $this->userIdentityClass = \Yii::$app->getUser()->identityClass;
        }
    }
}
