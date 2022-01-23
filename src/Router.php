<?php
    require_once('view/View.php');
    require_once('control/Controller.php');
    session_start();

    class Router {
        public function main($model){
            $router = new Router();
            
            $feedback = key_exists('feedback', $_SESSION) ? $_SESSION['feedback'] : '';
            $_SESSION['feedback'] = '';
            
            $view = new View($router, $feedback);
                        
            $authManager = new AuthenticationManager($model);
            $control = new Controller($view, $authManager);
            
            $feedback = "";
            
            // ################ Affichage Galerie ################ //
            if(key_exists('galerie', $_GET)){
                $view->makeGaleriePage();
            }
            
            else if(key_exists('creationExpo', $_GET)){
                $view->makeCreationExpoPage();
            }
            
            else if(key_exists('action', $_GET)){
                $action = $_GET['action'];
                
                // ################ Inscription ################ //
                if($action === 'inscription'){
                    $control->askInscription();
                }
                else if($action === 'inscriptionConfirme'){
                    $control->saveInscription($_POST);
                }

                // ################ Connexion ################ //
                else if($action === 'connexion'){
                    if(key_exists('user', $_SESSION)){
                        if($_SESSION['user']['statut'] === 'admin'){
                            $control->myAccountAdmin();
                        }
                        else{
                            $control->myAccountUser();
                        }
                    }
                    else{
                        $control->askConnexion(); 
                    }
                }
                else if($action === 'connexionConfirme'){
                    $control->connexion($_POST);
                }
                else if($action === 'deconnexion'){
                    $control->deconnexion();
                }

                // ################ Mon Compte ################ //
                else if($action === 'myAccount'){
                    if($_SESSION['user']['statut'] === 'admin'){
                        $control->myAccountAdmin();
                    }
                    else{
                        $control->myAccountUser();
                    }
                }
                
                // ################ Suppression User Account ################ //
                else if(key_exists('id', $_GET)){  
                    $id = $_GET['id'];
                    
                    if($action === 'UserAccountSuppression'){
                        $control->AskUserAccountSuppression($id);
                    }
                    else if($action === 'UserAccountSuppressionConfirme'){
                        $control->UserAccountSuppression($id);
                    }
                    else if($action === 'accountSuppression'){
                        $control->askAccountSuppression($id);
                    }
                    else if($action === 'accountSuppressionConfirme'){
                        $control->accountSuppression($id);
                    }
                }

                // ################ Erreur Action ################ //
                else{
                    $view->makeUnknownActionPage();
                }   
            }
            
            // ################ Accueil --> Connexion ################ //
            else{
                $view->makeExpositionPage();
            }
               
            $view->render('Squelette.php');  
        }
        
        public function POSTredirect($url, $feedback){
            $_SESSION['feedback'] = $feedback;
            header("Location: ".htmlspecialchars_decode($url), true, 303);
            die;
        }
        
// ################ Affichage ################ //
        
        public function getExpositionURL(){
            return "index.php";
        }
        
        public function getGalerieURL(){
            return "index.php?galerie";
        }
        
// ################ Création Expositions ################ //
        
        public function getCreationExpoURL(){
            return "index.php?creationExpo";
        }
        
// ################ Connexion ################ //
        
        public function getConnexionURL(){
            return 'index.php?action=connexion';
        }
        
        public function getConnexionConfirmeURL(){
            return 'index.php?action=connexionConfirme';
        }
        
        public function getDeconnexionURL(){
            return 'index.php?action=deconnexion';
        }
        
// ################ Inscription ################ //
        
        public function getInscriptionURL(){
            return 'index.php?action=inscription';
        }
        
        public function getInscriptionConfirmeURL(){
            return 'index.php?action=inscriptionConfirme';
        }
        
// ################ Mon Compte ################ //
        
        public function getMyAccountURL(){
            return 'index.php?action=myAccount';
        }
        
        public function getAccountSuppresionURL($id){
            return 'index.php?action=accountSuppression&id='.$id;
        }
        
        public function getAccountSuppresionConfirmeURL($id){
            return 'index.php?action=accountSuppressionConfirme&id='.$id;
        }
        
        public function getUserAccountSuppresionURL($id){
            return 'index.php?action=UserAccountSuppression&id='.$id;
        }
        
        public function getUserAccountSuppresionConfirmeURL($id){
            return 'index.php?action=UserAccountSuppressionConfirme&id='.$id;
        }
    }