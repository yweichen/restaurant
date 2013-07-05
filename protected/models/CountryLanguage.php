<?php

/**
 * This is the model class for table "country_language".
 *
 * The followings are the available columns in table 'country_language':
 * @property string $country_code
 * @property string $language
 * @property string $is_official
 * @property double $percentage
 */
class CountryLanguage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CountryLanguage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'country_language';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('percentage', 'numerical'),
			array('country_code', 'length', 'max'=>3),
			array('language', 'length', 'max'=>30),
			array('is_official', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('country_code, language, is_official, percentage', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'country_code' => 'Country Code',
			'language' => 'Language',
			'is_official' => 'Is Official',
			'percentage' => 'Percentage',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('is_official',$this->is_official,true);
		$criteria->compare('percentage',$this->percentage);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}