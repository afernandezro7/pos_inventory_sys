<?php

class ProductsController{

	static public function ctrListProducts(){
		$products = Product::findAll();
		return $products;
	}	


}