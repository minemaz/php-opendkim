--TEST--
Verify a message
--FILE--
<?php
if (!($dkim = new OpenDKIMVerify())) {
    die('KO:'.__LINE__.':'.$dkim->getError());
}
$body = file_get_contents(__DIR__.'/mails/001.eml');
if (!($res = $dkim->chunk($body))) {
    die('KO:'.__LINE__.':'.$dkim->getError());
}
if (!($res = $dkim->chunk())) {
    die('KO:'.__LINE__.':'.$dkim->getError());
}
if (!$dkim->getDomain()) {
    die('KO:'.__LINE__.':'.$dkim->getError());
}
if (!$dkim->getUser()) {
    die('KO:'.__LINE__.':'.$dkim->getError());
}
if (!$dkim->body('')) {
    die('KO:'.__LINE__.':'.$dkim->getError());
}
if (!$dkim->getMinBodyLen()) {
    die('KO:'.__LINE__.':'.$dkim->getError());
}
if (OpenDKIM::STAT_OK!=$dkim->eom()) {
    die('KO:'.__LINE__.':'.$dkim->getError());
}
echo $dkim->getARSigs();
echo "\n";
echo "OK\n";
?>
--EXPECTREGEX--
dkim=pass \(1024-bit key\) header\.d=lancard\.com header\.i=\@lancard\.com header\.b="c5mg1tnk"
OK
