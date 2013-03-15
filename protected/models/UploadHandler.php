<?php

/* * ***********************************************************************************************
 * 文件名：upload.han.php
 * 版本号：JishiGou 1.0.0 beta
 * 最后修改时间： 2010年6月12日
 * 作者：狐狸<foxis@qq.com>
 * 功能描述：文件上载
 * ************************************************************************************************ */

class UploadHandler {

    var $_error;
    var $_new_name;
    var $_save_name;
    var $_file;
    var $_path;
    var $_field;
    var $_max_size;
    var $_image;
    var $_ext;
    var $_ext_types;
    var $_image_types;

    function UploadHandler(& $file, $path, $field = 'upload', $image = false, $thumb = false, $maxwidth = 800, $maxhight = 1200) {
        $this->_file = & $file;
        $this->_path = $path;
        $this->_field = $field;
        $this->_max_size = 50;
        $this->_image = $image;
        $this->_thumb = $thumb;
        $this->_ext = '';
        $this->_new_name = '';
        $this->_save_name = '';
        $this->_maxwidth = $maxwidth;
        $this->_maxhight = $maxhight;
        $this->_ext_types = array('doc','docx','pdf','xls','xlsx','ppt','pptx','txt','rar','zip','mmap');
        $this->_image_types = array('gif', 'jpg', 'jpeg', 'png');
    }

    function setMaxSize($size) {
        $this->_max_size = (int) $size;
        return true;
    }

    function setExtTypes($array) {
        if (false == is_array($array)) {
            return false;
        }

        $this->_ext_types = & $array;
        return true;
    }

    function setImgTypes($array) {
        if (false == is_array($array)) {
            return false;
        }

        $this->_image_types = & $array;
        return true;
    }

    function setNewName($name) {
        $this->_new_name = trim($name);
        return true;
    }

    function getExt() {
        return $this->_ext;
    }

    function getSaveName() {
        return $this->_save_name;
    }

    function makethumb($srcfile, $dstfile, $thumbwidth, $thumbheight, $maxthumbwidth = 0, $maxthumbheight = 0, $src_x = 0, $src_y = 0, $src_w = 0, $src_h = 0) {
        if (!is_file($srcfile)) {
            return '';
        }
         
        $tow = $thumbwidth;
        $toh = $thumbheight;
        if ($tow < 30) {
            $tow = 30;
        }
        if ($toh < 30) {
            $toh = 30;
        }

        $make_max = 0;
        $maxtow = $maxthumbwidth;
        $maxtoh = $maxthumbheight;
        if ($maxtow >= 300 && $maxtoh >= 300) {
            $make_max = 1;
        }

        $im = '';
        if ($data = getimagesize($srcfile)) {
            if ($data[2] == 1) {
                $make_max = 0;
                if (function_exists("imagecreatefromgif")) {
                    $im = imagecreatefromgif($srcfile);
                }
            } elseif ($data[2] == 2) {
                if (function_exists("imagecreatefromjpeg")) {
                    $im = imagecreatefromjpeg($srcfile);
                }
            } elseif ($data[2] == 3) {
                if (function_exists("imagecreatefrompng")) {
                    $im = imagecreatefrompng($srcfile);
                }
            }
        }
        if (!$im)
            return '';

        $srcw = ($src_w ? $src_w : imagesx($im));
        $srch = ($src_h ? $src_h : imagesy($im));

        $towh = $tow / $toh;
        $srcwh = $srcw / $srch;
        if ($towh <= $srcwh) {
            $ftow = $tow;
            $ftoh = $ftow * ($srch / $srcw);

            $fmaxtow = $maxtow;
            $fmaxtoh = $fmaxtow * ($srch / $srcw);
        } else {
            $ftoh = $toh;
            $ftow = $ftoh * ($srcw / $srch);

            $fmaxtoh = $maxtoh;
            $fmaxtow = $fmaxtoh * ($srcw / $srch);
        }
        if ($srcw <= $maxtow && $srch <= $maxtoh) {
            $make_max = 0;
        }
        if ($srcw >= $tow || $srch >= $toh) {
            if (function_exists("imagecreatetruecolor") && function_exists("imagecopyresampled") && $ni = imagecreatetruecolor($ftow, $ftoh)) {
                imagecopyresampled($ni, $im, 0, 0, $src_x, $src_y, $ftow, $ftoh, $srcw, $srch);
                if ($make_max && $maxni = imagecreatetruecolor($fmaxtow, $fmaxtoh)) {
                    imagecopyresampled($maxni, $im, 0, 0, $src_x, $src_y, $fmaxtow, $fmaxtoh, $srcw, $srch);
                }
            } elseif (function_exists("imagecreate") && function_exists("imagecopyresized") && $ni = imagecreate($ftow, $ftoh)) {
                imagecopyresized($ni, $im, 0, 0, $src_x, $src_y, $ftow, $ftoh, $srcw, $srch);
                if ($make_max && $maxni = imagecreate($fmaxtow, $fmaxtoh)) {
                    imagecopyresized($maxni, $im, 0, 0, $src_x, $src_y, $fmaxtow, $fmaxtoh, $srcw, $srch);
                }
            } else {
                return '';
            }
            if (function_exists('imagejpeg')) {
                imagejpeg($ni, $dstfile);
                if ($make_max) {
                    imagejpeg($maxni, $srcfile);
                }
            } elseif (function_exists('imagepng')) {
                imagepng($ni, $dstfile);
                if ($make_max) {
                    imagepng($maxni, $srcfile);
                }
            }
            imagedestroy($ni);
            if ($make_max) {
                imagedestroy($maxni);
            }
        }
        imagedestroy($im);

        if (!is_file($dstfile)) {
            return '';
        } else {
            return $dstfile;
        }
    }

