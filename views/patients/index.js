$(document).ready(function () {

});


function updateId(id) {
    $('#idPatientAction').val(id);
    //console.log($('#idPatientAction').val(id));
}



function updateId2(id) {
    $('#idPatientAction').val(id);


    $.ajax({
        url: 'loadModalUpdatePatient',
        type: 'POST',
        dataType: 'json',
        data: {
            'idPatient': $('#idPatientAction').val()
        },
        success: function (data) {
            $('#update-patient').html(data.resultat);
        },
        error: function () {
            aler('Une erreur s\'est produite');
        }
    })

    //console.log($('#idPatientAction').val(id));
}




function deletePatient() {
    var idpatient = $('#idPatientAction').val();

    $.ajax({
        url: 'ajaxDeletePatient',
        type: 'POST',
        dataType: 'json',
        data: {
            'idPatient': idpatient
        },
        success: function (data) {
            console.log(data.conf);

            if (data.conf == 1){
                $('#tbodyTabListPatient').html(data.resultat);
            }
        },
        error: function () {
            alert('Une erreur s\'est produite');
        }
    })
}