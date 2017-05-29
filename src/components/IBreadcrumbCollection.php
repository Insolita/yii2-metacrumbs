<?php
/**
 * Created by solly [14.10.16 4:52]
 */
namespace insolita\metacrumbs\components;

/**
 * Interface IBreadcrumbCollection
 *
 */
interface IBreadcrumbCollection
{
    /**
     * @param CrumbItem $item
     *
     */
    public function addHome(CrumbItem $item);

    /**
     * @param CrumbItem $item
     *
     */
    public function addCrumb(CrumbItem $item);

    /**
     * @return array
     */
    public function getCrumbs();

    /**
     * @return string
    **/
    public function getLastLabel();

    /**
     * @return string
     */
    public function getFirstLabel();
    
    /**
     * @return int
     */
    public function count();
}