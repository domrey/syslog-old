<?php

namespace app\modules\rh\models;

/**
 * This is the ActiveQuery class for [[RhPuesto]].
 *
 * @see RhPuesto
 */
class RhPuestoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RhPuesto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RhPuesto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
