<?php

/**
 * This is the model class for table "user_want".
 *
 * The followings are the available columns in table 'user_want':
 * @property string $id
 * @property string $user_id
 * @property integer $project_id
 * @property string $project_name
 * @property string $unit_type
 * @property integer $expect_floor_low
 * @property integer $expect_floor_high
 * @property integer $coop
 * @property string $price
 * @property string $exposure
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Project $project
 */
class UserWant extends EActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user_want';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('date_created', 'required'),
            array('project_id, expect_floor_low, expect_floor_high', 'numerical', 'integerOnly' => true),
            array('project_name, expossure', 'length', 'max' => 50),
            array('unit_type', 'length', 'max' => 200),
            array('price, coop', 'length', 'max' => 10),
            array('date_updated, date_deleted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, project_id, project_name, unit_type, expect_floor_low, expect_floor_high, price, exposure, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
        );
    }

    public function beforeValidate() {
        $this->createId();
        return parent::beforeValidate();
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'AgentUser', 'user_id'),
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'user.id',
            'project_id' => 'peoject.id',
            'project_name' => '户型',
            'unit_type' => '房型(三室一厅)',
            'expect_floor_low' => '期房楼层',
            'expect_floor_high' => 'expect_floor_high',
            'price' => '价格',
            'exposure' => '方向',
            'coop' => 'coop',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('project_id', $this->project_id);
        $criteria->compare('project_name', $this->project_name, true);
        $criteria->compare('unit_type', $this->unit_type, true);
        $criteria->compare('expect_floor_low', $this->expect_floor_low);
        $criteria->compare('expect_floor_high', $this->expect_floor_high);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('expossure', $this->expossure, true);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('date_updated', $this->date_updated, true);
        $criteria->compare('date_deleted', $this->date_deleted, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserWant the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    private function createId() {
        if ($this->isNewRecord) {
            $num = $this->count() + 1;
            $this->id = "W" . str_pad($num, 5, "0", STR_PAD_LEFT);
        }
    }

}