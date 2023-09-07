<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property int $datestart
 * @property int $dateofdelivery
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'datestart', 'dateofdelivery'], 'required'],
            [['title'], 'string'],
            [['datestart', 'dateofdelivery'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'datestart' => 'Datestart',
            'dateofdelivery' => 'Dateofdelivery',
        ];
    }
}
