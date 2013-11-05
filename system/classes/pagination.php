<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagination
 *
 * @author clave5
 */
class Pagination {
    
    public $url;
    public $total_items;
    public $page_limit;
    public $current_page = 1;
    public $links = 7;
    public $separator;
    public $hidecorners = false;
    public $query_string;
    public $wraper = array('<div class="pagination">','</div>');
    public $item_wraper = array('','');
    public $current_wraper = array('<b>','</b>');
    
    public $first_items = "Primeros";
    public $last_items = "Ultimos";
    
    public function create_links(){
        
        // Total pages.
        $total_pages = ceil($this->total_items/$this->page_limit);

        if($total_pages < 2){
            return '';
        }
                
        // half at a side and half at the other side.
        $half = floor($this->links/2);        
        
        $url = $this->url;
                
        
        
        $dots = $this->item_wraper[0]."<i>...</i>".$this->item_wraper[1];
        
        $html = $this->wraper[0];
        
        $this->sanitize_query_string();
        
        if($this->hidecorners !== true){
            $str = ($this->query_string) ? '1&'.$this->query_string : '1';
            $html .= $this->item_wraper[0].'<a href="'.$url.'?pagina='.$str.'" class="pag-prev">'.$this->first_items.'</a>'.$this->item_wraper[1];
        }
            
        if(empty($this->current_page)){
            $this->current_page = 1;
        }
        
        // We get the limit of links that we need to build the pagination.
        $start = (($this->current_page - $half) > 0) ? $this->current_page - ($half) : 1;
        $end = (($this->current_page + $half) < $total_pages) ? ($this->current_page + $half) : $total_pages;
        
        //$start = ($end == $total_pages) ? ($total_pages - $this->links + 1) : $start;
        //$end = ($start == 1) ? $this->links : $end;
      
        if($start > 1){
            $html .= $dots;
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($this->current_page == $i) {
                $html .= $this->current_wraper[0] . $i . $this->current_wraper[1];
            } else {
                $str = ($this->query_string) ? $i.'&'.$this->query_string : $i;
                $html .= $this->item_wraper[0].'<a href="'.$url.'?pagina='.$str.'" class="number">'.$i.'</a>'.$this->item_wraper[1];
            }
            if($i < $end){
                $html .= $this->separator;
            }
        }
        
        if($end < $total_pages){
            $html .= $dots;
        }
        
        if($this->hidecorners !== true){
            $str = ($this->query_string) ? $total_pages.'&'.$this->query_string : $total_pages;
            $html .= $this->item_wraper[0].'<a href="'.$url.'?pagina='.$str.'" class="pag-next">'.$this->last_items.'</a>'.$this->item_wraper[1];
        }
        
        $html .= $this->wraper[1];
        
        return $html;
    }
    
    function sanitize_query_string(){
        $args = array();
		$parts = $this->query_string;
        if(!is_array($parts)){
            $explode = explode('&', $parts);
			foreach($explode as $arg){
				$arr = explode('=', $arg);
				$parts[$arr[0]] = $arr[1];
			}
        }
		foreach($this->query_string as $key => $val){
            if($key != "pagina"){
                $args[$key] = "$key=$val";
            }
        }
        $this->query_string = implode('&', $args);
    }    
}

?>