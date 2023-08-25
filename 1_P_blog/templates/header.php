<?php
    include_once('helpers/url.php');
    include_once('data/categories.php');
    include_once('data/posts.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog codar</title>
    <link rel="stylesheet"href="<?= $BASE_URL ?>/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@100;200;300;400;600;700;800;900&family=Montserrat:wght@300;700&family=Roboto:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <a href="<?= $BASE_URL ?>" id="logo">
           <img src="<?= $BASE_URL ?>/img/logo.png" alt="Gabriel Nathan">
        </a>
        <nav>
            <ul id="navbar">
                <li>
                    <a href="<?= $BASE_URL ?>" class="nav-link">Home</a>
                </li>
                <li>
                    <a href="#" class="nav-link">Categorias</a>
                </li>
                <li>
                    <a href="#" class="nav-link">Sobre</a>
                </li>
                <li>
                    <a href="<?= $BASE_URL ?>/contact.php" class="nav-link">Contatos</a>
                </li>
            </ul>
        </nav>
    </header>
