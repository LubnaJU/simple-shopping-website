<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\CategoryForm $model */
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use common\models\Category;
use yii\web\JqueryAsset;

$this->title = 'Edit Product';
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['site/dashboard']];
$this->params['breadcrumbs'][] = ['label' => 'Product', 'url' => ['site/add_product']];

?><div class="site-product"><div class="row">
        <div class="col-lg-5">
<div class="site-product">
        <h1><?= Html::encode($this->title) ?></h1>


		<?php $form = ActiveForm::begin(['id' => 'product-form','options' => ['enctype' => 'multipart/form-data']]) ?>
 
            <?= $form->field($model,'name')->textInput(['autofocus' => true]) ?>
			<?= $form->field($model, 'imageFile')->fileInput() ?>
			<?= $form->field($model,'price')->textInput(['autofocus' => true]) ?>
			<?= $form->field($model, 'category_name')->dropDownList(
            ArrayHelper::map(Category::find()->asArray()->all(), 'name', 'name'),
			[

        'prompt'=>'Please select category'
    ]
			)?>

            <div class="form-group">
                <?= Html::submitButton('Save Changes', ['class' => 'btn btn-primary btn-block', 'name' => 'product-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>
</div></div>
</div></div>

<?php $this->registerJs(
    '$("#product-form").submit(function( event ) {
		var conceptName = $("#productform-category_name").find(":selected").text();
	 $("<input />").attr("type", "hidden")
          .attr("category_name", conceptName)
          .appendTo("#product-form");
		});	
		'

);?>