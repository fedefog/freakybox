<?
/*****************************************************
*   usuarios.php:                                    *
*       Clase que controla a los usuarios.           *
*       Por ahora contiene la funcion que realiza    *
*           el loggin.                               *
*****************************************************/

class usuarios{
    
    public $error;
    public $config;
    
    public function __construct($config) {
        $this->config = $config;
    }
    
    /**
     * Obtiene los datos de usuario para el id provisto.
     * @param integer $id
     * @return array 
     */
    public function from_id($id){
        $id = intval($id);
        $usr_qr = mysql_query("SELECT * FROM usuario WHERE usuario_id='$id'");
        if (mysql_num_rows($usr_qr) > 0) {
            return mysql_fetch_assoc($usr_qr);
        }
        $this->error = "No existe usuario con ese id.";
        return false;
    }
    
    /**
     * Obtiene los datos del usuario actual.
     * @return mixed
     */
    public function current(){
        if(!empty($_SESSION['ctrlid'])){
            return $this->from_id($_SESSION['ctrlid']);
        }
        return false;
    }
    
    /**
     * Loguea a un usuario seteando la session ctrlid.
     * @param string $mail
     * @param string $pass 
     */
    function login($mail, $pass) {
        if (isset($mail) && isset($pass)) {
            $mail = mysql_real_escape_string($mail);
            $pass = encrypt($pass, $this->config->get("encode_key"));
            $pass = mysql_real_escape_string($pass);
            $qs = mysql_query("SELECT * FROM usuario WHERE usuario_mail='$mail' AND usuario_pass='$pass';");
            if (mysql_num_rows($qs) > 0) {
                $row = mysql_fetch_array($qs);
                $_SESSION['ctrlfail'] = 0;
                $_SESSION['ctrlid'] = $row[0];
                $_SESSION['ctrltype'] = $row['fk_tipousuario_id'];
                return true;
            } else {
                $this->error = "Nombre de usuario y contraseña no validos.";
                $_SESSION['ctrlfail'] = 1;
                return false;
            }
        }
        $this->error = "Debe proveer nombre de usuario y contraseña.";
        return false;
    }
    
    function changepassword($vs) {
        if ((isset($vs['changepassword_pass_old'])) && ($vs['changepassword_pass_old'] != '') && (isset($vs['changepassword_pass_new'])) && ($vs['changepassword_pass_new'] != '')) {
            $sql = sprintf("select * from usuario where usuario_id=" . $_SESSION['ctrlid'] . " AND usuario_pass='%s'", mysql_real_escape_string(md5($vs['changepassword_pass_old'])));
            $qs = mysql_query($sql);
            if (mysql_num_rows($qs) > 0) {
                $pass = encrypt($vs['changepassword_pass_new'], $this->config->get("encode_key"));
                $sqlc = sprintf("UPDATE usuario SET usuario_pass='" . $pass . "' WHERE usuario_id='%s'", mysql_real_escape_string($_SESSION['ctrlid']));
                $sqlchange = mysql_query($sqlc);
                $_SESSION['ctrlfailpass'] = 0;
                header("Location: " . ADMIN_FOLDER);
                exit();
            } else {
                $_SESSION['ctrlfailpass'] = 1;
            }
        } else {
            $_SESSION['ctrlfailpass'] = 1;
        }
    }
}
?>
