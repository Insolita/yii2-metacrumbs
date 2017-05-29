<?php
/**
 * Created by solly [29.05.17 9:12]
 */

namespace insolita\metacrumbs\mixins;

use yii\base\Behavior;
use yii\web\Controller;

/**
 * Class NoLayoutBehavior
 *
 * @package insolita\metacrumbs\mixins
 */
class NoLayoutBehavior extends Behavior
{
    /**
     * @var array
     */
    public $actions = [];
    
    /**
     * You also can set another layout
     * @var bool|string
     */
    public $noLayoutValue = false;
    /**
     * @var bool
     */
    public $except = false;
    /**
     * Declares event handlers for the [[owner]]'s events.
     *
     * @return array events (array keys) and the corresponding event handler methods (array values).
     */
    public function events()
    {
        return [Controller::EVENT_BEFORE_ACTION => 'noLayout'];
    }
    
    /**
     * @param \yii\base\ActionEvent $event
     *
     * @return bool
     */
    public function noLayout($event)
    {
        $action = $event->action->id;
        if ($this->except===false && in_array($action, $this->actions)) {
            $this->getOwner()->layout = false;
        }
        if ($this->except===true && !in_array($action, $this->actions)) {
            $this->getOwner()->layout = false;
        }
        return $event->isValid;
    }
    
    /**
     * @return \yii\base\Component|Controller
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
