<?php
// conf
set_time_limit(0);
ini_set('display_errors', 'off');
// datiprint("       ------------------------------------------
       | usage: php dharma.php server port #chan|
       |________________________________________|\n");
$host = $argv[1];
$port = $argv[2];
$nick="Dharma";
$ident="Dharma";

// qui il canale
$chan = "#chan";
$realname = "Dharma";
$fp = fsockopen($host, $port, $erno, $errstr, 30);
$loggo  =  fopen('log.txt',  'a'); 
$nbest = rand(1, 15);

$bestemmie = array(
"gli apostoli teletubbies"
,"mannaggia ai sandali di cristo"
,"madonna apostrofata"
,"dio condito"
,"i santi arrosto"
,"jacobbe salumaio"
,"san pietro vandalo"
,"maria curiosa"
,"san francesco assassino"
,"san beppe sventrato"
,"dio vigile"
,"gli apostoli interisti"
,"madonna di legno"
,"dio cacciavite sporco di sangue ebreo"
,"san marco a fuoco"
,"dio musso da corsa"
);

// join

if (!$fp)
{
    echo $errstr." (".$errno.")<br />\n";
}
else
{
	//INVIO DATI INIZIALI
	fwrite($fp, "PASS sticazzi\r\n");
	fwrite($fp, "NICK ".$nick."\r\n");
	fwrite($fp, "USER dharma 9 * : dharma dharma\r\n");
    
	
	//CICLO PRINCIPALE - BOTTA & RISPOSTA 
	while (!feof($fp))
	{
		$line =  fgets($fp, 128);
        fwrite($loggo,  $line."\r\n");
		
		//ESPLODO LA LINEA SEPARANDO LE PAROLE IN BASE AGLI SPAZI
		$parole = explode(" ", $line);
		
		
		//SE LA PRIMA PAROLA E' PING RISPONDO CON PONG
		if ( $parole[0] == "PING" )
		{
			fwrite($fp, "PONG ".$parole[1]."\r\n");
		}
		
		if ( $parole[1] == "001" )
		{
			fwrite($fp, "JOIN ".$chan."\n");
			fwrite($fp, "PRIVMSG ".$chan." :7Namaste!\r\n");
		}
		
		
		//ALTRE RISPOSTE
		
		// Admin
             switch (true) {

                  case (eregi('lol', $line));
                   fwrite($fp, "PRIVMSG ".$chan." : 7 asd\r\n");
                     break;
		case (eregi("!oop ", $line));
			$exline = explode(":", $line);
            $exline = str_replace("!oop", "", $exline);
                        fwrite($fp, "MODE ".$chan." +o ".$exline[2]." \n" );
                break;
		case (eregi("!dop", $line));
		
			$exline = explode(":", $line);
            $exline = str_replace("!dop","", $exline);
			fwrite($fp, "MODE ".$chan." -o ".$exline[2]." \n" );
		break;
		case (eregi("!ban", $line));
		
			$exline = explode(":", $line);
            $exline = str_replace("!ban", "", $exline);
			fwrite($fp, "MODE ".$chan." +b ".$exline[2]." \n" );
		break;
		case (eregi("!-ban", $line));
		
			$exline = explode(":", $line);
            $exline = str_replace("-b", "", $exline);
			fwrite($fp, "MODE ".$chan." -b ".$exline[2]." \n" );
		break;
		case (eregi("!vo", $line));
			$exline = explode(":", $line);
            $exline = str_replace("!vo", "", $exline);
			fwrite($fp, "MODE ".$chan." +v ".$exline[2]." \n" );
		break;
		case (eregi("!-vo", $line));
			$exline = explode(":", $line);
            $exline = str_replace("!-vo", "", $exline);
			fwrite($fp, "MODE ".$chan." -v ".$exline[2]." \n" );
		
		case (eregi("!k", $line));
		
			$exline = explode(":", $line);
            $exline = str_replace("!k", "", $exline);
			fwrite($fp, "KICK ".$chan." ".$exline[2]." :".$exline[2]." \n" );
		break;


		// risposte publiche
		case (eregi("!md5", $line));
		
			$exline = explode(":", $line);
            $exline = str_replace("!md5", "", $exline);
			$md5 = md5($exline[2]);
			fwrite($fp, "PRIVMSG ".$chan." : >> ".$md5."\r\n");
		break;
		case (eregi("!b64", $line));
		
			$exline = explode(":", $line);
            $exline = str_replace("!b64", "", $exline);
			$b64 = base64_encode($exline[2]);
			fwrite($fp, "PRIVMSG ".$chan." : ".$b64."\r\n");
		break;
		case (eregi("!decb64", $line));
		
			$exline = explode(":", $line);
            $exline = str_replace("!decb64", "", $exline);
			$bd64 = base64_decode($exline[2]);
			fwrite($fp, "PRIVMSG ".$chan." : ".$bd64."\r\n");
		break;
		case (eregi("!bestemmia", $line));
		
			fwrite($fp, "PRIVMSG ".$chan." : 7".$bestemmie[rand (0,15)]."\r\n");
		
		case (eregi("ciao", $line));
		
		$line2 = ("!".$line."");
		    $exline = explode("!", $line2);
			$exline = str_replace(":", "", $exline);
			fwrite($fp, "PRIVMSG ".$chan." : ciao ".$exline[1]." :) \r\n");
		break;
		case (eregi("!killme", $line));
		
			exit();
		break;
		case (eregi("!vez", $line));
		
			fwrite($fp, "PRIVMSG ".$chan." : 7 2.0 ~ Coded by Mr.JacK ~ www.kingpc.it \r\n");
		break;

		case (eregi("!help", $line));
		
		$line2 = ("!".$line."");
		$exline = explode("!", $line2);
		$exline = str_replace(":", "", $exline);
		fwrite($fp, "PRIVMSG ".$chan." :".$exline[1].", i comandi ti sono stati inviati in pvt :) \r\n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7 !killme {Il bot và a farsi fottere}\n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7!vez {versione corrente del bot}\n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7!oop  {nick} (operator) \n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7!dop  {nick} \r\n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7!vo {nick} (voice) \r\n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7!-vo  {nick} (devoice) \r\n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7!md5 {parola} \r\n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7!k {nick} (kick) \r\n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7!ban  {nick} (ban) \r\n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7!-ban  {nick} (- ban) \r\n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7!b64 {parola} (calcola il valore base64) \r\n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7!decb64 {parola} (decodifica stringhe in base64) \r\n");
		fwrite($fp, "PRIVMSG ".$exline[1]." :7!bestemmia ( 15 bestemmie scelte a caso ) \r\n");
                break;

		
		
	}	
    echo $line."\n";
   }
    fclose($fp);
}
?>
