<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carro".
 *
 * @property int $idCarro
 * @property string $modeloCarro
 * @property string $marcaCarro
 * @property int $ano
 * @property string|null $matricula
 * @property string $tipoCarro
 * @property int $fk_idPessoa
 *
 * @property Pessoa $fkIdPessoa
 * @property Venda[] $vendas
 */
class Carro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['modeloCarro', 'marcaCarro', 'ano', 'tipoCarro', 'fk_idPessoa'], 'required'],
            [['ano', 'fk_idPessoa'], 'integer'],
            [['tipoCarro'], 'string'],
            [['modeloCarro', 'marcaCarro', 'matricula'], 'string', 'max' => 45],
            [['fk_idPessoa'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::className(), 'targetAttribute' => ['fk_idPessoa' => 'idPessoa']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCarro' => 'Id Carro',
            'modeloCarro' => 'Modelo Carro',
            'marcaCarro' => 'Marca Carro',
            'ano' => 'Ano',
            'matricula' => 'Matricula',
            'tipoCarro' => 'Tipo Carro',
            'fk_idPessoa' => 'Fk Id Pessoa',
        ];
    }

    /**
     * Gets query for [[FkIdPessoa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdPessoa()
    {
        return $this->hasOne(Pessoa::className(), ['idPessoa' => 'fk_idPessoa']);
    }

    /**
     * Gets query for [[Vendas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVendas()
    {
        return $this->hasMany(Venda::className(), ['fk_idCarro' => 'idCarro']);
    }
}
