<?php
require_once './admin/config/config.php';
require_once './admin/config/db.php';
require_once './admin/helpers/h_post.php';
require_once './admin/helpers/h_url.php';
require_once 'partials/header.php'
?>

<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=419591998486666&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

</script>

    <main>
        <!-- Post Section -->
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-8">

                <?php
                    if(isset($_GET['id']) && $_GET['id'] > 0 && is_numeric($_GET['id'])) {
                        $id = $_GET['id'];
                        if(checkPostById($id)) {
                            $post = getPost($id);
                ?>
                    <div class="card border-0">
                        <img class="card-img-top img-fluid" max-width = 100% height = auto src="./img/posts/<?= $post['image'] ?>" alt="<?= $post['image'] ?>">
                        <div class="card-body">
                            <h3 class="card-title mt-3"><?= $post['title'] ?></h3>
                            <p class="text-muted m-0">
                                <?= $post['author'] ?>
                                |
                                <?= date('M d, Y', strtotime($post['created_date'])) ?>
                            </p>
                            <p class="card-text"><?= $post['description'] ?></p>
                            
                            <?php if($post['youtube_video'] != '') { ?>
                                <div class="youtube-video-box my-5">
                                <iframe width="100%" height="400px" src="https://www.youtube.com/embed/<?= $post['youtube_video'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            <?php } ?>

                            <?php if($post['video'] != '') { ?>
                            <div class="video-box mb-5">
                                <video width="100%" controls>
                                    <source src="./videos/posts/<?= $post['video'] ?>" type="video/mp4">
                                    <source src="./videos/posts/<?= $post['video'] ?>" type="video/ogg">
                                    Tu navegador no tiene soporte para HTML5 video.
                                </video>
                            </div>
                            <?php } ?>

                            <?php if($post['audio'] != '') { ?>
                            <div class="audio-box">
                                <audio controls>
                                    <source src="./audio/posts/<?= $post['audio'] ?>" type="audio/ogg">
                                    <source src="./audio/posts/<?= $post['audio'] ?>" type="audio/mpeg">
                                    Tu navegador no tiene soporte para el elemento de audio.
                                </audio>
                            </div>
                            <?php } ?>
                            
                            <div>
                            
                                <iframe id="fb-share" src="" width="60" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                                
                                <script src="//platform.linkedin.com/in.js" type="text/javascript">
                                    lang: en_US
                                </script>
                                <script type="IN/Share"></script>
                                
                                <a href="mailto:?Subject=<?= str_replace(' ', '%20', $post['title']) ?>&amp;Body=<?= substr($post['description'], 0, 50) ?> <?= URL_ROOT ?>/post.php?id=<?= $post['id'] ?>"><img src="<?= URL_ROOT ?>/img/email_button.png" alt="Email" style="margin-top:-13px; height:33px"/></a>
                            
                            </div>
				
                        </div>
                    </div>
                <?php
                        } else {
                            echo "<h3>No post found</h3>";
                        }
                    } else {
                        redirectP('index');
                    }
                ?>

                </div>

                <aside class="col-md-4">
                    <?php require_once 'partials/recents.php' ?>
                </aside>
            </div>
            <hr class="mt-5">
        </div>
    </main>

<?php require_once 'partials/footer.php' ?>