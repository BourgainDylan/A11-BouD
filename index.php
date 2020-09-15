<?php
require_once './settings/db.php';
require_once './classes/Manager.class.php';
require_once './classes/Vehicle.class.php';

$manager = new Manager($db);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eval PHPObjet</title>
    </head>
    <body>

        <!-- Table links -->
        <p style="text-align: center;">Table</p>
        <div style="margin: 0 0 30px 0; text-align: center;">
            <a href="index.php" ><=</a>&emsp;
            <a href="index.php?option=1">Créer</a>&emsp;

            <?php if($manager->existTable()): ?>

            <a href="index.php?option=2">Lire</a>&emsp;
            <a href="index.php?option=3">Vider</a>&emsp;
            <a href="index.php?option=4">Supprimer</a>
        </div>

        <hr />

        <!-- Vehicles links -->
        <p style="text-align: center;">Véhicules</p>
        <div style="margin: 0 0 10px 0; text-align: center;">
            <a href="index.php?option=5">Créer tout</a>&emsp;
            <a href="index.php?option=6">Décrire le 1er</a>&emsp;
            <a href="index.php?option=7">+ 1 km au 1er</a>&emsp;
            <a href="index.php?option=8">Supprimer le 1er</a>&emsp;
        </div>
        
        <div style="margin: 0 0 30px 0; text-align: center;">
            <a href="index.php?option=9">Liste des Renault</a>&emsp;
            <a href="index.php?option=10">Liste ct non valides</a>&emsp;
            <a href="index.php?option=11">Liste véhicules essence</a>&emsp;
            <a href="index.php?option=12">Liste km &#8805; 50 000</a>
        </div>

            <?php else: ?>
        </div>
            <?php endif; ?>

        <hr />

        <?php

        $center = 'style="text-align: center;"';

        $option = (isset($_GET['option'])) ? $_GET['option'] : null ;
        switch($option){
            case 1: // CREATE Table

                echo '<h1 '.$center.'>Créer</h1>';
               $manager = new Manager ($db);
              $createTable = $manager->createTable();
                echo '<p '.$center.'>La table a été créée</p>';

                break;
            case 2: // READ Table

                echo '<h1 '.$center.'>Lire</h1>';
                  $createTable = $manager->readTable();

                break;
            case 3: // TRUNCATE Table

                echo '<h1 '.$center.'>Vider</h1>';
                $truncateeTable = $manager->TruncateTable();
                echo '<p '.$center.'>La table a été vidée</p>';

                break;
            case 4: // DROP Table

                echo '<h1 '.$center.'>Supprimer</h1>';
                $deleteTable = $manager->dropTable(); 
                echo '<p '.$center.'>La table a été supprimée</p>';

                break;
            case 5: // CREATE all vehicules

                echo '<h1 '.$center.'>Créer tout</h1>';


               // Creeation of the table with all the vehicles

                $Vehicles = [

                    ['modele'=>'KADJAR', 'constructeur'=>'renault', 'carburant'=>'essence','couleur'=>'blanc','km'=>0, 'immatriculation'=>'KZ-483-AN', 'ct'=>'valide'],
                    ['modele'=>'TRAFIC', 'constructeur'=>'renault', 'carburant'=>'diesel','couleur'=>'Anthracite','km'=>2723, 'immatriculation'=>'JZ-9MA-8D','ct'=>'valide'],
                    ['modele'=>'108', 'constructeur'=>'peugeot', 'carburant'=>'essence','couleur'=>'kaki','km'=>59724,'immatriculation'=>'J9-K18-P2','ct'=>'unvalide'],
                    ['modele'=>'TALISMAN Estate', 'constructeur'=>'renault', 'carburant'=>'diesel','couleur'=>'Bleu Marine','km'=>39808,'immatriculation'=>'FA-491-CZ','ct'=>'valide'],
                    ['modele'=>'208', 'constructeur'=>'peugeot', 'carburant'=>'essence','couleur'=>'Rouge foncé','km'=>6920,'immatriculation'=>'AS-025-CZ','ct'=>'valide'],
                    ['modele'=>'astra', 'constructeur'=>'opel', 'carburant'=>'diesel','couleur'=>'Noir','km'=>109047,'immatriculation'=>'CQ-S77-EK','ct'=>'unvalide'],
                    ['modele'=>'YETI', 'constructeur'=>'skoda', 'carburant'=>'diesel','couleur'=>'rose crevette','km'=>136896,'immatriculation'=>'DG-356-LY','ct'=>'valide'],
                    ['modele'=>'KADJAR', 'constructeur'=>'renault', 'carburant'=>'essence','couleur'=>'noir','km'=>48203,'immatriculation'=>'AE-S21-KQ','ct'=>'valide'],
                    ['modele'=>'E-class', 'constructeur'=>'mercedes', 'carburant'=>'diesel','couleur'=>'blanc','km'=>78529,'immatriculation'=>'ET-356-LK','ct'=>'unvalide'],
                    ['modele'=>'DUCATO', 'constructeur'=>'fiat', 'carburant'=>'diesel','couleur'=>'noir','km'=>139730,'immatriculation'=>'BY-303-HA','ct'=>'valide'],
                    ['modele'=>'Hatch', 'constructeur'=>'mini', 'carburant'=>'essence','couleur'=>'Jaune','km'=>96294,'immatriculation'=>'DC-632-TR','ct'=>'valide'],
                    ['modele'=>'-', 'constructeur'=>'peuugeot', 'carburant'=>'essence','couleur'=>'orange','km'=>16920,'immatriculation'=>'AE-521-KQ','ct'=>'valide'],
                    ['modele'=>'sandero', 'constructeur'=>'-', 'carburant'=>'essence','couleur'=>'blanc','km'=>174329,'immatriculation'=>'FF-992-ZZ','ct'=>'unvalide'],
                    ['modele'=>'E-2008', 'constructeur'=>'peugeot', 'carburant'=>'essence','couleur'=>'bleu','km'=>8306,'immatriculation'=>'DC-092-CT','ct'=>'valide'],
                    ['modele'=>'C3', 'constructeur'=>'citroen', 'carburant'=>'essence','couleur'=>'-','km'=>127292,'immatriculation'=>'ET-277-VL','ct'=>'unvalide'],
                    ['modele'=>'ZOE', 'constructeur'=>'renault', 'carburant'=>'Electrique','couleur'=>'bordeau','km'=>0,'immatriculation'=>'FB-080','ct'=>'valide'],
                    ['modele'=>'Prius', 'constructeur'=>'toyota', 'carburant'=>'Hybride','couleur'=>'gris foncé','km'=>203927,'immatriculation'=>'SK','ct'=>'unvalide'],

                    ];


                    foreach($Vehicles as $lines){

                        
                        $manager = new Manager($db);
        
                        $newVehicleObjet = new vehicle();
                        
                    // creation of objets and hydrate with each lines of the table


                        $newVehicleObjet->hydrate($lines);
                        $manager->create($newVehicleObjet);
            
                     
        
                    }

                    
        

                echo '<p '.$center.'>Tous les véhicules ont été ajoutés</p>';

                break;
            case 6: // Describe first vehicle

                echo '<h1 '.$center.'>Décrire le 1er</h1>';
                $vehicle = $manager->selectFirst();
                $vehicle->describe();

                break;
            case 7: // UPDATE first vehicle (km + 1)

                echo '<h1 '.$center.'>Décrire le 1er</h1>';
                $vehicle = $manager->selectFirst();
                $vehicle->describe();

                echo '<h2 '.$center.'>+ 1 km</h2>';
        
                $manager = new Manager($db);
                $objetToUpdate = $manager->selectFirst();
                $kmToUpdate =  $objetToUpdate->getKilometer();
                $kmToUpdate = $kmToUpdate + 1;

                $updateVehicule =[
                    'id'=>$objetToUpdate->getId(),
                    'km'=>$kmToUpdate
                ];

                $updateObjet = new Vehicle();
                $updateObjet->hydrate($updateVehicule);
                
                $manager->update($updateObjet);
                $objetToUpdate = $manager->selectFirst();
                $updateObjet->describe();

                break;
            case 8: // DELETE first vehicle

                echo '<h1 '.$center.'>Supprimer le 1er</h1>';

                $delete = $manager->selectFirst();
               
                $manager->delete($delete);

                echo '<p '.$center.'>Le véhicule a été supprimé</p>';

                break;
            case 9: // List: Renault

                echo '<h1 '.$center.'>Liste des Renault</h1>';
                $listOfVehicles = $manager->listOfVehiclesByBuilder();

                foreach($listOfVehicles as $vehicle){
                    echo '
                        <p '.$center.'>'.
                       ''.$vehicle->getBuilder().' ('.$vehicle->getImmatriculation().')
                        </p>
                    ';
                }

                break;
            case 10: // List: invalid vehicles

                echo '<h1 '.$center.'>Liste des ct non valides</h1>';
                $listOfInvalidVehicles = $manager->listOfInvalidVehicles();

                foreach($listOfInvalidVehicles as $vehicle){
                    echo '
                        <p '.$center.'>'.
                        $vehicle->getBuilder().' '.$vehicle->getModel().' ('.$vehicle->getImmatriculation().')
                        </p>
                    ';
                }

                break;
            case 11: // List: gasoline vehicles

                echo '<h1 '.$center.'>Liste des véhicules essence</h1>';
                $listOfGasolineVehicles = $manager->listOfGasolineVehicles();

                foreach($listOfGasolineVehicles as $vehicle){
                    echo '
                        <p '.$center.'>'.
                        $vehicle->getBuilder().''.$vehicle->getModel().'('.$vehicle->getKilometer().')
                        </p>
                    ';
                }

                break;
            case 12: // List: km > 50000

                echo '<h1 '.$center.'>Liste des véhicules &#8805; 50 000 km</h1>';
                $listOfVehiclesByMoreKm = $manager->listOfVehiclesByMoreKm(50000);
               

                foreach($listOfVehiclesByMoreKm as $vehicle){
                    echo '
                    //         <p '.$center.'>'.
                                $vehicle->getBuilder(). $vehicle->getModel(). '('.$vehicle->getImmatriculation().') '.$vehicle->getKilometer().' km
                            </p>
                        ';
                }
                

                break;
            default:
                echo '<h1 '.$center.'>WrommMM!</h1>';
        }

        ?>
    </body>
</html>
