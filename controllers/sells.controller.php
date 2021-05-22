<?php

class SellsController{

	static public function getSellcode(){

		$response = Sell::getLastSellCode();

		if(is_array($response) && !empty($response['sell_code'])){

			$next_sell_code = intval($response['sell_code'])+1;
			return Helpers::sellCodeViewGenerator($next_sell_code);

		}else {
			
			return Helpers::sellCodeViewGenerator(1);

		}

	}	

	


}