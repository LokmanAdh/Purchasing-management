<?php
require_once('dbaccess.php');

class Stocksortie{

    private  $reference;
    private  $id;
    private  $date;
    private  $quantite;
    private  $dba;

    public function __construct($reference,$id,$date,$quantite){
        $this->reference = $reference;
        $this->id = $id;
        $this->date = $date;
        $this->quantite = $quantite;
    }

    public static function count($ref,$id,$date){
        $_dba = new Dbaccess();
        $_dba->query("select * from stocksortie where ref = '$ref' and id = '$id' and date = '$date' ");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function count2($ref,$id,$date,$oldid,$olddate){
        $_dba = new Dbaccess();
        $_dba->query("select * from stocksortie where ref = '$ref' and id = '$id' and date = '$date' and id != '$oldid' and date != '$olddate' ");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function getone($ref,$id,$date){
        $_dba = new Dbaccess();
        $_dba->query("select * from stocksortie where ref = '$ref' and id = '$id' and date = '$date' ");
        $_dba->execute();
        return $_dba->single();
    }


    public static function getAll(){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from stocksortie");
        return $_dba->resultSet();
    }
    

    public static function getsome($ref){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from stocksortie where ref='$ref'");
        return $_dba->resultSet();
    }


    public function save(){
        $_dba = new Dbaccess(); 
        $_dba->query("INSERT INTO stocksortie VALUES('$this->reference','$this->id','$this->date','$this->quantite')");
        $_dba->execute();
        return 0;
    }

    public static function delete($ref,$id,$date){
        $_dba = new Dbaccess();
        $_dba->query("delete from stocksortie where ref = '$ref' and id = '$id' and date = '$date'" );
        $_dba->execute();
        return 0;
    }

    public function update($refe,$idd,$datee){
        $_dba = new Dbaccess(); 
        $_dba->query("update stocksortie set ref = '$this->reference',id = '$this->id',date = '$this->date',quantite = '$this->quantite'  where ref = '$refe' and id = '$idd' and date = '$datee'");
        $_dba->execute();
        return 0;
    }


};

?>