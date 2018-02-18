<?php

namespace hzhihua\articles\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hzhihua\articles\models\ArticleStatus;

/**
 * ArticleStatusSearch represents the model behind the search form of `hzhihua\articles\models\ArticleStatus`.
 */
class ArticleStatusSearch extends ArticleStatus
{
    /**
     * @inheritdoc
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'child', 'is_allow_public', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'safe'],
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
        $query = ArticleStatus::find();

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
            'child' => $this->child,
            'is_default_status' => $this->is_default_status,
            'is_allow_public' => $this->is_allow_public,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
