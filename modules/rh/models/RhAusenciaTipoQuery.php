<?php

namespace app\modules\rh\models;

/**
 * This is the ActiveQuery class for [[RhAusenciaTipo]].
 *
 * @see RhAusenciaTipo
 */
class RhAusenciaTipoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RhAusenciaTipo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RhAusenciaTipo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
