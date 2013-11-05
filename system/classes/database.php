<?
class Database {
    var $msg="";
    var $query = "";
    var $typeOfQuery = "";
    //variables del paginador
    var $url="index.php";
    var $regByPage = 0;
    var $regCount = 0;
    var $startReg = 0;
    var $totalPages = 0;
    var $pageNbr = 0;
    //variable de configuracion del archivo te texto
    var $configuration = 0;
    
    var $db_link;
    var $sql;
    var $current_qr;
    var $inserted_id;
    
    var $wheres = array();
    var $or_wheres = array();
    
    var $parameters;
    
    var $joins = array();
    
    var $order;
    
    var $row_array = array();
    var $result_array = array();
    
    public function __construct($server = null, $username = null, $password = null, $database = null) {
        if(!is_null($server)){
            $this->db_link = mysql_connect($server, $username, $password);
            mysql_select_db($database, $this->db_link);
        }
    }
    
    /**
     * Inserta los datos del array en la tabla designada.
     * @param type $data
     * @param type $table 
     */
    public function insert($data, $table){
        $sql = array();
        foreach($data as $column => $value){
            $sql[] = "$column = '".$this->escape($value)."'";
        }
        
        mysql_query("INSERT INTO $table SET ".implode(', ', $sql), $this->db_link);
        
        $this->inserted_id = mysql_insert_id($this->db_link);
        
        return $this->inserted_id > 0;
    }
    
    public function update($data, $table){
        $iswhere = false;
        
        $where_sql = "";
        if(count($this->wheres) > 0){
            $where_sql = "WHERE ".implode(" AND ", $this->wheres);
            unset($this->wheres);
            $iswhere = true;
        }
        
        $or_where_sql = "";
        if(count($this->or_wheres) > 0){
            $or_where_sql = ($iswhere ? " OR " : "WHERE ").implode(" OR ", $this->or_wheres);
            unset($this->or_wheres);
            $iswhere = true;
        }
        
        $sql = array();
        foreach($data as $column => $value){
            $sql[] = "$column = '".$this->escape($value)."'";
        }
                
        mysql_query("UPDATE $table SET ".implode(', ', $sql)." $where_sql $or_where_sql", $this->db_link);
        
        return mysql_affected_rows($this->db_link) > 0;
    }
    
    public function select($table){
        return $this;
    }
    
    public function query($sql){
        $this->sql = $sql;
        return $this;
    }
    
    public function get($table = null, $offset = null, $limit = null){
        unset($this->row_array);
        $iswhere = false;
        
        $join_sql = "";
        if(count($this->joins) > 0){
            $join_sql = implode(" ", $this->joins);
            unset($this->joins);
        }
        
        $where_sql = "";
        if(count($this->wheres) > 0){
            $where_sql = "WHERE ".implode(" AND ", $this->wheres);
            unset($this->wheres);
            $iswhere = true;
        }
        
        $or_where_sql = "";
        if(count($this->or_wheres) > 0){
            $or_where_sql = ($iswhere ? " OR " : "WHERE ").implode(" OR ", $this->or_wheres);
            unset($this->or_wheres);
            $iswhere = true;
        }
        
        $limit_sql = "";
        if(!is_null($offset) && !is_null($limit)){
            $offset = intval($offset);
            $limit = intval($limit);
            $limit_sql = "LIMIT $offset, $limit";
        }
        
        $filters_sql = "";
        if(count($this->parameters) > 0){
            $filters_sql = "WHERE ".implode(' AND ', $this->parameters);
            unset($this->parameters);
        }
                        
        $order = $this->order;
        unset($this->order);
        
        if(!is_null($table)){
            $this->sql = "SELECT * FROM $table $join_sql $filters_sql $where_sql $or_where_sql $order $limit_sql";
        }
        
        if($_GET['DEBUG']){
            echo "<code>".$this->sql."</code>";
        }
        
        $this->current_qr = mysql_query($this->sql, $this->db_link);
        while($row = mysql_fetch_assoc($this->current_qr)){
            $this->row_array[] = $row;
        }
        return $this;
    }
    
    public function where($column, $value = null){
        if(!is_null($value)){
            $value = $this->escape($value);
            $this->wheres[] = "$column = '$value'";
        }
        else{
            $this->wheres[] = "$column";
        }
        return $this;
    }
    
    public function or_where($column, $value = null){
        if(!is_null($value)){
            $value = $this->escape($value);
            $this->or_wheres[] = "$column = '$value'";
        }
        else{
            $this->or_wheres[] = "$column";
        }
        return $this;
    }
    
    public function join($table, $bridge){
        $this->joins[] = "JOIN $table ON $bridge";
        return $this;
    }
    
    function order_by($column, $order = null){
        if(!is_null($order)){
            $this->order = "ORDER BY $column $order";
        }
        else{
            $this->order = "ORDER BY $column";
        }
        return $this;
    }
    
    function parameters($string){
        $array = explode(";", $string);
        if(is_array($array) && !empty($array)){
            foreach($array as $val){
                if(!empty($val)){
                    $this->parameters[] = str_replace(array(':'), array('='), $val);
                }
            }
        }
        return $this;
    }
    
    /**
     * Sanitiza el texto para ser ingresado en la base de datos.
     * @param string $string
     * @return string 
     */
    function escape($string){
        return mysql_real_escape_string($string, $this->db_link);
    }
    
