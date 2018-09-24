<?php

namespace app\modules\rh\models;

/**
 * This is the ActiveQuery class for [[RhAusenciaMotivo]].
 *
 * @see RhAusenciaMotivo
 */
class RhAusenciaMotivoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RhAusenciaMotivo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RhAusenciaMotivo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
