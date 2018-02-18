<?php
/**
 * @Author: Hzhihua
 * @Time: 2018/1/29 11:43
 * @Github: https://github.com/Hzhihua
 */


namespace hzhihua\articles\helpers;

use Yii;

/**
 * Class DateHelper
 *
 * 时间日期显示格式
 *
 * @package hzhihua\articles\helpers
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class DateHelper
{
    /**
     * @param int $timestamp
     * @param string $format
     * @return false|string
     */
    public static function show($timestamp, $format = '')
    {
        if (empty($format)) {
            $format = Yii::$app->controller->module->dateFormat;
        }
        return date($format, $timestamp);
    }
}