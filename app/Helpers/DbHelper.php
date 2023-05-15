<?php

namespace app\Helpers;

class DbHelper
{

	// FUNCTIONS 
	function __construct()
	{
	}

	protected function returnTypeOfVar($value)
	{
		if (is_numeric($value) && $value < 999999) {
			if ($value == intval($value))
				return 'i';
			else return 'd';
		} else return 's';
	}


	protected function returnPrimaryKeyofTable($table)
	{
		$val = 'PRIMARY';
		$query = " SHOW KEYS FROM $table WHERE Key_name =?";
		$this->stmt = $this->conn->prepare($query) or die($this->conn->error);
		$this->stmt->bind_param("s", $val) or die($this->conn->error);
		$this->stmt->execute();
		$result = $this->stmt->get_result();
		$row = $result->fetch_assoc();
		if (empty($row))
			die('This Table Does Not  have any primary key');
		return $row['Column_name'];
	}

	protected function doesTableExistinDB($table)
	{
		$query = "select 1 from $table LIMIT 1";
		$result = $this->conn->query($query);
		if (!$result)
			return false;
		$row = $result->fetch_assoc();
		if (isset($row[1]) && $row[1] != FALSE)
			return true;
		return false;
	}


	protected function validateTable($table)
	{
		$query = "SHOW TABLES LIKE '$table'";
		$result = $this->conn->query($query);
		if (!$result || $result->num_rows !== 1)
			die("table " . $table . " Does Not Exist");
		$row = $result->fetch_assoc();
		if (empty($row))
			die("table " . $table . " Does Not Exist");
		else
			return true;
	}

	protected function makeWhereConditions($whereArray)
	{
		if (empty($whereArray) || !is_array($whereArray))
			return '';

		$WHERE = ' WHERE ';
		$i = 0;
		foreach ($whereArray as $where) {
			if ($i > 0) $WHERE .= $where['opd'];

			if (is_array($where['val']) && strtoupper($where['opr']) == "IN") {
				$WHERE .= $where['col'] . " IN (" . implode(',', $where['val']) . ")";
			} else if ($where['val'] === null) {
				if ($where['opr'] == '!=')
					$WHERE .= " " . $where['col'] . " IS NOT NULL ";
				else $WHERE .= " " . $where['col'] . " IS NULL ";
			} else
				$WHERE .= " " . $where['col'] . " " . $where['opr'] . " ? ";
			// EXCEPT IN QUERT BECAUSE IN $val will be numeric array
			if (!is_array($where['val']) && $where['val'] !== null)
				$this->vals[] = $where['val'];
			$i++;
		}
		return $WHERE;
	}


	protected function makeJoins($joinsArray)
	{
		$JOINS = '';
		if (empty($joinsArray) ||  !is_array($joinsArray))
			return $JOINS;


		foreach ($joinsArray as $join) {
			$JOINS .= $join['join'] . " JOIN " . $join['table'] . " ON " . $join['col1'] . " = " . $join['col2'];
		}
		return $JOINS;
	}


	protected function buildInsertQuery($table, $array)
	{
		$i = 0;
		$types = '';
		$qvals = '';
		$qatrr = '';
		foreach ($array as $key => $value) {
			if ($i > 0) {
				$qatrr .= ",";
				$qvals .= ',';
			}
			$qatrr .= $key;
			$qvals .= '?';
			$types .= $this->returnTypeOfVar($value);
			$values[] = $value;
			$i++;
		}
		$this->query = "INSERT INTO $table (" . $qatrr . ') VALUES (' . $qvals . ')';
		return array($this->query, $types, $values);
	}


	protected function buildUpdateQuery($table, $array, $whereArray)
	{


		$i = 0;
		$types = '';
		$qvals = '';
		$qatrr = '';
		$query = "Update $table SET ";
		foreach ($array as $key => $value) {
			if ($i > 0) {
				$qatrr .= ",";
				$qvals .= ',';
				$query .= ",";
			}
			$query .= " `$key` = ?";
			$types .= $this->returnTypeOfVar($value);
			$values[] = $value;
			$i++;
		}
		if ($whereArray)
			$query .= $this->makeWhereConditions($whereArray);

		foreach ($whereArray as $where) {
			$types .= $this->returnTypeOfVar($where['val']);
			$values[] = $where['val'];
		}

		return array($query, $types, $values);
	}

