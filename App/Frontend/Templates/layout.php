<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet"> 
    <title>
      <?= isset($title) ? $title : 'Jeunes Dynamiques Baletet' ?>
    </title>
 
    <link rel="stylesheet" href="/css/style.css" type="text/css" />
  </head>
 
  <body id="home">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <div class="container">
          <a href="/" class="navbar-brand"><img src="/img/logo_mini_nuit.png" alt=""></a>
          <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                      <a href="/" class="nav-link">Accueil</a>
                  </li>
                  <li class="nav-item">
                      <a href="/news" class="nav-link">News</a>
                  </li>
                  <?php if ($user->isAuthenticated()) { ?>
                  <li class="nav-item">
                      <a href="/admin/" class="nav-link">Admin</a>
                  </li>
                  <li class="nav-item">
                      <a href="/membre" class="nav-link">Membres</a>
                  </li>
                  <li class="nav-item">
                      <a href="/admin/membre-index.html" class="nav-link">Supression et modification des membres</a>
                  </li>
                  <li class="nav-item">
                      <a href="/admin/membre-insertMembre.html" class="nav-link">Inscription d'un membre</a>
                  </li>
                  <li class="nav-item">
                      <a href="/admin/caisses-insertCaisses.html" class="nav-link">Entrée du jour</a>
                  </li>
                  <?php } else { ?>
                  <li class="nav-item">
                      <a href="/admin/connexion/" class="nav-link">Connexion</a>
                  </li>
                  <?php } ?>
              </ul>
          </div>
      </div>
    </nav>

    
 
      <div class="container-fluid">
        <section id="main">
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
 
          <?= $content ?>
        </section>
      </div>

    

    <!-- MAIN FOOTER -->
    <footer id="main-footer" class="bg-dark">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="py-4">
                        <h1 class="h3"><img src="/img/logo_mini_nuit.png" alt=""></h1>
                        <h1 class="h3">Bernard Geraud Dongmo</h1>
                        <p>Copyright &copy 2020</p>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#contactModal">Contact Us</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- CONTACT US -->
    <div class="modal fade text-dark" id="contactModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalTitle">
                        Contact Us
                    </h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-block">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script src="/javascript/dailyActivity.js"></script>
    <script src="/javascript/borrow.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>