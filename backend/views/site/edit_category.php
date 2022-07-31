<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\CategoryForm $model */
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Edit Category';
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['site/dashboard']];
$this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['site/add_category']];

?><div class="site-category">
<div class="row">
        <div class="col-lg-5">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'category-form']); ?>

            <?= $form->field($model,'name')->textInput(['autofocus' => true]) ?>


            <div class="form-group">
                <?= Html::submitButton('Save Changes', ['class' => 'btn btn-primary btn-block', 'name' => 'category-button']) ?>
            </div>
			
		<?php ActiveForm::end(); ?>
	
</div></div></div>