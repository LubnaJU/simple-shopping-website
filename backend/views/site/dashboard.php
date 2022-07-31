<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Admin Dashboard';
?>
<div class="site-Dashboard">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

                <div class="form-group">
				<?php
				        echo Html::tag('div',Html::a('Categories',['/site/add_category'],['class' => ['btn btn-link category text-decoration-none']]),['class' => ['d-flex']]);
				        echo Html::tag('div',Html::a('Products',['/site/add_product'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);

?>
                </div>

        </div>
    </div>
</div>
