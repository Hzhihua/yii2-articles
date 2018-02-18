<?php

namespace hzhihua\articles\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use hzhihua\articles\models\ArticleAndTag;

/**
 * ArticleAndTagSearch represents the model behind the search form of `hzhihua\articles\models\ArticleAndTag`.
 */
class ArticleAndTagSearch extends ArticleAndTag
{
    /**
     * @inheritdoc
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'article_id', 'tag_id', 'created_at'], 'integer'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ArticleAndTag::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'article_id' => $this->article_id,
            'tag_id' => $this->tag_id,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