    function SetConf($conf){
        if ($conf == 0){
            $this->configuration = 0;
        }else if ($conf == 1){
            $this->configuration = 1;
        }
    }
    
    function SetQuery($query, $regByPage = "", $url = ""){
        $this->typeOfQuery = strtolower(substr(trim(str_replace("(","",$query)), 0, 6));
        $this->query = $query;
        if (!isset($_GET['pageNbr'])){
            $this->pageNbr = 0;
        }else{
            $this->pageNbr = $_GET['pageNbr'];
        }
        if($this->typeOfQuery == "select"){
            if ( ($regByPage!='') && ($regByPage>0) ){
                $this->regByPage = $regByPage;
                $this->startReg = $this->pageNbr * $this->regByPage;
            }else{
                $this->regByPage = -1;
            }
            if ($url!==''){
                $this->url = $url;
            }
            if($qs = mysql_query($this->query)){
                $this->regCount = mysql_num_rows($qs);
                $this->totalPages = ceil($this->regCount / $this->regByPage);
            }
            //echo "regbypage=".$this->regByPage."<br>startreg=".$this->startReg."<br>regcount=".$this->regCount."<br>totalpages=".$this->totalPages;
        }
    }    
    function ExecuteQuery(){
        if (($this->typeOfQuery == "select") && ($this->regByPage!=-1)){
            $this->query.=" limit ".$this->startReg.",".$this->regByPage;
        }
        if(isset($_REQUEST['DEBUG'])){
            echo "<div style='background:#FFFFC0; padding:10px; clear:both;'>".$this->query."</div>";
        }
        $datebefore = time();
        $qs = mysql_query($this->query);
        $dateafter = time();
        $exectime = $dateafter - $datebefore;
        $this->SetError();
        if(isset($_REQUEST['DEBUG']) && mysql_error()){
            echo "<div style='background:#C0FFFF; padding:10px; clear:both;'>".mysql_error()."</div>";
        }
        if ($this->configuration == 1){
            
            $txtfile = fopen("DBlog.txt","a");
            $reg = date('d-m-Y  H:m:s').chr(9).$exectime." seg.".chr(9).$_SERVER['REMOTE_ADDR'].chr(9).$this->msg.chr(9).$this->query.chr(13).chr(10);
            fputs($txtfile,$reg);
            fclose($txtfile);
        }
        return $qs;
    }
    
    function SetError(){
        if(mysql_error()){
            $this->msg = mysql_error();
        }else{
            $this->msg = "No Error";
        }
    }
    
    function Pager2()
    {
        $querystr=$_SERVER['QUERY_STRING'];
        if ($querystr=="")
        {
            $querystr="?";
        }
        if (strstr($querystr,"pageNbr"))
        {
            $querystr="?".str_replace("pageNbr=".$this->pageNbr,"",$querystr);
            $querystr=trim($querystr);
        }
        else
        {
            $querystr="?".$querystr;
        }
        if ((strlen($querystr)>1 )&&(substr($querystr,-1)!="&"))
        {
            $querystr.="&amp;";
        }
        $pager="";
        if ($this->totalPages > 1){
            if($this->pageNbr+1!=1){
                $ii=$this->pageNbr-1;
                $pager .= "
                <div class='paginado'>
                <div class='paging clearfix'>
                <ul style='list-style:none;'>
                <li class='previous'><a href='".$this->url.$querystr."pageNbr=$ii'> ".$GLOBALS['cfg_previous']."  </a></li>";
            }else{
                $pager .= "<div class='paginado'>
                <div class='paging clearfix'>
                <ul style='list-style:none;>
                <li class='previous'></li>";
            }
            if($this->totalPages > 5){
                for($i=1;$i<=$this->totalPages;$i++){
                    if(($i<$this->pageNbr-1)){
                        $pager.= "<li style='display:inline;'><span class='ellipsis'>...</span></li>";
                        $i=$this->pageNbr-2;
                    }else if (($i>=$this->pageNbr-1) && ($i<=$this->pageNbr+3)){
                        $ii = $i-1;
                        if($i!=$this->pageNbr+1){
                            $pager.= "<li><a href='".$this->url.$querystr."pageNbr=$ii'>$i</a></li>";
                        }else{
                            $pager.= "<li><strong class='current'>$i</strong></li>";
                        }
                    }else if ($i>$this->pageNbr+3){
                        $ii = $this->totalPages-1;
                        $pager.= "<li><span class='ellipsis'>...</span></li>";
                        $i=$this->totalPages;
                    }
                }
            }else{
                for($i=1;$i<=$this->totalPages;$i++){
                    if($i!=$this->pageNbr+1){
                        $ii = $i-1;
                        $pager.= "<li style='display:inline;'><a href='".$this->url.$querystr."pageNbr=$ii'>$i</a></li>";
                    }else{
                        $pager.= "<li style='display:inline;'><strong class='current'>$i</strong></li>";
                    }
                }
            }
            if($this->pageNbr+1!=$this->totalPages){
                $ii=$this->pageNbr+1;
                $pager .= "<li class='next'><a href='".$this->url.$querystr."pageNbr=$ii'> ".$GLOBALS['cfg_next']." </a></li></ul></div>
</div>";
            }else{
                $pager .= "<li class='next'><a href='#'> ".$GLOBALS['cfg_next']." </a></li></ul></div>
</div>";
            }
        }
        $GLOBALS['pager']=$pager;
    }
}
?>