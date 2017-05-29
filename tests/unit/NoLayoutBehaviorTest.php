<?php
/**
 * Created by solly [29.05.17 10:52]
 */

namespace tests\unit\extensions\metacrumbs;

use Codeception\Specify;
use Codeception\Test\Unit;
use Codeception\Util\Stub;
use insolita\metacrumbs\mixins\NoLayoutBehavior;
use yii\base\Action;
use yii\base\ActionEvent;
use yii\web\Controller;

class NoLayoutBehaviorTest extends Unit
{
    use Specify;
    
    public function testBehavior()
    {
        $this->specify(
            'matched action',
            function () {
                /**@var Controller $controller */
                $controller = Stub::make(
                    Controller::class,
                    [
                        'id'          => 'test',
                        'layout'      => 'someLayout',
                        'getUniqueId' => Stub::never(
                            function () {
                                return 'test';
                            }
                        ),
                    ],
                    $this
                );
                $controller->attachBehavior(
                    'noLayout',
                    ['class' => NoLayoutBehavior::class, 'actions' => ['one', 'two']]
                );
                verify($controller->layout)->equals('someLayout');
                $controller->trigger(Controller::EVENT_BEFORE_ACTION,
                                     new ActionEvent(new Action('one', $controller)));
                verify($controller->layout)->false();
            }
        );
        $this->specify(
            'not matched action',
            function () {
                /**@var Controller $controller */
                $controller = Stub::make(
                    Controller::class,
                    [
                        'id'          => 'test',
                        'layout'      => 'someLayout',
                        'getUniqueId' => Stub::never(
                            function () {
                                return 'test';
                            }
                        ),
                    ],
                    $this
                );
                $controller->attachBehavior(
                    'noLayout',
                    ['class' => NoLayoutBehavior::class, 'actions' => ['one', 'two']]
                );
                verify($controller->layout)->equals('someLayout');
                $controller->trigger(Controller::EVENT_BEFORE_ACTION,
                                     new ActionEvent(new Action('foo', $controller)));
                verify($controller->layout)->equals('someLayout');
            }
        );
        $this->specify(
            'matched action by except',
            function () {
                /**@var Controller $controller */
                $controller = Stub::make(
                    Controller::class,
                    [
                        'id'          => 'test',
                        'layout'      => 'someLayout',
                        'getUniqueId' => Stub::never(
                            function () {
                                return 'test';
                            }
                        ),
                    ],
                    $this
                );
                $controller->attachBehavior(
                    'noLayout',
                    [
                        'class'   => NoLayoutBehavior::class,
                        'actions' => ['one', 'two'],
                        'except'  => true,
                    ]
                );
                verify($controller->layout)->equals('someLayout');
                $controller->trigger(Controller::EVENT_BEFORE_ACTION,
                                     new ActionEvent(new Action('foo', $controller)));
                verify($controller->layout)->false();
            }
        );
    }
}
