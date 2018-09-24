<?php

namespace app\modules\rh\models;

/**
 * This is the ActiveQuery class for [[RhDescanso]].
 *
 * @see RhDescanso
 */
class RhDescansoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RhDescanso[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RhDescanso|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
