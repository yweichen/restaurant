<?php

/**
 * This is the model class for table "merchant_account".
 *
 * The followings are the available columns in table 'merchant_account':
 * @property string $merchant_id
 * @property string $restaurant_name
 * @property string $restaurant_url
 * @property string $first_name
 * @property string $last_name
 * @property integer $contact_number_country_id
 * @property string $contact_number
 */
class MerchantAccount extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MerchantAccount the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'merchant_account';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('restaurant_name, first_name, last_name', 'required', 'message'=>Yii::t('merchant', 'ERROR_EMPTY_INPUT')),
            array('restaurant_name', 'length', 'max' => 200),
            array('restaurant_url', 'length', 'max'=>32),
            array('first_name, last_name', 'length', 'max' => 64),
            array('contact_number_country_id', 'numerical', 'integerOnly'=>true),
            array('contact_number', 'length', 'max' => 16),
            array('contact_number', 'numerical', 'message'=>Yii::t('merchant', 'ERROR_NUMERIC_INPUT')),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('restaurant_name, restaurant_url, first_name, last_name', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'merchant_id' => Yii::t('merchant', 'LABEL_MERCHANT'),
            'restaurant_name' => Yii::t('merchant', 'LABEL_RESTAURANT'),
            'restaurant_url' => Yii::t('merchant', 'LABEL_RESTAURANT_URL'),
            'first_name' => Yii::t('merchant', 'LABEL_CONTACT_PERSON_FIRST_NAME'),
            'last_name' => Yii::t('merchant', 'LABEL_CONTACT_PERSON_LAST_NAME'),
            'contact_number_country_id' => Yii::t('merchant', 'LABEL_CONTACT_NUMBER_COUNTRY'),
            'contact_number' => Yii::t('merchant', 'LABEL_CONTACT_NUMBER'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('merchant_id',$this->merchant_id,true);
        $criteria->compare('restaurant_name',$this->restaurant_name,true);
        $criteria->compare('restaurant_url',$this->restaurant_url,true);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('contact_number_country_id',$this->contact_number_country_id);
        $criteria->compare('contact_number',$this->contact_number,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}