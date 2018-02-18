<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-18 23:40
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles;


class MarkdownEditor
{
    private $_data = [];

    public function __construct(array $data)
    {
        $this->_data = $data;
        $this->_data['Article']['content'] = $this->getContent();
    }

    public function getContent()
    {
        return $this->_data['article-content-html-code'];
    }

    public function getData()
    {
        return $this->_data;
    }
}