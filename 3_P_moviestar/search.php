<?php
    require_once('templates/header.php');

    require_once('dao/MovieDAO.php');

    $movieDAO = new MovieDAO($conexao, $BASE_URL);

    $q = filter_input(INPUT_GET, "q");
    $movies = $movieDAO->findByTitle($q);

?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title" id='search-title'>Pesquisando por:<span id="search-result"> <?= $q ?> </span> </h2>
        <p class="section-description">Resultados de busca retornados</p>
            <div class="movies-container">
                <?php foreach($movies as $movie):?>
                    <?php require("templates/movie_card.php"); ?>
                <?php endforeach; ?>

                <?php if(count($movies) === 0): ?>
                    <p class="empty-list">Não encontramos esse Filme: 
                        <a href="<?= $BASE_URL?>" class="back-link">voltar</a>
                    </p>
                <?php endif; ?>
            </div>


</div>

<?php
    require_once('templates/footer.php');
?>