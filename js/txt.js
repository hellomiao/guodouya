//表单处理
var txt = {
    getVal: function(obj) {
        if ($(obj).val() == $(obj).attr("defaultvalue")) {
            return "";

        } else {
            return $(obj).val();
        }
    },
    strlimit: function(sString)
    {
        var sStr, iCount, i, strTemp;

        iCount = 0;
        sStr = sString.split("");
        for (i = 0; i < sStr.length; i++)
        {
            strTemp = escape(sStr[i]);
            if (strTemp.indexOf("%u", 0) == -1) // 表示是汉字
            {
                iCount = iCount + 1;
            }
            else
            {
                iCount = iCount + 2;
            }
        }
        return iCount;
    },
    checkWord: function(len, evt) {
        if (evt == null)
            evt = window.event;
        var src = evt.srcElement ? evt.srcElement : evt.target;
        var str = src.value.trim();//

        myLen = 0;
        i = 0;
        for (; (i < str.length) && (myLen <= len * 2); i++) {
            if (str.charCodeAt(i) > 0 && str.charCodeAt(i) < 128)
                myLen++;
            else
                myLen += 2;
        }
        var mydiv = document.getElementById("wordCheck");
        if (myLen > len * 2) {
            src.value = str.substring(0, i - 1);
        }

    }


}