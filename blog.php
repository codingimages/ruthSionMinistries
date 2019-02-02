<?php
require_once './admin/config/config.php';
require_once './admin/config/db.php';
require_once './admin/helpers/h_post.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Blog cristiano basado en la palabra que nunca falla, la palabra infalible de Dios.">
  <meta name="keywords" content="La biblia palabra infalible">
  <meta name="author" content="https://wwww.labibliapalabrainfalible.com">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="button.css">
  <link rel="shortcut icon" type="image/png" href=img/favicon.png>
  <title>Ruth Sion Ministries Blog</title>
</head>

<body>
  <!-- Navbar start -->
  <nav class="navbar navbar-expand-md navbar-light">
    <a class="navbar-brand nav-title text-dark" href="index.html">
      <img src="img/logo.png" width="30" height="30" class=" d-inline-block align-top" alt="logo">Ruth Sion Ministries</a>

    <!-- Responsive button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class = "nav-link" href="index.html">Inicio</a></li>
        <li class="nav-item"><a class = "nav-link" href="blog.php">Blog</a></li>
        <li class="nav-item"><a class = "nav-link" href="nosotros.html">Nosotros</a></li>
        <li class="nav-item"><a class = "nav-link" href="libro.html">Libro</a></li>
        <li class="nav-item"><a class = "nav-link" href="contacto.html">Contacto</a></li>
        <li class="nav-item"><a class = "nav-link" href="admin/login.php">Admin</a></li>
      </ul>
    </div>
  </nav>
  <!-- Navbar ends -->

    <main>
        <!-- Jumbostron -->
        <div class="container-fluid" id = "showcase__blog">
            <div class="blog__text">
                <h1>Bienvenidos a mi Blog</h1>
                <p>Palabra de Dios para tu vida</p>
            </div>
        </div>

        <div class="container mt-5 mb-5">
            <h2 class="heading-secondary">Ruth Sion Ministries Blog</h2>
            <p>Aquí podrás encontrar reflexones cristianas basadas en la palabra que nunca falla, la biblia, palabra infalible.</p>
        </div>

        <!-- Post Section -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="row">

                        <?php
                            $per_page = 1;
                            $page = isset($_GET['p']) ? $_GET['p'] : 1;
                            if ($page == "" || $page == 1) {
                                $page_1 = 0;
                            } else {
                                $page_1 = ($page * ITEMS_PER_PAGE) - ITEMS_PER_PAGE;
                            }
            
                            $count = postCount('active','', 'true');
                            $count = ceil($count / ITEMS_PER_PAGE);

                            $posts = getPosts('true', '', $page_1, ITEMS_PER_PAGE);
                            //echo '<pre>';
                            //print_r($posts);
                            //echo '</pre>';
                            foreach ($posts as $p) {
                                if($p['publish_date'] != '0000-00-00 00:00:00') {
                                    $time = time();
                                    $pTime = strtotime($p['publish_date']);
                                    if($pTime > $time) {
                                        //continue;
                                    }
                                }
                        ?>

                        <div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="card-inner-left">
                                        <img class="card-img-left img-fluid" src="./img/posts/<?= $p['image'] ?>" width="100%" height: "auto" alt="<?= $p['image'] ?>">
                                    </div>
                                    <div class="card-inner-right">
                                        <h3 class="card-title mt-3"><?= $p['title'] ?></h3>
                                        <p class="text-muted m-0">
                                            <?= $p['author'] ?>
                                            |
                                            <?= date('M d, Y', strtotime($p['created_date'])) ?>
                                        </p>
                                        <p class="card-text m-0"><?= substr($p['description'], 0, 120); ?></p>
                                        <a href="post.php?id=<?= $p['id'] ?>" class="btn btn-outline-dark btn-sm">Leer más</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="mb-3">
                        <?php 
                            $pre = $page - 1;
                            if($page > 1) { ?>
                                <a href="<?= URL_ROOT . '/index.php?p=' . $pre ?>" class="btn btn-light"><i class="fas fa-angle-double-left"></i> Anterior</a>
                            <?php } else { ?>
                                <a href="#" class="btn btn-light disabled"><i class="fas fa-angle-double-left"></i> Anterior</a>
                            <?php } ?>
                        
                        <?php 
                            $next = $page + 1;
                            if($count > $page) { ?>
                                <a href="<?= URL_ROOT . '/index.php?p=' . $next ?>" class="btn btn-light float-right">Siguiente <i class="fas fa-angle-double-right"></i></a>
                            <?php } else { ?>
                                <a href="#" class="btn btn-light float-right disabled">Siguiente <i class="fas fa-angle-double-right"></i></a>
                            <?php } ?>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <aside class="col-12 col-lg-4 mt-5 mb-5">
                    <div class="p-3 mb-3 bg-light rounded __web-inspector-hide-shortcut__">
                        <h4 class="font-italic">Sobre nosotros</h4>
                        <p class="mb-0">En <em>Ruth Sion Ministries</em> <br>queremos bendecirte con la palabra de Dios que transforma las vidas.</p>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body pb-2">
                            <form action="<?= URL_ROOT ?>/search.php" method="get">
                                <div class="form-group">
                                    <label for="">Inicia búsqueda</label>
                                    <div class="input-group">
                                        <input type="text" name="query" class="form-control" required>
                                        <button type="submit" class="btn-custom input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php require_once 'partials/recents.php' ?>
                </aside>
            </div>
            <hr class="mt-5">
        </div>
    </main>

<?php require_once 'partials/footer.php' ?>