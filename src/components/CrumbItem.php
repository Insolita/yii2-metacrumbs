<?php
/**
 * Created by solly [14.10.16 4:44]
 */

namespace insolita\metacrumbs\components;

use yii\base\Object;
use yii\helpers\Url;

/**
 * Class CrumbItem
 *
 */
class CrumbItem extends Object
{
    /**
     * @var array
     */
    public $options = [];
    
    /**
     * @var int
     */
    public $order = null;
    
    /**
     * @var string
     */
    private $title;
    
    /**
     * @var string|array
     */
    private $url = [];
    
    /**
     * CrumbItem constructor.
     *
     * @param string $title
     * @param        $url
     * @param null   $order
     * @param array  $config
     */
    public function __construct($title, $url, $order = null, $config = [])
    {
        $this->title = $title;
        $this->url = $url ?: Url::current();
        $this->order = $order;
        $this->options = $config;
        parent::__construct([]);
    }
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * @return array|string
     */
    public function getUrl()
    {
        return $this->url;
    }
    
}
