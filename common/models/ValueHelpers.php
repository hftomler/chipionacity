<?php

namespace common\models;

Class ValueHelpers {

	/**
	 * Devuelve el valor de un nombre de rol
	 * Por ejemplo: 
	 * 		Recibe: "Admin"
	 *		Devuelve: 20
	 * @param mixed $rol_name
	 * @return integer
	*/

	public static function getRolValue($rol_name) {
		$connection = \Yii::$app->db;
		$sql = "SELECT rol_value FROM roles WHERE rol_name = :rol_name";
		$command = $connection->createCommand($sql);
		$command -> bindValue(":rol_name", $rol_name);
		$result = $command->queryOne();

		return $result['rol_value'];
	}

	/**
	 * Devuelve el valor de un status
	 * Por ejemplo: 
	 * 		Recibe: "Pendiente"
	 *		Devuelve: 5
	 * @param mixed $status_name
	 * @return integer
	*/

	public static function getStatusValue($status_name) {
		$connection = \Yii::$app->db;
		$sql = "SELECT status_value FROM status WHERE status_name = :status_name";
		$command = $connection->createCommand($sql);
		$command -> bindValue(":status_name", $status_name);
		$result = $command->queryOne();

		return $result['status_value'];
	}

	/**
	 * Devuelve el valor de un user_type_name para usar 
	 * en métodos de PermissionHelpers
	 * Por ejemplo: 
	 * 		Recibe: "Suscrito"
	 *		Devuelve: 30
	 * @param mixed $user_type_name
	 * @return integer
	*/

	public static function getUserTypeValue($user_type_name) {
		$connection = \Yii::$app->db;
		$sql = "SELECT user_type_value FROM user_type WHERE user_type_name = :user_type_name";
		$command = $connection->createCommand($sql);
		$command -> bindValue(":user_type_name", $user_type_name);
		$result = $command->queryOne();

		return $result['user_type_value'];		
	}

}