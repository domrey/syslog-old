<?php

namespace app\modules\rh\models;

/**
 * This is the ActiveQuery class for [[RhMovimiento]].
 *
 * @see RhMovimiento
 */
class RhMovimientoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RhMovimiento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RhMovimiento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
