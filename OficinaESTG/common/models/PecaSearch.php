<?php

use common\models\Peca;
use yii\data\ActiveDataProvider;

class PecaSearch extends \common\models\Peca
{

    public function rules()
    {
        return parent::rules();
    }

    public function search($param)
    {

        $query = Peca::find()->where(['referencia' => $param]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($param);


        return $dataProvider;
    }


}