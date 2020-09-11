<?php

class Manager{

    // attributes
    private $db;

    const TABLE_NAME = 'vehicles';

    // constructor
    public function __construct(PDO $db){
        $this->setDb($db);
    }

    // setters
    public function setDb(PDO $db){
        $this->db = $db;
    }

    // methods
 

    public function createTable(){

        

        $sql =$this->db->prepare("CREATE TABLE IF NOT EXISTS `vehicles` ( `id` int(11) NOT NULL AUTO_INCREMENT, 
        `modele` varchar(255) NOT NULL,
         `constructeur` varchar(255) NOT NULL,
         `carburant` varchar(255) NOT NULL, 
        `couleur` varchar(255) NOT NULL,
         `km` int(80) NOT NULL, 
        `immatriculation` varchar(255) NOT NULL, 
        `ct` varchar(255) NOT NULL,
        PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8");

        $sql->execute();

    }

   

    /**
     * Vérifie la présense de la table des véhicules dans la base de données
     *
     * @return boolean retourne *false* en cas d'absence
     */
    public function existTable(){

        return $this->db->query('DESCRIBE '.Manager::TABLE_NAME);

    }

    /**
     * Permet d'afficher le contenu de la table des véhicules
     *  - vérifie la présence de la table avec *existTable()*
     *
     * @return void
     */
    public function readTable(){

        if($this->existTable()){

            $sql = $this->db->prepare("SELECT * FROM vehicles");
            $sql->execute();
            $fetch = $sql->fetchAll(PDO::FETCH_ASSOC);



            foreach($fetch as $value){

                echo''.$value['modele'].' '.$value['constructeur'].' '.$value['carburant'].' '.$value['couleur'].' '.$value['km'].' '.$value['ct'].'';
                echo'</br>';
         
            }

            
        }
        else
            echo '<p style="text-align: center;">La table "'.Manager::TABLE_NAME.'" n\'existe pas</p>';
    }

    
    public function TruncateTable(){

        $sql = $this->db->prepare("TRUNCATE `vehicles`.`vehicles`");
        $sql->execute();


    }


   
        public function dropTable(){

            $sql = $this->db->prepare("DROP TABLE vehicles");
            $sql->execute();
  
          }

    

    /**
     * Permet d'ajouter une entrée dans la table des véhicules
     *
     * @param  Vehicle $vehicle un objet véhicule
     * @return void
     */
    public function create(Vehicle $vehicle){

        
        $sql =$this->db->prepare("INSERT INTO `vehicles` (`modele`, `constructeur`, `carburant`, `couleur`, `km`,`immatriculation`,`ct`) VALUES (:param1, :param2, :param3, :param4, :param5, :param6, :param7)");
        $sql->bindvalue(':param1', $vehicle->getModel());
        $sql->bindvalue(':param2', $vehicle->getBuilder());
        $sql->bindvalue(':param3', $vehicle->getFuel());
        $sql->bindvalue(':param4', $vehicle->getColor());
        $sql->bindvalue(':param5', $vehicle->getKilometer());
        $sql->bindvalue(':param6', $vehicle->getImmatriculation());
        $sql->bindvalue(':param7', $vehicle->getTechnical_control());


        $sql->execute();
    
    }

    /**
     * Permet de sélectionner la première entrée dans la table des véhicules
     *
     * @return Vehicle retourne un objet véhicule
     */
    public function selectFirst(){

        $sql = $this->db->prepare('SELECT * FROM '.Manager::TABLE_NAME.' LIMIT 1');
        $sql->execute();
        $fetch = $sql->fetch(PDO::FETCH_ASSOC);


        //we create an objet and hydrate it with fetch 

        $OneVehicles = new Vehicle();
        $OneVehicles->hydrate($fetch);
        
        return $OneVehicles;

    }

    /**
     * Permet de modifier une entrée dans la table des véhicules
     *
     * @param  Vehicle $vehicle un objet véhicule
     * @return void
     */
    public function update(Vehicle $vehicle){

    
        $sql = $this->db->prepare("UPDATE `vehicles`
        SET  `km`= :param1
        WHERE id =:param2");
       
       $sql->bindvalue(':param1', $vehicle->getKilometer());
       $sql->bindvalue(':param2', $vehicle->getId());
       $sql->execute();

    }

    public function delete(Vehicle $vehicle){

        $sql =$this->db->prepare('DELETE FROM vehicles WHERE vehicles.immatriculation =:param1');
        $sql->bindvalue(':param1', $vehicle->getImmatriculation());

           //we delete the first  vehicles  by chosing the first immatriculation

        $sql->execute();


    }

    /**
     * Retourne la liste des véhicules d'un constructeur
     *  - classés par ordre croissant des modèles
     * 
     * @param  string $builder nom du constructeur (*Renault* par défaut)
     * @return array retourne une liste contenant des objets véhicules
     */
    public function listOfVehiclesByBuilder(string $builder = 'renault'){

        $sql =$this->db->prepare("SELECT * FROM vehicles WHERE constructeur = '$builder'");
        $sql->execute();
        $fetch = $sql->fetchAll(PDO::FETCH_ASSOC);

       // we return all the vehicles where the builder is "renault"
        

        return $fetch ;

    }

    /**
     * Retourne la liste des véhicules dont le contrôle technique est invalide
     * 
     * @return array retourne une liste contenant des objets véhicules
     */
    public function listOfInvalidVehicles(){

        $sql =$this->db->prepare("SELECT * FROM vehicles WHERE ct = 'unvalide'");
        $sql->execute();
        $fetch = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $fetch ;

    }

    /**
     * Retourne la liste des véhicules essence
     * 
     * @return array retourne une liste contenant des objets véhicules
     */
    public function listOfGasolineVehicles(){

        


        $sql =$this->db->prepare("SELECT * FROM vehicles WHERE carburant = 'essence'");
        $sql->execute();
        $fetch = $sql->fetchAll(PDO::FETCH_ASSOC);

        // we return all the vehicles where the fuel is "essence"

        return $fetch ;

    }

    /**
     * Retourne la liste des véhicules par km
     *  - classés par ordre croissant des km
     * 
     * @param  int $kilometer nombre de km (0 par défaut)
     * @return array retourne une liste contenant des objets véhicules
     */
    public function listOfVehiclesByMoreKm(int $kilometer = 0){

       
        $sql =$this->db->prepare("SELECT * FROM vehicles WHERE km >= '$kilometer'");
        $sql->execute();
        $fetch = $sql->fetchAll(PDO::FETCH_ASSOC);


        return $fetch ;


    }
       
    

}
