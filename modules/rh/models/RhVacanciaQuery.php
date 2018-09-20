<?php

namespace app\modules\rh\models;

/**
 * This is the ActiveQuery class for [[RhVacancia]].
 *
 * @see RhVacancia
 */
class RhVacanciaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RhVacancia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RhVacancia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
