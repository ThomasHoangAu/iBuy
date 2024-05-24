<?php
    class Cart {
        var $products;
        var $depth;

        function __construct() {
            $this->products = array();
            $this->depth = 0;
        }

        function add_product($key, $product) {
            $this->products[$key] = $product;
            $this->depth++;
        }

        function delete_product($product_no) {
            unset($this->products[$product_no]);
            //$this->products = array_values($this->products);
            $this->depth--;
        }

        function get_depth() {
            return $this->depth;
        }

        function get_product($product_no) {
            return $this->products[$product_no];
        }
    }
?>