<?php
/**
 * Created by solly [29.05.17 9:40]
 */

namespace insolita\metacrumbs\components;

/**
 * Interface IMetaManager
 *
 * @package insolita\metacrumbs
 */
interface IMetaManager
{
    /**
     * Bulk OpenGraph common meta-tags registration
     * @see http://ogp.me/
     * @param        $url
     * @param        $title
     * @param string $description
     * @param string $image
     * @param string $type
     *
     * @return void
     */
    public function ogMeta($title, $url = '', $description = '', $image = '', $type = '');
    /**
     * @param string      $url
     * @param string|null $width
     * @param string|null $height
     * @param string|null $mime
     * @param string|null $secUrl secure url
     */
    public function ogImage($url, $width = null, $height = null, $mime = null, $secUrl = null);
    
    /**
     * @param string      $url
     * @param string|null $width
     * @param string|null $height
     * @param string|null $mime
     * @param string|null $secUrl secure url
     */
    public function ogVideo($url, $width = null, $height = null, $mime = null, $secUrl = '');
    
    /**
     * @param string      $url
     * @param string|null $mime
     */
    public function ogAudio($url, $mime = null, $secUrl = null);
    
    /**
     * @param   string    $author
     * @param  string     $pubTime - publication time
     * @param string|null $modTime - modification type
     * @param string|null $section -  section
     * @param string|null $tag     - tags
     * @param string|null $expTime - expiration time
     */
    public function ogArticle($author, $pubTime, $modTime = null, $section = null, $tag = null, $expTime = null);
    
    /**
     * @param      $userName
     * @param null $firstName
     * @param null $lastName
     * @param null $gender
     */
    public function ogProfile($userName, $firstName = null, $lastName = null, $gender = null);
    /**
     * @param string $url
     *
     * @return void
     */
    public function canonical($url = '');
    
    /**
     * @param string $keywords
     */
    public function keywords($keywords);
    
    /**
     * @param $name
     * @param $content
     */
    public function prop($name, $content);
    
    /**
     * @param $name
     * @param $content
     */
    public function tag($name, $content);
}
