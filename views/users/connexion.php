<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 07/04/2018
 * Time: 14:00
 */

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo WEB_URL . 'public' . DS . 'css' . DS ?>style.css">
        <?php echo $style; ?>
        
        
        <title><?php echo ucfirst($title_p)?></title>
    </head>
    <body>

        <div class="container container-connxion">
            <div class="container-fluid logo-connexion">
                <div>
                    <img src="<?php echo WEB_URL . DS . 'public' . DS . 'img' . DS . 'logo' . DS . 'logo.jpg'?>" alt="">
                </div>


            </div>
            <form method="post">
                <?php
                if (isset($error) AND !empty($error)){
                    ?>
                    <div class="bg-danger error-connection"><span><?php echo $error ?></span></div>
                    <div class="btn-group btn-group-justified" style="width: 60%; margin: auto;">
                        <input type="submit" value="Ressayer" class="btn btn-danger" style="width: 100%">
                    </div>
                <?php
                }else {
                    ?>
                    <div class="form-group">
                        <input type="text" name="login" id="login" class="form-control"
                               placeholder="votre login, ou nom d'utilisateur">
                    </div>
                    <div class="form-group">
                        <input type="password" name="pwd" id="pwd" class="form-control"
                               placeholder="votre mot de passe">
                    </div>

                    <div class="btn-group" style="width: 100%">
                        <input type="submit" value="Se connecter" class="btn btn-primary" style="width: 100%">
                    </div>
                    <?php
                }
                ?>
            </form>
        </div>

    </body>
</html>
