<?php

class Vehicle{

    // Attributes
    private $_id;
    private $_model;
    private $_builder;
    private $_fuel;
    private $_color;
    private $_kilometer;
    private $_immatriculation;
    private $_technical_control;
   

    const FUEL_DIESEL = 'diesel';
    const FUEL_ESSENCE = 'essence';
    const FUEL_HYBRIDE = 'hybride';
    const FUEL_ELECTRIQUE = 'electrique';

    const VALID = 'valide';
    const INVALID = 'invalide';

    // Constructor
    public function __construct(){


        $this->setFuel(Vehicle::FUEL_ESSENCE);

        $this->setKilometer(0);
        $this->setTechnical_control(Vehicle::INVALID);
        // [[[[[[ compléter ci-dessus les autres attributs, voir le fichier read-table.png ]]]]]]
    }

    // Getters

        public function getModel(){
            return $this->_model;
        }

        public function getBuilder(){
            return $this->_builder;
        }

        public function getFuel(){
            return $this->_fuel;
        }

        public function getColor(){
            return $this->_color;
        }

        public function getKilometer(){
            return $this->_kilometer;
        }

        public function getImmatriculation(){
            return $this->_immatriculation;
        }


        public function getTechnical_control(){
            return $this->_technical_control;
        }
        
        public function getId(){
            return $this->_id;
        }




    // Setters
     

    
    public function setModele(string $Model){

        if(is_string($Model))
        $this->_model = $Model;

    }

    public function setBuilder(string $builder){

        if(is_string($builder))
        $this->_builder = $builder;

    }


    public function setFuel(string $fuel){

        if(is_string($fuel))
        $this->_fuel = $fuel;

    }


    public function setColor(string $color){

        if(is_string($color))
        $this->_color = $color;

    }

    public function setKilometer(string $Kilometer){

        if(is_string($Kilometer))
        $this->_kilometer = $Kilometer;

    }

    public function setImmatriculation(string $immatriculation){

        if(is_string($immatriculation))
        $this->_immatriculation = $immatriculation;

    }
    public function SetTechnical_control(string $Technical_control){

        if(is_string($Technical_control))
        $this->_technical_control = $Technical_control;

    }

    public function SetId($id){

        if(is_string($id))
        $this->_id = $id;

    }


    // Methods
    public function describe(){
        echo '
            <ul style="text-align: center;">
                <li>Modèle du véhicule: '.$this->getModel().'</li>
                <li>Immatriculation: '.$this->getImmatriculation().'</li>
                <li>Constructeur: '.$this->getBuilder().'</li>
                <li>Carburant: '.$this->getFuel().'</li>
                <li>Couleur: '.$this->getColor().'</li>
                <li>CT: '.$this->getTechnical_control().'</li>
                <li style="color: blue;">km: '.$this->getKilometer().'</li>
            </ul>
        ';
    }
    
    /**
     * Permet de compléter toutes les données de l'objet véhicule à partir d'un tableau associatif
     *
     * @param  mixed $tab un tableau associatif dont **les clés correspondent aux attributs de l'objet**
     * @return void
     */
    public function hydrate($tab){




        if(isset($tab['modele']) && !empty($tab['modele']))
        $this->setModele($tab['modele']);

        if(isset($tab['constructeur']) && !empty($tab['constructeur']))
        $this->setBuilder($tab['constructeur']);

        if(isset($tab['carburant']) && !empty($tab['carburant']))
        $this->setFuel($tab['carburant']);

        if(isset($tab['couleur']) && !empty($tab['couleur']))
        $this->setColor($tab['couleur']);

        if(isset($tab['km']) && !empty($tab['km']))
        $this->setKilometer($tab['km']);

        if(isset($tab['immatriculation']) && !empty($tab['immatriculation']))
        $this->setImmatriculation($tab['immatriculation']);

        if(isset($tab['ct']) && !empty($tab['ct']))
        $this->SetTechnical_control($tab['ct']);

        if(isset($tab['id']) && !empty($tab['id']))
        $this->SetId($tab['id']);

      
  


    }

}
