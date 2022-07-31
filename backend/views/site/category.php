<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\CategoryForm $model */
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Add Category';

$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['site/dashboard']];
?>
</br>
<h1>Edit Category</h1>

			<?php
				if (!empty($categories)) { ?>
				<p>Please click on the category you want to edit:</p>
				<?php
					foreach($categories as $category){			
			?>
					<div class='btn' style="cursor: context-menu; background-color:#E6E6FA ; margin-bottom:25px; width:350px">
				<?php
						echo Html::tag('div',Html::a($category["name"],['/site/edit_category','id' =>$category['id']],['class' => ['btn btn-link']]));				
				?>
					</div>					</br>

			<?php	
			
					}
				}
				else {?>
					<p>There are no categories to edit.</p>
			<?php
				}
			?>
			<div class="row">
        <div class="col-lg-5">
		<div class="site-category"></br>
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'category-form']); ?>

            <?= $form->field($model,'name')->textInput(['autofocus' => true]) ?>


            <div class="form-group">
                <?= Html::submitButton('Add Category', ['class' => 'btn btn-primary btn-block', 'name' => 'category-button']) ?>
            </div>
			
		<?php ActiveForm::end(); ?>
	
</div>
</div></div>