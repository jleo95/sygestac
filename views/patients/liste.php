<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 12/04/2018
 * Time: 13:10
 */

?>

<div class="patient-liste">

    <div style="width: 90%; margin: auto;">


        <div class="clear"></div>
    </div>

    <script>

        $(document).ready(function () {
            var dHeight;
            dHeight = $('.container-dataTable').height() - 195;
            $("#tablePatient").DataTable({
                'scrollY': dHeight,
                'scrollCollapse': false,
                "aaSorting": [],
                "pageLength": 200,
                "paging": true,
                "searching": true,
                "bInfo": true,
                "columns": [
                    {data: "#", width: "7%"},
                    {data: "NOM", width: null},
                    {data: "SEXE", width: "5%"},
                    {data: "TELEPHONE", width: "20%"},
                    {data: "ACTION", width: "5%"}
                ],
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
                        "sPrevious": "<<",
                        "sNext": ">>",
                        "sLast": "Dernier"
                    },
                    "oAria": {
                        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                    }
                }
            });

            $('.dataTables_scrollBody').addClass('scrollbar-deep-purple');
            $('.dataTables_scrollBody').addClass('bordered-deep-purple');
            //$('.dataTables_scrollBody').css('width', '98.6%');


        });

    </script>


    <div class="container-dataTable">

        <div class="dataTable-title bg-primary">

            <div class="left">
                <span>LISTE DES PATIENTS</span>
            </div>
            <div class="btn-groupe right">
                <button class="" data-toggle="modal" data-target="#add-patient"><span class="glyphicon glyphicon-plus"></span> Ajouter</button>
            </div>
            <div class="clear"></div>
        </div>

        <div class="table-content">

            <?php
            if (isset($success) AND $success){
                ?>
                <div style="padding: 10px; margin: auto; margin-bottom: 10px; text-align: center; -webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;"class="bg-success">
                    <p>Vous avez ajouter un nouveau patient</p>
                </div>
                <?php
            }elseif (isset($success) AND !$success){
                ?>
                <div style="padding: 10px; margin: auto; margin-bottom: 10px; width: 90%; text-align: center; -webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;"class="bg-warning">
                    <p>Error: Patient non ajouter</p>
                </div>
            <?php
            }
            ?>

            <table class="table table-bordered table-striped" id="tablePatient">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom & prénom</th>
                    <th>Sexe</th>
                    <th>Téléphone</th>
                    <th></th>
                </tr>
                </thead>

                <tbody id="tbodyTabListPatient">
                <?php
                $i = 0;

                foreach ($patients as $patient) {
                    ?>
                    <tr>
                        <td><?php echo ++ $i; ?></td>
                        <td><?php echo ucfirst($patient->name) . ' ' . ucfirst($patient->lastname); ?></td>
                        <td>
                            <?php
                            if ($patient->sexe == 1){
                                echo 'Homme';
                            }else{
                                echo 'Femme';
                            }
                            ?>
                        </td>
                        <td><?php echo $patient->telephone; ?></td>
                        <td>
                            <?php

                            if (isAuth('520') OR isAuth('521')){
                                $action = true ;
                            }
                            $down = 'dropdown';
                            if (count($patients) - $i <= 3){
                                $down = 'dropup';
                            }
                            $btnAction = '<div class="btn-group">' .
                                '<button class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span ' .
                                'class="glyphicon-cog glyphicon"></span> <span class="caret"></span></button>' .
                                '<ul class="dropdown-menu dropdown-menu-right">';

                            if (isAuth('204')){
                                $btnAction .= '<li><a href="folder/pat-' . $patient->idPatient . '"><span class="glyphicon glyphicon-user"></span> Profile</a></li>';
                                $action = true;
                            }else{
                                $btnAction .= '<li class="disabled"><a href="edit"><span class="glyphicon glyphicon-edit"></span> Voir profile</a></li>';
                            }

                            $btnAction .= '<li class="divider"></li>';

                            if (isAuth('520')){
                                $btnAction .= '<li onclick="updateId2(' . $patient->idPatient .')"><a href="#" data-toggle="modal" data-target="#update-patient"><span class="glyphicon glyphicon-edit"></span> Editer</a></li>';
                            }else{
                                $btnAction .= '<li class="disabled"><a href="edit"><span class="glyphicon glyphicon-edit"></span> Editer</a></li>';
                            }
                            $btnAction .= '<li class="divider"></li>';

                            if (isAuth('521')){
                                $btnAction .= '<li onclick="updateId(' . $patient->idPatient .')" ><a href="#" data-toggle="modal" data-target="#delete-patient"><span class="glyphicon glyphicon-remove"></span> Supprimer</a></li>';
                            }else{
                                $btnAction .= '<li class="disabled"><a href="delete"><span class="glyphicon glyphicon-remove"></span> Supprimer</a></li>';
                            }

                            if (isAuth('52')){
                                $btnAction .= '<li class="divider"></li>';
                                $btnAction .= '<li class=""><a href="delete"><span class="glyphicon glyphicon-print"></span> Fiche patient</a></li>';
                                $action = true;
                            }else{
                                //$btnAction .= '<li class="disabled"><a href="delete"><span class="glyphicon glyphicon-print"></span> Imprimer fiche patient</a></li>';
                            }
                            
                            $btnAction .= '</ul></div>';
                            
                            echo $btnAction;
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>

            </table>
        </div>

    </div>

    <input type="hidden" name="" id="idPatientAction">

    <div class="modal fade" id="delete-patient">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">Suppression</h4>
                </div>
                <div class="modal-body">
                    Voulez-vous vraiment suppremier ce patients
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" onclick="deletePatient()">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="add-patient">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title">Ajouter un nouveau patient</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="formAddPatient">
                <div class="modal-body">

                        <div class="add-patientForm" style="margin: auto; text-align: center;">



                            <div class="form-inline form-group" style="width: 100%">
                                <input type="text" name="addNamePatient" id="addNamePatient" class="form-control"
                                       placeholder="nom de famille" required style="width: 49%">
                                <input type="text" name="addLastnamePatient" id="addLastnamePatient" class="form-control" placeholder="prénom" style="width: 49%">
                            </div>
                            <div class="form-inline form-group">
                                <label for="addSexeMalePatient"><input type="radio" value="1" name="addSexePatient" id="addSexeMalePatient" class="radio"> Masculin</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label for="addSexeFemalPatient"><input type="radio" value="2" name="addSexePatient" id="addSexeFemalPatient" class="radio"> Feminin</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <select name="addCivilitePatient" id="addCivilitePatient" required class="form-control">
                                    <option value="">Civilité</option>
                                    <?php
                                    foreach ($civilites as $civilite) {
                                        ?>
                                        <option value="<?php echo $civilite->id ?>"><?php echo $civilite->libelle ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                                <select name="addPaysPatient" id="addPaysPatient" required class="form-control">
                                    <option value="">Nationnalitee</option>
                                    <?php
                                    foreach ($pays as $pay) {
                                        ?>
                                        <option value="<?php echo $pay->idpays ?>"><?php echo $pay->libelle?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>

                            <div class="form-group form-inline">
                                <input type="text" name="addDayPatient" id="addDayPatient" class="form-control" maxlength="2" required
                                       placeholder="jj" style="width: 50px; text-align: center">
                                <select name="addMonthPatient" id="addMonthPatient" required class="form-control">
                                    <option value="">mois</option>

                                    <?php
                                    $arrayMonth  = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aoute', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
                                    $month = $arrayMonth;

                                    foreach ($month as $m => $v) {
                                        ?>
                                        <option value="<?php echo $m + 1 ?>"><?php echo $v?></option>
                                        <?php
                                    }
                                    ?>

                                </select>

                                <input type="text" name="addYearPatient" id="addYearPatient" class="form-control" required
                                       placeholder="aaaa" style="width: 90px;" maxlength="4">
                                <input type="text" name="addPlacePatient" id="addPlacePatient" class="form-control" required
                                       placeholder="lieu de naissance" style="width: 51.5%">
                            </div>

                            <div class="form-group form-inline">
                                <input type="text" name="addProfessionPatient" id="addProfessionPatient"
                                       placeholder="proféssion" class="form-control" style="width: 49%">
                                <input type="text" name="addQuartierPatient" id="addQuartierPatient"
                                       placeholder="quartier de residence" class="form-control" style="width: 49%">
                            </div>

                            <div class="form-group form-inline">
                                <input type="text" name="addTelephonePatient" id="addTelephonePatient" required
                                       placeholder="numéro de téléphone" class="form-control" style="width: 49%">
                                <input type="text" name="addEmailPatient" id="addEmailPatient"
                                       placeholder="adresse mail" class="form-control" style="width: 49%">
                            </div>
                            <div class="form-group form-inline">
                                <input type="text" name="addPoidsPatient" id="addPoidsPatient" required
                                       placeholder="poids (expemple 60)" class="form-control" style="width: 60%">
                                <select name="addGroupePatient" id="addGroupePatient" class="form-control" style="width: 38%">
                                    <option value="">Goupe sanguin</option>
                                    <?php
                                    foreach ($grpsanguins as $grpsanguin) {
                                        ?>
                                        <option value="<?php echo $grpsanguin->id ?>"><?php echo $grpsanguin->libelle?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="update-patient">

    </div>

</div>

<style>

    #delete-patient .modal-dialog {
        vertical-align: middle;
    }
</style>
