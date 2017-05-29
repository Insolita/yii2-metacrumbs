<?php
/**
 * Created by solly [29.05.17 10:55]
 */

namespace tests\unit\extensions\metacrumbs;

use Codeception\Test\Unit;
use Codeception\Util\Debug;
use Codeception\Util\Stub;
use insolita\metacrumbs\components\MetaManager;
use yii\web\View;

class MetaManagerTest extends Unit
{
    public function testCanonical()
    {
        $view = new View();
        /**@var MetaManager $manager * */
        $manager = Stub::make(
            MetaManager::class,
            [
                'getView' => Stub::once(
                    function () use ($view) {
                        return $view;
                    }
                ),
            ],
            $this
        );
        verify($view->linkTags)->isEmpty();
        $manager->canonical('http://foo.bar');
        verify($view->linkTags)->notEmpty();
        verify($view->linkTags[0])->contains('href="http://foo.bar" rel="canonical"');
        Debug::debug($view->linkTags);
    }
    
    public function testKeywords()
    {
        $view = new View();
        /**@var MetaManager $manager * */
        $manager = Stub::make(
            MetaManager::class,
            [
                'getView' => Stub::once(
                    function () use ($view) {
                        return $view;
                    }
                ),
            ],
            $this
        );
        verify($view->metaTags)->isEmpty();
        $manager->keywords('foo,bar,baz');
        verify($view->metaTags)->notEmpty();
        verify($view->metaTags['keywords'])->contains('name="keywords" content="foo,bar,baz"');
        Debug::debug($view->metaTags);
    }
    
    public function testTag()
    {
        $view = new View();
        /**@var MetaManager $manager * */
        $manager = Stub::make(
            MetaManager::class,
            [
                'getView' => Stub::once(
                    function () use ($view) {
                        return $view;
                    }
                ),
            ],
            $this
        );
        verify($view->metaTags)->isEmpty();
        $manager->tag('custom', 'foo,bar,baz');
        verify($view->metaTags)->notEmpty();
        verify($view->metaTags[0])->contains('name="custom" content="foo,bar,baz"');
        Debug::debug($view->metaTags);
    }
    
    public function testProp()
    {
        $view = new View();
        /**@var MetaManager $manager * */
        $manager = Stub::make(
            MetaManager::class,
            [
                'getView' => Stub::once(
                    function () use ($view) {
                        return $view;
                    }
                ),
            ],
            $this
        );
        verify($view->metaTags)->isEmpty();
        $manager->prop('custom', 'foo,bar,baz');
        verify($view->metaTags)->notEmpty();
        verify($view->metaTags[0])->contains('property="custom"');
        Debug::debug($view->metaTags);
    }
    
    public function testOgMeta()
    {
        $view = new View();
        /**@var MetaManager $manager * */
        $manager = Stub::make(
            MetaManager::class,
            [
                'getView' => Stub::once(
                    function () use ($view) {
                        return $view;
                    }
                ),
            ],
            $this
        );
        verify($view->metaTags)->isEmpty();
        $manager->ogMeta('MyTitle', 'http://foo.bar', 'Bla-bla', 'http://foo.bar/img.jpg', '');
        verify($view->metaTags)->notEmpty();
        Debug::debug($view->metaTags);
    }
    
    public function testOgImage()
    {
        $view = new View();
        /**@var MetaManager $manager * */
        $manager = Stub::make(
            MetaManager::class,
            [
                'getView' => Stub::once(
                    function () use ($view) {
                        return $view;
                    }
                ),
            ],
            $this
        );
        verify($view->metaTags)->isEmpty();
        $manager->ogImage('http://foo.bar', '500', '300');
        verify($view->metaTags)->notEmpty();
        Debug::debug($view->metaTags);
    }
    
    public function testOgVideo()
    {
        $view = new View();
        /**@var MetaManager $manager * */
        $manager = Stub::make(
            MetaManager::class,
            [
                'getView' => Stub::once(
                    function () use ($view) {
                        return $view;
                    }
                ),
            ],
            $this
        );
        verify($view->metaTags)->isEmpty();
        $manager->ogVideo('http://foo.bar', '500', '300');
        verify($view->metaTags)->notEmpty();
        Debug::debug($view->metaTags);
    }
    
    public function testOgAudio()
    {
        $view = new View();
        /**@var MetaManager $manager * */
        $manager = Stub::make(
            MetaManager::class,
            [
                'getView' => Stub::once(
                    function () use ($view) {
                        return $view;
                    }
                ),
            ],
            $this
        );
        verify($view->metaTags)->isEmpty();
        $manager->ogAudio('http://foo.bar', 'audio/mp3');
        verify($view->metaTags)->notEmpty();
        Debug::debug($view->metaTags);
    }
    
    public function testOgProfile()
    {
        $view = new View();
        /**@var MetaManager $manager * */
        $manager = Stub::make(
            MetaManager::class,
            [
                'getView' => Stub::once(
                    function () use ($view) {
                        return $view;
                    }
                ),
            ],
            $this
        );
        verify($view->metaTags)->isEmpty();
        $manager->ogProfile('Insolita', null, null, 'female');
        verify($view->metaTags)->notEmpty();
        Debug::debug($view->metaTags);
    }
    
    public function testOgArticle()
    {
        $view = new View();
        /**@var MetaManager $manager * */
        $manager = Stub::make(
            MetaManager::class,
            [
                'getView' => Stub::once(
                    function () use ($view) {
                        return $view;
                    }
                ),
            ],
            $this
        );
        verify($view->metaTags)->isEmpty();
        //$manager->ogArticle('Insolita',Carbon::now()->toIso8601String());
        $manager->ogArticle('Insolita', date('Y-m-d\TH:i:sP'));
        verify($view->metaTags)->notEmpty();
        Debug::debug($view->metaTags);
    }
}
