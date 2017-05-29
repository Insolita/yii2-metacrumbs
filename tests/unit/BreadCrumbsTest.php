<?php

namespace tests\unit\extensions\metacrumbs;

use Codeception\Test\Unit;
use Codeception\Specify;
use insolita\metacrumbs\components\BreadCrumbs;
use insolita\metacrumbs\components\CrumbItem;

/**
 *  Class BreadCrumbsTest
 *  Test for insolita\metacrumbs\BreadCrumbs
 **/
class BreadCrumbsTest extends Unit
{
    use Specify;
    
    public function testAll()
    {
        $this->specify(
            'linear flow',
            function () {
                $crumbsy = $this->getTarget();
                $crumbsy->addCrumb(new CrumbItem('First', ['site/index']));
                $crumbsy->addCrumb(new CrumbItem('Second', ['site/index']));
                $crumbsy->addCrumb(new CrumbItem('Last', ['site/index']));
                verify($crumbsy->count())->equals(3);
                $list = $crumbsy->getCrumbs();
                verify($crumbsy->count())->equals(3);
                verify($crumbsy->getFirstLabel())->equals('First');
                verify($crumbsy->count())->equals(3);
                verify($crumbsy->getLastLabel())->equals('Last');
                verify($crumbsy->count())->equals(3);
                verify($list)->internalType('array');
                verify(count($list))->equals(3);
                $titles = '';
                foreach ($list as $i => $item) {
                    verify($item)->isInstanceOf(CrumbItem::class);
                    $titles .= $item->title;
                }
                verify($titles)->equals('FirstSecondLast');
            }
        );
        $this->specify(
            'home injection flow',
            function () {
                $crumbsy = $this->getTarget();
                $crumbsy->addCrumb(new CrumbItem('First', ['site/index']));
                $crumbsy->addCrumb(new CrumbItem('Second', ['site/index']));
                $crumbsy->addCrumb(new CrumbItem('Last', ['site/index']));
                $crumbsy->addHome(new CrumbItem('Home', ['site/index']));
                verify($crumbsy->count())->equals(4);
                $list = $crumbsy->getCrumbs();
                verify($crumbsy->getFirstLabel())->equals('Home');
                verify($crumbsy->getLastLabel())->equals('Last');
                verify($list)->internalType('array');
                verify(count($list))->equals(4);
                $titles = '';
                foreach ($list as $i => $item) {
                    verify($item)->isInstanceOf(CrumbItem::class);
                    $titles .= $item->title;
                }
                verify($titles)->equals('HomeFirstSecondLast');
            }
        );
        $this->specify(
            'ordered flow',
            function () {
                $crumbsy = $this->getTarget();
                $crumbsy->addCrumb(new CrumbItem('Second', ['site/index'], 2));
                $crumbsy->addCrumb(new CrumbItem('Last', ['site/index'], 4));
                $crumbsy->addCrumb(new CrumbItem('First', ['site/index'], 1));
                $crumbsy->addHome(new CrumbItem('Home', ['site/index']));
                verify($crumbsy->count())->equals(4);
                verify($crumbsy->getFirstLabel())->equals('Home');
                verify($crumbsy->getLastLabel())->equals('Last');
                $list = $crumbsy->getCrumbs();
                verify($list)->internalType('array');
                verify(count($list))->equals(4);
                $titles = '';
                foreach ($list as $i => $item) {
                    verify($item)->isInstanceOf(CrumbItem::class);
                    $titles .= $item->title;
                }
                verify($titles)->equals('HomeFirstSecondLast');
            }
        );
    }
    
    /**
     * @return BreadCrumbs|object
     **/
    private function getTarget()
    {
        return \Yii::createObject(
            [
                'class' => BreadCrumbs::class,
            ],
            []
        );
    }
}