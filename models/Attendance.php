<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attendance".
 *
 * @property int $id
 * @property int $idStudent
 * @property int $number
 * @property int $idAttendance
 *
 * @property AttendanceCategory $idAttendance0
 * @property Students $idStudent0
 */
class Attendance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idStudent', 'number', 'idAttendance'], 'required'],
            [['idStudent', 'number', 'idAttendance'], 'integer'],
            [['idAttendance'], 'exist', 'skipOnError' => true, 'targetClass' => AttendanceCategory::className(), 'targetAttribute' => ['idAttendance' => 'id']],
            [['idStudent'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['idStudent' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idStudent' => 'Id Student',
            'number' => 'Number',
            'idAttendance' => 'Id Attendance',
        ];
    }

    /**
     * Gets query for [[IdAttendance0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdAttendance0()
    {
        return $this->hasOne(AttendanceCategory::className(), ['id' => 'idAttendance']);
    }

    /**
     * Gets query for [[IdStudent0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdStudent0()
    {
        return $this->hasOne(Students::className(), ['id' => 'idStudent']);
    }
}
