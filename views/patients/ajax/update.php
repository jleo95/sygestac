<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 17/04/2018
 * Time: 11:16
 */

$date = $editPat->dateNaissance;

$y = date('Y', strtotime($date));
$mm = date('m', strtotime($date));
$dd = date('d', strtotime($date));


?>

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <span class="modal-title">Mettre à jour les infos</span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="updatePatient" method="post" id="formeditPatient">
            <div class="modal-body">

                <legend>Infos personnelles</legend>

                <div class="edit-patientForm" style="margin: auto; text-align: center;">

                    <input type="hidden" name="editIdPatient" value="<?php echo $editPat->idPatient; ?>">
                    <div class="form-inline form-group" style="width: 100%">
                        <input type="text" name="editNamePatient" id="editNamePatient" value="<?php echo $editPat->name; ?>" class="form-control"
                               placeholder="nom de famille" required style="width: 49%">
                        <input type="text" name="editLastnamePatient" id="editLastnamePatient"
                               value="<?php echo (isset($editPat->lastname) AND !empty($editPat->lastname)) ? $editPat->lastname : ''; ?>"
                               class="form-control" placeholder="prénom" style="width: 49%">
                    </div>
                    <div class="form-inline form-group">
                        <label for="editSexeMalePatient">
                            <input type="radio" value="1" name="editSexePatient" <?php echo (!empty($editPat->sexe) AND intval($editPat->sexe) == 1) ? 'checked' : '' ?>
                                   id="editSexeMalePatient" class="radio">
                            Masculin</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="editSexeFemalPatient">
                            <input type="radio" value="2" name="editSexePatient" <?php echo (!empty($editPat->sexe) AND intval($editPat->sexe) == 2) ? 'checked' : '' ?>
                                   id="editSexeFemalPatient" class="radio"> Feminin</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="editCivilitePatient" id="editCivilitePatient" required class="form-control">
                            <option value="">Civilité</option>
                            <?php
                            foreach ($civilites as $civilite) {
                                ?>
                                <option value="<?php echo $civilite->id ?>" <?php echo (!empty($editPat->civilite) AND intval($editPat->civilite) == $civilite->id) ? 'selected' : '' ?> >
                                    <?php echo $civilite->libelle ?></option>
                                <?php
                            }
                            ?>
                        </select>

                        <select name="editPaysPatient" id="editPaysPatient" required class="form-control">
                            <option value="">Nationnalitee</option>
                            <?php
                            foreach ($pays as $pay) {
                                ?>
                                <option value="<?php echo $pay->idpays ?>" <?php echo (!empty($editPat->pays) AND intval($editPat->pays) == $pay->idpays) ? 'selected' : '' ?>>
                                    <?php echo $pay->libelle?></option>
                                <?php
                            }
                            ?>
                        </select>

                    </div>

                    <div class="form-group form-inline">
                        <input type="text" name="editDayPatient" id="editDayPatient" class="form-control" maxlength="2" value="<?php echo $dd ?>" required
                               placeholder="jj" style="width: 50px; text-align: center">
                        <select name="editMonthPatient" id="editMonthPatient" required class="form-control">
                            <option value="">mois</option>

                            <?php
                            $arrayMonth  = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aoute', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
                            $month = $arrayMonth;

                            foreach ($month as $m => $v) {
                                ?>
                                <option value="<?php echo $m + 1 ?>" <?php echo (intval($mm) == $m + 1) ? 'selected' : '' ?>>
                                    <?php echo $v?></option>
                                <?php
                            }
                            ?>

                        </select>

                        <input type="text" name="editYearPatient" id="editYearPatient" class="form-control" value="<?php echo $y?>" required
                               placeholder="aaaa" style="width: 90px;" maxlength="4">
                        <input type="text" name="editPlacePatient" id="editPlacePatient" class="form-control" value="<?php echo $editPat->lieuNaissance?>" required
                               placeholder="lieu de naissance" style="width: 51.5%">
                    </div>

                    <div class="form-group form-inline">
                        <input type="text" name="editProfessionPatient" id="editProfessionPatient" value="<?php echo $editPat->profession ?>"
                               placeholder="proféssion" class="form-control" style="width: 49%">
                        <input type="text" name="editQuartierPatient" id="editQuartierPatient" value="<?php echo $editPat->adresse ?>"
                               placeholder="quartier de residence" class="form-control" style="width: 49%">
                    </div>

                    <div class="form-group form-inline">
                        <input type="text" name="editTelephonePatient" id="editTelephonePatient" value="<?php echo $editPat->telephone ?>" required
                               placeholder="numéro de téléphone" class="form-control" style="width: 49%">
                        <input type="text" name="editEmailPatient" id="editEmailPatient" value="<?php echo $editPat->mail ?>"
                               placeholder="adresse mail" class="form-control" style="width: 49%">
                    </div>

                    <legend>Antécedants</legend>
                    
                    <div class="form-group form-inline">
                        <input type="text" name="editPoidsPatient" id="editPoidsPatient" required value="<?php echo $editPat->poids; ?>"
                               placeholder="poids (expemple 60)" class="form-control" style="width: 60%">
                        <select name="editGroupePatient" id="editGroupePatient" class="form-control" style="width: 38%">
                            <option value="">Goupe sanguin</option>
                            <?php
                            foreach ($grpsanguins as $grpsanguin) {
                                ?>
                                <option value="<?php echo $grpsanguin->id ?>" <?php echo (!empty($editPat->sanguin) AND intval($editPat->sanguin) == $grpsanguin->id) ? 'selected' : '' ?> >
                                    <?php echo $grpsanguin->libelle?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </form>
    </div>
</div>
