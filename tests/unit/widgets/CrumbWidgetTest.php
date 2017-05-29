<?php
namespace tests\unit\extensions\metacrumbs\widgets;

use Codeception\Test\Unit;
use Codeception\Specify;
use Codeception\Util\Debug;
use insolita\metacrumbs\components\BreadCrumbs;
use insolita\metacrumbs\components\CrumbItem;
use insolita\metacrumbs\components\IBreadcrumbCollection;
use insolita\metacrumbs\widgets\CrumbWidget;
/**
*  Class CrumbWidgetTest
*  Test for insolita\metacrumbs\widgets\CrumbWidget
**/
class CrumbWidgetTest extends Unit
{
    use Specify;

    /**
    * Test for run
    * @see \insolita\metacrumbs\widgets\CrumbWidget::run()
    **/
    public function testRun()
    {
        \Yii::$container->setSingleton(IBreadcrumbCollection::class,BreadCrumbs::class);
        $crumbsy = \Yii::createObject(IBreadcrumbCollection::class);
        $widget = \Yii::createObject(['class'=>CrumbWidget::class]);
        $crumbsy->addCrumb(new CrumbItem('First','/site/index',null,['class'=>'spec']));
        $crumbsy->addCrumb(new CrumbItem('Second','/site/second', null));
        $crumbsy->addCrumb(new CrumbItem('Last','/site/third',null,['target'=>"_blank"]));
        ob_start();
        $widget->run();
        $result = ob_get_contents();
        ob_end_clean();
        Debug::debug($result);
        $result = str_replace("\n", '', $result);
        $expected = '<ul class="breadcrumb"><li><a class="spec" href="/site/index">First</a>'
            .'</li><li><a href="/site/second">Second</a></li>'
            .'<li><a href="/site/third" target="_blank">Last</a></li></ul>';
        verify($result)->equals($expected);
    }
}