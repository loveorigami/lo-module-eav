<?php

namespace lo\modules\eav\modules\admin\controllers;

use lo\modules\eav\models\EavAttribute;
use lo\modules\eav\models\EavCategories;
use lo\modules\eav\models\EavEntity;
use lo\modules\eav\models\EavEntityAttribute;
use lo\modules\eav\models\EavEntityModel;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\Controller;

/**
 * EavEntityController implements the CRUD actions for yeesoft\eav\models\EavEntity model.
 */
class DefaultController extends Controller
{
    //public $enableOnlyActions = ['index', 'get-attributes', 'set-attributes', 'get-categories'];

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'get-attributes' => ['post'],
                    'get-categories' => ['post'],
                    'set-attributes' => ['post'],
                ],
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (in_array($action->id, ['get-attributes', 'get-categories'])) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Lists all models.
     * @return mixed
     */
    public function actionIndex()
    {
        $entityModels = EavEntityModel::find()->orderBy('entity_name')->all();
        $entityModels = ArrayHelper::map($entityModels, 'id', function ($model) {
            return "{$model->entity_name} [{$model->entity_model}]";
        });

        return $this->renderIsAjax('index', compact('entityModels'));
    }

    public function actionSetAttributes()
    {
        if (Yii::$app->getRequest()->isAjax) {

            $modelId = (int)Yii::$app->getRequest()->post('model_id');
            $attributes = Yii::$app->getRequest()->post('attributes');
            $categoryId = Yii::$app->getRequest()->post('category_id');
            $categoryId = ($categoryId && !empty($categoryId)) ? $categoryId : null;

            $entity = EavEntity::findOne(['model_id' => $modelId, 'category_id' => $categoryId]);

            if (!$entity) {
                try {
                    $entity = new EavEntity(['model_id' => $modelId, 'category_id' => $categoryId]);
                    $entity->save();
                } catch (\Exception $exc) {
                    return false;
                }
            }

            Yii::$app->db->createCommand()->delete(EavEntityAttribute::tableName(), "entity_id = :entityId", [':entityId' => $entity->id])->execute();

            if (is_array($attributes)) {
                foreach ($attributes as $order => $attributeId) {
                    Yii::$app->db->createCommand()->insert(EavEntityAttribute::tableName(), [
                        'entity_id' => $entity->id,
                        'attribute_id' => $attributeId,
                        'order' => $order,
                        'author_id' => 1,
                        'updater_id' => 1,
                        'created_at' => time(),
                        'updated_at' => time(),
                    ])->execute();
                }
            }
        }

        return false;
    }

    public function actionGetAttributes()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (!$modelId = Yii::$app->getRequest()->post('model_id')) {
            return null;
        }

        $params['model_id'] = (int)$modelId;
        $category_id = Yii::$app->getRequest()->post('category_id');
        $params['category_id'] = ($category_id) ? $category_id : null;

        $entity = EavEntity::findOne($params);

        if (!$entity) {
            try {
                $entity = new EavEntity($params);
                $entity->save();
            } catch (\Exception $exc) {
                return false;
            }
        }

        $querySelected = $entity->getEavAttributes()->orderBy('label')->limit(null);
        $queryAvailable = clone $querySelected;
        $selectedDataProvider = new ActiveDataProvider(['query' => $querySelected]);

        $ids = $queryAvailable->select('id')->all();
        $ids = array_map(function ($item) {
            return $item->id;
        }, $ids);
        $ids = (!empty($ids)) ? implode(', ', $ids) : '0';

        $availableDataProvider = new ActiveDataProvider([
            'query' => EavAttribute::find()->where("id NOT IN ($ids)")->limit(null)
        ]);

        $selected = $this->renderIsAjax('attributes', ['dataProvider' => $selectedDataProvider]);
        $available = $this->renderIsAjax('attributes', ['dataProvider' => $availableDataProvider]);

        return ['available' => $available, 'selected' => $selected];
    }

    public function actionGetCategories()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model_id = (int)Yii::$app->getRequest()->post('model_id');
        $model = EavEntityModel::findOne($model_id);

        if ($model) {
            try {
                $model = new $model->entity_model;

                if ($model instanceof EavCategories) {
                    $categories = $model->getEavCategories();

                    if ($categories && !empty($categories)) {
                        $categories = ArrayHelper::merge(['' => Yii::t('eav', 'Not Selected')], $categories);
                        $dropDown = Html::dropDownList('entityCategory', null, $categories, ['id' => 'entityCategory']);
                        return ['list' => $dropDown];
                    }
                }
            } catch (\Exception $exc) {
                return null;
            }
        }

        return null;
    }

    /**
     * Render ajax or usual depends on request
     *
     * @param string $view
     * @param array $params
     *
     * @return string|\yii\web\Response
     */
    protected function renderIsAjax($view, $params = [])
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax($view, $params);
        } else {
            return $this->render($view, $params);
        }
    }
}