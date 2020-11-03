<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marcacao".
 *
 * @property int $idMarcacoes
 * @property string $tipoMarcacao
 * @property string $dataMarcacao
 * @property string $descricaoMarcacao
 * @property string $estadoMarcacao
 * @property int $fk_idPessoa
 *
 * @property Pessoa $fkIdPessoa
 * @property MarcacaoHaspecas[] $marcacaoHaspecas
 */
class Marcacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marcacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipoMarcacao', 'dataMarcacao', 'descricaoMarcacao', 'estadoMarcacao', 'fk_idPessoa'], 'required'],
            [['tipoMarcacao', 'estadoMarcacao'], 'string'],
            [['dataMarcacao'], 'safe'],
            [['fk_idPessoa'], 'integer'],
            [['descricaoMarcacao'], 'string', 'max' => 255],
            [['fk_idPessoa'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::className(), 'targetAttribute' => ['fk_idPessoa' => 'idPessoa']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idMarcacoes' => 'Id Marcacoes',
            'tipoMarcacao' => 'Tipo Marcacao',
            'dataMarcacao' => 'Data Marcacao',
            'descricaoMarcacao' => 'Descricao Marcacao',
            'estadoMarcacao' => 'Estado Marcacao',
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
     * Gets query for [[MarcacaoHaspecas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaoHaspecas()
    {
        return $this->hasMany(MarcacaoHaspecas::className(), ['fk_idMarcacao' => 'idMarcacoes']);
    }
}
