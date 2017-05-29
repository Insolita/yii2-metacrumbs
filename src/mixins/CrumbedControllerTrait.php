<?php
/**
 * Created by solly [05.05.17 11:44]
 */

namespace insolita\metacrumbs\mixins;

use insolita\metacrumbs\components\CrumbItem;
use insolita\metacrumbs\components\IBreadcrumbCollection;
use yii\helpers\Url;

/**
 * Class CrumbedControllerTrait
 *
 * @mixin \yii\web\Controller
 */
trait CrumbedControllerTrait
{
    /**
     * @var \insolita\metacrumbs\components\BreadCrumbs $crumbCollection
     **/
    protected $crumbCollection;
    
    public function init()
    {
        $this->crumbCollection = \Yii::createObject(IBreadcrumbCollection::class);
        parent::init();
    }
    
    /**
     * @param string $name
     */
    protected function registerHomeCrumb($name = 'Главная')
    {
        $this->crumbCollection->addHome(new CrumbItem($name, \Yii::$app->getHomeUrl()));
    }
    
    /**
     * @param string $name
     * @param string $action
     */
    protected function registerIndexCrumb($name, $action = null)
    {
        $action = $action ?: $this->defaultAction;
        $this->crumbCollection->addCrumb(new CrumbItem($name, Url::to([$action])));
    }
    
    /**
     * @param string $name
     * @param string|null $url
     */
    protected function registerCurrentCrumb($name, $url = null)
    {
        $this->crumbCollection->addCrumb(new CrumbItem($name, $url));
    }
    
}
