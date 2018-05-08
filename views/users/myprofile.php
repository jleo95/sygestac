<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 09/04/2018
 * Time: 14:44
 */
?>

<div class="myprofile">

    <div class="edit-avatar left">
        <form id="editAvatarForm" enctype="multipart/form-data">

            <div class="new-avatar">
                <label for="newAvatarFile">
                    <?php
                    if (isset($user->avatar) AND !empty($user->avatar)){
                        ?>
                        <img id="newAvatarImg" src="<?php echo WEB_URL . 'public' . DS . 'img' . DS . 'avatars' . DS . 'users' . DS . $user->avatar; ?>" alt="">
                        <?php
                    }else{
                        ?>
                        <img id="newAvatarImg"  src="<?php echo WEB_URL . 'public' . DS . 'img' . DS . 'avatars' . DS . 'users' . DS . 'avatar.png'; ?>" alt="">
                        <?php
                    }
                    ?>
                </label>
            </div>
            <input type="file" name="newAvatarFile" id="newAvatarFile">

            <div class="error-avatar error-profile"><p></p></div>

            <input type="submit" class="btn btn-primary" value="Sauvegarder">
        </form>
    </div>

    <div class="edit-infos right">

        <h3>Information personnel</h3>

        <form id="editInfosPerso" method="post">
            <div class="form-group">
                <input type="text" name="newLogin" id="newLogin" class="form-control" placeholder="nouveau login"
                       value="<?php echo (isset($user->username) AND !empty($user->username)) ? $user->username : '' ?>">
            </div>
            <div class="form-group">
                <input type="text" name="newPwd" id="newPwd" class="form-control" placeholder="nouvelle adresse email"
                       value="<?php echo (isset($user->username) AND !empty($user->email)) ? $user->email : '' ?>">
            </div>
            <div class="form-group">
                <input type="email" name="newEmail" id="newEmail" class="form-control" placeholder="nouveau mot de passe">
            </div>

            <div class="error-infos error-profile"><p></p></div>

            <div class="btn-group">
                <input type="submit" value="Sauvegarder" class="btn btn-primary">
            </div>

        </form>
    </div>

    <div class="clear"></div>

</div>
