<?php

class DB {

	//generic query
	static function run($query, $values) {

		global $con;

		if ($values) $values = (array) $values;

		//prepare the query
		$stmt = $con->prepare($query);

		//get types
		$types = '';

		if (!empty($values)) {

			foreach ($values as $value) {

				if (is_int($value)) $types .= 'i';
				else if (is_numeric($value)) $types .= 'd';
				else $types .= 's';

			}

			$stmt->bind_param($types, ...$values);

		}

		//execute the query
		$stmt->execute();
		$stmt->store_result();

		return new Query($stmt);
	}

	//select several rows
	static function select($query, $values = false) {

		$query = 'SELECT '.$query;

		return self::run($query, $values)->get_result();
	}

	//select a single row
	static function row($query, $values = false) {

		$query = $query.' LIMIT 1';

		$res = self::select($query, $values);

		return  $res->fetch_assoc();
	}

	//select a specific value
	static function find($query, $values = false) {

		$what = substr($query, 0, strpos($query, ' FROM'));

		$row = self::row($query, $values);

		if ($row) return $row[$what];
		else return false;
	}

	//get a count of entries
	static function count($what, $query, $values = false) {

		$query = 'COUNT('.$what.') AS num FROM '.$query;

		return self::row($query, $values)['num'];
	}

	//get a sum of values
	static function sum($what, $query, $values = false) {

		$query = 'SUM('.$what.') AS tot FROM '.$query;

		return self::row($query, $values)['tot'];
	}

	//add an element
	static function add($query, $values = false) {

		global $con;

		$query = 'INSERT INTO '.$query;

		if (self::run($query, $values)) return $con->insert_id;
		else return false;
	}

	//update an element
	static function update($query, $values = false) {

		$query = 'UPDATE '.$query;

		return self::run($query, $values);
	}

	//delete an element
	static function delete($query, $values = false) {

		$query = 'DELETE FROM '.$query;

		return self::run($query, $values);
	}

	//check if an element exists 
	static function exists($query, $values = false) {

		$query = '1 FROM '.$query.' LIMIT 1';

		return self::select($query, $values)->num_rows;
	}

	//check if a table exists
	static function table($tbl) {

		global $con;

		$query = "SHOW TABLES LIKE '".$tbl."'";

		return $con->query($query)->num_rows;
	}
}