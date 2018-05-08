<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 11/04/2018
 * Time: 13:14
 */

namespace Controllers;


use Core\Controller;

class PatientController extends Controller
{

    protected $id = 'idPatient';
    public function __construct($request = NULL)
    {
        parent::__construct($request);

        $this->views->setStyle('patients' . DS . 'patient');
        $this->views->setJS('patients' . DS . 'index');
    }


    public function add()
    {
        $grpsanguins = $this->Groupesanguin->all();
        $civilites = $this->Civilites->all();
        $pays = $this->Pays->all();
        $this->views->assign('civilites', $civilites);
        $this->views->assign('grpsanguins', $grpsanguins);
        $this->views->assign('pays', $pays  );

        if ($_POST){

            $data = [];
            $antecedant = [];

            if (isset($this->input->addNamePatient) AND !empty($this->input->addNamePatient)){
                $data ['name'] = $this->input->addNamePatient;
            }
            if (isset($this->input->addLastnamePatient) AND !empty($this->input->addLastnamePatient)){
                $data ['lastname'] = $this->input->addLastnamePatient;
            }
            if (isset($this->input->addSexePatient) AND !empty($this->input->addSexePatient)){
                $data ['sexe'] = $this->input->addSexePatient;
            }
            if (isset($this->input->addCivilitePatient) AND !empty($this->input->addCivilitePatient)){
                $data ['civilite'] = $this->input->addCivilitePatient;
            }
            if (isset($this->input->addDayPatient) AND !empty($this->input->addDayPatient)
                AND isset($this->input->addMonthPatient) AND !empty($this->input->addMonthPatient)
                AND isset($this->input->addYearPatient) AND !empty($this->input->addYearPatient)){
                $d = intval($this->input->addDayPatient);
                $m = $this->input->addMonthPatient;
                $y = $this->input->addYearPatient;

                if ($d < 10){
                    $d = '0' . $d;
                }
                $data ['dateNaissance'] = $y . '-' . $m . '-' . $d;
            }


            if (isset($this->input->addPlacePatient) AND !empty($this->input->addPlacePatient)){
                $data ['lieuNaissance'] = $this->input->addPlacePatient;
            }
            if (isset($this->input->addProfessionPatient) AND !empty($this->input->addProfessionPatient)){
                $data ['profession'] = $this->input->addProfessionPatient;
            }
            if (isset($this->input->addQuartierPatient) AND !empty($this->input->addQuartierPatient)){
                $data ['adresse'] = $this->input->addQuartierPatient;
            }
            if (isset($this->input->addTelephonePatient) AND !empty($this->input->addTelephonePatient)){
                $data ['telephone'] = $this->input->addTelephonePatient;
            }
            if (isset($this->input->addEmailPatient) AND !empty($this->input->addEmailPatient)){
                $data ['mail'] = $this->input->addEmailPatient;
            }
            if (isset($this->input->addPoidsPatient) AND !empty($this->input->addPoidsPatient)){
                $antecedant ['poids'] = $this->input->addPoidsPatient;
            }

            if (isset($this->input->addGroupePatient) AND !empty($this->input->addGroupePatient)){
                $antecedant ['groupeSanguin'] = $this->input->addGroupePatient;
            }
            if (isset($this->input->addPaysPatient) AND !empty($this->input->addPaysPatient)){
                $data ['pays'] = $this->input->addPaysPatient;
            }

            if (!empty($data)){
                if ($this->Patients->insert($data)){
                    $antecedant['patient'] = $this->Patients->lastId();
                    $this->Antecedants->insert($antecedant);
                    $success = true;
                    $this->views->assign('success', $success);
                }
            }

        }

        $this->views->setTitle('nouveau patient', 'p');
        $this->views->setTitle('nouveau patient', 'v');
        $this->views->render('patients' . DS . 'add');
    }

