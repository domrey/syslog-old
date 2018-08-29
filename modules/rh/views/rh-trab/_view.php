<?php
    use yii\helpers\Html;
?>
<div class="view">
<p><strong>F-<?= $model['clave'] ?></strong> &nbsp;
     <em><?= Html::a($model['fullName'], ['rh-trab/view', 'id' => $model['clave']]) ?></em>
</p>
</div>
