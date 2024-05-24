<?php
    class Product {
        var $product_id;
        var $product_des;
        var $qty;
        var $unit_price;
        var $product_img;
        
        // function get_product_cost() {
        //     return $this->qty * $this->unit_price;
        // }
        
        function __construct($product_id, $product_des, $qty, $unit_price, $product_img) {
            $this->product_id = $product_id;
            $this->product_des = $product_des;
            $this->qty = $qty;
            $this->unit_price = $unit_price;
            $this->product_img = $product_img;
        }

        function get_product_id() {
            return $this->product_id;
        }

        function get_product_des() {
            return $this->product_des;
        }

        function get_qty() {
            return $this->qty;
        }

        function get_unit_price() {
            return $this->unit_price;
        }

        function get_product_img() {
            return $this->product_img;
        }
    }
?>