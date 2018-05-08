<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 07/04/2018
 * Time: 12:59
 */

namespace Lib;


use Core\Session;
use Core\Table;

class Views
{
    private $data;
    private $template = 'template';
    private $table;

    /**
     * Views constructor.
     */
    public function __construct()
    {
        $this->table = new Table();

        $this->data = [];
        $this->data['title_p'] = 'acueil';
        $this->data['title_v'] = 'acueil';
        $this->data['style'] = '';
        $this->data['css'] = '';
        $this->data['js'] = '';
        $this->data['menus'] = '';
        $this->data['droits'] = '';

        $this->setDroit();
    }


    /**
     * la methode qui permet de rendre une vue
     * @param $view la vue a rendre
     * @param bool $directoup
     */
    public function render($view, $directout = false)
    {
        if (!file_exists(ROOT . DS . 'views' . DS . $view . '.php')){
            $parts = explode('\\', $view);
            $parts = end($parts);
            $this->errors('404 Not Found', 'Le fichier ' . ROOT . DS . 'views' . DS . $view . '.php ne contient pas la vue ' . $parts);
        }

        extract($this->data);


        if (!$directout){
            ob_start();
        }

        require ROOT . DS . 'views' . DS . $view . '.php';

        if (!$directout){
            $content_page = ob_get_clean();
            require_once ROOT . DS . 'views' . DS . $this->template . '.php';
        }

    }


    /**
     * rendre une vue ajax
     * @param $view le chemin de la vue ajax
     * @param array $variables les variables a transmetre a la vue, par defaut elles sont null
     * @return string return le contenu du fichier
     */
    public function ajax($view, $variables = [])
    {
        $viewpath = ROOT . DS . 'views' . DS . $view . '.php';

        #verifie si le chemin ou le fichier existe
        if (!file_exists($viewpath)){
            $view = explode('\\', $view);
            $this->errors('404 Not Found', 'Le fichier ' . $viewpath . ' ne contient pas la vue ' . end($view));
        }

        #on recupere le contenu du fichier
        ob_start();
        if (isset($variables)) {
            extract($variables);
        }
        extract($this->data);
        require $viewpath;
        $resultat = ob_get_clean();
        return $resultat;
    }

    /**
     * editer un template
     * @param $template le nouveau template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * editer un titre
     * @param $title contenu du nouveau titre
     * @param string $type type de titre
     */
    public function setTitle($title, $type = 'p')
    {
        $this->data['title_' . $type] = $title;
    }


    /**
     * charger une feuille de style
     * @param $filename chemin du fichier qui contient la feuille de style
     */
    public function setStyle($filename)
    {
        if (file_exists(ROOT . DS . 'views' . DS . $filename . '.css')){
            $style = file_get_contents(ROOT . DS . 'views' . DS . $filename . '.css');
            $file = ROOT . DS . 'public' . DS . 'css' . DS . 'style_2.css';

            if (empty($this->data['style'])){
                fopen($file, 'w');
            }

            if (file_put_contents($file, $style, FILE_APPEND)){
                $css = "<link href = '" . WEB_URL . "public/css/style_2.css' rel = 'stylesheet' type = 'text/css' />";
                $this->data['style'] .= $css;
            }

        }else{
            $this->errors('Not Found', 'Le feuille de style ' . ROOT . DS . 'views' . DS . $filename . '.css');
        }
    }

    public function setJS($filename)
    {
        if (file_exists(ROOT . DS . 'views' . DS . $filename . '.js')){
            $script = file_get_contents(ROOT . DS . 'views' . DS . $filename . '.js');
            $file = ROOT . DS . 'public' . DS . 'js' . DS . 'clients.js';

            if (empty($this->data['js'])){
                fopen($file, 'w');
            }

            if (file_put_contents($file, $script, FILE_APPEND)){
                $client = '<script src="' . WEB_URL . 'public' . DS . 'js' . DS . 'clients.js"></script>';
                $this->data['js'] .= $client;
            }

        }else{
            $this->errors('Not Found', 'Le feuille de style ' . ROOT . DS . 'views' . DS . $filename . '.js');
        }
    }


