<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "venda".
 *
 * @property int $idVenda
 * @property int $quantiaVenda
 * @property string $dataVenda
 * @property string|null $descricaoVenda
 * @property int $fk_idCarro
 *
 * @property Carro $fkIdCarro
 */
class Venda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'venda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantiaVenda', 'dataVenda', 'fk_idCarro'], 'required'],
            [['quantiaVenda', 'fk_idCarro'], 'integer'],
            [['dataVenda'], 'safe'],
            [['descricaoVenda'], 'string', 'max' => 255],
            [['fk_idCarro'], 'exist', 'skipOnError' => true, 'targetClass' => Carro::className(), 'targetAttribute' => ['fk_idCarro' => 'idCarro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idVenda' => 'Id Venda',
            'quantiaVenda' => 'Quantia Venda',
            'dataVenda' => 'Data Venda',
            'descricaoVenda' => 'Descricao Venda',
            'fk_idCarro' => 'Fk Id Carro',
        ];
    }

    /**
     * Gets query for [[FkIdCarro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdCarro()
    {
        return $this->hasOne(Carro::className(), ['idCarro' => 'fk_idCarro']);
    }
}
