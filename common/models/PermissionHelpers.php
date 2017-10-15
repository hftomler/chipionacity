<?php

namespace common\models;

use common\models\ValueHelpers;
use yii;
use yii\web\Controller;
use yii\helpers\Url;

Class PermissionHelpers {
	/**
	 * check if the user is the owner of the record
	 * use Yii::$app->user->identity->id for $userid, 'string' for model name
	 * for example 'profile' will check the profile model to see if the user
	 * owns the record. Provide the model instance, typically as $model->id as
	 * the last parameter. Returns true or false, so you can wrap in if statement
	 * @param mixed $userid
	 * @param mixed $model_name
	 * @param mixed $model_id
	*/
	public static function userMustBeOwner($model_name, $model_id) {
		$connection = \Yii::$app->db;
		$userid = Yii::$app->user->identity->id;
		$sql = "SELECT id FROM $model_name WHERE user_id=:userid AND id=:model_id";
		$command = $connection->createCommand($sql);
		$command->bindValue(":userid", $userid);
		$command->bindValue(":model_id", $model_id);
		if ($result = $command->queryOne()) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Método para requerir el tipo de usuario, si no está suscrito,
	 * se le redirecciona a la página de suscripción.
	 * @param mixed $user_type_name
	 * @return \yii\web\Response
	*/
	public static function requireUpgradeTo($user_type_name) {
		if (Yii::$app->user->identity->user_type_id != 
			ValueHelpers::getUserTypeValue($user_type_name)) {
			return Yii::$app->getResponse()->redirect(Url::to(['upgrade/index']));
		}
	}

	/**
	 * @requireStatus
	 * @param mixed $status_name
 	*/
 	public static function requireStatus($status_name) {
 		if (Yii::$app->user->identity->status_id ==
 			ValueHelpers::getStatusValue($status_name)) {
 			return true;
 		} else {
 			return false;
 		}
 	}

	/**
	 * @requireMinStatus
	 * @param mixed $status_name
 	*/
 	public static function requireMinStatus($status_name) {
 		if (Yii::$app->user_identity->status_id >=
 			ValueHelpers::getStatusValue($status_name)) {
 			return true;
 		} else {
 			return false;
 		}
 	}

	/**
	 * @requireRol
	 * @param mixed $rol_name
 	*/
 	public static function requireRol($rol_name) {
 		if (Yii::$app->user_identity->rol_id ==
 			ValueHelpers::getRolValue($rol_name)) {
 			return true;
 		} else {
 			return false;
 		}
 	}

	/**
	 * @requireMinRol
	 * @param mixed $rol_name
 	*/
 	public static function requireMinRol($rol_name) {
 		if (Yii::$app->user_identity->rol_id >=
 			ValueHelpers::getRolValue($rol_name)) {
 			return true;
 		} else {
 			return false;
 		}
 	}
}