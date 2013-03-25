<?php

class Utils {

    public static function face_path($uid) {
        $key = "ww" . "w.jis" . "higo" . "u.c" . "om";
        $hash = md5($key . "\t" . $uid . "\t" . strlen($uid) . "\t" . $uid % 10);
        $path = $hash{$uid % 32} . "/" . abs(crc32($hash) % 100) . "/";
        return $path;
    }

    public static function js_alert_output($alert_msg, $halt = true) {
        echo "<script language='javascript'>alert('{$alert_msg}');</script>";

        if ($halt)
            exit;
    }

    public static function js_console_log($alert_msg, $halt = true) {
        echo "<script language='javascript'>console.log('{$alert_msg}');</script>";

        if ($halt)
            exit;
    }

    public static function my_image_resize($src_file, $dst_file, $new_width, $new_height) {
        if (file_exists($dst_file)) {
            chmod($dst_file, 0777);
        }
        if ($new_width < 1 || $new_height < 1) {
            echo "params width or height error !";
            exit();
        }
        if (!file_exists($src_file)) {
            echo $src_file . " is not exists !";
            exit();
        }
// 图像类型
//$type=exif_imagetype($src_file);
        $arr = explode(".", $src_file);
        $type = trim(strtolower(end($arr)));
        $support_type = array('jpg', 'png', 'gif');
        if (!in_array($type, $support_type, true)) {
            echo "this type of image does not support! only support jpg , gif or png";
            exit();
        }
//Load image
        switch ($type) {
            case 'jpg' :
                $src_img = imagecreatefromjpeg($src_file);
                break;
            case 'png' :
                $src_img = imagecreatefrompng($src_file);
                break;
            case 'gif' :
                $src_img = imagecreatefromgif($src_file);
                break;
            default:
                echo "Load image error!";
                exit();
        }
        $w = imagesx($src_img);
        $h = imagesy($src_img);
        $ratio_w = 1.0 * $new_width / $w;
        $ratio_h = 1.0 * $new_height / $h;
        $ratio = 1.0;
// 生成的图像的高宽比原来的都小，或都大 ，原则是 取大比例放大，取大比例缩小（缩小的比例就比较小了）
        if (($ratio_w < 1 && $ratio_h < 1) || ($ratio_w > 1 && $ratio_h > 1)) {
            if ($ratio_w < $ratio_h) {
                $ratio = $ratio_h; // 情况一，宽度的比例比高度方向的小，按照高度的比例标准来裁剪或放大
            } else {
                $ratio = $ratio_w;
            }
// 定义一个中间的临时图像，该图像的宽高比 正好满足目标要求
            $inter_w = (int) ($new_width / $ratio);
            $inter_h = (int) ($new_height / $ratio);
            $inter_img = imagecreatetruecolor($inter_w, $inter_h);
            imagecopy($inter_img, $src_img, 0, 0, 0, 0, $inter_w, $inter_h);
// 生成一个以最大边长度为大小的是目标图像$ratio比例的临时图像
// 定义一个新的图像
            $new_img = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($new_img, $inter_img, 0, 0, 0, 0, $new_width, $new_height, $inter_w, $inter_h);
            switch ($type) {
                case 'jpg' :
                    imagejpeg($new_img, $dst_file, 100); // 存储图像
                    break;
                case 'png' :
                    imagepng($new_img, $dst_file, 100);
                    break;
                case 'gif' :
                    imagegif($new_img, $dst_file, 100);
                    break;
                default:
                    break;
            }
        } // end if 1
// 2 目标图像 的一个边大于原图，一个边小于原图 ，先放大平普图像，然后裁剪
// =if( ($ratio_w < 1 && $ratio_h > 1) || ($ratio_w >1 && $ratio_h <1) )
        else {
            $ratio = $ratio_h > $ratio_w ? $ratio_h : $ratio_w; //取比例大的那个值
// 定义一个中间的大图像，该图像的高或宽和目标图像相等，然后对原图放大
            $inter_w = (int) ($w * $ratio);
            $inter_h = (int) ($h * $ratio);
            $inter_img = imagecreatetruecolor($inter_w, $inter_h);
//将原图缩放比例后裁剪
            imagecopyresampled($inter_img, $src_img, 0, 0, 0, 0, $inter_w, $inter_h, $w, $h);
// 定义一个新的图像
            $new_img = imagecreatetruecolor($new_width, $new_height);
            imagecopy($new_img, $inter_img, 0, 0, 0, 0, $new_width, $new_height);
            switch ($type) {
                case 'jpg' :
                    imagejpeg($new_img, $dst_file, 100); // 存储图像
                    break;
                case 'png' :
                    imagepng($new_img, $dst_file, 100);
                    break;
                case 'gif' :
                    imagegif($new_img, $dst_file, 100);
                    break;
                default:
                    break;
            }
        }// if3
    }

// end function

