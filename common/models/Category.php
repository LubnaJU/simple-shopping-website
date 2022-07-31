<?php

namespace common\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


/**
 * Login form
 */
class Category extends ActiveRecord

/**
 * Category model
 *
 * @property integer $id
 * @property string $name
 */
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Category}}';
    }

  

    /**
     * {@inheritdoc}
     */
	 
	 public function get_categories()
    {
		
		return Category::find()->select('id','name')->asArray();

    }
   }
