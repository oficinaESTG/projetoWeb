<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "peca".
 *
 * @property int $idPeca
 * @property string $nomePeca
 * @property string $quantidadePeca
 * @property string $precoPeca
 *
 * @property MarcacaoHaspecas[] $marcacaoHaspecas
 */
class Peca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'peca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomePeca', 'quantidadePeca', 'precoPeca'], 'required'],
            [['nomePeca', 'quantidadePeca', 'precoPeca'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPeca' => 'Id Peca',
            'nomePeca' => 'Nome Peca',
            'quantidadePeca' => 'Quantidade Peca',
            'precoPeca' => 'Preco Peca',
        ];
    }

    /**
     * Gets query for [[MarcacaoHaspecas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaoHaspecas()
    {
        return $this->hasMany(MarcacaoHaspecas::className(), ['fk_idPeca' => 'idPeca']);
    }
}
