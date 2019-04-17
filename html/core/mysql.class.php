<?php
require_once '/var/www/html/core/mysql.conf.php';
class dbmysql {
    private $link;
    public $res;
    private $host;
    private $user;
    private $password;
    private $db;
function result($query) {
    if (!$this->link || !mysqli_ping($this->link)) {
	$this->connect();
    }
    $this->res = mysqli_query($this->link, $query);
    return $this->res;
}	
function assoc_array($query) {
    if ($this->res = $this->result($query))
	{
	    $ret = mysqli_fetch_assoc($this->res);
	    return $ret;
	}
    return false;
}
function fetch_assoc() {
        return mysqli_fetch_assoc($this->res);
}
function fetch_row() {
        return mysqli_num_rows($this->res);
}
function freeres() {
    return mysqli_free_result($this->res);
}
private function connect() {
    $this->link = mysqli_connect($this->host,$this->user,$this->password,$this->db);
    mysqli_query($this->link, "SET NAMES 'utf8'");
    mysqli_query($this->link, "SET CHARACTER SET 'utf8'");
    if (!$this->link)
	{
        echo "<h2>Ошибка соединения с сервером!</h2>";
        printf(mysqli_connect_error());
	    exit;
	}
}
function __construct($host = MY_HOSTNAME, $user = MY_USERNAME, $password = MY_PASSWORD, $db = MY_DB) {
    if (!$this->link) {
    $this->host = $host;
    $this->user = $user;
    $this->password = $password;
    $this->db = $db;
    $this->connect();
    }
}
function __destruct() {
    if ($this->res) {
	@mysqli_free_result($this->res);
    }
}
}
?>