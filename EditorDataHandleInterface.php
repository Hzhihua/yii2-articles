<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-19 23:59
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles;


interface EditorDataHandleInterface
{
    /**
     * get data which had been handle for post method
     * @return array|mixed
     * @see \hzhihua\articles\MarkdownEditor
     */
    public static function getEditorDataHandle();
}