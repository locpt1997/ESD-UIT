<?php

namespace backend\controllers;

use Yii;
use backend\models\Customer;
use backend\models\search\Customer as CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\WebClient;
use yii\data\ArrayDataProvider;
use backend\models\Admin;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionKiotvietCustomer()
    {
        $client = new WebClient("anything");
        $client->setGet();
        $admin = new Admin();
        $access_token = $admin->getAccessToken();
        $url = 'https://public.kiotapi.com/customers';
        $client->setHeader("Retailer: forpets");
        $client->setHeader("Authorization: Bearer $access_token");
        $customersKiotviet = json_decode($client->createCurl($url))->data;
        $customersDB = (new \yii\db\Query())
        ->select(['name', 'code'])
        ->from('customer')
        ->all();
         foreach($customersKiotviet as  $key => $customerKiotviet)
        {
            foreach($customersDB as $customerDB)
            {
                if($customerKiotviet->name !== $customerDB['name'] ||
                    $customerKiotviet->code !== $customerDB['code']){
                    continue;
                }
                else{
                    unset($customersKiotviet[$key]);
                    break;
                }
            }
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $customersKiotviet,
        ]);
        return $this->render('kiotviet-customer', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAddKiotvietCustomer()
    {
        $count = 0;
        $ids= Yii::$app->request->post('selection');
        $client = new WebClient("anything");
        $client->setGet();
        $admin = new Admin();
        $access_token = $admin->getAccessToken();
        $url = 'https://public.kiotapi.com/customers';
        $client->setHeader("Retailer: forpets");
        $client->setHeader("Authorization: Bearer $access_token");
        $customersKiotviet = json_decode($client->createCurl($url))->data;
        foreach($ids as $id)
        {
            foreach($customersKiotviet as $customerKiotviet)
            {
                if($id == $customerKiotviet->id)
                {
                    $customer = new Customer();
                    $customer->name =  $customerKiotviet->name;
                    $customer->code = $customerKiotviet->code;
                    if(isset($customerKiotviet->gender))
                    $customer->gender = $customerKiotviet->gender;
                    if(isset($customerKiotviet->birthDate))
                    $customer->birthday = $customerKiotviet->birthDate;
                    if(isset($customerKiotviet->address))
                    $customer->address = $customerKiotviet->address;
                    if(isset($customerKiotviet->locationName))
                    $customer->location_name = $customerKiotviet->locationName;
                    if(isset($customerKiotviet->email))
                    $customer->email = $customerKiotviet->email;
                    if(isset($customerKiotviet->contactNumber))
                    $customer->contact_number = $customerKiotviet->contactNumber;
                    $customer->save();
                    $count++;
                }
            }
        }
        return $this->render('add-kiotviet-customer', [
            'model' => $ids,
            'count' => $count
        ]);
    }
    /**
     * Displays a single Customer model.
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
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Customer model.
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
     * Deletes an existing Customer model.
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
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
