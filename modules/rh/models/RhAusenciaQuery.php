<?php

namespace app\modules\rh\models;

/**
 * This is the ActiveQuery class for [[RhAusencia]].
 *
 * @see RhAusencia
 */
class RhAusenciaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RhAusencia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RhAusencia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
