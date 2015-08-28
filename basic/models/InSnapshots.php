<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "in_snapshots".
 *
 * @property integer $id
 * @property integer $location_id
 * @property string $date
 * @property integer $views
 * @property integer $rating
 */
class InSnapshots extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_snapshots';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_id', 'views', 'rating'], 'integer'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location_id' => 'Location ID',
            'date' => 'Date',
            'views' => 'Views',
            'rating' => 'Rating',
        ];
    }
}