	protected function getColumnsOfTable($table)
	{
		$query = "SHOW COLUMNS FROM $table";
		$result = $this->conn->query($query);
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return $data;
	}

	protected function getKeyReference($table1, $table2)
	{
		$query = "SELECT TABLE_NAME,COLUMN_NAME, CONSTRAINT_NAME,REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
			FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
			WHERE
			REFERENCED_TABLE_NAME =?";
		$this->stmt = $this->conn->prepare($query) or die($this->conn->error);
		$this->stmt->bind_param('s', $table1) or die($this->conn->error);
		$this->stmt->execute();
		$result = $this->stmt->get_result();
		$data = array();
		while ($row = $result->fetch_assoc()) {
			if ($row['TABLE_NAME'] == $table2)
				return $row['COLUMN_NAME'];
		}
		die("Table " . $table1 . " is not referenced to table " . $table2);
	}



	protected function bind_custom_param($values, $types = null)
	{
		if (empty($values))
			return;
		if (is_string($values)) {
			$values[0] = $values;
		}

		if (!$types) {
			foreach ($values as $value)
				$types .= $this->returnTypeOfVar($value);
		}

		switch (sizeof($values)) {
			case 1:
				$this->stmt->bind_param($types, $values[0]);
				break;
			case 2:
				$this->stmt->bind_param($types, $values[0], $values[1]);
				break;
			case 3:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2]);
				break;
			case 4:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3]);
				break;
			case 5:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4]);
				break;
			case 6:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5]);
				break;
			case 7:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6]);
				break;
			case 8:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7]);
				break;
			case 9:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8]);
				break;
			case 10:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9]);
				break;
			case 11:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10]);
				break;
			case 12:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11]);
				break;
			case 13:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12]);
				break;
			case 14:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13]);
				break;
			case 15:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14]);
				break;
			case 16:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15]);
				break;
			case 17:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16]);
				break;
			case 18:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17]);
				break;
			case 19:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18]);
				break;
			case 20:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19]);
				break;
			case 21:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20]);
				break;
			case 22:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21]);
				break;
			case 23:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21], $values[22]);
				break;
			case 24:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21], $values[22], $values[23]);
				break;
			case 25:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21], $values[22], $values[23], $values[24]);
				break;
			case 26:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21], $values[22], $values[23], $values[24], $values[25]);
				break;
			case 27:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21], $values[22], $values[23], $values[24], $values[25], $values[26]);
				break;
			case 28:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21], $values[22], $values[23], $values[24], $values[25], $values[26], $values[27]);
				break;
			case 29:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21], $values[22], $values[23], $values[24], $values[25], $values[26], $values[27], $values[28]);
				break;
			case 30:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21], $values[22], $values[23], $values[24], $values[25], $values[26], $values[27], $values[28], $values[29]);
				break;
			case 31:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21], $values[22], $values[23], $values[24], $values[25], $values[26], $values[27], $values[28], $values[29], $values[30]);
				break;
			case 32:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21], $values[22], $values[23], $values[24], $values[25], $values[26], $values[27], $values[28], $values[29], $values[30], $values[31]);
				break;
			case 33:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21], $values[22], $values[23], $values[24], $values[25], $values[26], $values[27], $values[28], $values[29], $values[30], $values[31], $values[32]);
				break;
			case 34:
				$this->stmt->bind_param($types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10], $values[11], $values[12], $values[13], $values[14], $values[15], $values[16], $values[17], $values[18], $values[19], $values[20], $values[21], $values[22], $values[23], $values[24], $values[25], $values[26], $values[27], $values[28], $values[29], $values[30], $values[31], $values[32], $values[33]);
				break;
			default:
				die("maximum attribute limit is 25 and you have sent " . sizeof($values) . " attributes in your request");
		}
	}
}
