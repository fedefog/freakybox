<?php

class Cart {

    private $items = array();

    public function __construct($items = null) {
        if (!is_null($items) && !empty($items)) {
            if (is_array($items)) {
                $this->items = $items;
            }
        }
    }

    /**
     * Agrega un item al carrito.
     * @param array $item
     */
    public function add($item) {
        if (is_array($item)) {
            $item['uid'] = sha1(serialize($item['id'] . $item['options']));
            $ikey = -1;
            
            $exit = false;
            foreach($this->items as $key => $loaded){
                if($loaded['uid'] == $item['uid']){
                    $ikey = $key;
                    if ($item['quantity'] == 0) {
                        unset($this->items[$key]);
                        $exit = true;
                    }
                }
            }
            
            if($exit !== true){
                if($ikey > -1){
                    $this->items[$ikey] = $item;
                }
                else{
                    if ($item['quantity'] > 0) {
                        array_push($this->items, $item);
                    }
                }
            }
        }
        $_SESSION['cart'] = $this->items;
    }

    /**
     * Edita un item en el carrito.
     * @param array $item
     */
    public function edit($item) {
        $i = 0;
        $remove = false;
        for ($i = 0; $i <= count($this->items); $i++) {
            if ($this->items[$i]['uid'] == $item['uid']) {
                if ($item['quantity'] == 0) {
                    $remove = true;
                    unset($this->items[$i]);
                }
                break;
            }
        }
        // Remove the item from the cart if the quantity is zero.
        if ($remove === true) {
            unset($this->items[$i]);
        } else {
            if (is_array($this->items)) {
                $this->items[$i] = $item;
            }
        }
        
        $_SESSION['cart'] = $this->items;
    }

    /**
     * Remueve un item del carrito.
     * @param type $uid
     */
    public function remove($uid) {
        $this->edit(array('uid' => $uid, 'quantity' => 0));
    }
    
    /**
     * Remove all items;
     */
    public function clear(){
        $this->items = array();
        $_SESSION['cart'] = $this->items;
    }

    /**
     * Return all items.
     * @return array 
     */
    public function items() {
        return $this->items;
    }

    /**
     * Retorna la suma de todos los items del carrito.
     * @return integer
     */
    public function get_total() {
        $total = 0;
        if (!empty($this->items)) {
            foreach ($this->items as $item) {
                if (!empty($item['discount'])) {
                    $total += $item['quantity'] * $item['price'] * ($item['discount'] / 100);
                } else {
                    if($item['total'] != 0){
                        $total = $item['total'];
                    }
                }
            }
            
            foreach ($this->items as $item) {
                if (!empty($item['discount'])) {
                    $total += $item['quantity'] * $item['price'] * ($item['discount'] / 100);
                } else {
                    if($item['price'] > 0 && empty($item['total'])){
                        $total += $item['quantity'] * $item['price'];
                    }
                }
            }
        }
        return $total;
    }

    /**
     * Retorna la cantidad total de items.
     * @return integer
     */
    public function get_item_count() {
        $total = 0;
        if (!empty($this->items)) {
            foreach ($this->items as $item) {
                $total += $item['quantity'];
            }
        }
        return $total;
    }

}