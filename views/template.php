<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 08/04/2018
 * Time: 13:35
 */
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo WEB_URL . 'public' . DS . 'css' . DS ?>style.css">
        <?php echo $style; ?>
        <title><?php echo ucfirst($title_p)?></title>


        <script type="text/javascript" src="<?php echo WEB_URL . 'public' . DS . 'js' . DS . 'jquery-3.1.1.min.js'?>"></script>
        <script src="<?php echo WEB_URL . 'public' . DS . 'js' . DS . 'script.js'?>"></script>
        <?php echo $js; ?>
    </head>
    <body>

        <div class="container-principal container">

            <!-- left page -->

            <div class="left-page left">

                <div class="user-name">
                    <div class="name">
                        <span><?php echo ucfirst($user->username); ?></span>
                    </div>

                    <div class="profile">
                        <a href="<?php echo WEB_URL . 'users' . DS ?>myprofile">Mon profile</a>&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo WEB_URL . 'users' . DS ?>deconnexion"><span class="glyphicon glyphicon-lock"></span> Deconnexion</a>
                    </div>
                </div>

                <div class="user-avatar">

                    <a href="<?php echo BASE_URL?>">
                        <div class="img">
                            <?php
                            if (isset($user->avatar) AND !empty($user->avatar)){
                                ?>
                                <img src="<?php echo WEB_URL . 'public' . DS . 'img' . DS . 'avatars' . DS . 'users' . DS . $user->avatar; ?>" alt="">
                                <?php
                            }else{
                                ?>
                                <img src="<?php echo WEB_URL . 'public' . DS . 'img' . DS . 'avatars' . DS . 'users' . DS . 'avatar.png'; ?>" alt="">
                                <?php
                            }
                            ?>

                        </div>
                    </a>

                </div>

                <div class="container-menus">
                    <?php
                    echo $menus;
                    ?>
                </div>

            </div>

            <!-- right page -->

            <div class="right-page right">

                <!-- header de la page -->
                <div class="header-page">
                    <div class="left"></div>
                    <div class="clock right">
                        <div class="icone">
                            <span class="glyphicon glyphicon-time"></span>
                            <span class="date" style="padding-left: 5px;"><?php echo formatDate(date('d-m-Y'));?></span>
                        </div>
                        <div class="heure">
                            <span id="montre"></span>
                        </div>
                    </div>

                    <div class="clear"></div>

                </div>

                <!-- content layout -->
                <div class="content-view container-fluid">

                    <div class="views">
                        <?php if (isset($title_v) AND !empty($title_v)):?>
                        <div class="title-view bg-info">
                            <p><?php echo ucfirst($title_v); ?></p>
                        </div>
                        <?php endif; ?>

                        <div class="view">
                            <?php echo $content_page ?>
                        </div>
                    </div>
                    
                    <div id="loading">
                        <div class="img">
                            <img src="<?php echo WEB_URL . 'public' . DS . 'img' . DS . 'icones' . DS . 'loading.gif'?>" alt="">
                        </div>
                        <p>Veillez patienter svp  ...</p>
                    </div>

                </div>

            </div>

            <div class="clear"></div>

        </div>
    </body>

    <script !src="">

        $(document).ready(function() {
            $('.myNav').simpleAccordion({
                'item'	   : '.ui-accordion-item',
                'trigger'  : '.ui-accordion-trigger',
                'content'  : '.ui-accordion-content',
                'active'   : 'active',
                'autoClose': false,
                'multiOpen': false,
                'speed'    : 300
            });
        });

        (function($){
            /*
                            $(window).on("load",function(){
                                $(".container-menus").mCustomScrollbar({
                                    theme: "dark-3",
                                    scrollInertia: 200
                                });
                            });
                            */
        })(jQuery);


    </script>


</html>
