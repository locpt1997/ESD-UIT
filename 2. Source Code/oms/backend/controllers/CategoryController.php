<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\search\Category as CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Admin;
use common\models\WebClient;
use yii\data\ArrayDataProvider;
/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionKiotvietCategory()
    {
        $client = new WebClient("anything");
        $client->setGet();
        $admin = new Admin();
        $access_token = $admin->getAccessToken();
        $url = 'https://public.kiotapi.com/categories';
        $client->setHeader("Retailer: forpets");
        $client->setHeader("Authorization: Bearer $access_token");
        $categoriesKiotviet = json_decode($client->createCurl($url))->data;
        $categoriesDB = (new \yii\db\Query())
                        ->select(['id', 'name'])
                        ->from('category')
                        ->all();
        foreach($categoriesKiotviet as  $key => $categoryKiotviet)
        {
            foreach($categoriesDB as $categoryDB)
            {
                if($categoryKiotviet->categoryName !== $categoryDB['name']){
                    continue;
                }
                else{
                    unset($categoriesKiotviet[$key]);
                    break;
                }
            }
            
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $categoriesKiotviet,
        ]);
        return $this->render('kiotviet-category', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddKiotvietCategory()
    {
        $count = 0;
        $ids= Yii::$app->request->post('selection');
        $client = new WebClient("anything");
        $client->setGet();
        $admin = new Admin();
        $access_token = $admin->getAccessToken();
        $url = 'https://public.kiotapi.com/categories';
        $client->setHeader("Retailer: forpets");
        $client->setHeader("Authorization: Bearer $access_token");
        $categoriesKiotviet = json_decode($client->createCurl($url))->data;
        foreach($ids as $key => $id)
        {
            foreach($categoriesKiotviet as $categoryKiotviet)
            {
                if($id == $categoryKiotviet->categoryId)
                {
                    $category = new Category();
                    $category->id = $categoryKiotviet->categoryId;
                    $category->name =  $categoryKiotviet->categoryName;
                    $category->save();
                    $count++;
                }
            }
        }
        return $this->render('add-kiotviet-category', [
            'model' => $ids,
            'count' => $count
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
