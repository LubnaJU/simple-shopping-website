<?php


namespace backend\models;


use Yii;
use yii\base\Model;
use common\models\Category;
use backend\models\ProductForm;


/**
 * Category form
 */
class CategoryForm extends Model
{
	public $name;

    /**
     * {@inheritdoc}
     */
	 
	public function rules()
    {
        return [
            ['name', 'required']
        ];
    }
    public static function tableName()
    {
        return '{{%Category}}';
    }

    
	public function add_category()
    {
		if(!($category = Category::find()->where(['name' => $this->name])->one()))

        {
			$category = new Category();
            $category->name = $this->name;
           return $category->save();
		}
		else
            Yii::$app->session->setFlash('error', 'Sorry, the category already exists.');
    }
	
	public function edit_category($id)
		{if(!($category = Category::find()->where(['name' => $this->name])->one()))

			{
			$category =Category::findOne($id);
			$old_name = $category->name;
			$products_to_be_edited = new ProductForm();
			$new = $this->name;
			$products_to_be_edited->edit_product_category_name($old_name, $new);
			
			$category->name = $this->name;
			return $category->save();	
			
			
			}
		else
			Yii::$app->session->setFlash('error', 'Sorry, the category name already exists.');
			return false;
    }
	
	public function get_categories()
    {
		
		return Category::find()->asArray()->all();

    }
}
