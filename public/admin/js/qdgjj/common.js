/*
* common.js
* 2016.03.02
* lch
*/

function trim(str){
    return str.replace(/^\s+|\s+$/,"");
}
function stopPropagation(e) {
    e = e || window.event;
    if(e.stopPropagation) { //W3C阻止冒泡方法
        e.stopPropagation();
    } else {
        e.cancelBubble = true; //IE阻止冒泡方法
    }
}

function preventDefault(e) {
    e = e || window.event;
    if(e.preventDefault) { //W3C阻止冒泡方法
        e.preventDefault();
    } else {
        e.returnValue = false; //IE阻止冒泡方法
    }
}

function getStyle(obj,attr){
    if(obj.currentStyle){
        return obj.currentStyle[attr];
    }else{
        return getComputedStyle(obj,false)[attr];
    }
}

function addListener(e, n, o, u){
    if(e.addEventListener){
        e.addEventListener(n, o, u);
        return true;
    } else if(e.attachEvent){
        e.attachEvent('on' + n, o);
        return true;
    }
    return false;
}
//缓冲类型运动
function startMove(obj,json,endFn){
    clearInterval(obj.timer);
    obj.timer = setInterval(function(){
        var bBtn = true;
        for(var attr in json){
            var iCur = 0;
            var speed = 0;
            if(attr == 'opacity'){
                if(Math.round(parseFloat(getStyle(obj,attr))*100)==0){
                    iCur = Math.round(parseFloat(getStyle(obj,attr))*100);
                }
                else{
                    iCur = Math.round(parseFloat(getStyle(obj,attr))*100) || 100;
                }
            }else{
                iCur = parseInt(getStyle(obj,attr)) || 0;
            }
            iSpeed = (json[attr] - iCur)/4;
            iSpeed = iSpeed >0 ? Math.ceil(iSpeed) : Math.floor(iSpeed);
            if(iCur!=json[attr]){
                bBtn = false;
            }
            if(attr == 'opacity'){
                obj.style.filter = 'alpha(opacity=' +(iCur + iSpeed)+ ')';
                obj.style.opacity = (iCur + iSpeed)/100;
            }
            else{
                obj.style[attr] = iCur + iSpeed + 'px';
            }
        }
        if(bBtn){
            clearInterval(obj.timer);
            if(endFn){
                endFn.call(obj);
            }
        }
    },50);
}

function offset(oEle){
    if(!oEle) {
        return false;
    }
    var oPare = oEle;
    var t = 0;
    var l = 0;
    while(oPare){
        t += oPare.offsetTop;
        l += oPare.offsetLeft;
        oPare=oPare.offsetParent;
    }
    return { top : t , left : l }
}


//兼容ie6的fix ,left 等值需要写行内样式
function fix(obj){
    if(!obj) return false;
    var _this=this;
    var regExpIe6 = /msie 6.0/i;
    var h=document.documentElement;
    var b=document.body;
    var sT = h.scrollTop || b.scrollTop || 0;
    var sL = h.scrollLeft || b.scrollLeft || 0;
    var winH = h.clientHeight || b.clientHeight;
    var winW = h.clientWidth || b.clientWidth;
    //非ie6
    if(!regExpIe6.test(_this.userAgent)){
        return false;
    }
    var p = {};
    var L = parseInt(getStyle(obj,"left"));
    var R = parseInt(getStyle(obj,"right"));
    var T = parseInt(getStyle(obj,"top"));
    var B = parseInt(getStyle(obj,"bottom"));
    var W = obj.offsetWidth;
    var H = obj.offsetHeight;
    var dis=0;
    obj.style.position = "absolute";
    h.scrollTop = 0;
    h.scrollLeft = 0;
    pos();
    _this.addListener(window,'scroll',function(){
        var sT = h.scrollTop || b.scrollTop || 0;
        var sL = h.scrollLeft || b.scrollLeft || 0;
        for(var attr in p){
            dis = attr == "left" ? sL : sT;
            obj.style[attr] = p[attr] + dis + "px";
        }
    },false);
    _this.addListener(window,'resize',function(){
        pos();
    },false);
    //位置更新
    function pos(){
        var sT = h.scrollTop || b.scrollTop || 0;
        var sL = h.scrollLeft || b.scrollLeft || 0;
        var winH = h.clientHeight || b.clientHeight;
        var winW = h.clientWidth || b.clientWidth;
        if(!isNaN(R)){ //如果定义了right的样式
            p.left = winW + sL -R -W;
        }else{
            p.left = L;
        };
        if(!isNaN(B)){
            p.top = winH + sT -B -H;
        }else{
            p.top = T;
        };
        for(var attr in p){
            dis = attr == "left" ? sL : sT;
            obj.style[attr] = p[attr] + dis + "px";
        }
    }
}

// 兼容的placeHolder
function jsPlaceHolder(oTxtId,option){
    var _this=this;
    if(!oTxtId) return false;
    var  _test = "placeHolder" in document.createElement("input");
    if(_test) return false;
    //以下代码是不支持的情况
    option=option||{};
    var oTxt=null;
    var setting={
        focusColor:"#333",
        blurColor:"#999"
    };
    for(var key in setting){
        if(!option[key]){
            option[key] = setting[key];
        }
    };
    if(typeof(oTxtId)!="string" && oTxtId.nodeType==1){
        oTxt = oTxtId;
        oTxtId=oTxt.id;
    }
    if(!oTxt){
        oTxt = document.getElementById(oTxtId);
    }
    var blurTxt = oTxt.getAttribute("placeholder").replace(/^\s+|\s+$/,"");
    oTxt.value = blurTxt;
    oTxt.style.color=setting.blurColor;
    _this.addListener(oTxt,"focus",function(){
        if(oTxt.value.replace(/^\s+|\s+$/,"")==blurTxt){
            oTxt.value="";
            oTxt.style.color=setting.focusColor;
        }
    });
    _this.addListener(oTxt,"blur",function(){
        if(oTxt.value.replace(/^\s+|\s+$/,"")==blurTxt || oTxt.value.replace(/^\s+|\s+$/,"")==""){
            oTxt.value=blurTxt;
            oTxt.style.color=setting.blurColor;
        }
    });
}

//左侧菜单栏
function toggleNav(boxId,claNm){
    var boxId = boxId || "js-leftnavbox";
    var claNm = claNm || "up";
    var regE = new RegExp("\\b"+claNm+"\\b","g");

    var oBox = document.getElementById(boxId);
    if(!oBox) return false;
    var allDl = oBox.getElementsByTagName("dl");
    var len = allDl.length;
    if(!len) return false;

    for(var i=0;i<len;i++){
        allDl[i].onselectstart=function(){
            return false
        };
        ;(function(i){
            var oDt = allDl[i].children[0];
            oDt.onclick=function(ev){
                if(allDl[i].className.search(regE)==-1){
                    allDl[i].className += " "+claNm;
                }else{
                    allDl[i].className = allDl[i].className.replace(regE,"");
                }

            }
        })(i)
    }
}
