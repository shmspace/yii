<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\CrawlerLog;
use app\models\Items;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
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
        $rs = Array();

        $connection = Yii::$app->db;
        $sql = "select count(id) as need_item_num from items where phone not in (select phone from items where id = 159278) and id > 280173;";
        $command = $connection->createCommand($sql);
        $item_num = $command->queryOne();

        $last_id = Items::find()->orderBy("id desc")->one()->id;
        $item_num["item_num"] = $last_id - 280173;
        $rs[] = $item_num;

        $log = CrawlerLog::find()->where(['crawler' => 'crawler03'])->orderBy('id desc')->one();
        if($log) $rs[] = $log->getAttributes();

        $log = CrawlerLog::find()->where(['crawler' => 'crawler04'])->orderBy('id desc')->one();
        if($log) $rs[] = $log->getAttributes();

        $log = CrawlerLog::find()->where(['crawler' => 'crawler05'])->orderBy('id desc')->one();
        if($log) $rs[] = $log->getAttributes();

        $log = CrawlerLog::find()->where(['crawler' => 'crawler06'])->orderBy('id desc')->one();
        if($log) $rs[] = $log->getAttributes();

        $log = CrawlerLog::find()->where(['crawler' => 'crawler07'])->orderBy('id desc')->one();
        if($log) $rs[] = $log->getAttributes();

        $log = CrawlerLog::find()->where(['crawler' => 'crawler08'])->orderBy('id desc')->one();
        if($log) $rs[] = $log->getAttributes();

        $log = CrawlerLog::find()->where(['crawler' => 'crawler09'])->orderBy('id desc')->one();
        if($log) $rs[] = $log->getAttributes();

        return str_replace("{", "</br>", str_replace("}", "</br>", str_replace(",", "</br>", json_encode($rs))));
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = 'Hello')
    {
        return $this->render('say', ['message' => $message]);
    }

    public function actionEntry()
    {
        $model = new EntryForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 验证 $model 收到的数据
            // 做些有意义的事 ...
            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // 无论是初始化显示还是数据验证错误
            return $this->render('entry', ['model' => $model]);
        }
    }
}
