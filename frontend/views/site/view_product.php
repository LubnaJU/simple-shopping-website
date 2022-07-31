<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\CartForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use frontend\models\Cart;
use frontend\models\CartForm;

$this->title = 'Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['site/user_home_page']];

?><div class="row">
        <div class="col-lg-5">
<div class="site-Products">
    <h1><?= Html::encode($this->title) ?></h1>

    

                

					<div class='btn' style="cursor: context-menu; background-color:#E6E6FA ; margin-bottom:25px; width:350px">
						<div class="product-image"><img src="<?php echo $product["imageFile"]; ?>"></div>

						<?php echo Html::tag('div',Html::a('Product : '.$product["name"],['/site/view_product','id' =>$product['id']],['class' => ['btn btn-link']]));
							?>
						<div class="product-price"><?php echo "Price : $".$product["price"]; ?></div>
						<div class="product-category-name"><?php echo "category : ".$product["category_name"]; ?></div>
						
					<?php $form = ActiveForm::begin(['id' => 'cart-form','options' => ['enctype' => 'multipart/form-data']]) ?>
 
					<?= $form->field($model,'quantity')->textInput(['autofocus' => true]) ?>
					<?= $form->field($model, 'product_id')->hiddenInput(['value'=> $product['id']])->label(false)?>
					<div class="form-group">
						<?= Html::submitButton('Add to cart', ['class' => 'btn btn-primary btn-block', 'name' => 'cart-button']) ?>
					</div>

					<?php ActiveForm::end(); ?>
						
					</div>
					<br>
					

        </div>
    </div>
</div>

