<?php

namespace net\frenzel\comment\tests\unit;

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
     * @inheritdoc
     */
    protected function _before()
    {
        $this->instance = null;
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