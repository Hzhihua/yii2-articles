<?php

namespace hzhihua\articles\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use hzhihua\articles\models\ArticleAndCategory;

/**
 * ArticleAndCategorySearch represents the model behind the search form of `hzhihua\articles\models\ArticleAndCategory`.
 */
class ArticleAndCategorySearch extends ArticleAndCategory
{
    /**
     * @inheritdoc
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'article_id', 'category_id', 'created_at'], 'integer'],
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
        $query = ArticleAndCategory::find();

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
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
