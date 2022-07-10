<?php
require_once('dbaccess.php');

class Category{

    private  $nom;
    private  $dba;

    public function __construct($nom){
        $this->nom = $nom;
    }

    public static function getAll(){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from category");
        return $_dba->resultSet();
    }

    public static function getone($id){
        $_dba = new Dbaccess(); 
        $_dba->query("Select nom from category where id='$id'");
        return $_dba->single();
    }


};

?>