    /**
     * transmetre une variable a une vue
     * @param $name nom de la variable
     * @param $value valeur de la varaible
     */
    public function assign($name, $value)
    {
        $this->data[$name] = $value;
    }


    public function setMenu()
    {
        $menus = '<ul class="myNav">' . PHP_EOL;
        $droits = $_SESSION['droitsuser'];
//        $etatmenu = json_encode(str_split($_SESSION['etatmenu']));
        $etatmenu = '"' . $_SESSION['etatmenu'] . '"';
        $etatmenu = str_replace('"', '\'', $etatmenu);

        $etatmenu2 = str_split($etatmenu);
        //var_dump($etatmenu2);
        /*$etatmenu = str_replace('[', '', $etatmenu);
        $etatmenu = str_replace(']', '', $etatmenu);
        $etatmenu = str_replace('\'', '', $etatmenu);
        $etatmenu = explode(',', $etatmenu);
        $etatmenu = implode($etatmenu, ',');*/
//        var_dump($etatmenu);

        $occ = [];

        for($i = 0; $i < count($droits); $i ++){
            $occ [] = '?';
        }
        $occ = implode($occ, ', ');

        $req = 'SELECT * FROM GROUPES g WHERE (' .
                  'SELECT COUNT(f.IDFONCTION) FROM FONCTIONNALITES f WHERE f.DROIT IN ( ' . $occ . ')) > 0';
        $groupes = $this->table->query($req, $droits);

        $g = 0;
        foreach ($groupes as $groupe) {
            $value = [];
            $value [] = $groupe->idgroupe;
            $d = $droits;
            $g++;
            foreach ($d as $dt) {
                $value [] = $dt;
            }
            $fonctions = $this->table->query('SELECT * FROM FONCTIONNALITES f ' .
                            'WHERE f.IDGROUPE = ? AND f.DROIT IN (' . $occ . ')', $value);

            if (count($fonctions) > 0){
                $active = '';
                if (intval($etatmenu2[$groupe->idgroupe]) == 1){
                    $active = 'active';
                }
                $menus .= '<li class="myNav-item ui-accordion-item ' . $active . '" onclick="updateMenu(' . $etatmenu . ',' . $g . ');">' . PHP_EOL .
                            '<a href="#" class="myNav-link ui-accordion-trigger">' .
                    '<span class="glyphicon ' . $groupe->icone . '"></span> ' . $groupe->libelle . '</a>' . PHP_EOL;

                $menus .= '<ul class="myNav-content ui-accordion-content">' . PHP_EOL;

                foreach ($fonctions as $fonction) {
                    $menus .= '<li><a href="' . WEB_URL . $fonction->controller . DS . $fonction->action . '">' . $fonction->libelle . '</a></li>' . PHP_EOL;
                }

                $menus .= '</ul>' . PHP_EOL;
                $menus .= '</li>' . PHP_EOL;
            }

        }
        $menus .= '</ul>' . PHP_EOL;
        $this->data['menus'] = $menus;
    }

    private function setDroit()
    {
        $session = new Session();
        if (isset($_SESSION['iduser']) AND !empty($_SESSION['iduser'])){
            $_SESSION['droitsuser'] = json_decode($this->table->query('SELECT * FROM USERS WHERE IDUSER = ?', [$_SESSION['iduser']], TRUE)->droits);
        }
    }


    /**
     * @param $heading l'entete de l'erreur
     * @param $message le contenu du message d'erreur
     * @param string $type type d'erreur
     */
    public function errors($heading, $message, $type = '404')
    {
        $this->assign('heading', $heading);
        $this->assign('message', $message);
        extract($this->data);
        require_once ROOT . DS . 'views' . DS . 'errors' . DS . $type . '.php';
        die();
    }

}