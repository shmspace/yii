<?php

namespace app\controllers\api;

use Yii;
use yii\web\Controller;
use app\models\Items;
use app\models\Tasks;
use app\models\ItemTasks;
use app\models\CrawlerLog;

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
     * add item api.
     *
     * @return string
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if($request->post("name") == ""){
            return json_encode(["status" => "-1"]);
        }
        $pre_items = Items::FindAll(["item_url" => $request->post('item_url')]);
        if(count($pre_items) == 0){
            $item = new Items();
        }else{
            $item = $pre_items[0];
        }

        $item->name = $request->post('name');
        $item->adress = $request->post('adress');
        $item->phone = $request->post('phone');
        $item->description = substr($request->get('description'), 0, 200);
        $item->item_url = $request->post('item_url');
        $item->list_url = $request->post('list_url');
        $item->category = $request->post('category');
        $item->crawler = $request->post('crawler');
        if(count($pre_items) == 0){
            $item->created_at = date("Y-m-d H:i:s", time());
        }
        $item->updated_at = date("Y-m-d H:i:s", time());
        //print_r($item->attributes);
        if ($item->save(false)) {
            if($item->name != '' && $item->adress != '' && $item->phone != ''){
                $it_status = 1;
            }else{
                $it_status = -1;
            }
            $item_tasks = ItemTasks::FindAll(["id" => $request->post("item_tasks_id")]);
            if(count($item_tasks) > 0){
                $item_tasks[0]->status = $it_status;
                $item_tasks[0]->updated_at = date("Y-m-d H:i:s", time());
                $item_tasks[0]->save(false);
            }

            return json_encode(["status" => "1", "id" => $item->id,
                "item_task_id" => $request->post("item_tasks_id")]);
        }else{
            return json_encode(["status" => "0"]);
        }
    }

    /**
     * find task api
     *
     */
    public function actionTasks()
    {
        $crawler = Yii::$app->request->get("crawler");
        $tasks = Tasks::findAll(["crawler" => $crawler]);
        return json_encode(["status" => '1', "tasks" => $tasks[0]->toArray()]);
    }


    /**
     * insert item tasks
     *
     */
    public function actionAddit()
    {
        $request = Yii::$app->request;
        $status = 0;
        $item_status = 0;
        $pre_its = ItemTasks::FindAll(["url" => $request->post("url")]);
        if(count($pre_its) == 0){
            $item_task = new ItemTasks();
            $item_task->tasks_id = $request->post("tasks_id");
            $item_task->url = $request->post("url");
            $item_task->page_url = $request->post("page_url");
            $item_task->page = $request->post("page");
            $item_task->status = $status;
            $item_task->crawler = $request->post("crawler");
            $item_task->created_at = date("Y-m-d H:i:s", time());
            $item_task->updated_at = date("Y-m-d H:i:s", time());
            $item_task->save(false);
            $items_id = $item_task->id;
        }else{
            $status = -1;
            $item_status = $pre_its[0]->status;
            $items_id = $pre_its[0]->id;
        }
        $log = new CrawlerLog();
        $log->crawler = $request->post("crawler");
        $log->tasks_id = $request->post("tasks_id");
        $log->items_id = $items_id;
        $log->item_url = $request->post("url");
        $log->task_url = $request->post("page_url");
        $log->logs = $status;
        $log->created_at = date("Y-m-d H:i:s", time());
        $log->updated_at = date("Y-m-d H:i:s", time());
        $rs = $log->save(false);

        return json_encode(["status" => $status, "item_status" => $item_status,
            "items_id" => $items_id, "log_id" => $log->id]);
    }

    /**
     * 查询items
     *
     */
    public function actionFind()
    {
        $request = Yii::$app->request;
        $max_id = $request->get("max_id");
        $items = Items::findBySql("select id, name, phone, adress, description, item_url from items where id > ".$max_id." limit 10")->all();
        $result = array();
        foreach($items as $key => $item){
            $result[] = $item->attributes;
        }

        return json_encode($result);
    }
}
