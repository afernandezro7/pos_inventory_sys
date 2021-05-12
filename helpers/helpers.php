<?php

class Helpers{

	static public function LongTimeFilter($date) {
        if ($date == null) {
            return "Sin fecha";
        }

		$format = "y-m-d H:i:s";
		$now = date ($format);
		$nowArr = date_parse($now);
		$lastLogArr = date_parse($date);

		$since_start = array(
			"y"=>$nowArr['year'] - $lastLogArr['year'],
			"m"=>$nowArr['month'] - $lastLogArr['month'],
			"d"=>$nowArr['day'] - $lastLogArr['day'],
			"h"=>$nowArr['hour'] - $lastLogArr['hour'],
			"i"=>$nowArr['minute'] - $lastLogArr['minute'],
			"s"=>$nowArr['second'] - $lastLogArr['second']
		);

        if ($since_start['y'] == 0) {
            if ($since_start['m'] == 0) {
                if ($since_start['d'] == 0) {
                    if ($since_start['h'] == 0) {
                        if ($since_start['i'] == 0) {
                            if ($since_start['s'] == 0) {
                                $result = $since_start['s'] . ' segundos';
                            } else {
                                if ($since_start['s'] == 1) {
                                    $result = $since_start['s'] . ' segundo';
                                } else {
                                    $result = $since_start['s'] . ' segundos';
                                }
                            }
                        } else {
                            if ($since_start['i'] == 1) {
                                $result = $since_start['i'] . ' minuto';
                            } else {
                                $result = $since_start['i'] . ' minutos';
                            }
                        }
                    } else {
                        if ($since_start['h'] == 1) {
                            $result = $since_start['h'] . ' hora';
                        } else {
                            $result = $since_start['h'] . ' horas';
                        }
                    }
                } else {
                    if ($since_start['d'] == 1) {
                        $result = $since_start['d'] . ' día';
                    } else {
                        $result = $since_start['d'] . ' días';
                    }
                }
            } else {
                if ($since_start['m'] == 1) {
                    $result = $since_start['m'] . ' mes';
                } else {
                    $result = $since_start['m'] . ' meses';
                }
            }
        } else {
            if ($since_start['y'] == 1) {
                $result = $since_start['y'] . ' año';
            } else {
                $result = $since_start['y'] . ' años';
            }
        }
 
        return "Hace " . $result;
    }


}

