<?php
    require_once('model/Account.php');
    require_once('model/AccountStorage.php');

    class AccountStorageMySQL implements AccountStorage{
        protected $bd;
        protected $dsn;
        protected $user;
        protected $pass;
        
        public function __construct(){
            $dsn = 'mysql:host=mysql.info.unicaen.fr;dbname=21606393_5';
            $user = '21606393';
            $pass = 'aemoo1Ahnaexeich';
            try{
                $this->db = new PDO($dsn, $user, $pass);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e){
                die('ERROR : '.$e->getMessage());
            }
        }
        
        public function reinit(){
            $rqDelete = "DELETE FROM accounts;";
            $rqInsert = 'INSERT INTO accounts VALUES 
                (1, "toto", "$2y$10$OvEBbT4N5tvmH/x.TAmqBePrEvAo.DkX6TwuMEW9wtuEtl3T5kzVW", "Master" "Toto", "admin"),
                (1, "tutu", "$2y$10$tmceaqpwpiqpuYqAl68PXuWdoO6/XdPtbtkcxwLKupI28IcwMKVOq", "Master" "Tutu", "admin")';            
            
            $this->db->query($rqDelete);
            $this->db->query($rqInsert);
        }
        
        public function read($id):Account{            
            $rq = "SELECT * FROM accounts WHERE id = :id";
            $stmt = $this->db->prepare($rq);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch();

            return new Account($result['login'], $result['password'], $result['name'], $result['statut']);
        }
        
        public function readAll(){
            $res = $this->db->query('SELECT * FROM accounts');
            return $res->fetchAll();
        }
    
        public function create(Account $account){ 
            $passwordHash = $this->createPassword($account->getPassword());
            
            $rq = "INSERT INTO accounts (login, password, name, statut) VALUES (:login, :password, :name, :statut)";
            $stmt = $this->db->prepare($rq);
            $stmt->bindValue(":login", $account->getLogin(), PDO::PARAM_STR);
            $stmt->bindValue(":password", $passwordHash, PDO::PARAM_STR);
            $stmt->bindValue(":name", $account->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":statut", $account->getStatut(), PDO::PARAM_STR);
            $stmt->execute();

            return $this->db->lastInsertId();
        }
        
        public function createPassword($pass){
            $hash = password_hash($pass, PASSWORD_BCRYPT);
            return $hash;
        }
        
        public function deleteAll(){
            $rqDelete = "DELETE FROM accounts;";
            $this->db->query($rqDelete);
        }
        
        public function delete($login){
            $id = $this->exists($login);
            $rq = "DELETE FROM accounts WHERE id = :id";
            $stmt = $this->db->prepare($rq);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }
        
        // Problème avec la requête préparé pour exists qui ne fonctionne pas, solution alternative moins propre ... mais fonctionnel ! 
        public function exists($login){
            $all = $this->readAll();
            foreach($all as $key => $value){
                if(key_exists('login', $all[$key])){
                    $log = $all[$key]['login'];
                    if($log === $login){
                        return $value['id'];
                    } 
                }
            }
            return false;
        }
    }