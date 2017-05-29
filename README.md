Yii2 meta-crumbs pack
=====================
alternative way for work with breadcrumbs and metadata with open-graph-protocol helpers

also include NoLayoutBehavior for registration actions where layout must be skipped

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require --prefer-dist insolita/yii2-metacrumbs "~0.0.1"
```

or add

```
"insolita/yii2-metacrumbs": "~0.0.1"
```

to the require section of your `composer.json` file.


Usage
-----

 - register MetaCrumbsBootstrap, or manual register as singleton  :

```php
 \Yii::$container->setSingleton(IBreadcrumbCollection::class,BreadCrumbs::class);
 ```
and/or
```
 \Yii::$container->setSingleton(IMetaManager::class,MetaManager::class);

```

 - add widget in layout
 ```php
       <?= \insolita\metacrumbs\widgets\CrumbWidget::widget([]) ?>
 ```

 - add CrumbedControllerTrait in base controller (or in needed controllers) and register crumbs
 - add MetaManagerTrait in needed controllers or base controller (also in service possible)

 Controller Example

 ```php
 class ExampleController extends Controller
 {
     use CrumbedControllerTrait;
     use MetaManagerTrait;

     public function actions()
     {
         return [
             'error'   => [
                 'class' => 'yii\web\ErrorAction',
             ],
         ];
     }

    public function behaviors()
    {
        return [
            'nolayout'=>['class'=>NoLayoutBehavior::class,'actions' => ['ajax']]
            // 'nolayout'=>['class'=>NoLayoutBehavior::class,'actions' => ['index','about'],'except'=>true]

        ];
    }
     public function beforeAction($action)
     {
         $this->registerHomeCrumb();
         $this->registerIndexCrumb('Сайтег');
         if ($action->id == 'error') {
             $this->registerCurrentCrumb('Страница ошибок');
             $this->metaManager()->canonical();
         }
         return parent::beforeAction($action);
     }

    public function actionIndex()
    {
        $this->metaManager()->canonical(Url::to(['example/default']));
        $this->metaManager()->tag('description', 'Bla-bla-la-la-la');
        $this->metaManager()->prop('og:description', 'Bla-bla-bla');
        $this->metaManager()->prop('og:title', 'Bla-bla-bla');
        $this->metaManager()->keywords('Some, keywords,list');
        //Also
        return $this->render('index');
    }
     public function actionView(int $id)
     {
          $this->crumbCollection->addCrumb(
                new CrumbItem('Special crumb', Url::to(['some/page']), 20, ['target' => '_blank'])
           );
          $model = $this->pageFinder->findById($id);
          $this->registerCurrentCrumb($model->title);
          $this->metaManager()->ogMeta($model->title,Url::current([],true),$model->description,$model->cover,'article');
          return $this->render('about',['model'=>$model]);
     }

     ....
 ```