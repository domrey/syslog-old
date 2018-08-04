<?php
    use yii\helpers\Html;
?>
<hr>
<div class="view">
<p><strong>F-<?= $model['clave'] ?></strong> &nbsp;
     <em><?= Html::a($model['trab'], ['rh-trab/view', 'id' => $model['clave']]) ?></em>
</p>
</div>

