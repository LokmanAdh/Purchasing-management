<?php
require_once('dbaccess.php');

class Admin{

    private  $id;
    private  $nom;
    private  $prenom;
    private  $address;
    private  $tele;
    private  $email;
    private  $password ;
    private  $image ;
    private  $dba;

    public function __construct($id,$nom,$prenom,$address,$tele,$email,$password,$image){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->address = $address;
        $this->tele = $tele;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
    }

    public static function count($email,$password){
        $_dba = new Dbaccess();
        $_dba->query("select * from admin where email= '$email' and password = '$password' ");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function getOne($email,$password){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from admin where email= '$email' and password = '$password' ");
        return $_dba->single();
    }

    public static function getOneid($id){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from admin where id = '$id' ");
        return $_dba->single();
    }


};

?>