<?php
/**
 * Created by solly [05.05.17 11:09]
 */

namespace insolita\metacrumbs\widgets;

use insolita\metacrumbs\components\CrumbItem;
use insolita\metacrumbs\components\IBreadcrumbCollection;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class CrumbWidget
 *
 * @package insolita\metacrumbs\widgets
 */
class CrumbWidget extends Widget
{
    /**
     * @var string the name of the breadcrumb container tag.
     */
    public $tag = 'ul';
    
    /**
     * @var array the HTML attributes for the breadcrumb container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'breadcrumb'];
    
    /**
     * @var bool whether to HTML-encode the link labels.
     */
    public $encodeLabels = true;
    
    /**
     * @var string the template used to render each inactive item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each inactive item.
     */
    public $itemTemplate = "<li>{link}</li>\n";
    
    /**
     * @var string the template used to render each active item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each active item.
     */
    public $activeItemTemplate = "<li class=\"active\">{link}</li>\n";
    
    /**
     * @var \insolita\metacrumbs\components\IBreadcrumbCollection
     */
    private $breadCrumbManager;
    
    /**
     * CrumbWidget constructor.
     *
     * @param \insolita\metacrumbs\components\IBreadcrumbCollection $breadcrumbManager
     * @param array                                                 $config
     */
    public function __construct(IBreadcrumbCollection $breadcrumbManager, array $config = [])
    {
        $this->breadCrumbManager = $breadcrumbManager;
        parent::__construct($config);
    }
    
    /**
     *
     */
    public function run()
    {
        if ($this->breadCrumbManager->count() === 0) {
            return;
        }
        $links = [];
        $crumbs = $this->breadCrumbManager->getCrumbs();
        foreach ($crumbs as $crumb) {
            $links[] = $this->renderItem($crumb, $crumb->url ? $this->itemTemplate : $this->activeItemTemplate);
        }
        echo Html::tag($this->tag, implode('', $links), $this->options);
    }
    
    /**
     * @param \insolita\metacrumbs\components\CrumbItem $item
     * @param                                           $template
     *
     * @return string
     */
    protected function renderItem(CrumbItem $item, $template)
    {
        if ($item->url) {
            $link = Html::a($item->title, $item->url, $item->options);
        } else {
            $link = $item->title;
        }
        return strtr($template, ['{link}' => $link]);
    }
}
