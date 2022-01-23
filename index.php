<?php
    set_include_path("./src");
    require_once("Router.php");
    require_once('model/AccountStorageMySQL.php');


/* NUMETU1 21606393 
 * NUMETU2 21711412
 *
 * PersonnageStorageStub n'est pas complet et ne possède donc pas toute les fonctionnalitées
 *
 * PersonnageStorageFile est complet et possède les dernieres fontionnalité
 *
 *      Pour l'activer en revanche il faut modifier la vue en échangeant ces quelques lignes : 
 *      View : ligne 360 par 361 || ligne 54 par 55
 *      PrivateView : ligne : 49 par 50
 *
 * PersonnageStorageMySQL est complet et possède les dernieres fonctionnalité
 *
 *      host : 'mysql:host=mysql.info.unicaen.fr;dbname=21606393_5';
 *      user : '21606393';
 *      password : 'aemoo1Ahnaexeich';
 *
 * Compte Admin : toto - toto et  tutu - tutu
*/

// ################ Base de Donnée ################ //
    $model = new AccountStorageMySQL();

    $router = new Router();
    $router->main($model);