    public function liste()
    {
        $lists = $this->Patients->all();
        $this->views->assign('patients', $lists);
        $grpsanguins = $this->Groupesanguin->all();
        $civilites = $this->Civilites->all();
        $pays = $this->Pays->all();
        $this->views->assign('civilites', $civilites);
        $this->views->assign('grpsanguins', $grpsanguins);
        $this->views->assign('pays', $pays  );

        $this->views->assign('btnAction', $this->bootstrap->btnAction());
        $this->views->assign('btnPrint', $this->bootstrap->btnPrint());



        if ($_POST){

            $data = [];
            $antecedant = [];

            if (isset($this->input->addNamePatient) AND !empty($this->input->addNamePatient)){
                $data ['name'] = $this->input->addNamePatient;
            }
            if (isset($this->input->addLastnamePatient) AND !empty($this->input->addLastnamePatient)){
                $data ['lastname'] = $this->input->addLastnamePatient;
            }
            if (isset($this->input->addSexePatient) AND !empty($this->input->addSexePatient)){
                $data ['sexe'] = $this->input->addSexePatient;
            }
            if (isset($this->input->addCivilitePatient) AND !empty($this->input->addCivilitePatient)){
                $data ['civilite'] = $this->input->addCivilitePatient;
            }
            if (isset($this->input->addDayPatient) AND !empty($this->input->addDayPatient)
                AND isset($this->input->addMonthPatient) AND !empty($this->input->addMonthPatient)
                AND isset($this->input->addYearPatient) AND !empty($this->input->addYearPatient)){
                $d = intval($this->input->addDayPatient);
                $m = $this->input->addMonthPatient;
                $y = $this->input->addYearPatient;

                if ($d < 10){
                    $d = '0' . $d;
                }
                $data ['dateNaissance'] = $y . '-' . $m . '-' . $d;
            }


            if (isset($this->input->addPlacePatient) AND !empty($this->input->addPlacePatient)){
                $data ['lieuNaissance'] = $this->input->addPlacePatient;
            }
            if (isset($this->input->addProfessionPatient) AND !empty($this->input->addProfessionPatient)){
                $data ['profession'] = $this->input->addProfessionPatient;
            }
            if (isset($this->input->addQuartierPatient) AND !empty($this->input->addQuartierPatient)){
                $data ['adresse'] = $this->input->addQuartierPatient;
            }
            if (isset($this->input->addTelephonePatient) AND !empty($this->input->addTelephonePatient)){
                $data ['telephone'] = $this->input->addTelephonePatient;
            }
            if (isset($this->input->addEmailPatient) AND !empty($this->input->addEmailPatient)){
                $data ['mail'] = $this->input->addEmailPatient;
            }
            if (isset($this->input->addPoidsPatient) AND !empty($this->input->addPoidsPatient)){
                $antecedant ['poids'] = $this->input->addPoidsPatient;
            }

            if (isset($this->input->addGroupePatient) AND !empty($this->input->addGroupePatient)){
                $antecedant ['groupeSanguin'] = $this->input->addGroupePatient;
            }
            if (isset($this->input->addPaysPatient) AND !empty($this->input->addPaysPatient)){
                $data ['pays'] = $this->input->addPaysPatient;
            }

            if (!empty($data)){
                if ($this->Patients->insert($data)){
                    $antecedant ['patient'] = $this->Patients->lastId();
                    /*var_dump($antecedant);
                    die();*/
                    $this->Antecedants->insert($antecedant);
                    $success = true;
                    $this->views->assign('success', $success);
                }else{
                    $success = false;
                }
            }

        }



        $this->views->setTitle('Gestion des patients');
        $this->views->setTitle('Gestion des patients', 'v');
        $this->views->render('patients' . DS . 'liste');
    }

    public function folder()
    {
        $patient = $this->Patients->getById(str_replace('pat-', '', $this->request->params[0]));
        $civilite = $this->Civilites->getById($patient->civilitePatient);
        $pays = $this->Pays->getById($patient->pays);
        $this->views->assign('patient', $patient);
        $this->views->assign('civilite', $civilite);
        $this->views->assign('pays', $pays);
        $this->views->render('patients' . DS . 'folder');
    }


    public function ajaxDeletePatient()
    {
        $idPatient = $this->input->idPatient;

        if ($this->Patients->deleteById($idPatient)){
            $patients = $this->Patients->all();
            $this->views->assign('patients', $patients);
            $tab = $this->views->ajax('patients' . DS . 'ajax' . DS . 'liste');
            $data = [
                'resultat' => $tab,
                    'conf' => 1
            ];
            echo json_encode($data);
        }else{
            $data = [
                'resultat' => 'Supppression échoué',
                'conf' => 0
            ];
            echo json_encode($data);
        }
    }


