
function objtostr(obj) {
	var s = " ";
	var objname = typeof (obj);
	if (objname == "object") {
		for (var i in obj) {
			if ((i != "indexOf") && (i != "remove") && (i != "removeById")) {
				if ( typeof (obj[i]) == "object") {
					s += "[" + i + "]=" + objtostr(obj[i]);
				} else {
					s += "    '" + i + "':" + objtostr(obj[i]);
				}
			}
		}
	} else {
		switch (objname) {
			case "number":
				s = obj + "\n";
				break;
			case "string":
				s = "'" + obj + "'\n";
				break;
			default:
				s = objname + ":" + obj;
		}
	}
	return s;
};

jQuery.comm = {
	asendmessage : function(url, Msg) {
		var html = $.ajax({
			url : url,
			async : false
		}).responseText;
		return html;
	},
	sendmessage : function(url, Msg, fcallback, ecallback) {
		$.ajax({
			url : url,
			type : 'post',
			beforeSend : function(oXhr) {
				oXhr.setRequestHeader('Connection', 'Keep-Alive');
			},
			data : Msg,
			timeout : 120000,
			success : fcallback,
			error : ecallback
		});
	}
};

function ajsonp(uri, packet, onsuccess) {
	$.ajax({
		async : true,
		url : window.location.protocol + "//" + window.location.host + "/" + uri,
		type : 'GET',
		dataType : 'jsonp',
		jsonp : 'jsoncallback',
		data : packet,
		timeout : 5000,
		beforeSend : function() {
		},
		success : function(json) {
			onsuccess(json);
		},
		complete : function(XMLHttpRequest, textStatus) {
		},
		error : function(xhr) {
			$().toastmessage('showErrorToast', "请求出错(请检查相关度网络状况.)");
		}
	});
}

function setcookie(name, value, expTime) {
	var Days = expTime;
	var exp = new Date();
	exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
	document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
}

function setcookie1(_name, _value, _nSenconds) {
	var str = _name + "=" + escape(_value);
	if (_nSenconds > 0) {
		var date = new Date();
		var ms = _nSenconds * 24 * 60 * 60 * 1000;
		date.setTime(date.getTime() + ms);
		str += "; expires=" + date.toGMTString() + "; domain=" + window.location.host + "; path=/;";
	}
	document.cookie = str;
};

function getcookie(name) {
	var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
	if (arr != null)
		return unescape(arr[2]);
	return null;

}

function delcookie(name) {
	var exp = new Date();
	exp.setTime(exp.getTime() - 1);
	var cval = getCookie(name);
	if (cval != null)
		document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}

function uuid() {
	var chars = '0123456789abcdef'.split('');
	var uuid = [], rnd = Math.random, r;
	uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';
	uuid[14] = '4';
	for (var i = 0; i < 36; i++) {
		if (!uuid[i]) {
			r = 0 | rnd() * 16;
			uuid[i] = chars[(i == 19) ? (r & 0x3) | 0x8 : r & 0xf];
		}
	}
	return uuid.join('');
}

function getfixstr(str,len){
    var strl1 = "00000000000000000000000"+str;
    return strl1.substr(strl1.length-len,len);
}


function getdatetime(delt) {
        var datex = new Date();
	var date = new Date(datex.getTime()+delt*1000);
	var now = "";
	now = date.getFullYear() + "-";
	now = now + (date.getMonth() + 1) + "-";
	now = now + date.getDate() + " ";
	now = now + date.getHours() + ":";
	now = now + date.getMinutes() + ":";
	now = now + date.getSeconds() + "";
	return now;
}

function getdatetime1(delt) {
	var date = new Date(delt*1000);
	var now = "";
	now = date.getFullYear() + "-";
	now = now + getfixstr((date.getMonth() + 1),2) + "-";
	now = now + getfixstr(date.getDate(),2) + " ";
	now = now + getfixstr(date.getHours(),2) + ":";
	now = now + getfixstr(date.getMinutes(),2) + ":";
	now = now + getfixstr(date.getSeconds(),2) + "";
	return now;
}

function getdate(delt) {
        var datex = new Date();
	var date = new Date(datex.getTime()+delt*1000);
	var now = "";
	now = date.getFullYear() + "-";
	now = now + getfixstr((date.getMonth() + 1),2) + "-";
	now = now + getfixstr(date.getDate(),2);
	return now;
}

function getdatem(delt) {
        var datex = new Date();
	var date = new Date(datex.getTime()+delt*1000);
	var now = "";
	now = date.getFullYear() + "-";
	now = now + getfixstr((date.getMonth() + 1),2) 
	return now;
}

function getdate1(timeticket) {
	var date = new Date(timeticket*1000);
	var now = "";
	now = date.getFullYear() + "-";
	now = now + (date.getMonth()+1) + "-";
	now = now + date.getDate();
	return now;
}

function getdatem1(timeticket) {
	var date = new Date(timeticket*1000);
	var now = "";
	now = date.getFullYear() + "-";
	now = now + (date.getMonth() +1)
	return now;
}

function gettime(delt) {
        var datex = new Date();
	var date = new Date(datex.getTime()+delt*1000);
	var now = "";
	now = now + date.getHours() + ":";
	now = now + date.getMinutes() + ":";
	now = now + date.getSeconds() + "";
	return now;
}

function gettimeticket(delt) {
	var nowticket = new Date();
	return (parseInt( nowticket.getTime() / 1000 )+delt);
}

function gettimeticketfromstr(str) {
        var dateArr = str.split("-");
	var nowticket = new Date(dateArr[0],dateArr[1]-1,dateArr[2],0,0,0);
	return parseInt( nowticket.getTime() / 1000 );
}

