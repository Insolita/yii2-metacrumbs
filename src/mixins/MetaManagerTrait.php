<?php
/**
 * Created by solly [01.04.17 11:27]
 */

namespace insolita\metacrumbs\mixins;

use insolita\metacrumbs\components\IMetaManager;

/**
 * MetaManagerTrait
 *
 * @package insolita\metacrumbs
 */
trait MetaManagerTrait
{
    /**
     * @var \insolita\metacrumbs\components\MetaManager
     */
    private $metaManager;
    
    /**
     * @return \insolita\metacrumbs\components\MetaManager
     */
    public function metaManager()
    {
        if (!$this->metaManager) {
            $this->metaManager = \Yii::createObject(IMetaManager::class);
        }
        return $this->metaManager;
    }
}
