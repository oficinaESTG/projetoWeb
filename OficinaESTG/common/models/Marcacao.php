<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "marcacao".
 *
 * @property int $idMarcacoes
 * @property string $tipoMarcacao
 * @property string $dataMarcacao
 * @property string $descricaoMarcacao
 * @property string $estadoMarcacao
 * @property int $fk_idPessoa
 * @property int $fk_idCarro
 * @property int|null $fk_idResponsavel
 * @property int|null $valorFinal
 * @property string $descricaoFinal
 *
 * @property Carro $fkIdCarro
 * @property Pessoa $fkIdPessoa
 * @property Pessoa $fkIdResponsavel
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
            [['tipoMarcacao', 'dataMarcacao', 'descricaoMarcacao', 'estadoMarcacao', 'fk_idPessoa', 'fk_idCarro'], 'required'],
            [['tipoMarcacao', 'estadoMarcacao', 'descricaoFinal'], 'string'],
            [['dataMarcacao'], 'safe'],
            [['fk_idPessoa', 'fk_idCarro', 'fk_idResponsavel', 'valorFinal'], 'integer'],
            [['descricaoMarcacao'], 'string', 'max' => 255],
            [['fk_idCarro'], 'exist', 'skipOnError' => true, 'targetClass' => Carro::className(), 'targetAttribute' => ['fk_idCarro' => 'idCarro']],
            [['fk_idPessoa'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::className(), 'targetAttribute' => ['fk_idPessoa' => 'idPessoa']],
            [['fk_idResponsavel'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::className(), 'targetAttribute' => ['fk_idResponsavel' => 'idPessoa']],
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
            'fk_idCarro' => 'Fk Id Carro',
            'fk_idResponsavel' => 'Fk Id Responsavel',
            'valorFinal' => 'Valor Final',
            'descricaoFinal' => 'Descricao Final',
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
     * Gets query for [[FkIdResponsavel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdResponsavel()
    {
        return $this->hasOne(Pessoa::className(), ['idPessoa' => 'fk_idResponsavel']);
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

    public function getPessoa(){
       $pessoa = Pessoa::find()->where(['idPessoa' => $this->fk_idPessoa])->one();
       return $pessoa;
    }

}
