<?php

namespace app\modules\rh\models;

/**
 * This is the ActiveQuery class for [[RhPlaza]].
 *
 * @see RhPlaza
 */
class RhPlazaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RhPlaza[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RhPlaza|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
