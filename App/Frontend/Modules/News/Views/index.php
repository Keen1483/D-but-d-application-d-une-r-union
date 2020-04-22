<?php /*echo '<h1>'. $title .'</h1>';
foreach ($listeNews as $news)
{
?>
  <h2><a href="news-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></h2>
  <p><?= nl2br($news['contenu']) ?></p>
<?php
}*/

?>
<!-- EPLORE HEAD -->
<div id="">
    <section id="explore-head-section">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="p-5">
                        <h1 class="display-4">News</h1>
                        <p class="lead">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque praesentium voluptas, expedita 
                            exercitationem ex iure ab aliquid temporibus dolorem libero?</p>
                        <a href="#" class="btn btn-outline-secondary">Find Out More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EXPLORE SECTION -->
    <section id="explore-section" class="bg-light text-muted py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="img/explore-section1.jpg" alt="" class="img-fluid mb-3 rounded-circle">
                </div>
                <div class="col-md-6">
                    <h3><?= $title ?></h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil temporibus neque delectus cupiditate quam ea 
                        cum corporis nam molestias vel incidunt corrupti dolores eum modi maiores, dicta enim fuga minus!</p>
                    <?php foreach ($listeNews as $news): ?>
                      <div class="d-flex flex-row">
                          <div class="p-4 align-self-start">
                              <i class="material-icons">
                                  message</i>
                          </div>
                          <div class="p-4 align-self-end">
                            <h2><a href="news-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></h2>
                            <p><?= nl2br($news['contenu']) ?></p>
                          </div>
                      </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</div>