<?php


namespace backend\models;


use Yii;
use yii\base\Model;
use common\models\Product;
use common\models\Category;
use backend\models\CategoryForm;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;


/**
 * Product form
 */
class ProductForm extends Model
{
	/**
     * @var UploadedFile
     */
	 
	public $name;
	public $price;
	public $category_name;
    public $imageFile;

    /**
     * {@inheritdoc}
     */
	 
	public function rules()
    {
        return [
            [['name', 'price' ,'category_name', 'imageFile'] , 'required'],
			['price', 'double', 'min' => 0],
			[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],


        ];
    }
    public static function tableName()
    {
        return '{{%Product}}';
    }

    public function upload()
    {
		Yii::$app->params['uploadPath'] = realpath(Yii::$app->basePath) . '/uploads/';

        if ($this->validate()) {
            $this->imageFile->saveAs(Yii::$app->params['uploadPath']. $this->imageFile->baseName .'__'.$this->name. '.' . $this->imageFile->extension);
			$this->imageFile = Yii::$app->params['uploadPath']. $this->imageFile->baseName .'__'.$this->name. '.' . $this->imageFile->extension;
            return true;
        } else {
            return false;
        }
    }
	
	public function add_product()
    {
		if(!($Product = Product::find()->where(['name' => $this->name])->one()))

        {
			$Product = new Product();
            $Product->name = $this->name;
			$Product->price = $this->price;
            $Product->category_name = $this->category_name;
			$Product->imageFile = $this->imageFile;
			
           return $Product->save();
		}
		else
            Yii::$app->session->setFlash('error', 'Sorry, the Product already exists.');
    }
	
	public function edit_product_category_name($old, $new)
	{
		
		$Products = Product::find()->where(['category_name' => $old])->asArray()->all();
		
		foreach($Products as $product){
			$edited_product = Product::findOne($product['id']);	
			$edited_product->category_name = $new;
			$edited_product->save();			
			}
	}
	public function edit_product($id)
		{if(!($product = Product::find()->where(['name' => $this->name])->one()))

			{
			$product =Product::findOne($id);
			$product->name = $this->name;
			$product->price = $this->price;
			$product->category_name = $this->category_name;
			$product->imageFile = $this->imageFile;

			return $product->save();	
			
			
			}
		else
			Yii::$app->session->setFlash('error', 'Sorry, the product name already exists.');
			return false;
    }
	 public function get_products()
    {
		
		return Product::find()->asArray()->all();

    }
}
