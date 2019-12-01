<?php
/**
 * created by alim ömer abul
 * pdo dbhelper
 */
class dbo  {

	private $pdo;
	protected $CI;

	function __construct() {
		
		$this->CI =& get_instance();
		$db = $this->CI->load->database('default',true);
    /* print_r($db); */
		$this->pdo = new pdo("mysql:host={$db->hostname};dbname={$db->database}", "{$db->username}", "{$db->password}", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}

	public function delete($table, $where, $id) {
        try {		    
		$data = array($id);
		$sel = $this -> pdo -> prepare("Delete from $table where $where=?");
		$sel -> execute($data);
            return array("success" => true, "msg" => ("deleted..."));
        } catch(PDOException $x) 
        {
            return array("success" => false, "msg" => $x->getMessage());
        }
	}

	/**
	 * update record
	 * @param  string $table table name
	 * @param  array $dat   associative array 'col'=>'val'
	 * @param  string $id    primary key column name Tablonun Id adinini belirt.. Toshe..
	 * @param  int $val   key value
	 */
	public function update($table, $dat, $id, $val) {
		if ($dat !== null)
			$data = array_values($dat);
		array_push($data, $val);
		//grab keys
		$cols = array_keys($dat);
		$mark = array();
		foreach ($cols as $col) {
			$mark[] = $col . "=?";
		}
		$im = implode(', ', $mark);
		$ins = $this -> pdo -> prepare("UPDATE $table SET $im where $id=?");
		$ins -> execute($data);
	}
	
	 /**
    * insert data to table
    * @param  string $table table name
    * @param  array $dat   associative array 'column_name'=>'val'
    */
	public function insert($table, $dat) {
		if ($dat !== null)
			$data = array_values($dat);
		//grab keys
		$cols = array_keys($dat);
		$col = implode(', ', $cols);
		//grab values and change it value
		$mark = array();
		foreach ($data as $key) {
			$keys = '?';
			$mark[] = $keys;
		}
		$im = implode(', ', $mark);
		$ins = $this -> pdo -> prepare("INSERT INTO $table ($col) values ($im)");
		$ins -> execute($data);
		return $this->pdo -> lastInsertId();
	}
	
	public function fetch_all($table)
    {
        $sel = $this->pdo->prepare("SELECT * FROM $table");
        $sel->execute();
        
        return $sel->fetchAll(PDO::FETCH_CLASS);
    }

    public function fetch($table)
    {
        $sel = $this->pdo->prepare("SELECT * FROM $table");
        $sel->execute();
        
        return $sel->fetch(PDO::FETCH_CLASS);
    }

    public function query($sorgu)
    {
        $sel = $this->pdo->query($sorgu);     
        return $sel;
    }
    
    public function prepare($sorgu)
    {
        $sel = $this->pdo->prepare($sorgu);     
        return $sel;
    }
    
    public function count($table) 
    {
        $sel = $this->pdo->query("Select Count(*) FROM $table");
        return $sel->fetchColumn();
    }

	public function __destruct() {
		$this -> pdo = null;
	}


	
	
	
}
?>
