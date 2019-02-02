<?php
$page_title = 'Home';
require_once './admin/config/config.php';
require_once './admin/config/db.php';
require_once './admin/helpers/h_post.php';
require_once 'partials/header.php';
?>

    <main>
        <!-- Post Section -->
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-8">
                    <?php
                        if(isset($_GET['query'])){
                            $search = $_GET['query'];

                            $per_page = 1;
                            $page = isset($_GET['p']) ? $_GET['p'] : 1;
                            if ($page == "" || $page == 1) {
                                $page_1 = 0;
                            } else {
                                $page_1 = ($page * ITEMS_PER_PAGE) - ITEMS_PER_PAGE;
                            }
            
                            $count = postCount('active', $search, 'true');
                            $count = ceil($count / ITEMS_PER_PAGE);

                            $posts = getPosts('true', $search, $page_1, ITEMS_PER_PAGE);

                            if(count($posts)){
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <h4>Mostrando resultados que contienen "<strong><?= $search ?></strong>"</h4>
                        </div>
                    </div>

                    <?php 
                        foreach ($posts as $p) { 
                            if($p['publish_date'] != '0000-00-00 00:00:00') {
                                $time = time();
                                $pTime = strtotime($p['publish_date']);
                                if($pTime > $time) {
                                    continue;
                                }
                            }
                    ?>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="card-inner-left">
                                        <img class="card-img-left" src="./img/posts/<?= $p['image'] ?>" width="auto" alt="<?= $post['image'] ?>">
                                    </div>
                                    <div class="card-inner-right">
                                        <h5 class="card-title"><?= $p['title'] ?></h5>
                                        <p class="card-text"><?= substr($p['description'], 0, 120); ?>..</p>
                                        <a href="post.php?id=<?= $p['id'] ?>" class="btn btn-outline-dark btn-sm">Leer más</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                            }
                        } else {
                            echo "<h4>No data found against \"<strong>$search</strong>\"</h4>";
                        }
                    } 
                    ?>

                    <?php if(count($posts)){ ?>
                    <div>
                        <?php 
                            $pre = $page - 1;
                            if($page > 1) { ?>
                                <a href="<?= URL_ROOT . '/search.php?query='.$search.'&p=' . $pre ?>" class="btn btn-light"><i class="fas fa-angle-double-left"></i> Anterior</a>
                            <?php } else { ?>
                                <a href="#" class="btn btn-light disabled"><i class="fas fa-angle-double-left"></i> Anterior</a>
                            <?php } ?>
                        
                        <?php 
                            $next = $page + 1;
                            if($count > $page) { ?>
                                <a href="<?= URL_ROOT . '/search.php?query='.$search.'&p=' . $next ?>" class="btn btn-light float-right">Siguiente <i class="fas fa-angle-double-right"></i></a>
                            <?php } else { ?>
                                <a href="#" class="btn btn-light float-right disabled">Siguiente <i class="fas fa-angle-double-right"></i></a>
                            <?php } ?>
                        <div class="clearfix"></div>
                    </div>
                    <?php } ?>
                </div>

                <aside class="col-md-4">
                    <div class="p-3 mb-3 bg-light rounded __web-inspector-hide-shortcut__">
                        <h4 class="font-italic">About</h4>
                        <p class="mb-0">La Biblia <em>Palabra Infalible</em> <br>Nuestro propósito es llevar el mensaje de la palabra de Dios inspirados por el Espíritu Santo.</p>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body pb-2">
                            <form action="<?= URL_ROOT ?>/search.php" method="get">
                                <div class="form-group">
                                    <label for="">Buscar por temas</label>
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