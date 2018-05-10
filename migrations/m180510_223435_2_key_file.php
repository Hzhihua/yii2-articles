<?php

use hzhihua\dump\Migration;

/**
 * Class m180510_223435_2_key_file
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180510_223435_2_key_file extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['PRIMARY'] = $this->addPrimaryKey(null, '{{%file}}', 'id');
        $this->runSuccess['addAutoIncrement'] = $this->addAutoIncrement('{{%file}}', 'id', 'integer', '', 10);
        $this->runSuccess['file_key'] = $this->createIndex('file_key', '{{%file}}', 'file_key', 1);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('addAutoIncrement' === $keyName) {
                continue;
            } elseif ('PRIMARY' === $keyName) {
                // must be remove auto_increment before drop primary key
                if (isset($this->runSuccess['addAutoIncrement'])) {
                    $value = $this->runSuccess['addAutoIncrement'];
                    $this->dropAutoIncrement("{$value['table_name']}", $value['column_name'], $value['column_type'], $value['property']);
                }
                $this->dropPrimaryKey(null, '{{%file}}');
            } elseif (!empty($keyName)) {
                $this->dropIndex("`$keyName`", '{{%file}}');
            }
        }

    }
}
