<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pessoa".
 *
 * @property int $idPessoa
 * @property string $nome
 * @property string $dataNascimento
 * @property string $morada
 * @property int $nif
 * @property string $tipoPessoa
 * @property string $email
 *
 * @property Carro[] $carros
 * @property Marcacao[] $marcacaos
 */
class Pessoa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'dataNascimento', 'morada', 'nif', 'tipoPessoa', 'email'], 'required'],
            [['dataNascimento'], 'safe'],
            [['nif'], 'integer'],
            [['tipoPessoa'], 'string'],
            [['nome', 'morada', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPessoa' => 'Id Pessoa',
            'nome' => 'Nome',
            'dataNascimento' => 'Data Nascimento',
            'morada' => 'Morada',
            'nif' => 'Nif',
            'tipoPessoa' => 'Tipo Pessoa',
            'email' => 'Email',
        ];
    }

    /**
     * Gets query for [[Carros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarros()
    {
        return $this->hasMany(Carro::className(), ['fk_idPessoa' => 'idPessoa']);
    }

    /**
     * Gets query for [[Marcacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaos()
    {
        return $this->hasMany(Marcacao::className(), ['fk_idPessoa' => 'idPessoa']);
    }
}
