<?php

namespace hzhihua\articles\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hzhihua\articles\models\ArticleTag;

/**
 * ArticleTagSearch represents the model behind the search form of `hzhihua\articles\models\ArticleTag`.
 */
class ArticleTagSearch extends ArticleTag
{
    /**
     * @inheritdoc
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description'], 'safe'],
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
        $query = ArticleTag::find();

        $query->where(['created_by' => $this->userId]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]]
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
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
