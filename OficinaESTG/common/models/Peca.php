<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "peca".
 *
 * @property int $idPeca
 * @property string $nomePeca
 * @property int $quantidadePeca
 * @property int $precoPeca
 * @property string $referenciaPeca
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
            [['nomePeca', 'quantidadePeca', 'precoPeca', 'referenciaPeca'], 'required'],
            [['quantidadePeca', 'precoPeca'], 'integer'],
            [['nomePeca'], 'string', 'max' => 45],
            [['referenciaPeca'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPeca' => 'ID',
            'nomePeca' => 'Nome',
            'quantidadePeca' => 'Quantidade',
            'precoPeca' => 'Preco',
            'referenciaPeca' => 'Referencia',
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
