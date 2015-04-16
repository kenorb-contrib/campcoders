	var userLang = 'en_CA';
	var splashCookieName = 'AppSplash';
	var splashCookieValue = 'dont_ask';
	var splashCookieDuration = 365;
	var pathToSplash = '/web/splash/index.html';
	var loginPath = '/web/InitialTangerine.html?command=displayLoginRegular&device=web&locale=';
	
	//Ask the user every time unless they clicked "No Thanks"
	function setSplashCookie(){
		var exdate=new Date();
		exdate.setDate(exdate.getDate() + splashCookieDuration);
		var c_value=escape(splashCookieValue) + "; expires="+exdate.toUTCString();
		document.cookie=splashCookieName + "=" + c_value + ";domain="+window.location.hostname+";path=/;";
	}
	
	function getSplashCookie(){
		var c_value = document.cookie;
		var c_start = c_value.indexOf(" " + splashCookieName + "=");
		if (c_start == -1){
			c_start = c_value.indexOf(splashCookieName + "=");
		}
		if (c_start == -1){
			c_value = null;
		}else{
			c_start = c_value.indexOf("=", c_start) + 1;
			var c_end = c_value.indexOf(";", c_start);
			if (c_end == -1){
			c_end = c_value.length;
			}
			c_value = unescape(c_value.substring(c_start,c_end));
		}
		return c_value;
	}
	
	function checkIfMobileSplash(passedLang){
/*		
 		userLang = passedLang;
		var getApp=getSplashCookie();
		if (getApp==null || getApp=="" || (getApp != splashCookieValue)){
			showAppSplash();
		}
*/
	}
	
	function showAppSplash(){
		dev = getDev();
		switch(dev){
			case 'unknown':
				setSplashCookie();
				break;
			case 'iphone':
				if(iOSUnder6())showSplash();	
				break;	
			case 'ipad':
				if(iOSUnder6())showSplash();
				break;
			case 'ipod':
				if(iOSUnder6())showSplash();
				break;
			case 'android':
				showSplash();
				break;
			case 'androidtablet':
				showSplash();
				break;
			case 'bb10':
				showSplash();
				break;
			case 'winphone8':
				dev = 'winphone7';
				showSplash();
				break;
			case 'winphone7':
				showSplash();
				break;
			case 'wintouch':
				break;
			case 'blackberry':
				showSplash();
				break;
			case 'playbook':
				showSplash();
				break;
			default:
				break;
		}
	}
	
	function showSplash(){
		window.location.href = '/web/' + userLang + pathToSplash;
	}
	
	function iOSUnder6(){
	  if (/iP(hone|od|ad)/.test(navigator.platform)) {
	    var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
	    return parseInt(v[1], 10)<6;
	  }
	  return true;
	}
	
	function closeSplash(userLang){
		setSplashCookie();
		try{
			dcsMultiTrack('DCS.dcsuri',document.location.toString(),'WT.ti',userLang + ' - CloseSplash');
		}catch (e){
			//silent fail
		}
		//Check if referring URL has 'DST=' parameter, append it.
		window.location.href = loginPath + userLang + getReferringDST();
	}
	
	function goToApp(){
		if("unknown" != getDev()){
			try{
				dcsMultiTrack('DCS.dcsuri',document.location.toString(),'WT.ti',userLang + ' - GoToApp');
			}catch (e){
				//silent fail
			}
			window.location.href = links[getDev()];
		}else{
			closeSplash(userLang);
		}
	}

	function getDev(){
		var d="unknown"
		var a={android:/(Android)\s+([\d.]+).*([\d.]+)\s+(Mobile Safari)/,androidtablet:/(Android)\s+([\d.]+).*([\d.]+)\s+(Safari)/,iphone:/(iPhone\sOS)\s([\d_]+)/,ipad:/(iPad).*OS\s([\d_]+)/,blackberry:/(BlackBerry|RIM)\s([\d.]+).*Version\/([\d.]+)/,winphone8:/(Windows Phone 8.)[\d.]/,wintouch:/(MSIE 10).*(Touch)/,bb10:/BB10;[\d]?/,playbook:/PlayBook;.*Tablet/,winphone7:/(Windows Phone OS 7.)[\d.]/};
		for(b in a){
			if(navigator.userAgent.search(a[b])>=0){
				d=b;
				break;
			}
		}
		return d
	}
	
	function getReferringDST(){
		try{
			var query = document.referrer.split('?')[1];		
			if(query){
				var vars = query.split("&");
				for (var i=0;i<vars.length;i++) {
					var pair = vars[i].split("=");
					if(pair[0] == 'DST'){return '&DST='+pair[1];}
				}
			}
		} catch (e){
			//silent fail
		}
		return('');
	}
	
	var links = {
		iphone:"https://itunes.apple.com/ca/app/ing-direct-canada/id847844097?mt=8",
		ipad:"https://itunes.apple.com/ca/app/ing-direct-canada/id847844097?mt=8",
		ipod:"https://itunes.apple.com/ca/app/ing-direct-canada/id847844097?mt=8",
		android:"market://details?id=ca.tangerine.clients.phone",
		androidtablet:"market://details?id=ca.tangerine.clients.tablet",
		winphone8:"https://www.windowsphone.com/en-us/store/app/ing-direct/e4d6beab-875e-47d6-b46c-d455eb3fe35c",
		winphone7:"https://www.windowsphone.com/en-us/store/app/ing-direct/e4d6beab-875e-47d6-b46c-d455eb3fe35c",
		wintouch:"ms-windows-store:PDP?PFN=2e5233fe-d039-4115-8227-51c2ae091c37",
		bb10:"https://appworld.blackberry.com/webstore/content/49799472/",
		blackberry:"https://appworld.blackberry.com/webstore/content/49799472/"
	}