<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 14/04/2018
 * Time: 18:48
 */
?>

<div class="folder-patient">

    <ul class="nav nav-tabs">
        <li class="active"><a href="#folderOngle1" data-toggle="tab">Infos personnels</a></li>
        <li><a href="#folderOngle2" data-toggle="tab">Antécedant personnel</a></li>
        <li><a href="#folderOngle3" data-toggle="tab">Consultations</a></li>
        <li class="disabled"><a href="#folderOngle4" data-toggle="tab">Hospitalisation</a></li>
    </ul>
    <div class="tab-content">

        <!-- tab1 #folderOngle1 infos personnal -->
        <div class="tab-pane active folderOngle1" id="folderOngle1">


            <div class="content-tab">
                <div class="content-span folder-namePatient">
                    <span class="label">PATIENT: </span>
                    <span class="content"><?php echo ucfirst($patient->namePatient) . ' ' . ucfirst($patient->lastnamePatient)?></span>
                </div>

                <div class="content-span folder-sexePatient">
                    <span class="label">SEXE: </span>
                    <span class="content"><?php echo ($patient->sexe == 1) ? 'Homme' : 'Femme'; ?></span>
                </div>

                <div class="content-span folder-sexePatient">
                    <span class="label">CIVILITE: </span>
                    <span class="content"><?php echo $civilite->libelle; ?></span>
                </div>

                <div class="content-span folder-agePatient">
                    <span class="label">AGE: </span>
                    <span class="content"><?php echo calculAge($patient->date_naissance) . ' ANS'; ?></span>
                </div>

                <div class="content-span folder-placePatient">
                    <span class="label">LIEU DE NAISSANCE: </span>
                    <span class="content"><?php echo $patient->lieu_naissance; ?></span>
                </div>

                <div class="content-span folder-quartierPatient">
                    <span class="label">QUARTIER DE RESIDANCE: </span>
                    <span class="content"><?php echo $patient->quartierPatient; ?></span>
                </div>

                <div class="content-span folder-telPatient">
                    <span class="label">TELEPHONE: </span>
                    <span class="content"><?php echo $patient->telPatient; ?></span>
                </div>

                <div class="content-span folder-mailPatient">
                    <span class="label">EMAIL: </span>
                    <span class="content"><?php echo $patient->mailPatient; ?></span>
                </div>

                <div class="content-span folder-paysPatient">
                    <span class="label">PAYS D'ORIGINE: </span>
                    <span class="content"><?php echo $pays->libelle; ?></span>
                </div>
            </div>



        </div>

        <div class="tab-pane" id="folderOngle2">Antecedant</div>
        <div class="tab-pane" id="folderOngle3">Toutes les consultation</div>
        <div class="tab-pane" id="folderOngle4">Toutes les hospitalisation</div>
    </div>

</div>
