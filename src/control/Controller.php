<?php
    require_once('view/View.php');
    require_once('control/AuthentificationManager.php');
    require_once('model/AccountBuilder.php');

    class Controller{
        protected $currentConnexionBuilder;
        protected $currentInscriptionBuilder;
        
        public function __construct($view, $authManager){
            $this->view = $view;
            $this->authManager = $authManager;
            $this->currentConnexionBuilder = key_exists('currentConnexionBuilder', $_SESSION) ? $_SESSION['currentConnexionBuilder'] : null;
            $this->currentInscriptionBuilder = key_exists('currentInscriptionBuilder', $_SESSION) ? $_SESSION['currentInscriptionBuilder'] : null;
        }
        
        public function __destruct(){
            $_SESSION['currentConnexionBuilder'] = $this->currentConnexionBuilder;
            $_SESSION['currentInscriptionBuilder'] = $this->currentInscriptionBuilder;
        }
    
        
        // ################ Connexion ################ //
        
        public function askConnexion(){
            if($this->currentConnexionBuilder === null){
                $this->currentConnexionBuilder = new AccountBuilder();
            }
            $this->view->makeConnexionPage($this->currentConnexionBuilder);
        }
        
        public function connexion(array $data){
            $this->currentConnexionBuilder = new AccountBuilder($data);
            
            $loginRef = $this->currentConnexionBuilder->getLoginRef();
            $passwordRef = $this->currentConnexionBuilder->getPasswordRef();
            
            if($data[$loginRef] ==! null){
                $login = $data[$loginRef];
                if($data[$passwordRef] ==! null){
                    $password = $data[$passwordRef];
                    $check = $this->authManager->checkAuth($login, $password);
                    if($check === 'login'){
                        $this->currentConnexionBuilder->setError($loginRef, 'Login erroné');
                        $this->view->displayConnexionFailure();
                    }
                    if($check === 'password'){
                        $this->currentConnexionBuilder->setError($passwordRef, 'Password erroné');
                        $this->view->displayConnexionFailure();
                    }
                    else{
                        $this->currentConnexionBuilder = null;
                        $this->view->displayConnexionSucces();
                    }
                }
                else{
                    $this->currentConnexionBuilder->setError($passwordRef, 'Password vide');
                    $this->view->displayConnexionFailure();
                }
            }
            else{
                $this->currentConnexionBuilder->setError($loginRef, 'Login vide');
                $this->view->displayConnexionFailure();
            }     
        }
        
        public function deconnexion(){
            $this->authManager->disconnectUser();
            $this->view->displayDeconnexionSucces(); 
        }
    
    // ################ Inscription ################ //    
        
        public function askInscription(){
            if($this->currentInscriptionBuilder === null){
                $this->currentInscriptionBuilder = new AccountBuilder();
            }
            $this->view->makeInscriptionPage($this->currentInscriptionBuilder);
        }
        
        public function saveInscription(array $data){
            $this->currentInscriptionBuilder = new AccountBuilder($data);
            if($this->currentInscriptionBuilder->isValidInscription()){
                $newAccount = $this->currentInscriptionBuilder->createAccount();
                $this->authManager->create($newAccount);
                $this->currentInscriptionBuilder = null;
                $this->view->displayInscriptionSucces();
            }
            else{
                $this->view->displayInscriptionFailure();
            }
        }
        
    // ################ Mon Compte ################ // 
        
        public function myAccountAdmin(){
            $listAccount = $this->authManager->readAllAccount();
            $this->view->makeMyAccountAdminPage($listAccount);
        }
        
        public function myAccountUser(){
            $this->view->makeMyAccountUserPage();
        } 
        
        public function askAccountSuppression($id){
            $this->view->makeAccountSuppressionConfirmePage($id);
        }
        
        public function accountSuppression($id){
            $this->authManager->accountSuppression($id);
            $this->authManager->disconnectUser();
            $this->view->displayAccountSuppressionSucces();
        }
        
        public function AskUserAccountSuppression($id){
            if($this->authManager->isAdminAccount($id)){
                $this->view->displaySuppressionAdminImpossible();
            }
            else{
                $this->view->makeUserAccountSuppressionConfirmePage($id);
            }
            
        }
        
        public function UserAccountSuppression($id){
            $this->authManager->UserAccountSuppression($id);
            $this->view->displayUserAccountSuppressionSucces();
        }  
        
    }