<?php
/**
 * Created by solly [29.05.17 4:37]
 */

namespace insolita\metacrumbs;

use insolita\metacrumbs\components\BreadCrumbs;
use insolita\metacrumbs\components\IBreadcrumbCollection;
use insolita\metacrumbs\components\IMetaManager;
use insolita\metacrumbs\components\MetaManager;
use yii\base\BootstrapInterface;

/**
 * Class MetaCrumbsBootstrap
 *
 * @package insolita\metacrumbs
 */
class MetaCrumbsBootstrap implements BootstrapInterface
{
    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        \Yii::$container->setSingleton(IBreadcrumbCollection::class,BreadCrumbs::class);
        \Yii::$container->setSingleton(IMetaManager::class,MetaManager::class);
    }
    
}
