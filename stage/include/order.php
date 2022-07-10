<?php
require_once('dbaccess.php');

class Order{

    private  $libelle;
    private  $description;
    private  $quantite;
    private  $image;
    private  $idcategory ;
    private  $state;
    private  $iduser ;
    private  $dba;

    public function __construct($libelle,$description,$quantite,$image,$idcategory,$state,$iduser){
        $this->libelle = $libelle;
        $this->description = $description;
        $this->quantite = $quantite;
        $this->image = $image;
        $this->idcategory = $idcategory;
        $this->state = $state;
        $this->iduser = $iduser;
    }

    public static function count($email,$password){
        $_dba = new Dbaccess();
        $_dba->query("select * from orders where email= '$email' and password = '$password' ");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function getOne($id){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from orders where id= '$id'");
        return $_dba->single();
    }


    public static function getAll(){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from orders");
        return $_dba->resultSet();
    }

    public static function getsome($id,$state){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from orders where iduser = '$id' and state = '$state' ");
        return $_dba->resultSet();
    }

    public static function getsome2($id,$state){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from orders where id not in (Select idorder from orders join offers on orders.id = offers.idorder where offers.state = 'Confirmed') and iduser = '$id' and state = '$state' ");
        return $_dba->resultSet();
    }
    public static function getsome3($state){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from orders where state ='$state' ");
        return $_dba->resultSet();
    }

    public static function getsome4($id,$state){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from orders where id not in (Select idorder from orders join offers on orders.id = offers.idorder where offers.state = 'Confirmed' or offers.state = 'Accepted') and idcategory = '$id' and state = '$state' ");
        return $_dba->resultSet();
    }

    
    public function save(){
        $_dba = new Dbaccess(); 
        $_dba->query("INSERT INTO orders VALUES(null,'$this->libelle','$this->description','$this->quantite',NOW(),'$this->image','$this->idcategory','$this->state','$this->iduser')");
        $_dba->execute();
        return 0;
    }

    public static function delete($id){
        $_dba = new Dbaccess();
        $_dba->query("delete from orders where id = '$id'" );
        $_dba->execute();
        return 0;
    }

    public function update($id){
        $_dba = new Dbaccess(); 
        $_dba->query("update orders set libelle = '$this->libelle',description = '$this->description',quantite = '$this->quantite',date = NOW(),image = '$this->image',idcategory = '$this->idcategory',state = '$this->state',iduser = '$this->iduser' where id ='$id'");
        $_dba->execute();
        return 0;
    }

    public static function updatestatus($id,$state){
        $_dba = new Dbaccess();
        $_dba->query("update orders set state = '$state' where id = '$id' ");
        $_dba->execute();
        return 0;
    }

};

?>