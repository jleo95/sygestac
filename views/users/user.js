$(document).ready(function (even) {

    var subAvatar = true;

    $('#newAvatarFile').change(function () {
        var file = this.files[0];
        var typeImage = file.type;
        var arrEx = ["image/jpeg", "image/png", "image/jpeg"];
        var maxSize = 5097152;
        subAvatar = false;
        $('.error-avatar p').html('')

        if (!(typeImage == arrEx[0] || typeImage == arrEx[1] || typeImage == arrEx[2])) {
            subAvatar = false;
            $('.error-avatar p').html('Extension non autorisé <br> Veillez chosir un fichier de type : png ou jpg ou jpeg') ;
        }else if (file.size > maxSize){
            subAvatar = false;
            $('.error-avatar p').html('Taille non autorisé <br> Votre fichier ne doit pas depasser 5Mo') ;
        }else {
            subAvatar = true;
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });



    /** uploader la photo de profile */
    $('#editAvatarForm').submit(function (even) {
       even.preventDefault();

        $.ajax({
            url: '/sygestac/users/ajaxEditAvatar',
            type: 'post',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                if (data.resultat == 1){
                    $('.error-avatar p').html('Votre photo de profile a été modifiée');
                    $('.error-avatar p').css('color', 'green');
                }else {
                    $('.error-avatar p').html(data.resultat);
                }
            }
        });

    });

    /** mettre a jour les infos personnels*/
    $('#editInfosPerso').submit(function (even) {
       even.preventDefault();

        $('.error-avatar p').html('')

        $.ajax({
            url: '/sygestac/users/ajaxEditInfosPerso',
            type: 'post',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                if (data.resultat == 1){
                    $('.error-infos p').html('Vos information ont été mit à jour');
                    $('.error-infos p').css('color', 'green');
                }else {
                    $('.error-avatar p').html(data.resultat);
                }
            }
        });

    });

});


function imageIsLoaded(e) {
    $('#newAvatarImg').attr('src', e.target.result);
};
