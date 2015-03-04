<?php

namespace net\frenzel\comment\tests\unit;

use \net\frenzel\comment\Module;

/**
 * This is CommentModule unit test.
 * @license   https://github.com/philippfrenzel/yii2masonry/blob/master/LICENSE.md MIT
 * @author    Philipp Frenzel <philipp@frenzel.net>
 */

class CommentModuleTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \yii2masonry\yii2masonry
     */
    protected $instance;

    /**
     * @inheritdoc
     */
    protected function _before()
    {
        $this->instance = new Module();
    }

    /**
     * @inheritdoc
     */
    protected function _after()
    {
        $this->instance = null;
    }

    // tests
    public function testMe()
    {

    }

}