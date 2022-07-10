<?php
require_once('dbaccess.php');

class Delivery{

    private  $idoffer;
    private  $state;
    private  $dba;

    public function __construct($idoffer,$state){
        $this->idoffer = $idoffer;
        $this->state = $state;
    }

    public static function count($id){
        $_dba = new Dbaccess();
        $_dba->query("select * from delivery where idorder = '$id' and state != 'Not Accepted' ");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function getOne($id){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from delivery where id= '$id'");
        return $_dba->single();
    }


    public static function getAll(){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from delivery");
        return $_dba->resultSet();
    }

    public static function getsome($id){
        $_dba = new Dbaccess(); 
        $_dba->query("select idfournisseur,delivery.id,idorder,image,delivery.state,offers.quantite,offers.prixunitaire,offers.prixachat,offers.datedelivery,offers.latedatedelivery from delivery  join offers on delivery.idoffer = offers.id join orders on offers.idorder = orders.id where iduser = '$id' ");
        return $_dba->resultSet();
    }
    public static function getsome2(){
        $_dba = new Dbaccess(); 
        $_dba->query("select idfournisseur,iduser,delivery.id,idorder,image,delivery.state,offers.quantite,offers.prixunitaire,offers.prixachat,offers.datedelivery,offers.latedatedelivery from delivery  join offers on delivery.idoffer = offers.id join orders on offers.idorder = orders.id  ");
        return $_dba->resultSet();
    }
    public static function getsome3($id){
        $_dba = new Dbaccess(); 
        $_dba->query("select iduser,delivery.id,idorder,image,delivery.state,offers.quantite,offers.prixunitaire,offers.prixachat,offers.datedelivery,offers.latedatedelivery from delivery  join offers on delivery.idoffer = offers.id join orders on offers.idorder = orders.id where idfournisseur = '$id' ");
        return $_dba->resultSet();
    }

    public function save(){
        $_dba = new Dbaccess(); 
        $_dba->query("INSERT INTO delivery VALUES(null,'$this->idoffer','$this->state')");
        $_dba->execute();
        return 0;
    }

    public static function delete($id){
        $_dba = new Dbaccess();
        $_dba->query("delete from delivery where id = '$id'" );
        $_dba->execute();
        return 0;
    }

    public static function updatestatus($id,$state){
        $_dba = new Dbaccess();
        $_dba->query("update delivery set state = '$state' where id = '$id' ");
        $_dba->execute();
        return 0;
    }

    public function update($id){
        $_dba = new Dbaccess(); 
        $_dba->query("update delivery set idoffer = '$this->idoffer', state = '$this->state' where id = '$id' ");
        $_dba->execute();
        return 0;
    }

};

?>