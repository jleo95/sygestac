/**
 * Created by LEOBA on 24/02/2018.
 */

//$("head").append('<script type="text/javascript" src="http://localhost/sygestac/public/js/jquery-3.0.0.min.js"></script>');
$("head").append('<script type="text/javascript" src="http://localhost/sygestac/public/js/bootstrap.js"></script>');
$("head").append('<script type="text/javascript" src="http://localhost/sygestac/public/js/jquery.dataTables.min.js"></script>');
$("head").append('<script type="text/javascript" src="http://localhost/sygestac/public/js/dataTables.bootstrap.min.js"></script>');
$("head").append('<script type="text/javascript" src="http://localhost/sygestac/public/js/jquery.simpleAccordion.min.js"></script>');
$("head").append('<script type="text/javascript" src="http://localhost/sygestac/public/js/jquery.mCustomScrollbar.concat.min.js"></script>');


$(document).ready(function () {

    $(document).ajaxStart(function () {
        $("#loading").show();
    }).ajaxStop(function () {
        $("#loading").hide();
    });

    setInterval(function () {
        var date = new Date();
        var h = date.getHours();
        var s = date.getSeconds();
        var m = date.getMinutes();
        if(h <= 9)
            heure = "0"+h;
        else
            heure = h;
        if(m <= 9)
            minute = "0"+m;
        else
            minute = m;
        if(s <= 9)
            seconde = "0"+s;
        else
            seconde = s;
        var hrs = heure+":"+minute+":"+seconde;
        $('#montre').html(hrs);
    }, 1000);

    var dHeight;
    dHeight = $('.container-dataTable').height();

    $.extend($.fn.dataTable.default, {
        "aaSorting": [],
        "scrollCollapse": false,
        "scrollY": dHeight,
        "pageLength": 200,
        "paging": true,
        "searching": true,
        "bInfo": true,
        //"dom": '<"tableWrapper"fl>',
        "jQueryUI": true,
        "language": {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher&nbsp;:",
            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix": "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "Pr&eacute;c&eacute;dent",
                "sNext": "Suivant",
                "sLast": "Dernier"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            }
        }
    });
    function scrollDeepPurple(classname) {
        var name = '.' + classname;
        console.log(name);
        $(name).addClass('scrollbar-deep-purple');
        $(name).addClass('bordered-deep-purple');
    }
});



function heure_t(){
    var date = new Date();
    var h = date.getHours();
    var s = date.getSeconds();
    var m = date.getMinutes();
    if(h <= 9)
        heure = "0"+h;
    else
        heure = h;
    if(m <= 9)
        minute = "0"+m;
    else
        minute = m;
    if(s <= 9)
        seconde = "0"+s;
    else
        seconde = s;
    var hrs = heure+":"+minute+":"+seconde;
    $('#montre').html(hrs);
}


function updateMenu(etatmenu, idgroup) {
    var _url = $(location).attr("pathname");
    _url = _url.split('/');

    var _chemin = "users";

    if (_url.length === 3) {
        if (_url[2] !== "") {
            _chemin = _url[2];
        }
    }
    if (_url.length === 4) {
        if (_url[3] !== "") {
            _chemin = "./";
        } else {
            _chemin = _url[2];
        }
    }

    etatmenu = etatmenu.toString();

    console.log(etatmenu);

    $.ajax({
        url: _chemin + '/ajaxUpdateMenu',
        type: 'post',
        dataType: 'html',
        data: {
            'etatmenu': etatmenu,
            'idgroupe': idgroup
        },
        success: function (data) {
        }
    });
}



