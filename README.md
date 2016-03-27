# Getting started with Lo-module-eav

### 1. Установка

```bash
  "repositories": [
    {
      "type": "vcs",
      "url": "http://loveorigami@bitbucket.org/loveorigami/lo-module-eav.git"
    }
  ],
  "minimum-stability": "dev",
  "require": {
       "loveorigami/lo-module-eav": "*"
  }
```

Database schema
--------------------
Update

```bash
$ php yii migrate/up --migrationPath=@vendor/loveorigami/lo-module-eav/migrations
```

Create

```bash
$ php yii migrate/create --migrationPath=@vendor/loveorigami/lo-module-eav/migrations "eav-tbl..."

```

Configuration
------

- In your backend config file

```php
'modules'=>[
    'eav' => [
        'class' => 'lo\modules\eav\Module',
    ],
],
```

Usage of module
---

- Models must implement EavCategories interface:
```php
class SomeModel extends ActiveRecord implements yeesoft\eav\models\EavCategories
```

- Implement needed methods:
```php
public function getEavCategories()
{
  return Category::getCategories();
}

public static function getEavCategoryField()
{
  return 'category_id';
}
```

- Add EAV behavior to model:
```php
public function behaviors()
{
  return [
    'eav' => [
      'class' => \yeesoft\eav\EavBehavior::className(),
    ]
  ];
}
```

- If model uses category to separate attributes then you should specify category ID when you create model:
```php
$model = new SomeModel(['category_id' => 7]);
```

- Add EavQueryTrait to ModelQuery class:
```php
use yeesoft\eav\EavQueryTrait;
```

- Add filters to ModelSearch class:
```php
$query->andEavFilterWhere('=', 'customtext', Yii::$app->getRequest()->get('customtext'));
```

- Add fields to form view:
```php
echo $form->field($model, 'customtext')->textInput(['maxlength' => true]);

echo $form->field($model, 'customselect')->dropDownList($model->getEavAttribute('customselect')->getEavOptionsList());
```

- Add columns to GridView in index view:
```php
GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'columns' => [
    [
      'value' => function (SomeModel $model) {
        return (isset($model->input)) ? $model->input : '(not set)';
      },
      'filter' => Html::input('text', 'customtext', Yii::$app->getRequest()->get('customtext'), ['class' => 'form-control']),
    ],
])
```
