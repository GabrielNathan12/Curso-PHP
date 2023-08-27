<?php
    include_once('templates/header.php');
    require_once('dao/UserDAO.php');

    $userDAO = new UserDAO($conexao, $BASE_URL);
    
    $userData = $userDAO->verifyToken();
?>

<div id="main-container" class="containber-fluid">
<h1>Editar Perfil</h1>
</div>

<?php
    include_once('templates/footer.php');
?>