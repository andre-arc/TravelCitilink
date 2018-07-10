<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Config Email via SMTP
 * username, password, port, dan host
 *
 * untuk server live inong2.bandaacehkota.info jangan gunakan tipe SMTP
 * tapi gunakan tipe MAIL karena terjadi bentrok sertifikasi authentifikasi
 *
 */
$config['protocol']    = "smtp";
$config['smtp_host']   = "inong.bandaacehkota.go.id";
$config['smtp_user']   = "no-reply@inong.bandaacehkota.go.id";
$config['smtp_pass']   = "silahkanMASUKb4!Qu17i";
$config['smtp_port']   = 465;
$config['smtp_crypto'] = "ssl"; // untuk ssl gunakan port '465' pada $config['smtp_port']

/**
 * Config timeout ketika akses SMTP
 */
$config['smtp_timeout'] = 60;

/**
 * Config email untuk jenisnya
 */
$config['useragent'] = "Muhammad-Baiquni";
$config['mailtype']  = "text/html";
$config['charset']   = "utf-8"; // "iso-8859-1";
$config['clrf']      = "\r\n";
$config['newline']   = "\r\n";

?>
