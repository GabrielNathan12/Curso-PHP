<?php

    require_once('globals.php');
    require_once('db.php');

    require_once('models/User.php');
    require_once('models/Message.php');
    require_once('dao/UserDAO.php');

    $message = new Message($BASE_URL);
    $userDAO = new UserDAO($conexao, $BASE_URL);

    $type = filter_input(INPUT_POST, 'type');

    if($type === 'register'){
        $name = filter_input(INPUT_POST, 'name');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $confirmpassword = filter_input(INPUT_POST, 'confirmpassword');

        if($name && $lastname && $email && $password){
            if($password === $confirmpassword){

                if($userDAO->findByEmail($email) === false){
                   $user = new User();
                   
                   $userToken = $user->generateToken();
                   $finalPassword = $user->generatePassword($password);

                   $user->setName($name);
                   $user->setLastname($lastname);
                   $user->setEmail($email);
                   $user->setPassword($finalPassword);
                   $user->setToken($userToken);

                   $auth = true;

                   $userDAO->create($user, $auth);
                   
                }
                else{
                    $message->setMessage("Email já cadastrado", 'error', 'back');
                }
            }
            else{
                $message->setMessage("As senhas não conferem", 'error', 'back');
            }
        }
        else{
            $message->setMessage("Por favor, preencha todos os campos", 'error', 'back');
        }
    }
    else if($type === 'login'){
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');


        if($userDAO->authenticateUser($email, $password)){
            $message->setMessage('Seja bem-vindo', 'success', 'editprofile.php');
        }
        else{
            $message->setMessage("Usuário ou senha incorretos", 'error', 'back');
        }
    }
    else{
        $message->setMessage("Informações incorretas", 'error', 'index.php');
    }