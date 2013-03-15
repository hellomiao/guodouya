//弹窗对象,超简版@pigg
var popup={
    html:'<div class="dialog_jky dwt" id="dialog_jky" style="position:  absolute;  display: none;z-index:100000;">	<div class="dialog_tita">		<table class="table_diat">			<tbody>				<tr>					<td class=""></td>					<td class=""></td>					<td class=""></td>				</tr>				<tr>					<td class=""></td>					<td class="">						<table class="tabel_ctdiat">							<tbody>	<tr>	<td><a class="close" href="javascript:;">x</a></td></tr>							<tr>									<td class="td_content_ctdiat">										<div class="content_waprpper_ctdiat">											<div class="content_ctdiat">											   <img class="tips_verify" alt="" src="../img/transparent.gif"><span id="dialog_txt">您确定要删除此任务吗？此操作将不可恢复</span>											</div>										</div>									</td>								</tr>								<tr>									<td class="tn_btn_ctdiat">										<div class="btn_ctdiat">											<a class="btn_sure btn_small_green" title="确定" href="javascript:void(0);"><b><i>确定</i></b></a><a class="btn_cancel btn_small_gay" title="取消" href="javascript:void(0);"><b><i>取消</i></b></a>										</div>									</td>								</tr>							</tbody>						</table>					</td>					<td class="right_tdiat"></td>				</tr>				<tr>					<td class=""></td>					<td class=""></td>					<td class=""></td>				</tr>			</tbody>		</table>	</div></div>',
    htmltip:'<div id="poptip" class="poptip" style="display: none; width: auto; position: absolute; left: 217px; top: 469.733px; z-index: 100;">	<div class="cont_pp"><table cellspacing="0" cellpadding="0"><tbody><tr><td class="wrapper_pp" style="white-space: normal;"><span class="poptiptxt">结束该任务</span></td></tr></tbody></table></div>	<div class="tria_pp" style="margin-left: 35px;"></div></div>',
    datehtml:'',
    //超简版弹窗,剧中带蒙版
    showWin:function(obj){
        var winNode = $("#"+obj);
        var that =this; 
        winNode.fadeIn("slow"); 
        that.setPos(obj);
        $("#light_box_fullbg").show();
    },
    // 设置位置
    setPos:function(obj) {

        var html = document.documentElement,
        box = document.getElementById(obj),
        boxWidth = box.offsetWidth,
        boxHeight = box.offsetHeight;

        // 可视窗口
        var htmlWidth = html.clientWidth,
        htmlHeight = html.clientHeight,
    
        // margin 值
        marginX = htmlWidth > boxWidth ? -(boxWidth/2) : 0,
        marginY = htmlHeight > boxHeight ? -(boxHeight/2) : 0,

        // 可视宽度如果太小，要注意让内容能完整显示出来
        left = marginX == 0 ? 0 : '50%',
        top = marginY == 0 ? 0 : '50%';
      
        //alert(boxHeight);

        box.style.left = left;
        box.style.top = top;
        box.style.marginLeft = marginX + 'px';
        box.style.marginTop = marginY + 'px';
    },
    hide:function(obj){  
        var winNode = $("#"+obj);  

        winNode.fadeOut("slow");  

        winNode.hide("slow");  

        $("#light_box_fullbg").hide();
    },

    //获取坐标
    getX:function(e)
    {
        e = e|| window.event;
        return e.pageX || e.clientX + document.body.scroolLeft;
    },

    getY:function(e)
    {
        e = e|| window.event;
        return e.pageY || e.clientY + document.body.scrollTop;

    },

    setBoxPos:function(x,y,obj){
        var w = $(obj).width();
        var h =$(obj).height();
        $(obj).css("left",x-w/2+"px");
        $(obj).css("top",y-h-20+"px");
    },
    setBoxPos1:function(x,y,obj){
        var w = $(obj).width();
        var h =$(obj).height();
        $(obj).css("left",x-w/2-40+"px");
        $(obj).css("top",y-h-20+"px");
    },
    setBoxPosBottom:function(x,y,obj){
        var w = $(obj).width();
        var h =$(obj).height();
        $(obj).css("left",x-w/2+"px");
        $(obj).css("top",y+15+"px");
    },
    //以下弹窗都是根据鼠标位置显示的，不带蒙版
    //confirm窗口 e事件 txt文本内容（可为空） callback返回函数 e和callback是必须参数 callback 传入操作t 实际是事件dom对象
    confirm:function(){
        var obj = "#dialog_jky_1";
        $(obj).remove();
        var n = arguments.length;

        e = arguments[0];

        if(n<=2){
            _txt = "您确定要删除此任务吗？此操作将不可恢复";
            callback =  arguments[1];

        }else{
            _txt = arguments[1]
            callback = arguments[2]
        }
        var that =this;
        var x = that.getX(e);
        var y = that.getY(e);
        $("body").append(that.html);
        $("#dialog_jky").attr("id","dialog_jky_1")

        $(obj).show();
        $(obj+" .tabel_ctdiat tr").eq(0).remove();
        $(obj+" #dialog_txt").text(_txt);
        that.setBoxPos(x,y,obj);

        var t=$(e.target);
        //确定按钮
        $(obj+" .btn_sure").click(function(){
            callback(t);
            $(obj).remove();
        });

        //取消按钮
        $(obj+" .btn_cancel").click(function(){
            $(obj).remove();
        });
        
        $(obj+" .close").click(function(){
            $(obj).remove();

        });

    },

    //提示 e是事件 type是类型(success,error,warning),txt是提示内容,time是多久消失
    tips:function(e,type,_txt,time,callback){
        var obj = "#dialog_jky_2";
        $(obj).remove();
        var that =this;
        var x = that.getX(e);
        var y = that.getY(e);
        time=typeof(time)=='undefined'?2000:time*1000;
        callback=typeof(callback)=='undefined'?function(){}:callback;
        $("body").append(that.html);
        $("#dialog_jky").attr("id","dialog_jky_2")
        $(obj+" .close").remove();
        $(obj+" .tabel_ctdiat tr").eq(0).remove();
        $(obj+" .tabel_ctdiat tr").eq(1).remove();
        switch(type)
        {
            case 'success':
                $(obj).find('img').attr("class","yes_verify");
                break;
            case 'error':
                $(obj).find('img').attr("class","error_verify");
                break;
            case 'warning':
                $(obj).find('img').attr("class","warm_verify");
                break;
        }
        $(obj).fadeIn("slow");
        $(obj+" #dialog_txt").text(_txt);
        that.setBoxPos(x,y,obj);
        window.setTimeout(function(){
	
            $(obj).animate({
                top:"-1250px",
                opacity: 'toggle'
            },800,function(){
                $(obj).remove();
                callback();
            });

        },time)

    },
   
    //无事件提示
    tipsx:function(type,txt,time,callback){

        var obj = "#dialog_jky_2";
        var objo = "dialog_jky_2";
        $(obj).remove();
        var that =this;
        time=typeof(time)=='undefined'?2000:time*1000;
        callback=typeof(callback)=='undefined'?function(){}:callback;
        $("body").append(that.html);
        $("#dialog_jky").attr("id","dialog_jky_2")
        $(obj+" .tabel_ctdiat tr").eq(0).remove();
        $(obj+" .tabel_ctdiat tr").eq(1).remove();
        switch(type)
        {
            case 'success':
                $(obj).find('img').attr("class","yes_verify");
                break;
            case 'error':
                $(obj).find('img').attr("class","error_verify");
                break;
            case 'warning':
                $(obj).find('img').attr("class","warm_verify");
                break;
        }
        $(obj).fadeIn("slow");
        $(obj+" #dialog_txt").text(txt);
        that.setPos(objo);
    
        window.setTimeout(function(){
	
            $(obj).animate({
                top:"-1250px",
                opacity: 'toggle'
            },800,function(){
                $(obj).remove();
                callback();
            });

        },time)
        

    },

    t:"#dialog_jky_3",
    tx:"dialog_jky_3",
    //简版弹窗以后扩展 e 事件 thtml要加载的内容快 callback回调函数 确定按钮 参数f 获取input或者其他值 如f("#xx").val() 
    box:function(target,callback,showBtn,js_envent)
    {
        js_envent=typeof(js_envent)=='undefined'?"click":js_envent;
        var that =this;
        var obj=that.t;

        $(target).bind(js_envent,function(e){
            $(obj).remove();

            var x = that.getX(e);
            var y = that.getY(e);
            $("body").append(that.html);
            $("#dialog_jky").attr("id","dialog_jky_3")

            $(obj).show();

            var f=function(objx){

                return $(obj).find(objx);
            }
            var href=$(this).attr("href");
            var thtml;
            var content = $(obj+" .tabel_ctdiat").eq(0).find(".content_ctdiat");
            showBtn=typeof(showBtn)=='undefined'?true:showBtn;
            if(showBtn==false){
                $(obj+" .tabel_ctdiat .tn_btn_ctdiat").remove();
            }
            if(href.indexOf("#")!='-1'&&href.indexOf("#")=='0'){
                thtml=$(href).html();
                content.html(thtml);
            }else{
                $.get(href,function(d){//ajax
                    content.html(d);
                });
            }
            if(x>1200){
                x=1200;
            }
            if(y<300){
                y=300;
            }
            that.setBoxPos(x,y,obj);
            callback.before=typeof(callback.before)=='undefined'?function(){}:callback.before;
            callback.success=typeof(callback.success)=='undefined'?function(){}:callback.success;
            callback.before(f,$(e.target));
            //确定按钮
            $(obj+" .btn_sure").click(function(){
                var flag;
                flag=callback.success(f,e);
                if(flag!=false){
                    $(obj).remove();
                }
            });

            //取消按钮
            $(obj+" .btn_cancel").click(function(){
                $(obj).remove();

            });
            
            $(obj+" .close").click(function(){
                $(obj).remove();

            });
            
            return false;

        });
      
        

    },
    
    boxCenter:function(target,callback)
    {
        var that =this;
        var obj=that.t;
        var objx=that.tx;
        $(target).click(function(e){
            $(obj).remove();

            var x = that.getX(e);
            var y = that.getY(e);
            $("body").append(that.html);
            $("#dialog_jky").attr("id","dialog_jky_3")

            $(obj).show();

            var f=function(objx){

                return $(obj).find(objx);
            }
            var href=$(this).attr("href");
            var thtml;
            var content = $(obj+" .tabel_ctdiat").eq(0).find(".content_ctdiat");
            if(href.indexOf("#")!='-1'&&href.indexOf("#")=='0'){
                thtml=$(href).html();
                content.html(thtml);
            }else{
                $.get(href,function(d){//ajax
                    content.html(d);
                });
            }

            that.setPos(objx);
            callback.before=typeof(callback.before)=='undefined'?function(){}:callback.before;
            callback.success=typeof(callback.success)=='undefined'?function(){}:callback.success;
            callback.before(f,$(e.target));
            //确定按钮
            $(obj+" .btn_sure").click(function(){
                var flag;
                flag=callback.success(f,e);
                if(flag!=false){
                    $(obj).remove();
                }
            });

            //取消按钮
            $(obj+" .btn_cancel").click(function(){
                $(obj).remove();

            });
            
            $(obj+" .close").click(function(){
                $(obj).remove();

            });

            return false;

        });

    },
    boxBottom:function(target,callback)
    {
        var that =this;
        var obj=that.t;
        $(target).click(function(e){
            $(obj).remove();

            var x = that.getX(e);
            var y = that.getY(e);
            $("body").append(that.html);
            $("#dialog_jky").attr("id","dialog_jky_3")

            $(obj).show();

            var f=function(objx){

                return $(obj).find(objx);
            }
            var href=$(this).attr("href");
            var thtml;
            var content = $(obj+" .tabel_ctdiat").eq(0).find(".content_ctdiat");
            if(href.indexOf("#")!='-1'&&href.indexOf("#")=='0'){
                thtml=$(href).html();
                content.html(thtml);
            }else{
                $.get(href,function(d){//ajax
                    content.html(d);
                });
            }

            that.setBoxPosBottom(x,y,obj);
            callback.before=typeof(callback.before)=='undefined'?function(){}:callback.before;
            callback.success=typeof(callback.success)=='undefined'?function(){}:callback.success;
            callback.before(f,$(e.target));
            //确定按钮
            $(obj+" .btn_sure").click(function(){
                var flag;
                flag=callback.success(f,e);
                if(flag!=false){
                    $(obj).remove();
                }
            });

            //取消按钮
            $(obj+" .btn_cancel").click(function(){
                $(obj).remove();

            });
            
            $(obj+" .close").click(function(){
                $(obj).remove();

            });

            return false;

        });

    },
    
    titles:function(target,type)
    {
        var that =this;
        var obj="#poptip";
       
        $(target).live("mouseover",function(e){
            $(obj).remove();
            var titlex = $(this).attr("title");
            var x = that.getX(e);
            var y = that.getY(e);
            $(this).parent().append(that.htmltip);
       
            $(obj).show();
            $(obj).find(".poptiptxt").text(titlex);
            var w = $(obj).width();
            var h = $(obj).height();
            var left = $(this).offset().left;
            var top = $(this).offset().top;
            $(obj).find(".tria_pp").css("margin-left",w/2-8)
            if(type=='user'){
                $(obj).css("left",left-40);
                $(obj).css("top",top-h-5);
            }else{
                $(obj).css("left",left-w/2+12);
                $(obj).css("top",top-h-5);
            }
        });
        $(target).live("mouseout",function(e){
            $(obj).remove();
        
            });
    }



}

