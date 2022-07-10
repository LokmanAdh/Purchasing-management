<?php
require_once('dbaccess.php');

class Stock{

    private  $reference;
    private  $libelle;
    private  $description;
    private  $image;
    private  $idcategory;
    private  $dba;

    public function __construct($reference,$libelle,$description,$image,$idcategory){
        $this->reference = $reference;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->image = $image;
        $this->idcategory = $idcategory;
    }

    public static function count($ref){
        $_dba = new Dbaccess();
        $_dba->query("select * from stock where ref= '$ref'");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function count2($ref,$old){
        $_dba = new Dbaccess();
        $_dba->query("select * from stock where ref= '$ref' and ref != '$old' ");
        $_dba->execute();
        return $_dba->rowCount();
    }


    public static function getAll(){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from stock");
        return $_dba->resultSet();
    }

    public static function getOne($ref){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from stock where ref= '$ref' ");
        return $_dba->single();
    }

    public function save(){
        $_dba = new Dbaccess(); 
        $_dba->query("INSERT INTO stock VALUES('$this->reference','$this->libelle','$this->description','$this->image','$this->idcategory','0')");
        $_dba->execute();
        return 0;
    }

    public static function delete($ref){
        $_dba = new Dbaccess();
        $_dba->query("delete from stock where ref = '$ref'" );
        $_dba->execute();
        return 0;
    }

    public function update($refe){
        $_dba = new Dbaccess(); 
        $_dba->query("update stock set ref = '$this->reference',libelle = '$this->libelle',description = '$this->description',image = '$this->image',idcategory = '$this->idcategory' where ref ='$refe'");
        $_dba->execute();
        return 0;
    }


};

?>