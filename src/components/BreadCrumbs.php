<?php
/**
 * Created by solly [14.10.16 4:36]
 */

namespace insolita\metacrumbs\components;

use yii\helpers\ArrayHelper;

/**
 * Class BreadCrumbs
 */
class BreadCrumbs implements IBreadcrumbCollection
{
    /**
     * @var array
     */
    private $crumbs = [];
    
    /**
     * @return int
     */
    public function count()
    {
        return count($this->crumbs);
    }
    
    /**
     * @param CrumbItem $item
     */
    public function addHome(CrumbItem $item)
    {
        $item->order = 0;
        $this->crumbs[0] = $item;
    }
    
    /**
     * @param CrumbItem $item
     */
    public function addCrumb(CrumbItem $item)
    {
        if (!$item->order || isset($this->crumbs[$item->order])) {
            $item->order = $this->count() ? (max(array_keys($this->crumbs)) + 1) : 1;
        }
        $this->crumbs[$item->order] = $item;
    }
    
    /**
     * @return array
     */
    public function getCrumbs()
    {
        ksort($this->crumbs);
        return $this->crumbs;
    }
    
    /**
     * @return string
     */
    public function getLastLabel()
    {
        if ($this->count() > 0) {
            $crumbs = $this->crumbs;
            ksort($crumbs);
            return ArrayHelper::getValue(array_pop($crumbs), 'title', '');
        } else {
            return \Yii::$app->name;
        }
    }
    
    /**
     * @return string
     */
    public function getFirstLabel()
    {
        if ($this->count() > 0) {
            $crumbs = $this->crumbs;
            ksort($crumbs);
            return ArrayHelper::getValue(array_shift($crumbs), 'title', '');
        } else {
            return \Yii::$app->name;
        }
    }
}
