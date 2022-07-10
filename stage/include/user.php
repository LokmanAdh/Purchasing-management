<?php
require_once('dbaccess.php');

class User{

    private  $nom;
    private  $prenom;
    private  $address;
    private  $tele;
    private  $email;
    private  $password ;
    private  $image ;
    private  $role;
    private  $dba;

    public function __construct($nom,$prenom,$address,$tele,$email,$password,$image,$role){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->address = $address;
        $this->tele = $tele;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
        $this->role = $role;
    }

    public static function count($email,$password){
        $_dba = new Dbaccess();
        $_dba->query("select * from user where email= '$email' and password = '$password' ");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function countp($phone){
        $_dba = new Dbaccess();
        $_dba->query("select * from user where tele= '$phone'");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function counte($email){
        $_dba = new Dbaccess();
        $_dba->query("select * from user where email= '$email'");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function countp2($phone,$old){
        $_dba = new Dbaccess();
        $_dba->query("select * from user where tele= '$phone' and id != (select id from user where email = '$old' )");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function counte2($email,$old){
        $_dba = new Dbaccess();
        $_dba->query("select * from user where email= '$email' and id != (select id from user where email = '$old' )");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function getOne($email,$password){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from user where email= '$email' and password = '$password' ");
        return $_dba->single();
    }

    public static function getOne2($id){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from user where id= '$id'");
        return $_dba->single();
    }

    public static function getOne3($email){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from user where email= '$email'");
        return $_dba->single();
    }

    public static function getAll(){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from user");
        return $_dba->resultSet();
    }

    public function save(){
        $_dba = new Dbaccess(); 
        $_dba->query("INSERT INTO user VALUES(null,'$this->nom','$this->prenom','$this->address','$this->tele','$this->email','$this->password','$this->image','$this->role')");
        $_dba->execute();
        return 0;
    }

    public static function delete($email){
        $_dba = new Dbaccess();
        $_dba->query("delete from user where email = '$email'" );
        $_dba->execute();
        return 0;
    }

    public function update($mail){
        $_dba = new Dbaccess(); 
        $_dba->query("update user set nom = '$this->nom',prenom = '$this->prenom',address = '$this->address',tele = '$this->tele',email = '$this->email',password = '$this->password',image = '$this->image',role = '$this->role' where email ='$mail'");
        $_dba->execute();
        return 0;
    }

};

?>