<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CanilAnimal;
use common\models\Animal;

/**
 * CanilAnimalSearch represents the model behind the search form of `common\models\CanilAnimal`.
 */
class CanilAnimalSearch extends CanilAnimal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_Animal', 'id_Canil', 'estado'], 'integer'],
            [['descricao', 'created_at', 'updated_at', 'animal.nome'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $perfil)
    {
        $query = $perfil->getCanilAnimals();

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
            'id_animal' => $this->animal,
            'id_Canil' => $this->canil,
            'estado' => $this->estado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'id_animal', $this->animal]);

        return $dataProvider;
    }
}
