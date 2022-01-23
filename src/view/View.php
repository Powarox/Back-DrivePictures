<?php
    require_once('Router.php');
    require_once('model/Account.php');
    require_once('model/AccountBuilder.php');

    class View{
        protected $linkCss;
        protected $scriptJs;
        protected $title;
        protected $content;
        
        public function __construct($router, $feedback){
            $this->linkCss = "";
            $this->scriptJs = "";
            $this->title = "";
            $this->content = "";
            $this->router = $router;
            $this->feedback = $feedback;
        }
        
        // Méthode qui affiche le squelette html
        public function render($squel){
            include($squel);
        }
        
        // Méthode pour Page d'erreur Action
        public function makeUnknownActionPage(){
            $this->title = "Erreur";
            $this->content = "<p>L'action n'existe pas</p>";
        }
        
        // ################ Accueil Exposition ################ //
        
        public function makeExpositionPage(){
            $this->linkCss = "";
            
            $this->title = "Expositions";
            
            $this->content = "";
            $this->content .= "";
        }
        
        // ################ Galerie Image ################ //
        
        public function makeGaleriePage(){
            $this->linkCss = '<link rel="stylesheet" href="styles/galerie.css">';
                
            $this->title = "Galerie";
            
            $this->content = '<section class="section1">';
                $this->content .= '<img src="images/img1.jpg" alt="">';
                $this->content .= '<img src="images/img2.jpg" alt="">';
                $this->content .= '<img src="images/img3.jpg" alt="">';
                $this->content .= '<img src="images/img4.jpg" alt="">';
                $this->content .= '<img src="images/img5.jpg" alt="">';
                $this->content .= '<img src="images/img6.jpg" alt="">';
                $this->content .= '<img src="images/img7.jpg" alt="">';
                $this->content .= '<img src="images/img8.jpg" alt="">';
                $this->content .= '<img src="images/img9.jpg" alt="">';
            $this->content .= '</section>';
        }
        
        // ################ Création Expositions ################ //
        
        public function makeCreationExpoPage(){
            $this->linkCss = '<link rel="stylesheet" href="styles/creaExpo.css">';
            $this->scriptJs = '<script defer src="javascript/drag&drop.js"></script>';
                
            $this->title = "Création Expositions";
            
            $this->content = '<section class="section1">';
                $this->content .= '<div class="description">';
                    $this->content .= '<form action="" class="box">';
                        $this->content .= '<input type="text" placeholder="Titre">';
                        $this->content .= '<textarea name="" id="" cols="30" rows="5" placeholder="Description"></textarea>';
                    $this->content .= '</form>';
                    $this->content .= "<button type='submit'>Créer l'exposition</button>";
                $this->content .= '</div>';
            
                $this->content .= '<div class="expo" ondrop="drop(event)" ondragover="allowDrop(event)">';
                    $this->content .= '<!--<div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>-->';
                $this->content .= '</div>';
            $this->content .= '</section>';
            
            $this->content .= '<section class="section2">';
                $this->content .= '<img src="images/img1.jpg" class="imageZoom" alt="" id="drag1" draggable="true" ondragstart="drag(event)">';
                $this->content .= '<img src="images/img2.jpg" class="imageZoom" alt="" id="drag2" draggable="true" ondragstart="drag(event)">';
                $this->content .= '<img src="images/img3.jpg" class="imageZoom" alt="" id="drag3" draggable="true" ondragstart="drag(event)">';
            
                $this->content .= '<img src="images/img4.jpg" class="imageZoom" alt="" id="drag4" draggable="true" ondragstart="drag(event)">';
                $this->content .= '<img src="images/img5.jpg" class="imageZoom" alt="" id="drag5" draggable="true" ondragstart="drag(event)">';
                $this->content .= '<img src="images/img6.jpg" class="imageZoom" alt="" id="drag6" draggable="true" ondragstart="drag(event)">';
            
                $this->content .= '<img src="images/img7.jpg" class="imageZoom" alt="" id="drag7" draggable="true" ondragstart="drag(event)">';
                $this->content .= '<img src="images/img8.jpg" class="imageZoom" alt="" id="drag8" draggable="true" ondragstart="drag(event)">';
                $this->content .= '<img src="images/img9.jpg" class="imageZoom" alt="" id="drag9" draggable="true" ondragstart="drag(event)">';
            
                $this->content .= '<img src="images/img1.jpg" class="imageZoom" alt="" id="drag10" draggable="true" ondragstart="drag(event)">';
                $this->content .= '<img src="images/img2.jpg" class="imageZoom" alt="" id="drag11" draggable="true" ondragstart="drag(event)">';
                $this->content .= '<img src="images/img3.jpg" class="imageZoom" alt="" id="drag12" draggable="true" ondragstart="drag(event)">';
            
                $this->content .= '<img src="images/img4.jpg" class="imageZoom" alt="" id="drag13" draggable="true" ondragstart="drag(event)">';
                $this->content .= '<img src="images/img5.jpg" class="imageZoom" alt="" id="drag14" draggable="true" ondragstart="drag(event)">';
                $this->content .= '<img src="images/img6.jpg" class="imageZoom" alt="" id="drag15" draggable="true" ondragstart="drag(event)">';
            
                $this->content .= '<img src="images/img7.jpg" class="imageZoom" alt="" id="drag16" draggable="true" ondragstart="drag(event)">';
                $this->content .= '<img src="images/img8.jpg" class="imageZoom" alt="" id="drag17" draggable="true" ondragstart="drag(event)">';
                $this->content .= '<img src="images/img9.jpg" class="imageZoom" alt="" id="drag18" draggable="true" ondragstart="drag(event)">';
            $this->content .= '</section>';
        }
        
        // ################ Connexion ################ //
        
        public function makeConnexionPage($builder){
            $this->linkCss = '<link rel="stylesheet" href="styles/monCompte.css">';
            
            $this->title = "Connexion";
            
            $data = $builder->getData();
            
            $loginRef = $builder->getLoginRef();
            $passwordRef = $builder->getPasswordRef();
            
            $errLogin = $builder->getErrors($loginRef);
            $errPassword = $builder->getErrors($passwordRef);
            
            $this->content = '<form class="box" action="'.$this->router->getConnexionConfirmeURL().'" method="POST">'."<br>";
            $this->content .= '<h2>Login</h2>';
            
            $this->content .= '<input type="text" name="'.$loginRef.'" placeholder="Login" value="'.self::htmlesc($data[$loginRef]).'">';
            if($errLogin !== null){
                $this->content .= '<span class="errors">'.$errLogin.'</span>';
            }
            $this->content .= '<br>';
            
            $this->content .= '<input type="password" name="'.$passwordRef.'" placeholder="Password" value="'.self::htmlesc($data[$passwordRef]).'">';
            if($errPassword !== null){
                $this->content .= '<span class="errors">'.$errPassword.'</span>';
            }
            $this->content .= '<br>';
            
            $this->content .= '<button type="submit">Se connecter</button>';
            $this->content .= '</form>';
            
            $this->content .= '<br>';
            $this->content .= '<br>';
            $this->content .= '<br>';
            $this->content .= '<a class="option" href="'.$this->router->getInscriptionURL().'">Inscription</a>';
        }
        
        public function displayConnexionSucces(){
            $this->router->POSTredirect($this->router->getMyAccountURL(), "<p class='feedback'>Vous êtes bien connecté en tant que ".$_SESSION['user']['statut']."</p>");  
        }
        
        public function displayConnexionFailure(){
            $this->router->POSTredirect($this->router->getConnexionURL(), "<p class='feedback'>Erreurs dans le formulaire</p>");
        }
        
        public function displayRequireConnexion(){
            $this->router->POSTredirect($this->router->getConnexionURL(), "<p class='feedback'>Connexion requise pour accèder à cette page</p>");
        }
        
        public function displayDeconnexionSucces(){
            $this->router->POSTredirect($this->router->getConnexionURL(), "<p class='feedback'>Déconnexion réussi</p>");
        }
        
        // ################ Inscription ################ //
        
        public function makeInscriptionPage($builder){
            $this->linkCss = '<link rel="stylesheet" href="styles/monCompte.css">';
            
            $this->title = "Inscription";
            
            $data = $builder->getData();
            
            $loginRef = $builder->getLoginRef();
            $passwordRef = $builder->getPasswordRef();
            $nameRef = $builder->getNameRef();
            
            $errLogin = $builder->getErrors($loginRef);
            $errPassword = $builder->getErrors($passwordRef);
            $errName = $builder->getErrors($nameRef);
            
            $this->content = '<form class="box" action="'.$this->router->getInscriptionConfirmeURL().'" method="POST">'."<br>";
            $this->content .= '<h2>Inscription</h2>';
            
            $this->content .= '<input type="text" name="'.$loginRef.'" placeholder="Login" value="'.self::htmlesc($data[$loginRef]).'">';
            if($errLogin !== null){
                $this->content .= '<span class="errors">'.$errLogin.'</span>';
            }
            $this->content .= '<br>';
            
            $this->content .= '<input type="text" name="'.$passwordRef.'" placeholder="Pasword" value="'.self::htmlesc($data[$passwordRef]).'">';
            if($errPassword !== null){
                $this->content .= '<span class="errors">'.$errPassword.'</span>';
            }
            $this->content .= '<br>';
            
            $this->content .= '<input type="text" name="'.$nameRef.'" placeholder="Name" value="'.self::htmlesc($data[$nameRef]).'">';
            if($errName !== null){
                $this->content .= '<span class="errors">'.$errName.'</span>';
            }
            $this->content .= '<br>';
            
            $this->content .= "<button type='submit'>S'inscrire</button>";
            $this->content .= '</form>';
            
            $this->content .= '<br>';
            $this->content .= '<br>';
            $this->content .= '<br>';
            $this->content .= '<a class="option" href="'.$this->router->getConnexionURL().'">Connexion</a>';
        }
        
        public function displayInscriptionSucces(){
            $this->router->POSTredirect($this->router->getConnexionURL(), "<p class='feedback'>Vous êtes bien inscrit</p>");
        }
        
        public function displayInscriptionFailure(){
            $this->router->POSTredirect($this->router->getInscriptionURL(), "<p class='feedback'>Erreurs dans le formulaire</p>");
        }
        
        // ################ Mon Compte ################ //
        
        public function makeMyAccountUserPage(){
            $this->linkCss = '<link rel="stylesheet" href="styles/monCompte.css">';
            
            $this->title = "Mon compte";
            
            $this->content .= '<h2>Information compte : </h2>';
            $this->content .= '<ul>';
                $this->content .= '<li>Nom : '.self::htmlesc($_SESSION["user"]["name"]).'</li>';
                $this->content .= '<li>Login : '.self::htmlesc($_SESSION["user"]["login"]).'</li>';
                $this->content .= '<li>Statut : '.self::htmlesc($_SESSION["user"]["statut"]).'</li>';
            $this->content .= '</ul>';
            $this->content .= '<br>';
            
            $this->content .= '<a class="option" href="'.$this->router->getAccountSuppresionURL($_SESSION["user"]["login"]).'">Suppression</a>';
            $this->content .= '<a class="option" href="'.$this->router->getDeconnexionURL().'">Deconnexion</a>';
        }
        
        public function makeMyAccountAdminPage($listAccount){
            $this->linkCss = '<link rel="stylesheet" href="styles/monCompte.css">';
            
            $this->title = "Mon compte";
            
            $this->content .= '<h2>Information compte : </h2>';
            $this->content .= '<ul>';
                $this->content .= '<li>Nom : '.self::htmlesc($_SESSION["user"]["name"]).'</li>';
                $this->content .= '<li>Login : '.self::htmlesc($_SESSION["user"]["login"]).'</li>';
                $this->content .= '<li>Statut : '.self::htmlesc($_SESSION["user"]["statut"]).'</li>';
            $this->content .= '</ul>';
            
            $this->content .= '<h2>Voici la liste de tout les comptes : </h2>';
            
            $this->content .= '<ul>';
            foreach($listAccount as $key => $value){
                $this->content .= "<li>";
                $this->content .= '<a href="'.$this->router->getUserAccountSuppresionURL($value['login']).'">'.self::htmlesc($value['login']).'</a>'; 
                $this->content .= "</li>\n";
            }
            $this->content .= '</ul>';
            $this->content .= '<br>';
            
            $this->content .= '<a class="option" href="'.$this->router->getDeconnexionURL().'">Deconnexion</a>';
        }       
        
        public function makeAccountSuppressionConfirmePage($id){
            $this->title = "Suppression du Compte";
            $this->content .= '<p>Voulez vous vraiment supprimer ce compte ?</p>';
            $this->content .= '<br>';
            $this->content .= '<a class="option" href="'.$this->router->getMyAccountURL().'">Retour</a>';
            $this->content .= '<a class="option" href="'.$this->router->getAccountSuppresionConfirmeURL($id).'">Supprimer</a>';
        }
        
        public function displayAccountSuppressionSucces(){
            $this->router->POSTredirect($this->router->getConnexionURL(), "<p class='feedback'>Le compte à bien été supprimé</p>");
        }
        
        public function makeUserAccountSuppressionConfirmePage($id){
            $this->title = "Suppression du Compte";
            $this->content .= '<p>Voulez vous vraiment supprimer le compte '.self::htmlesc($id).' ?</p>';
            $this->content .= '<br>';
            $this->content .= '<a class="option" href="'.$this->router->getMyAccountURL().'">Retour</a>';
            $this->content .= '<a class="option" href="'.$this->router->getUserAccountSuppresionConfirmeURL($id).'">Supprimer</a>';
        }
        
        public function displayUserAccountSuppressionSucces(){
            $this->router->POSTredirect($this->router->getConnexionURL(), "<p class='feedback'>Le compte à bien été supprimé</p>");
        }
        
        public function displaySuppressionAdminImpossible(){
            $this->router->POSTredirect($this->router->getConnexionURL(), "<p class='feedback'>Il est impossible de supprimer un compte admin</p>");
        }
        
        // ################ Utilitaire ################ //
        
        public static function htmlesc($str){
            return htmlspecialchars($str, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8');
        }
        
        protected function getMenu() {
            return array(
                "Exposition" => $this->router->getExpositionURL(),
                "Galerie" => $this->router->getGalerieURL(),
                "Création Expositions" => $this->router->getCreationExpoURL(),
                "Connexion" => $this->router->getConnexionURL(),
            );
        }
    }