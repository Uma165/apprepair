<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property int|null $time_id
 * @property int|null $day_id
 * @property int|null $category_id
 *
 * @property Category $category
 * @property Day $day
 * @property Time $time
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time_id', 'day_id', 'category_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['day_id'], 'exist', 'skipOnError' => true, 'targetClass' => Day::class, 'targetAttribute' => ['day_id' => 'id']],
            [['time_id'], 'exist', 'skipOnError' => true, 'targetClass' => Time::class, 'targetAttribute' => ['time_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time_id' => 'Time ID',
            'day_id' => 'Day ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Day]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDay()
    {
        return $this->hasOne(Day::class, ['id' => 'day_id']);
    }

    /**
     * Gets query for [[Time]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTime()
    {
        return $this->hasOne(Time::class, ['id' => 'time_id']);
    }
}
