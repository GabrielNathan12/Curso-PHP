<?php
    require_once('templates/header.php');

    require_once('dao/MovieDAO.php');

    $movieDAO = new MovieDAO($conexao, $BASE_URL);

    $latesMovies = $movieDAO->getLatesMovies();
    $actionMovies = $movieDAO->getMoviesByCategory("Ação");
    $comedyMovies = $movieDAO->getMoviesByCategory("Comédia");;


?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Filmes novos</h2>
        <p class="section-description">Veja as avaliações desse Filme</p>
            <div class="movies-container">
                <?php foreach($latesMovies as $movie):?>
                    <?php require("templates/movie_card.php"); ?>
                <?php endforeach; ?>

                <?php if(count($latesMovies) === 0): ?>
                    <p class="empty-list">Ainda não possuimos filmes no nosso site</p>
                <?php endif; ?>
            </div>

<h2 class="section-title">Ação</h2>
    <p class="section-description">Veja os filmes de ação</p>
        <div class="movies-container">
            <?php foreach($actionMovies as $movie):?>
                    <?php require("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if(count($actionMovies) === 0): ?>
                    <p class="empty-list">Ainda não possuimos esses filmes no nosso site</p>
            <?php endif; ?>
        </div>

<h2 class="section-title">Filmes comédia</h2>
    <p class="section-description">Veja os filmes de ação</p>
        <div class="movies-container">
            <?php foreach($comedyMovies as $movie):?>
                        <?php require("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if(count($comedyMovies) === 0): ?>
                    <p class="empty-list">Ainda não possuimos esses filmes no nosso site</p>
            <?php endif; ?>
        </div>
</div>

<?php
    require_once('templates/footer.php');
?>