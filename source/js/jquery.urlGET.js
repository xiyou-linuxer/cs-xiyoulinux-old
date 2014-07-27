/*============================================================================
* FileName: jquery.urlGET.js
*
*   Author: Jensyn <zhangyongjun369@gmail.com>
*
*     Blog: http:zhangyongjun.sinaapp.com
*
*  Version: 1.0
*
*     Date: 2014年07月21日 星期一 21时39分52秒
* 
*============================================================================*/

;(function($)  
{  
    $.extend(
    {  
    /** 
     * url get parameters 
     * @public 
     * @return array() 
     **/  
        urlGet:function() {  
            var aQuery = window.location.href.split("?");//取得Get参数  
            var aGET = new Array();  
            if(aQuery.length > 1) {  
                var aBuf = aQuery[1].split("&");  
                for(var i=0, iLoop = aBuf.length; i<iLoop; i++) {  
                    var aTmp = aBuf[i].split("=");//分离key与Value  
                    aGET[aTmp[0]] = aTmp[1];  
                }
            }  
            return aGET;  
        },  
    });  
})(jQuery); 

