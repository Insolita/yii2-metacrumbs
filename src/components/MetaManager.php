<?php
/**
 * Created by solly [01.04.17 9:05]
 */

namespace insolita\metacrumbs\components;

use yii\helpers\Url;

/**
 * Class MetaManager
 *
 * @package insolita\metacrumbs
 */
class MetaManager implements IMetaManager
{
    /**
     * @var string
     */
    public $defaultImage = '';
    
    /**
     * @var string
     */
    public $defaultType = 'website';
    
    /**
     * @var
     */
    public $siteName;
    
    /**
     * Bulk OpenGraph meta-tags registration
     *
     * @see http://ogp.me/
     * Don't forget register in head tag <head prefix="og: http://ogp.me/ns#">
     *
     * @param        $url
     * @param        $title
     * @param string $description
     * @param string $image
     * @param string $type
     *
     * @return void
     */
    public function ogMeta($title, $url = '', $description = '', $image = '', $type = '')
    {
        $url = $url ?: Url::canonical();
        $type = $type ?: $this->defaultType;
        $image = $image ?: $this->defaultImage;
        $siteName = $this->siteName ?: \Yii::$app->name;
        $view = $this->getView();
        $title = str_replace(['&quot;', '"'], '', $title);
        $view->registerMetaTag(['content' => $title, 'property' => 'og:title'], 'og:title');
        $view->registerMetaTag(['content' => $url, 'property' => 'og:url'], 'og:url');
        $view->registerMetaTag(['content' => $siteName, 'property' => 'og:site_name'], 'og:site_name');
        $view->registerMetaTag(['content' => $type, 'property' => 'og:type'], 'og:type');
        if ($description) {
            $view->registerMetaTag(['content' => $description, 'property' => 'og:description']);
            $view->registerMetaTag(['content' => $description, 'name' => 'description']);
        }
        if ($image) {
            $view->registerMetaTag(['content' => $image, 'property' => 'og:image']);
        }
    }
    
    /**
     * @param string      $url
     * @param string|null $width
     * @param string|null $height
     * @param string|null $mime
     * @param string|null $secUrl secure url
     */
    public function ogImage($url, $width = null, $height = null, $mime = null, $secUrl = null)
    {
        $view = $this->getView();
        $view->registerMetaTag(['content' => $url, 'property' => 'og:image']);
        if ($width) {
            $view->registerMetaTag(['content' => $width, 'property' => 'og:image:width']);
        }
        if ($height) {
            $view->registerMetaTag(['content' => $height, 'property' => 'og:image:height']);
        }
        if ($mime) {
            $view->registerMetaTag(['content' => $mime, 'property' => 'og:image:type']);
        }
        if ($secUrl) {
            $view->registerMetaTag(['content' => $secUrl, 'property' => 'og:image:secure_url']);
        }
    }
    
    /**
     * @param string      $url
     * @param string|null $width
     * @param string|null $height
     * @param string|null $mime
     * @param string|null $secUrl secure url
     */
    public function ogVideo($url, $width = null, $height = null, $mime = null, $secUrl = '')
    {
        $view = $this->getView();
        $view->registerMetaTag(['content' => $url, 'property' => 'og:video']);
        if ($width) {
            $view->registerMetaTag(['content' => $width, 'property' => 'og:video:width']);
        }
        if ($height) {
            $view->registerMetaTag(['content' => $height, 'property' => 'og:video:height']);
        }
        if ($mime) {
            $view->registerMetaTag(['content' => $mime, 'property' => 'og:video:type']);
        }
        if ($secUrl) {
            $view->registerMetaTag(['content' => $secUrl, 'property' => 'og:video:secure_url']);
        }
    }
    
    /**
     * @param string      $url
     * @param string|null $mime
     */
    public function ogAudio($url, $mime = null, $secUrl = null)
    {
        $view = $this->getView();
        $view->registerMetaTag(['content' => $url, 'property' => 'og:audio']);
        if ($mime) {
            $view->registerMetaTag(['content' => $mime, 'property' => 'og:audio:type']);
        }
        if ($secUrl) {
            $view->registerMetaTag(['content' => $secUrl, 'property' => 'og:audio:secure_url']);
        }
    }
    
    /**
     * @param   string    $author
     * @param  string     $pubTime - publication time
     * @param string|null $modTime - modification type
     * @param string|null $section -  section
     * @param string|null $tag     - tags
     * @param string|null $expTime - expiration time
     */
    public function ogArticle($author, $pubTime, $modTime = null, $section = null, $tag = null, $expTime = null)
    {
        $view = $this->getView();
        $view->registerMetaTag(['content' => $author, 'property' => 'article:author']);
        $view->registerMetaTag(['content' => $pubTime, 'property' => 'article:published_time']);
        if ($modTime) {
            $view->registerMetaTag(['content' => $modTime, 'property' => 'article:modified_time']);
        }
        if ($section) {
            $view->registerMetaTag(['content' => $section, 'property' => 'article:section']);
        }
        if ($tag) {
            $view->registerMetaTag(['content' => $tag, 'property' => 'article:tag']);
        }
        if ($expTime) {
            $view->registerMetaTag(['content' => $expTime, 'property' => 'article:expiration_time']);
        }
    }
    
    /**
     * @param      $userName
     * @param null $firstName
     * @param null $lastName
     * @param null $gender
     */
    public function ogProfile($userName, $firstName = null, $lastName = null, $gender = null)
    {
        $view = $this->getView();
        $view->registerMetaTag(['content' => $userName, 'property' => 'profile:username']);
        if ($firstName) {
            $view->registerMetaTag(['content' => $firstName, 'property' => 'profile:first_name']);
        }
        if ($lastName) {
            $view->registerMetaTag(['content' => $lastName, 'property' => 'profile:last_name']);
        }
        if ($gender) {
            $view->registerMetaTag(['content' => $gender, 'property' => 'profile:gender']);
        }
    }
    
    /**
     * @param string $keywords
     */
    public function keywords($keywords)
    {
        $this->getView()->registerMetaTag(['content' => $keywords, 'name' => 'keywords'], 'keywords');
    }
    
    /**
     * @param string $name
     * @param string $content
     */
    public function prop($name, $content)
    {
        $this->getView()->registerMetaTag(['content' => $content, 'property' => $name]);
    }
    
    /**
     * @param string $name
     * @param string $content
     */
    public function tag($name, $content)
    {
        $this->getView()->registerMetaTag(['content' => $content, 'name' => $name]);
    }
    
    /**
     * @param string $url
     */
    public function canonical($url = '')
    {
        $view = $this->getView();
        $url = $url ?: Url::canonical();
        $view->registerLinkTag(['rel' => 'canonical', 'href' => $url]);
    }
    
    /**
     * @return \yii\base\View|\yii\web\View
     */
    protected function getView()
    {
        return \Yii::$app->controller->getView();
    }
}
