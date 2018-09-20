<?php

namespace app\modules\rh\models;

/**
 * This is the ActiveQuery class for [[RhTrab]].
 *
 * @see RhTrab
 */
class RhTrabQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RhTrab[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RhTrab|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
