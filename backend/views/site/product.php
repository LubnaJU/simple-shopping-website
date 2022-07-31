<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\ProductForm $model */
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use common\models\Category;
use yii\web\JqueryAsset;
$this->title = 'Add Product';
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['site/dashboard']];
?>

</br>
<h1>Edit Product</h1>

			<?php
				if (!empty($products)) { ?>
				<p>Please click on the product you want to edit:</p>
				<?php
					foreach($products as $product){	
			?>
					<div class='btn' style="cursor: context-menu; background-color:#E6E6FA ; margin-bottom:25px; width:350px">
					<div class="product-image"><img src="<?php echo $product["imageFile"]; ?>"></div>

				<?php
						echo Html::tag('div',Html::a($product["name"],['/site/edit_product','id' =>$product['id']],['class' => ['btn btn-link']]));
				?>
						<div class="product-price"><?php echo "Price : $".$product["price"]; ?></div>
						<div class="product-category-name"><?php echo "category : ".$product["category_name"]; ?></div>
				
					</div>					</br>

			<?php	
			
					}
				}
				else {?>
					<p>There are no products to edit.</p>
			<?php
				}
			?>
	</br>
<div class="row">
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
                <?= Html::submitButton('Add product', ['class' => 'btn btn-primary btn-block', 'name' => 'product-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>
</div></div>
</div>

<?php $this->registerJs(
    '$("#product-form").submit(function( event ) {
		var conceptName = $("#productform-category_name").find(":selected").text();
	 $("<input />").attr("type", "hidden")
          .attr("category_name", conceptName)
          .appendTo("#product-form");
		});	
		'

);?>
