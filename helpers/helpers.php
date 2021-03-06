<?php

class Helpers
{

    static public function LongTimeFilter($date)
    {
        if ($date == null) {
            return "Sin fecha";
        }

        $format = "y-m-d H:i:s";
        $now = date($format);
        $nowArr = date_parse($now);
        $lastLogArr = date_parse($date);

        $since_start = array(
            "y" => $nowArr['year'] - $lastLogArr['year'],
            "m" => $nowArr['month'] - $lastLogArr['month'],
            "d" => $nowArr['day'] - $lastLogArr['day'],
            "h" => $nowArr['hour'] - $lastLogArr['hour'],
            "i" => $nowArr['minute'] - $lastLogArr['minute'],
            "s" => $nowArr['second'] - $lastLogArr['second']
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
                        $result = $since_start['d'] . ' d??a';
                    } else {
                        $result = $since_start['d'] . ' d??as';
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
                $result = $since_start['y'] . ' a??o';
            } else {
                $result = $since_start['y'] . ' a??os';
            }
        }

        return "Hace " . $result;
    }

    static public function processImage($file, $dir, $name)
    {
        //cut image to 500x500
        list($width, $height) = getimagesize($file['tmp_name']);
        $newWidth = 500;
        $newHeight = 500;

        $path = "";

        if ($file['type'] == "image/jpeg") {
            $path = $dir . $name . ".jpg";

            $origin = imagecreatefromjpeg($file['tmp_name']);
            $destiny = imagecreatetruecolor($newWidth, $newHeight);

            imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            imagejpeg($destiny, $path);
        }

        if ($file['type'] == "image/png") {
            $path =  $dir . $name . ".jpg";

            $origin = imagecreatefrompng($file['tmp_name']);
            $destiny = imagecreatetruecolor($newWidth, $newHeight);

            imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            imagepng($destiny, $path);
        }

        return $path;
    }

    static public function getPermission($role,Array $rolesAdmited)
    {
        return in_array ( $role , $rolesAdmited );
    }
}
