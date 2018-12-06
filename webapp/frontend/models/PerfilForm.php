<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\perfil;

/**
 * PerfilSearch represents the model behind the search form of `common\models\perfil`.
 */
class PerfilSearch extends perfil
{
    public $nome;
    public $nif;
    public $morada;
    public $localidade;
    public $nacionalidade;
    public $contacto;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_tipo'], 'integer'],
            [['nif'], 'number'],
            [['nome', 'morada', 'localidade', 'nacionalidade', 'contacto'], 'safe'],
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
    public function search($params)
    {
        $query = perfil::find();

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
            'id_user' => $this->id_user,
            'id_tipo' => $this->id_tipo,
            'nif' => $this->nif,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'morada', $this->morada])
            ->andFilterWhere(['like', 'localidade', $this->localidade])
            ->andFilterWhere(['like', 'nacionalidade', $this->nacionalidade])
            ->andFilterWhere(['like', 'contacto', $this->contacto]);

        return $dataProvider;
    }
}

