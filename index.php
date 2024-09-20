<?php

use Jscorptech\Credentials;
use Jscorptech\HttpClient;
use Jscorptech\SMS;

require "vendor/autoload.php";


$session = new HttpClient(new Credentials("sunenergy", "Vok!]%(8=}Ov"), "https://send.smsxabar.uz");

$sms = new SMS("sfsdfsadf","3700", "998888112309", "Quyoshli marketplace sayti va mobil ilovasiga ro'yxatdan o'tishingingiz uchun tasdiqlash kodi: 1234");
$session->send_sms($sms);