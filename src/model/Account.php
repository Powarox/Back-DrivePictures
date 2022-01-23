<?php
    class Account{
        public function __construct($login, $password, $name, $statut){
            $this->login = $login;
            $this->password = $password;
            $this->name = $name;
            $this->statut = $statut;
        }
        
        public function getLogin(){
            return $this->login;
        }
        
        public function getPassword(){
            return $this->password;
        }
        
        public function getName(){
            return $this->name;
        }
        
        public function getStatut(){
            return $this->statut;
        }
            
        public function setPassword($passwordHash){
            $this->password = $passwordHash;
        }
    }