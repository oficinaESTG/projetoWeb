<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marcacao_haspecas".
 *
 * @property int $idMarcacao_hasPecas
 * @property int $fk_idPeca
 * @property int $fk_idMarcacao
 * @property int $quantidadeParaMarcacao
 *
 * @property Marcacao $fkIdMarcacao
 * @property Peca $fkIdPeca
 */
class MarcacaoHaspecas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marcacao_haspecas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_idPeca', 'fk_idMarcacao', 'quantidadeParaMarcacao'], 'required'],
            [['fk_idPeca', 'fk_idMarcacao', 'quantidadeParaMarcacao'], 'integer'],
            [['fk_idMarcacao'], 'exist', 'skipOnError' => true, 'targetClass' => Marcacao::className(), 'targetAttribute' => ['fk_idMarcacao' => 'idMarcacoes']],
            [['fk_idPeca'], 'exist', 'skipOnError' => true, 'targetClass' => Peca::className(), 'targetAttribute' => ['fk_idPeca' => 'idPeca']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idMarcacao_hasPecas' => 'Id Marcacao Has Pecas',
            'fk_idPeca' => 'Fk Id Peca',
            'fk_idMarcacao' => 'Fk Id Marcacao',
            'quantidadeParaMarcacao' => 'Quantidade Para Marcacao',
        ];
    }

    /**
     * Gets query for [[FkIdMarcacao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdMarcacao()
    {
        return $this->hasOne(Marcacao::className(), ['idMarcacoes' => 'fk_idMarcacao']);
    }

    /**
     * Gets query for [[FkIdPeca]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdPeca()
    {
        return $this->hasOne(Peca::className(), ['idPeca' => 'fk_idPeca']);
    }

    public function getPeca()
    {
        $peca = Peca::find()->where(['idPeca' => $this->fk_idPeca])->one();
        return $peca;
    }
}
