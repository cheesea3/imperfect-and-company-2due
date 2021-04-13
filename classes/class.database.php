<?php
class DatabaseConnector {

	private static function connect() {
		
///NOPASS //then we tell pdo which password
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	}
	
	public static function query($query, $params = array()) {
		$statement = self::connect()->prepare($query);
		$statement->execute($params);
		
		//if the first keyword in the query is select, then run this.
		if (explode(' ', $query)[0] == 'SELECT'){
		$data = $statement->fetchAll();
		return $data;			
		}
	}

	

}