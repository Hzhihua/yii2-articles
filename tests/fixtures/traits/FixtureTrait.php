<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-6 10:45
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles\tests\fixtures\traits;


use hzhihua\articles\tests\fixtures\ArticleFixture;
use hzhihua\articles\tests\fixtures\ArticleTagFixture;
use hzhihua\articles\tests\fixtures\ArticleAndTagFixture;
use hzhihua\articles\tests\fixtures\ArticleStatusFixture;
use hzhihua\articles\tests\fixtures\ArticleCategoryFixture;
use hzhihua\articles\tests\fixtures\ArticleAndCategoryFixture;

/**
 * Trait FixtureTrait
 *
 * @package hzhihua\articles\tests\fixtures\traits
 * @see https://codeception.com/for/yii
 */
trait FixtureTrait
{

    protected function _before()
    {
        // tests/_data/../fixture/data
        $dataDir = codecept_data_dir() . '../fixtures/data';

        $this->tester->haveFixtures([
            'Article' => [
                'class' => ArticleFixture::className(),
                'dataFile' => $dataDir . '/ArticleData.php',
            ],
            'ArticleStatus' => [
                'class' => ArticleStatusFixture::className(),
                'dataFile' => $dataDir . '/ArticleStatusData.php',
            ],
            'ArticleCategory' => [
                'class' => ArticleCategoryFixture::className(),
                'dataFile' => $dataDir . '/ArticleCategoryData.php',
            ],
            'ArticleAndCategory' => [
                'class' => ArticleAndCategoryFixture::className(),
                'dataFile' => $dataDir . '/ArticleAndCategoryData.php',
            ],
            'ArticleTag' => [
                'class' => ArticleTagFixture::className(),
                'dataFile' => $dataDir . '/ArticleTagData.php',
            ],
            'ArticleAndTag' => [
                'class' => ArticleAndTagFixture::className(),
                'dataFile' => $dataDir . '/ArticleAndTagData.php',
            ],
        ]);

        // get first user from ArticleFixture
        // $this->tester->grabFixture('Article', 0);

    }

    protected function _after()
    {
    }
}