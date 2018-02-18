<?php

use Codeception\Test\Unit;
use hzhihua\articles\models\Article;
use hzhihua\articles\models\ArticleTag;
use hzhihua\articles\models\ArticleStatus;
use hzhihua\articles\models\ArticleCategory;
use hzhihua\articles\tests\fixtures\traits\FixtureTrait;

class ArticleTest extends Unit
{
    use FixtureTrait;

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * test get articleStatus
     */
    public function testGetArticleStatus()
    {
        $error_msg = sprintf("测试[\\%s查询文章状态信息]失败", ArticleStatus::className());
        $data = Article::find()->with('articleStatus')->asArray()->all();
        expect($error_msg, $data[0]['title'])->equals('title_1');
        expect($error_msg, $data[0]['articleStatus']['name'])->equals('待审核');
        expect($error_msg, $data[1]['title'])->equals('title_2');
        expect($error_msg, $data[1]['articleStatus']['name'])->equals('已审核');
    }

    /**
     * test get articleCategory
     */
    public function testGetArticleCategory()
    {

        $error_msg = sprintf("测试[\\%s查询文章分类信息]失败", ArticleCategory::className());

        $data = Article::find()->with('articleAndCategory')->asArray()->all();

        expect($error_msg, $data[0]['title'])->equals('title_1');
        expect($error_msg, $data[0]['articleAndCategory'][1]['articleCategory']['name'])->equals('Python');

        expect($error_msg, $data[1]['title'])->equals('title_2');
        expect($error_msg, $data[1]['articleAndCategory'][0]['articleCategory']['name'])->equals('PHP');

    }

    /**
     * test get articleCategory
     */
    public function testGetArticleTag()
    {

        $error_msg = sprintf("测试[\\%s查询文章标签云信息]失败", ArticleTag::className());

        $data = Article::find()->with('articleAndTag')->asArray()->all();

        expect($error_msg, $data[0]['title'])->equals('title_1');
        expect($error_msg, $data[0]['articleAndTag'][1]['articleTag']['name'])->equals('Python tag');

        expect($error_msg, $data[1]['title'])->equals('title_2');
        expect($error_msg, $data[1]['articleAndTag'][0]['articleTag']['name'])->equals('PHP tag');

    }

}