    public function loadModalUpdatePatient()
    {
        //$idpatient = $this->input->
        $grpsanguins = $this->Groupesanguin->all();
        $civilites = $this->Civilites->all();
        $pays = $this->Pays->all();
        $this->views->assign('civilites', $civilites);
        $this->views->assign('grpsanguins', $grpsanguins);
        $this->views->assign('pays', $pays  );
        $patient = $this->Patients->getById($this->input->idPatient);
        $this->views->assign('editPat', $patient);
        $data = [
            'resultat' => $this->views->ajax('patients' . DS . 'ajax' . DS . 'update')
        ];

        echo json_encode($data);
    }

    public function updatePatient()
    {
        if ($_POST){
            $data = [];
            $patient = $this->Patients->getById($this->input->editIdPatient);

            if (isset($this->input->editNamePatient) AND
                !empty($this->input->editNamePatient) AND $this->input->editNamePatient !== $patient->namePatient) {
                $data ['namePatient'] = $this->input->editNamePatient;
            }

            if (isset($this->input->editLastnamePatient) AND !empty($this->input->editLastnamePatient) AND
                $this->input->editLastnamePatient !== $patient->lastnamePatient) {
                $data ['lastnamePatient'] = $this->input->editLastnamePatient;
            }

            if (isset($this->input->editSexePatient) AND
                !empty($this->input->editSexePatient) AND $this->input->editSexePatient !== $patient->sexe) {
                $data ['sexe'] = $this->input->editSexePatient;
            }

            if (isset($this->input->editCivilitePatient) AND
                !empty($this->input->editCivilitePatient) AND $this->input->editCivilitePatient !== $patient->civilitePatient) {
                $data ['civilitePatient'] = $this->input->editCivilitePatient;
            }

            if (isset($this->input->editPaysPatient) AND
                !empty($this->input->editPaysPatient) AND $this->input->editPaysPatient !== $patient->pays) {
                $data ['pays'] = $this->input->editPaysPatient;
            }

            if (isset($this->input->editPlacePatient) AND
                !empty($this->input->editPlacePatient) AND $this->input->editPlacePatient !== $patient->lieu_naissance) {
                $data ['lieu_naissance'] = $this->input->editPlacePatient;
            }

            if (isset($this->input->editProfessionPatient) AND
                !empty($this->input->editProfessionPatient) AND $this->input->editProfessionPatient !== $patient->professionPatient) {
                $data ['professionPatient'] = $this->input->editProfessionPatient;
            }

            if (isset($this->input->editQuartierPatient) AND
                !empty($this->input->editQuartierPatient) AND $this->input->editQuartierPatient !== $patient->quartierPatient) {
                $data ['quartierPatient'] = $this->input->editQuartierPatient;
            }

            if (isset($this->input->editTelephonePatient) AND
                !empty($this->input->editTelephonePatient) AND $this->input->editTelephonePatient !== $patient->telPatient) {
                $data ['telPatient'] = $this->input->editTelephonePatient;
            }

            if (isset($this->input->editPoidsPatient) AND
                !empty($this->input->editPoidsPatient) AND $this->input->editPoidsPatient !== $patient->poids) {
                $data ['poids'] = $this->input->editPoidsPatient;
            }

            if (isset($this->input->editGroupePatient) AND
                !empty($this->input->editGroupePatient) AND $this->input->editGroupePatient !== $patient->grpSanguine) {
                $data ['grpSanguine'] = $this->input->editGroupePatient;
            }

            if (isset($this->input->editDayPatient) AND !empty($this->input->editDayPatient) AND
                isset($this->input->editMonthPatient) AND !empty($this->input->editMonthPatient) AND
                isset($this->input->editYearPatient) AND !empty($this->input->editYearPatient)) {

                $date = $this->input->editYearPatient . '-' . $this->input->editMonthPatient . '-' . $this->input->editDayPatient;
                if ($date !== $patient->date_naissance) {
                    $data ['date_naissance'] = $date;
                }
            }

            if (!empty($data)){
                if ($this->Patients->update($data, ['idPatient' => $patient->idPatient])){
                    $success = true;
                    $this->views->assign('success', $success);
                }else{
                    $success = false;
                }
            }else{
                $success = false;
            }

            header('Location:' . WEB_URL . 'patient' . DS . 'liste');
        }
    }


    public function profile()
    {
        //var_dump($this->request);
        $patient = $this->Patients->getById(str_replace('pat-', '', $this->request->params[0]));
        $this->views->assign('patient', $patient);
        $this->views->setTitle('', 'v');
        $this->views->render('patients' . DS . 'profile');
    }

}