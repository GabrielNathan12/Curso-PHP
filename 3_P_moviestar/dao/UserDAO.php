<?php
    require_once('models/User.php');
    require_once('models/Message.php');
    class UserDAO implements UserDaoInterface{
        private $conexao;
        private $url;
        private $message;

        public function __construct(PDO $conexao, $url ){
            $this->conexao = $conexao;
            $this->url = $url;
            $this->message = new Message($url);
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
            $stmt = $this->conexao->prepare('INSERT INTO users (name, lastname, email, password, token) 
            VALUES (:name, :lastname, :email, :password, :token)');

            $stmt->bindParam(':name', $user->getName());
            $stmt->bindParam(':lastname', $user->getLastname());
            $stmt->bindParam(':email',$user->getEmail());
            $stmt->bindParam(':password', $user->getPassword());
            $stmt->bindParam(':token',$user->getToken());

            $stmt->execute();

            if($authUser){
                $this->setTokenToSession($user->getToken());
            }

        }
        public function updade(User $user, $redirect = true){
            $stmt = $this->conexao->prepare('UPDATE users SET 
            name = :name, lastname = :lastname, email = :email, image = :image,
            bio = :bio, token = :token WHERE id = :id');

            $stmt->bindParam(':name', $user->getName());
            $stmt->bindParam(':lastname', $user->getLastname());
            $stmt->bindParam(':email', $user->getEmail());
            $stmt->bindParam(':image', $user->getImage());
            $stmt->bindParam(':bio', $user->getBio());
            $stmt->bindParam(':token', $user->getToken());
            $stmt->bindParam(':id', $user->getId());


            $stmt->execute();

            if($redirect){
                $this->message->setMessage('Dados atualizados com sucesso', 'success', 'editprofile.php');
            }
        }
        public function verifyToken($protected = false){
            if(!empty($_SESSION['token'])){
                $token = $_SESSION['token'];

                $user = $this->findByToken($token);

                if($user){
                    return $user;
                }
                else if($protected){
                    $this->message->setMessage('Faça a autenticação para acessar está página', 'error', 'index.php');
                }
            }
            else if($protected){
                $this->message->setMessage('Faça a autenticação para acessar está página', 'error', 'index.php');
            }
        }
        public function setTokenToSession($token, $redirect = true){
            $_SESSION['token'] = $token;

            if($redirect){
                $this->message->setMessage('Boas vindas', 'success', 'editprofile.php');
            }
        }
        public function authenticateUser($email, $password){
            $user = $this->findByEmail($email);

            if($user){
                if(password_verify($password, $user->getPassword())){
                   $token = $user->generateToken();
                   $this->setTokenToSession($token, false);

                   $user->setToken($token);

                   $this->updade($user, false);
                   return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        public function findByEmail($email){
            if($email !== ''){
                $stmt = $this->conexao->prepare('SELECT * FROM users WHERE email = :email');
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    $data = $stmt->fetch();
                    $user = $this->buildUser($data);
                    return $user;

                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        public function findById($id){

        }
        public function findByToken($token){
            if($token !== ''){
                $stmt = $this->conexao->prepare('SELECT * FROM users WHERE token = :token');
                $stmt->bindParam(':token', $token);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    $data = $stmt->fetch();
                    $user = $this->buildUser($data);
                    return $user;

                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }

        public function destroyToken(){
            $_SESSION['token'] = '';

            $this->message->setMessage('Até mais amigo', 'success', 'index.php');

        }
        public function changePassword(User $user){

        }
    }