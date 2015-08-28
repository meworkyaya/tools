<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "in_locations".
 *
 * @property integer $id
 * @property integer $total_week
 * @property integer $total_month
 */
class InLocations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total_week', 'total_month'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'total_week' => 'Total Week',
            'total_month' => 'Total Month',
        ];
    }
}
