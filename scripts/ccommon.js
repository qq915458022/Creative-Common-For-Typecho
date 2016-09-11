var license = getQueryString(getJSUrl(),"license");
var jsPath =  getJSUrl().substring(0, getJSUrl().lastIndexOf('/'));
var path = jsPath.substring(0, jsPath.lastIndexOf('/')); 
$( document ).ready(function() {
	if(license == "all"){
		var node=document.createTextNode("保留所有权利。");
		makeLicense(node,null,null);
	}else if(license == "no"){
		var node=document.createTextNode("针对此文章不进行权利保留：");
		makeLicense(node,"https://creativecommons.org/publicdomain/zero/1.0/",path + "/media/zero/1.0/80x15.png");
	}else{
		var node=document.createTextNode("本作品基于此协议授权：");
		makeLicense(node,"https://creativecommons.org/licenses/" + license + "/4.0/",path + "/media/cc/" + license +"/4.0/80x15.png");
	}
})

function makeLicense(node,llink,logo){
	var para=document.createElement("h6");
	para.style.cssText = "margin-top:50px";
	
	para.appendChild(node);
	
	if(llink != null){
		var link,img;
		para.appendChild(link = document.createElement("a"));
		link.appendChild(img = document.createElement("img"));
		link.target = "_blank";
		link.href = llink;
		img.style.cssText = "vertical-align:text-top";
		img.src = logo;
	}
		
	var element=document.getElementById("article-content-div");
	element.appendChild(para);
}

function getQueryString(url, name) {
    var reg = new RegExp("(^|&|\\?)" + name + "=([^&]*)(&|$)", "i");
    var r = url.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
} 

function getJSUrl(){
	var i = 0,
    	result = null,
        script, scripts, url, reg, r;
    
    // firefox支持currentScript属性
    if( document.currentScript ){
        script = document.currentScript
    }
    else{
        // 正常情况下，在页面加载时，当前js文件的script标签始终是最后一个
        scripts = document.getElementsByTagName( 'script' )            
        script = scripts[ scripts.length - 1 ]
    }           

    url = script.hasAttribute ? script.src : script.getAttribute( 'src', 4 );
    return url;
}