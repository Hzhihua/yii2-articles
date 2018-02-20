<?php

use hzhihua\dump\Migration;

/**
 * Class m180210_093422_2_key_article_category
 * @property \yii\db\Transaction $_transaction
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class m180210_093422_2_key_article_category extends Migration
{

	/**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->addPrimaryKey(null, '{{%article_category}}', 'id');
        $this->addAutoIncrement('{{%article_category}}', 'id', 'integer');

    }

	/**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('PRIMARY' === $keyName) {
                $this->dropPrimaryKey(null, '{{%article_category}}');
            } else {
                $this->dropIndex($keyName, '{{%article_category}}');
            }
        }

    }
}
