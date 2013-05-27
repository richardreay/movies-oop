<?php

class Table {
	// Method that dynamically adds values to a MYSQL database table using the $_POST vars

	public function __construct() {
		$this->database = new Database();
	}

	function AddToDB($tbl) {
		// Set the arrays we'll need
		$sql_columns = array();
		$sql_columns_use = array();
		$sql_value_use = array();

		// Pull the column names from the table $tbl
		//$pull_cols = mysql_query("SHOW COLUMNS FROM ".$tbl) or die("MYSQL ERROR: ".mysql_error());
		$this->database->query("SHOW COLUMNS FROM ".$tbl);
		$columns = $this->database->resultSet();

		// Pull an associative array of the column names and put them into a non-associative array
		//while ($columns = mysql_fetch_assoc($pull_cols)) {
		//	$sql_columns[] = $columns["Field"];
		//}
		$arrFirstLen = count($columns);
		for ($i=0; $i < $arrFirstLen; $i++) {
			$sql_columns[] = $columns[$i]["Field"];
		}

		foreach( $_POST as $key => $value ) {
			// Check to see if the variables match up with the column names
			if ( in_array($key, $sql_columns) && trim($value) )	{
				// If this variable contains the string "DATESTAMP" then use MYSQL function NOW() 
				if ($value == "DATESTAMP") {
					$sql_value_use[] = "NOW()";
				} else {
					// If this variable contains a number, then don't add single quotes, otherwise check to see 
					// if magic quotes are on and use addslashes if they aren't
					if ( is_numeric($value) ) {
					$sql_value_use[] = $value;
					} else {
						$sql_value_use[]  = $value;
					}
				}
				// Put the column name into the array
				$sql_columns_use[] = $key;

			}
		}

		// If $sql_columns_use or $sql_value_use are empty then that means no values matched
		if ( (sizeof($sql_columns_use) == 0) || (sizeof($sql_value_use) == 0) ) {
			echo "Error: No values were passed that matched any columns.";
			return false;
		} else {
			// Implode $sql_columns_use and $sql_value_use into an SQL insert statement
			$this->database->query("INSERT INTO ".$tbl." (".implode(",",$sql_columns_use).") VALUES (:".implode(",:",$sql_columns_use).")");
			$arrLen = count($sql_columns_use);
			for ($i=0; $i < $arrLen; $i++) {
				$this->database->bind(':'.$sql_columns_use[$i], $sql_value_use[$i]);
			}
			$this->database->execute();
		}
	}
}










?>