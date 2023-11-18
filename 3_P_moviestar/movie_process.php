<?php
    require_once("globals.php");
    require_once("db.php");
    require_once("models/Movie.php");
    require_once("models/Message.php");
    require_once("dao/MovieDAO.php");
    require_once("dao/UserDAO.php");
  
    $message = new Message($BASE_URL);
    
    $userDao = new UserDao($conexao, $BASE_URL);
    $movieDAO = new MovieDAO($conexao, $BASE_URL);

    $type = filter_input(INPUT_POST, "type");
    
    $userData = $userDao->verifyToken();

    if($type === "create"){
        $title = filter_input(INPUT_POST,"title");
        $description = filter_input(INPUT_POST,"description");
        $trailer = filter_input(INPUT_POST,"trailer");
        $category = filter_input(INPUT_POST,"category");
        $length = filter_input(INPUT_POST,"length");
        
        $movie = new Movie();

        if(!empty($title) && !empty($description) && !empty($length)){
            $movie->title = $title;
            $movie->description = $description;
            $movie->trailer = $trailer;
            $movie->category = $category;
            $movie->length = $length;
            $movie->users_id = $userData->id;
            
            if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])){
                $image = $_FILES["image"];
                $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                $jpgArray = ["image/jpeg", "image/jpg"];

                if(in_array($image["type"], $imageTypes)){
                    if(in_array($image["type"], $jpgArray)){
                        $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                    }else{
                        $imageFile = imagecreatefrompng($image["tmp_name"]);
                    }
                    $imageName = $movie->imageGenerateName();

                    imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

                    $movie->image = $imageName;
                }
                else{
                    $message->setMessage("Tipo de imagem não suportado, insira png ou jpg!", "error", "back");
                }
            }

            $movieDAO->create($movie);
        }
        else{
            $message->setMessage("É preciso adicionar um título, descrição e uma categoria!", "error", "back");
        }
    }else if($type === "delete"){
        $id = filter_input(INPUT_POST, "id");
        $movie = $movieDAO->findById($id);

        if($movie){
            if($movie->users_id === $userData->id){
                $movieDAO->destroy($movie->id);
            }else{
                $message->setMessage("Informações incorretas!", "error", "index.php"); 
            }
        }
    }
    else if($type === "update"){
        $id = filter_input(INPUT_POST,"id");
        $title = filter_input(INPUT_POST,"title");
        $description = filter_input(INPUT_POST,"description");
        $trailer = filter_input(INPUT_POST,"trailer");
        $category = filter_input(INPUT_POST,"category");
        $length = filter_input(INPUT_POST,"length");
        
        $movieData = $movieDAO->findById($id);

        if($movieData){
            if($movieData->users_id === $userData->id){
                
                if(!empty($title) && !empty($description) && !empty($category)){
                    $movieData->title = $title;
                    $movieData->description = $description;
                    $movieData->trailer = $trailer;
                    $movieData->category = $category;
                    $movieData->length = $length;

                    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])){
                        $image = $_FILES["image"];
                        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                        $jpgArray = ["image/jpeg", "image/jpg"];
        
                        if(in_array($image["type"], $imageTypes)){
                            if(in_array($image["type"], $jpgArray)){
                                $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                            }else{
                                $imageFile = imagecreatefrompng($image["tmp_name"]);
                            }
                            $imageName = $movieData->imageGenerateName();
        
                            imagejpeg($imageFile, "./img/movies/" . $imageName, 100);
        
                            $movieData->image = $imageName;
                        }
                        else{
                            $message->setMessage("Tipo de imagem não suportado, insira png ou jpg!", "error", "back");
                        }
                    }
                    $movieDAO->update($movieData);
                }
                else{
                    $message->setMessage("Precisa informar pelo menos: título, descrição e categoria do filme selecionado!", "error", "index.php"); 
                }
                
            }
        }
        else{
            $message->setMessage("Informações incorretas!", "error", "index.php"); 
        }
    }
    else{
        $message->setMessage("Informações incorretas!", "error", "index.php");
    }