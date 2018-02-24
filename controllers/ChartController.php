<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-21 21:21
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles\controllers;


use yii\web\Controller;

class ChartController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}