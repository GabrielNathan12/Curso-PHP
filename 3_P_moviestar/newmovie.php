<?php
    require_once("templates/header.php");

    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    $user = new User();
    $userDao = new UserDao($conexao, $BASE_URL);

    $userData = $userDao->verifyToken(true);

?>
<div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4 new-movie-container">
        <h1 class="page-title">Adicionar um novo Filme</h1>
        <p class="page-description">Adicione sua crítica a esse filme</p>
        <form action="<?= $BASE_URL ?>movie_process.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
                <div class="form-group">
                    <label for="title">Título do Filme</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do filme">
                </div>
                <div class="form-group">
                    <label for="image">Capa do Filme</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="length">Duração do Filme</label>
                    <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do filme">
                </div>
                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Selecione</option>
                        <option value="Ação">Ação</option>
                        <option value="Drama">Drama</option>
                        <option value="Comédia">Comédia</option>
                        <option value="Fantasia / Ficção">Fantasia / Ficção</option>
                        <option value="Romance">Romance</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="trailer">Trailer do Filme</label>
                    <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Adcione o link do Trailer">
                </div>
                <div class="form-group">
                    <label for="description">Descrição do Filme</label>
                    <textarea class="form-control" id="description" rows="5" name="description" placeholder="Digite a descrição do Filme"></textarea>
                </div>
                <input type="submit" class="btn card-btn" value="Adicionar">
        </form>
    </div>
</div>

<?php
    require_once('templates/footer.php');
?>