<?php

namespace app\controllers;

use yii\web\Controller;
use yii\helpers\Json;
use Yii;
use yii\web\Response;

class BaseController extends Controller
{
    public $data = [];

    public function init()
    {
        $input = file_get_contents('php://input');

        parse_str($input, $arr);

        if (isset($arr['data'])) {
            $arrData = $arr['data'];
            $arrData = str_replace(array('\n', '\r', '\r\n'), '', $arrData);
            $this->data = Json::encode($arrData, true);
        }
    }

    public function afterAction($action, $result)
    {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        return $result;
    }
}