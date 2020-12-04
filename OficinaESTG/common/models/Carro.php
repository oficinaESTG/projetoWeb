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
 * @property int $quilometros
 * @property string $combustivel
 * @property int $fk_idPessoa
 * @property int|null $precoCarro
 *
 * @property Pessoa $fkIdPessoa
 * @property Marcacao[] $marcacaos
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
            [['modeloCarro', 'marcaCarro', 'ano', 'tipoCarro', 'quilometros', 'combustivel', 'fk_idPessoa'], 'required'],
            [['ano', 'quilometros', 'fk_idPessoa', 'precoCarro'], 'integer'],
            [['tipoCarro', 'combustivel'], 'string'],
            [['modeloCarro', 'marcaCarro', 'matricula'], 'string', 'max' => 45],
            [['ano'], 'integer', 'max'=>2020, 'min'=>1900],
            [['quilometros'], 'integer', 'max'=>1000000, 'min'=>0],
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
            'quilometros' => 'Quilometros',
            'combustivel' => 'Combustivel',
            'fk_idPessoa' => 'Fk Id Pessoa',
            'precoCarro' => 'Preco Carro',
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
     * Gets query for [[Marcacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaos()
    {
        return $this->hasMany(Marcacao::className(), ['fk_idCarro' => 'idCarro']);
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
