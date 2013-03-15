 <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/txt.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/popup.js"></script>
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/popup.css"    rel="stylesheet"/>
<script language="javascript" type="text/javascript">
    $(document).ready(function(){

        $("#submits").click(function(event){
            var url="/user/AjaxSetting";
            var nickname=$("#nickname").val();
            var oldpwd = txt.getVal('#oldpwd');
            var newpwd = txt.getVal('#newpwd');
            var imgpathx = $("#img_path").val();
            if(nickname==""){
                popup.tips(event,'warning',"昵称不能为空","3");
                return false;
            }
                    
            if(newpwd!='')
            {
                if(oldpwd==''){
                    popup.tips(event,'warning',"呀！你不输入旧密码不能设置新密码！⊙﹏⊙b汗","3");
                    return false;
                }            
            }
            $(this).text("保存中...");
            $(this).addClass('blueactive');
            var that = this;    
            $.post(url,{imgpath:imgpathx,nickname:nickname,oldpwd:oldpwd,newpwd:newpwd},function(t){
                if(t=='1'){
                    popup.tips(event,'error',"亲！你的旧密码输入有误哟~:(","3");
                }else if(t=='2'){
                    popup.tips(event,'success',"你的新设置已生效~:)","3");
                }else{
                    popup.tips(event,'warning',"啥都木更新~:(","3");
                }
                $(that).text("保 存");
                $(that).removeClass('blueactive');
               
            });
        });
         });
        </script>
<div id="content" class="container" style="width: 70%;">

    <div class="container-fluid">
        <div class="row-fluid">
            
            <div class="span9 plant-right">
                
            

<div id="personinfo">
<div class="settings"><?php echo Yii::app()->user->name;?>的设置</div>
<div class="photo_p">
  <p class="pull-left"><img width="64" height="64" id="crop_preview" name="crop_preview" src="<?php echo Yii::app()->baseUrl.$user->Picture;?>"></p>
  <div class="choose_p">
  <div>
      <iframe width="0" height="0" frameborder="0" id="uploadface" name="uploadface" marginwidth="0" src="about:blank"></iframe>
   <a class="btn_upload" style="position:relative" href="javascript:;">选择新头像
       <form method="post" action="/user/AjaxUpload" enctype="multipart/form-data" name="face_form" target="uploadface" id="face_form"><input type="file" name="face" onchange="document.getElementById('face_form').submit();" class="file_formupoadfile " id="idFile"></form> 
   </a>   
</div>
    <input type="hidden" id="img_path">
   <p>你可以选择png/jpg图片(128*128)作为头像 </p>
  </div>
</div>

<div>
    <div class="profile_set tn-form ">
        <div class="eidt_pros">

            <div class="tn-form-row ">

                <p><label class="tn-form-label">

                    邮箱
              </label></p>

                <input type="text" class="input-large" value="<?php echo $user->Email;?>" disable="" readonly="true" maxlength="20">



            </div>

            <div class="tn-form-row ">

                <p><label class="tn-form-label">

                    昵称</label></p>

                <input type="text" class="input-large" value="<?php echo $user->NickName;?>" maxlength="20" id="nickname">

            </div>


            <div class="tn-form-row clearfix">

                <p><label class="tn-form-label">

                    旧密码</label></p>

                <input type="password" class="input-large" value="请输入旧密码" defaultvalue="请输入旧密码" maxlength="20" id="oldpwd">
                <span style="position:relative" class="noticed2"><small class="muted">不修改密码则不需要填此项</small><s class="triangle"></s></span>
            </div>

            <div class="tn-form-row clearfix">

                <p><label class="tn-form-label">

                    新密码</label></p>

                <input type="password" class="inputxt" value="请输入新密码" defaultvalue="请输入新密码" id="newpwd">
               <span style="position:relative" class="noticed2">  <small class="muted">修改密码请先输入旧密码</small><s class="triangle"></s></span>
            </div>

        </div>
</div>

    </div>

    <div class="save_pros"><a class="blue-button" id="submits" href="javascript:void(0);">保 存</a></div>
</div>


                
            </div>
        </div>
        
    </div>
    
</div>