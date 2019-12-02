# Codeigniter-with-PDO
codeigniter pdo class library
to integrate MYSQL PDO into codeigniter project ..

config\database.php

    $active_group = 'default';
    $query_builder = TRUE;
    $active_record = TRUE;


    $db['default'] = array(
        'dsn'	=> 'mysql:host=localhost;dbname=DBNAME; charset=utf8',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'DBNAME',
        'dbdriver' => 'pdo',
        'dbprefix' => '',
        'pconnect' => TRUE,
        'db_debug' => TRUE,
        'cache_on' => FALSE,
        'cachedir' => '',
        'char_set' => 'utf8',
        'dbcollat' => 'utf8_general_ci',
        'swap_pre' => '',
        'encrypt' => FALSE,
        'compress' => FALSE,
        'stricton' => FALSE,
        'failover' => array(),
        'save_queries' => TRUE
    );

config\autoload.php

    $autoload['libraries'] = array('database','session','form_validation','user_agent','dbo');


To run the query within the controller

    public function get2() {
        $this->load->library('dbo');
        $result =  $this->dbo->fetch_all('tbl_tableName');
        print_r($result);
    }

use of prepare

    public function get2() {
        $this->load->library('dbo');
        $sql =  $this->dbo->prepare('SELECT * FROM table Where id=?');
        $sql->execute(array($id));
        $rows = $sql->fetchAll(PDO::FETCH_CLASS);
        print_r($rows);        
    }

