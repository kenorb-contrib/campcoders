function DcsInit(){
	this.dcsid="dcsqfhp5v10000082npv8ae8i_1k4j";
    this.period=".";
    this.strVar1="info";
    this.strVar2="tan"
    this.strVar3="gerine"
    this.strVar4="ca"
    this.domain=this.strVar1+this.period+this.strVar2+this.strVar3+this.period+this.strVar4;
	this.enabled=true;
	this.fpc="WT_FPC";
    var t=this;
    (function(){
        if (t.enabled&&(document.cookie.indexOf(t.fpc+"=")==-1)&&(document.cookie.indexOf("WTLOPTOUT=")==-1))
        {
            document.write("<scr"+"ipt type='text/javascript' src='"+"https://"+t.domain+"/"+t.dcsid+"/wtid.js"+"'><\/scr"+"ipt>");
        }
	})();
}
var DCS={};
var WT={};
var DCSext={};
var dcsInit=new DcsInit();