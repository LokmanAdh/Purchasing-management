<?php
require_once('dbaccess.php');

class Fournisseur{

    private  $nom;
    private  $address;
    private  $tele;
    private  $email;
    private  $password ;
    private  $image ;
    private  $idcategory;
    private  $dba;

    public function __construct($nom,$address,$tele,$email,$password,$image,$idcategory){
        $this->nom = $nom;
        $this->address = $address;
        $this->tele = $tele;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
        $this->idcategory = $idcategory;
    }

    public static function count($email,$password){
        $_dba = new Dbaccess();
        $_dba->query("select * from fournisseur where email= '$email' and password = '$password' ");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function countp($phone){
        $_dba = new Dbaccess();
        $_dba->query("select * from fournisseur where tele= '$phone'");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function counte($email){
        $_dba = new Dbaccess();
        $_dba->query("select * from fournisseur where email= '$email'");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function countp2($phone,$old){
        $_dba = new Dbaccess();
        $_dba->query("select * from fournisseur where tele= '$phone' and id != (select id from fournisseur where email = '$old' )");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function counte2($email,$old){
        $_dba = new Dbaccess();
        $_dba->query("select * from fournisseur where email= '$email' and id != (select id from fournisseur where email = '$old' )");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function getOne($email,$password){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from fournisseur where email= '$email' and password = '$password' ");
        return $_dba->single();
    }

    public static function getOne2($id){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from fournisseur where id= '$id'");
        return $_dba->single();
    }

    public static function getOne3($email){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from fournisseur where email= '$email'");
        return $_dba->single();
    }

    public static function getAll(){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from fournisseur");
        return $_dba->resultSet();
    }

    public function save(){
        $_dba = new Dbaccess(); 
        $_dba->query("INSERT INTO fournisseur VALUES(null,'$this->nom','$this->address','$this->tele','$this->email','$this->password','$this->image','$this->idcategory')");
        $_dba->execute();
        return 0;
    }

    public static function delete($email){
        $_dba = new Dbaccess();
        $_dba->query("delete from fournisseur where email = '$email'" );
        $_dba->execute();
        return 0;
    }

    public function update($mail){
        $_dba = new Dbaccess(); 
        $_dba->query("update fournisseur set nom = '$this->nom',address = '$this->address',tele = '$this->tele',email = '$this->email',password = '$this->password',image = '$this->image',idcategory='$this->idcategory' where email ='$mail'");
        $_dba->execute();
        return 0;
    }


};

?>