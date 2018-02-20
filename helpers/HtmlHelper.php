<?php
/**
 * @Author: Hzhihua
 * @Time: 2018/1/27 22:15
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles\helpers;

use Yii;

class HtmlHelper extends \yii\helpers\Html
{
    /**
     * 遍历生成meta标签
     * @param array $options
     * @return string
     */
    public static function metaAll(array $options)
    {
        $meta = self::tag('meta', '', ['charset' => Yii::$app->charset]);
        foreach ($options as $option) {
            $meta .= self::tag('meta', '', $option);
        }
        return $meta . self::csrfMetaTag();
    }

    /**
     * Convert special HTML entities back to characters
     * @param string $html
     * @return string
     * @see http://php.net/manual/zh/function.htmlspecialchars-decode.php
     */
    public static function htmlDecode($html)
    {
        return htmlspecialchars_decode($html);
    }

    /**
     * Convert special characters to HTML entities
     * @param string $html
     * @return string
     * @see http://php.net/manual/zh/function.htmlspecialchars.php
     */
    public static function htmlEncode($html)
    {
        return htmlspecialchars($html);
    }

    /**
     * @param string $html
     * @return string
     * @see http://php.net/manual/zh/function.strip-tags.php
     */
    public static function removeHtmlTags($html, $allowable_tags=null)
    {
        return strip_tags($html, $allowable_tags);
    }

}