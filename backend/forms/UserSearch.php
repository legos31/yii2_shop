<?php

namespace backend\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\User;

/**
 * userSearch represents the model behind the search form of `shop\entities\user`.
 */
class UserSearch extends Model
{
    public $id;
    public $status;
    public $username;
    public $email;
    public $created_at;
    public $date_from;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at'], 'integer'],
            [['username', 'email', 'created_at'], 'safe'],
            [['date_from'], 'date', 'format' => 'php:Y-m-d'],
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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ;

        return $dataProvider;
    }
}
