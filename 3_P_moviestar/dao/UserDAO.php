<?php
    require_once('models/User.php');

    class UserDAO implements UserDaoInterface{
        private $conexao;
        private $url;

        public function __construct(PDO $conexao, $url ){
            $this->conexao = $conexao;
            $this->url = $url;
        }
        public function buildUser($data){
            $user = new User();

            $user->setId($data['id']);
            $user->setName($data['name']);
            $user->setLastname($data['lastname']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setBio($data['bio']);
            $user->setToken($data['token']);

            return $user;

        }
        public function create(User $user, $authUser = false){

        }
        public function updade(User $user){

        }
        public function verifyToken($protected = false){

        }
        public function setTokenToSession($token, $redirect = true){

        }
        public function authenticateUser($email, $password){

        }
        public function findByEmail($email){

        }
        public function findById($id){

        }
        public function findByToken($token){

        }
        public function changePassword(User $user){

        }
    }