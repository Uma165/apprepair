<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "applications".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $patronymic
 * @property string|null $email
 * @property string $text
 */
class Applications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'applications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
            [['name', 'patronymic', 'email'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'email' => 'Email',
            'text' => 'Вопрос',
        ];
    }
}
