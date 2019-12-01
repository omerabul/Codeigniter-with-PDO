# Codeigniter-with-PDO
codeigniter pdo class library

To run the query within the controller

    public function get2() {
        $this->load->library('dbo');
        $result =  $this->dbo->fetch_all('tbl_tableName');
        print_r($result);
    }
# or
    public function get2() {
        $this->load->library('dbo');
        $sql =  $this->dbo->prepare('SELECT * FROM table Where id=?');
        $sql->execute(array($id));
        $rows = $sql->fetchAll(PDO::FETCH_CLASS);
        print_r($rows);        
    }

