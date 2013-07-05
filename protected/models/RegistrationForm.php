<?php

class RegistrationForm extends CFormModel {

    public $agree;

    public function rules() {
        return array(
            array('agree', 'required', 'requiredValue' => 1, 'message' => Yii::t('general', 'ERROR_AGREE_TOS')),
        );
    }

    public function attributeLabels() {
        return array(
            'agree' => Yii::t('general', 'LABEL_TOS'),
        );
    }
}