    function doUpload() {
        if (false == is_writable($this->_path)) {
            $this->_setError(504);
            return false;
        }

        if (false == isset($this->_file[$this->_field])) {
            $this->_setError(501);
            return false;
        }

        $name = $this->_file[$this->_field]['name'];
        $size = $this->_file[$this->_field]['size'];
        $type = $this->_file[$this->_field]['type'];
        $temp = $this->_file[$this->_field]['tmp_name'];

        $type = preg_replace("/^(.+?);.*$/", "\\1", $type);

        if (false == $name || $name == 'none') {
            $this->_setError(501);
            return false;
        }

        $this->_ext = strtolower(end(explode('.', $name)));

        if (false == $this->_ext) {
            $this->_setError(502);
            return false;
        }
        if (false == $this->_image) {
            if (false == in_array($this->_ext, array_merge($this->_image_types, $this->_ext_types))) {
                $this->_setError(502);
                return false;
            }
        } else {
            if (false == in_array($this->_ext, $this->_image_types)) {
                $this->_setError(507);
                return false;
            }

            if (function_exists('exif_imagetype') && !exif_imagetype($temp)) {
                $this->_setError(507);
                return false;
            } elseif (function_exists('getimagesize') && !getimagesize($temp)) {
                $this->_setError(507);
                return false;
            }
        }


        if ($this->_max_size &&
                $this->_max_size * 1000 < $size) {
            $this->_setError(503);
            return false;
        }

        if (false == $this->_new_name) {
            $this->_save_name = $name;
            $full_path = $this->_path . $name;
        } else {
            $this->_save_name = $this->_new_name;
            $full_path = $this->_path . $this->_save_name;
        }

        if (false == move_uploaded_file($temp, $full_path)) {
            if (false == copy($temp, $full_path)) {
                $this->_setError(505);
                return false;
            }
        }

        //新增缩略图

        if (true == $this->_thumb) {

            $this->makethumb($full_path, $full_path, $this->_maxwidth, $this->_maxhight, 0, 0, 0, 0, 0, 0);
        }

        $this->_setError(506);
        return true;
    }

    function getError() {
        return $this->_error;
    }

    function _GetError() {
        $type = $this->_file[$this->_field]['error'];
        $error_types = array(0 => '没有错误发生，文件上传成功。',
            1 => '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。',
            2 => '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。',
            3 => '文件只有部分被上传。',
            4 => '没有文件被上传。',
            6 => '找不到临时文件夹。',
            7 => '文件写入失败');
        if (false == isset($error_types[$type])) {
            $error_types[$type] = $val;
        }
        $this->_error = $error_types[$type];
        return true;
    }

    function _setError($type, $val = '') {

        $error_types = array(501 => '没有上载的文件',
            502 => '不允许的扩展名',
            503 => '上载的文件超过了服务器最大限制的值，上载失败！',
            504 => '目录不可写',
            505 => '移动文件时出错！',
            506 => '上载成功',
            507 => '上载的图片文件不是有效的图片文件',
        );

        if (false == isset($error_types[$type])) {
            $error_types[$type] = $val;
        }
        $this->_error_no = $type;

        $this->_error = $error_types[$type];
        return true;
    }

    function getErrorNo() {
        return $this->_error_no;
    }

}

?>