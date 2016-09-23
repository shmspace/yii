<?php

namespace app\controllers\api;

use Yii;
use yii\web\Controller;
use app\models\Items;

class SiteController extends Controller
{
    public function init()
    {
        $this->enableCsrfValidation = false;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $item = new Items();
        $request = Yii::$app->request;
        $item->name = $request->post('name');
        $item->adress = $request->post('adress');
        $item->phone = $request->post('phone');
        $item->description = $request->post('description');
        $item->item_url = $request->post('item_url');
        $item->list_url = $request->post('list_url');
        $item->category = $request->post('category');
        $item->crawler = $request->post('crawler');
        $item->created_at = date("Y-m-d H:i:s", time());
        $item->updated_at = date("Y-m-d H:i:s", time());
        if ($item->save()) {
            return json_encode(["status" => "1", "id" => $item->id]);
        }else{
            return json_encode(["status" => "0"]);
        }
    }
}
