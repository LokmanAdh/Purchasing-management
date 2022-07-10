<?php
require_once('dbaccess.php');

class Chef{

    private  $nom;
    private  $prenom;
    private  $address;
    private  $tele;
    private  $email;
    private  $password ;
    private  $image ;
    private  $dba;

    public function __construct($nom,$prenom,$address,$tele,$email,$password,$image){
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
        $_dba->query("select * from chef where email= '$email' and password = '$password' ");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function countp($phone){
        $_dba = new Dbaccess();
        $_dba->query("select * from chef where tele= '$phone'");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function counte($email){
        $_dba = new Dbaccess();
        $_dba->query("select * from chef where email= '$email'");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function countp2($phone,$old){
        $_dba = new Dbaccess();
        $_dba->query("select * from chef where tele= '$phone' and id != (select id from chef where email = '$old' )");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function counte2($email,$old){
        $_dba = new Dbaccess();
        $_dba->query("select * from chef where email= '$email' and id != (select id from chef where email = '$old' )");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function getOne($email,$password){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from chef where email= '$email' and password = '$password' ");
        return $_dba->single();
    }

    public static function getAll(){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from chef");
        return $_dba->resultSet();
    }

    public function save(){
        $_dba = new Dbaccess(); 
        $_dba->query("INSERT INTO chef VALUES(null,'$this->nom','$this->prenom','$this->address','$this->tele','$this->email','$this->password','$this->image')");
        $_dba->execute();
        return 0;
    }

    public static function delete($email){
        $_dba = new Dbaccess();
        $_dba->query("delete from chef where email = '$email'" );
        $_dba->execute();
        return 0;
    }

    public function update($mail){
        $_dba = new Dbaccess(); 
        $_dba->query("update chef set nom = '$this->nom',prenom = '$this->prenom',address = '$this->address',tele = '$this->tele',email = '$this->email',password = '$this->password',image = '$this->image' where email ='$mail'");
        $_dba->execute();
        return 0;
    }


};

?>