    public static function is_image($filename, $allow_types = array('gif' => 1, 'jpg' => 1, 'png' => 1, 'bmp' => 1)) {
        if (!is_file($filename)) {
            return false;
        }

        $imagetypes = array('1' => 'gif', '2' => 'jpg', '3' => 'png', '4' => 'swf', '5' => 'psd', '6' => 'bmp', '7' => 'tiff', '8' => 'tiff', '9' => 'jpc', '10' => 'jp2', '11' => 'jpx', '12' => 'jb2', '13' => 'swc', '14' => 'iff', '15' => 'wbmp', '16' => 'xbm',);
        if (!$allow_types) {
            $allow_types = array('gif' => 1, 'jpg' => 1, 'png' => 1, 'bmp' => 1);
        }
        $typeid = 0;
        $imagetype = '';
        if (function_exists('exif_imagetype')) {
            $typeid = exif_imagetype($filename);
        } elseif (function_exists('getimagesize')) {
            $_tmps = getimagesize($filename);
            $typeid = (int) $_tmps[2];
        } else {
            if (($fh = @fopen($filename, "rb"))) {
                $strInfo = unpack("C2chars", fread($fh, 2));
                fclose($fh);
                $fileTypes = array(7790 => 'exe', 7784 => 'midi', 8297 => 'rar', 255216 => 'jpg', 7173 => 'gif', 6677 => 'bmp', 13780 => 'png',);
                $imagetype = $fileTypes[intval($strInfo['chars1'] . $strInfo['chars2'])];
            }
        }
        $file_ext = strtolower(trim(substr(strrchr($filename, '.'), 1)));
        if ($typeid > 0) {
            $imagetype = $imagetypes[$typeid];
        } else {
            if (!$imagetype) {
                $imagetype = $file_ext;
            }
        }

        if ($allow_types && $file_ext && $imagetype && isset($allow_types[$file_ext]) && isset($allow_types[$imagetype])) {
            return true;
        }

        return false;
    }

    public static function sendmail($frommail, $fromname, $tomail, $subject, $body, $ccmail, $bccmail) {
        $mailer = Yii::createComponent('application.extensions.phpmailer.phpmailer');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = Yii::app()->params['MailHost'];
        $mail->SMTPAuth = true;
        $mail->Username = Yii::app()->params['MailUser'];
        $mail->Password = Yii::app()->params['MailPass'];
        $mail->CharSet = 'utf-8';
        $mail->Encoding = 'base64';
        $mail->From = $frommail;
        $mail->FromName = $fromname;
        $mail->AddAddress($tomail);
        if (!empty($ccmail)) {
            $mail->AddCC($ccmail);
        }
        if (!empty($bccmail)) {
            $mail->AddCC($bccmail);
        }
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = "";
        return $mail->Send();
    }

    public function checkWord($str){
        $arr = Yii::app()->params['Word'];
        $word = $arr[0];
        foreach($word as $k=>$v){
             if (strpos($str, $v) !== FALSE) {
                 return false;
             }else{
                 return true;
             }
        }
        
    }
    
    public static function tranTime($time) { 
    $time = strtotime($time);
    $rtime = date("m-d H:i",$time); 
    $htime = date("H:i",$time); 
    $time = time() - $time; 
    if ($time < 60) { 
        $str = '刚刚'; 
    } 
    elseif ($time < 60 * 60) { 
        $min = floor($time/60); 
        $str = $min.'分钟前'; 
    } 
    elseif ($time < 60 * 60 * 24) { 
        $h = floor($time/(60*60)); 
        $str = $h.'小时前 '.$htime; 
    } 
    elseif ($time < 60 * 60 * 24 * 3) { 
        $d = floor($time/(60*60*24)); 
        if($d==1) 
           $str = '昨天 '.$rtime; 
        else 
           $str = '前天 '.$rtime; 
    } 
    else { 
        $str = $rtime; 
    } 
    return $str; 
} 

}

