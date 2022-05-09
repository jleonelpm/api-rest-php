<?php
namespace app\components;

use Yii;

class JwtValidationData extends \sizeg\jwt\JwtValidationData {
	/**
	 * @inheritdoc
	 */
/* 	public function init() {
		$jwtParams = Yii::$app->params['jwt'];
		$this->validationData->setIssuer($jwtParams['issuer']);
		$this->validationData->setAudience($jwtParams['audience']);
		$this->validationData->setId($jwtParams['id']);

		parent::init();
	} */

    public function init()
    {
        $this->validationData->setIssuer('http://api-rest');
        $this->validationData->setAudience('http://api-rest');
        $this->validationData->setId('aa9hoh6shef3eephoo3H');

        parent::init();
    }

}