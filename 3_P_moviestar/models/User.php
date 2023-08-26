<?php
    class User{
        private $id;
        private $name;
        private $lastname;
        private $email;
        private $password;
        private $image;
        private $bio;
        private $token;

        public function getId(){
            return $this->id;
        }
        
        public function getName(){
            return $this->name;
        }
        
        public function getLastname(){
            return $this->lastname;
        }
        
        public function getEmail(){
            return $this->email;
        }
        
        public function getPassword(){
            return $this->password;
        }
        
        public function getImage(){
            return $this->image;
        }
        
        public function getBio(){
            return $this->bio;
        }
        
        public function getToken(){
            return $this->token;
        }

        public function setId($id){
            $this->id = $id;
        }
        
        public function setName($name){
            $this->name = $name;
        }
        
        public function setLastname($lastname){
            $this->lastname = $lastname;
        }
        public function setEmail($email){
            $this->email = $email;
        }

        public function setPassword($password){
            $this->password = $password;
        }
        public function setImage($image){
            $this->image = $image;
        }
        public function setBio($bio){
            $this->bio = $bio;
        }
        public function setToken($token){
            $this->token = $token;
        }
        
    }

    interface UserDaoInterface {
        public function buildUser(User $user);
        public function create(User $user, $authUser = false);
        public function updade(User $user);
        public function verifyToken($protected = false);
        public function setTokenToSession($token, $redirect = true);
        public function authenticateUser($email, $password);
        public function findByEmail($email);
        public function findById($id);
        public function findByToken($token);
        public function changePassword(User $user);

    }