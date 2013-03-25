<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/txt.js"></script>
<script>
    $(function() {
        $("#name").blur(function() {
            var name = txt.getVal("#name");
            var patrn = /^[\u0391-\uFFE5A-Za-z0-9]{5,10}$/;
            if (!patrn.exec(name)) {
                $("#namemsg").show();
                $("#namemsg").html('提示：昵称只能由5~20个字符组成');
                $("#comittrue").hide();
                $("#comitfalse").show();
            } else {
                $("#namemsg").hide();
                $("#comittrue").show();
                $("#comitfalse").hide();
            }
        });
        $("#route").blur(function() {
            var route = txt.getVal("#route");
            if (route) {
                var patrn = /^[0-9A-Za-z_]{3,20}$/
                if (!patrn.exec(route)) {
                    $("#routemsg").show();
                    $("#routemsg").html('提示：路由只能由3~30个字符组成');
                    $("#comittrue").hide();
                    $("#comitfalse").show();
                } else {
                    $("#routemsg").hide();
                    $("#comittrue").show();
                    $("#comitfalse").hide();
                }
            }
        });

  $("#info").keyup(function(event){
      txt.checkWord("120",event);
  });

        $("#comittrue").live("click", function() {


           var name = txt.getVal("#name");
           var route = txt.getVal("#route");
           var info = txt.getVal("#info");

            if (name == '') {
                $("#namemsg").show();
                $("#namemsg").html('提示：昵称不能为空');
                return false;
            }
            if (route == '') {
                $("#rotuemsg").show();
                $("#routemsg").html('提示：电子邮箱不能为空');
                return false;
            }
            if (info == '') {
                $("#infomsg").show();
                $("#infomsg").html('提示：简介不能为空');
                return false;
        
            }
            var url = "/shelf/ajaxCreate";
            $.post(url, {name:name,route:route,info:info}, function(d) {
                if (d == 'ok') {
                    location.href = "/shelf/index";
                }
            });
        });
    });
</script>
<div id="content" class="container" style="width: 70%;">

    <div class="container-fluid">
        <div class="row-fluid">

            <div class="span9 plant-right">
              
                    <div class="control-group">
                        <label class="control-label" for="inputName">名称</label>
                        <div class="controls">
                            <input type="text" id="name" placeholder="花架名称"> <span id="namemsg" class="text-error"></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputRoute">路由</label>
                        <div class="controls">
                            <input type="text" id="route" placeholder="花架的访问路由"> <span id="routemsg" class="text-error"></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputInfo">简介</label>
                        <div class="controls">
                             
                            <textarea rows="3" id="info" style="width: 60%"></textarea> <span id="infomsg" class="text-error"></span> 还可输入<span id="wordCheck">120</span>字
                            
         
                        </div>
                    </div>
                    
                         <div class="control-group">
         
                        <div class="controls">
                            
                            <input type="button" id="comittrue" class="blue-button" value="创 建">
                            <input type="button" id="comitfalse" class="blue-button dsnone" value="创 建">
                        </div>
                    </div>
                    
            
            </div>
        </div>
    </div>
</div>