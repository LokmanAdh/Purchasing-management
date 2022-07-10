<?php
require_once('dbaccess.php');

class Offer{

    private  $quantite;
    private  $prixunitaire;
    private  $datedelivery;
    private  $latedatedelivery;
    private  $state;
    private  $idorder;
    private  $idfournisseur ;
    private  $dba;

    public function __construct($quantite,$prixunitaire,$datedelivery,$latedatedelivery,$state,$idorder,$idfournisseur){
        $this->quantite = $quantite;
        $this->prixunitaire = $prixunitaire;
        $this->datedelivery = $datedelivery;
        $this->latedatedelivery = $latedatedelivery;
        $this->state = $state;
        $this->idorder = $idorder;
        $this->idfournisseur = $idfournisseur;
    }

    public static function count($id){
        $_dba = new Dbaccess();
        $_dba->query("select * from offers where idorder = '$id' and state != 'Not Accepted' ");
        $_dba->execute();
        return $_dba->rowCount();
    }

    public static function getOne($id){
        $_dba = new Dbaccess(); 
        $_dba->query("select * from offers where id= '$id'");
        return $_dba->single();
    }


    public static function getAll(){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from offers");
        return $_dba->resultSet();
    }

    public static function getsome($id){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from offers where idorder = '$id' ");
        return $_dba->resultSet();
    }

    public static function getsome2($id,$f){
        $_dba = new Dbaccess(); 
        $_dba->query("Select * from offers where idorder = '$id' and idfournisseur = '$f' ");
        return $_dba->resultSet();
    }
    public static function getsome3($id){
        $_dba = new Dbaccess(); 
        $_dba->query("select offers.id,orders.image,orders.libelle,orders.description,offers.quantite,offers.prixunitaire,offers.prixachat,datedelivery,latedatedelivery,offers.state,offers.idorder,orders.iduser from offers  join orders on offers.idorder = orders.id where idfournisseur = '$id' and offers.state= 'Accepted'");
        return $_dba->resultSet();
    }

    public function save(){
        $_dba = new Dbaccess(); 
        $_dba->query("INSERT INTO offers VALUES(null,'$this->quantite','$this->prixunitaire','','$this->datedelivery','$this->latedatedelivery','$this->state','$this->idorder','$this->idfournisseur')");
        $_dba->execute();
        return 0;
    }

    public static function delete($id){
        $_dba = new Dbaccess();
        $_dba->query("delete from offers where id = '$id'" );
        $_dba->execute();
        return 0;
    }

    public static function updatestatus($id,$state){
        $_dba = new Dbaccess();
        $_dba->query("update offers set state = '$state' where id = '$id' ");
        $_dba->execute();
        return 0;
    }

    public function update($id){
        $_dba = new Dbaccess(); 
        $_dba->query("update offers set quantite = '$this->quantite',prixunitaire = '$this->prixunitaire',prixachat = '$this->quantite'*'$this->prixunitaire',datedelivery = '$this->datedelivery',latedatedelivery = '$this->latedatedelivery',state = '$this->state',idorder = '$this->idorder',idfournisseur = '$this->idfournisseur' where id ='$id'");
        $_dba->execute();
        return 0;
    }

};

?>