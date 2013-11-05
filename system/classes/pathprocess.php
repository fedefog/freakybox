<?

/* * **********************************************************
 *   pathprocess.php:                                        *
 *        Procesa la url para determinar en que              *
 *           seccion estoy y que debo hacer a continuaci�n   *
 * ********************************************************** */

class pathprocess {

    var $sys;       /* BASE SYSTEM */
    var $bf;  /* BASE FOLDER */
    var $ac;  /* ACTION: list, form, etc */
    var $qs;  /* querystring */
    var $segments;

    function __construct() {
        $this->myurl();
    }

    function myurl() {

        /*
          El atributo sys va a ser implementado correctamente en una instancia mas avanzada
         */
        $this->sys = "admin";

        /*
          Si esta seteada la variable 's' y no esta vacia, un array llamado $components va a ser llenado por 2 elementos.
          Uno va a ser por el el directorio y el otro la accion.
          Si la variable no esta seteada le asigna un valor por default a los atributos de la clase
         */
        if ((isset($_REQUEST['s'])) && ($_REQUEST['s'] != '')) {
            $path = trim($_REQUEST['s'], '/');
            $components = explode("/", $path);
        } else {
            $this->bf = "main";
            $this->ac = "inicio";
            $this->qs = "";
        }

        //Comente estas dos lineas porque pinchaban
        //$qs=explode("?",substr($_SERVER['REQUEST_URI'],1));        
        //$components=explode("/",$qs[0]);

        /*
          Si la variable componentes esta seteada, se fija cuantos elementos tiene.
          Si tiene mas de uno, al atributo $bf de la clase lo va a llenar con el primer elemento (que es el directorio).
          $ac va a ser llenado por el segundo elemento que es la accion a realizar.
          Si hay un solo elemento, $bf se llena por el directorio y a $ac se le da la accion por default
          que es listar.
         */
        $actions = array("new", "edit", "view", "list", "actions", "import", "export", "ajax", "crop", "resizecrop", "set_in_list", "install", "buildtables", "regen");
        
        $this->bf = "main";
        $this->ac = "inicio";
        $this->qs = "";
        if ((isset($components)) && (count($components) > 0)) {
            $ac = end($components);

            if(in_array($ac, $actions)){
                $this->ac = $ac;
                array_pop($components);
            }
            else{
                $this->ac = "list";
            }

            $this->bf = implode("/", $components);
        }

        /*
          Si hay algo escrito luego del '?' en la url, eso va a ser el querystring de la clase.
          Si no hay nada el querystring queda vacio
         */
        $rquri = explode("?", $_SERVER['REQUEST_URI']);
        if (count($rquri) > 1) {
            $this->qs = $rquri[1];
        } else {
            $this->qs = "";
        }
    }
	
	 /**
     * Return the current path.
     * @return string
     */
    function path(){
        if(count($this->segments)==0){
            return;
        }
        return implode("/", $this->segments);
    }

    /**
     * Return the selected segment.
     * @param integer $index
     * @return string
     */
    function segment($index){
        $index = $index - 1;
        $segment = "";
        if(isset($this->segments[$index])){
            $segment = $this->segments[$index];
        }
        return $segment;
    }
}
?>