<?
class DB4 {
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
            echo "<div style='background:#FFFFC0; padding:10px;'>".$this->query."</div>";
        }
        $datebefore = time();
        $qs = mysql_query($this->query);
        $dateafter = time();
        $exectime = $dateafter - $datebefore;
        $this->SetError();
        if(isset($_REQUEST['DEBUG'])){
            echo "<div style='background:#FFFFC0; padding:10px;'>".mysql_error()."</div>";
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