<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-12 22:52
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles\helpers;

use Yii;

/**
 * Class NotifyHelper
 * helps to turn standard bootstrap alerts into "growl" like notifications.
 *
 * @package hzhihua\articles\helpers
 * @see http://bootstrap-notify.remabledesigns.com/
 * @see https://packagist.org/packages/yii2mod/yii2-bootstrap-notify
 */
class NotifyHelper
{
    /**
     * @param $key
     * @param $message
     * @param bool $removeAfterAccess
     */
    public static function notify($key, $message, $removeAfterAccess = true)
    {
        Yii::$app->session->setFlash($key, $message, $removeAfterAccess);
    }

    /**
     * @param mixed $message
     * @param bool $removeAfterAccess
     */
    public static function success($message, $removeAfterAccess = true)
    {
        static::notify('success', $message, $removeAfterAccess);
    }

    /**
     * @param mixed $message
     * @param bool $removeAfterAccess
     */
    public static function info($message, $removeAfterAccess = true)
    {
        static::notify('info', $message, $removeAfterAccess);
    }

    /**
     * @param mixed $message
     * @param bool $removeAfterAccess
     */
    public static function warning($message, $removeAfterAccess = true)
    {
        static::notify('warning', $message, $removeAfterAccess);
    }

    /**
     * @param mixed $message
     * @param bool $removeAfterAccess
     */
    public static function error($message, $removeAfterAccess = true)
    {
        static::notify('error', $message, $removeAfterAccess);
    }

    /**
     * @param mixed $message
     * @param bool $removeAfterAccess
     */
    public static function danger($message, $removeAfterAccess = true)
    {
        static::notify('danger', $message, $removeAfterAccess);
    }


}