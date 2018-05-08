<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 11/04/2018
 * Time: 13:16
 */
?>

<div class="add-patient">
    <form action="" method="post">
        <?php
        if (isset($success) AND $success){
            ?>
            <div style="padding: 10px; margin: auto; margin-bottom: 10px; width: 90%; text-align: center; -webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;"class="bg-success">
                <p>Vous avez ajouter un nouveau patient</p>
            </div>
            <?php
        }
        ?>
        <div class="add-patientForm">



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
                       placeholder="lieu de naissance" style="width: 57.5%">
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

            <div class="btn-group">
                <input type="submit" value="Ajouter" class="btn btn-primary">
            </div>

        </div>

    </form>
</div>
