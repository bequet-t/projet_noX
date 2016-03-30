<?php
$message_file = fopen($argv[1], 'r'); // Ouverture du fichier du message
$message_str = fread($message_file, filesize($argv[1]));
preg_match_all("#[a-zA-Z][\S]+[a-zA-Z]#", $message_str, $message);

$message = array_pop($message);
fclose($message_file);

$i = 0;
$dico_file = fopen("dico_rj", "w");
shuffle($message);

while ($i < 1800)
{
	$str_tmp = $message[$i] . "\n";
	fwrite($dico_file, $str_tmp);
	$i++;
}
fclose($dico_file);