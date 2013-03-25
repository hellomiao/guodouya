<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/txt.js"></script>
<script>
    $(function() {
        $("#nickname").blur(function() {
            var nickname = txt.getVal("#nickname");
            var patrn = /^[\u0391-\uFFE5A-Za-z0-9]{3,10}$/;
            if (!patrn.exec(nickname)) {
                $("#msg").show();
                $("#msg").html('提示：昵称只能由3~10个字符组成');
                $("#comittrue").hide();
                $("#comitfalse").show();
            } else {
                $("#msg").hide();
                $("#comittrue").show();
                $("#comitfalse").hide();
            }
        });
        $("#password").blur(function() {
            var password = txt.getVal("#password");
            if (password) {
                var patrn = /^(\w){6,20}$/;
                if (!patrn.exec(password)) {
                    $("#msg").show();
                    $("#msg").html('提示：密码格式有误，只能6-20个字母、数字、下划线');
                    $("#comittrue").hide();
                    $("#comitfalse").show();
                } else {
                    $("#msg").hide();
                    $("#comittrue").show();
                    $("#comitfalse").hide();
                }
            }
        });

        $("#email").blur(function() {
            var email = txt.getVal("#email");
            var reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
            if (email) {
                if (reg.test(email)) {
                    var url = '/front/AjaxCheckEmail';
                    $.post(url, {email: email}, function(d) {
                        if (d == 'ok') {
                            $("#msg").hide();
                            $("#comittrue").show();
                            $("#comitfalse").hide();
                        } else {
                            $("#msg").show();
                            $("#msg").html(d);
                            $("#comittrue").hide();
                            $("#comitfalse").show();
                        }
                    })
                } else {
                    $("#msg").show();
                    $("#msg").html('提示：邮箱格式有误');
                    $("#comittrue").hide();
                    $("#comitfalse").show();
                }
            }
        });

        $("#comittrue").live("click", function() {


            var email = txt.getVal("#email");
            var nickname = txt.getVal("#nickname");
            var password = txt.getVal("#password");

            if (nickname == '') {
                $("#msg").show();
                $("#msg").html('提示：昵称不能为空');
                return false;
            }
            if (email == '') {
                $("#msg").show();
                $("#msg").html('提示：电子邮箱不能为空');
                return false;
            }
            if (password == '') {
                $("#msg").show();
                $("#msg").html('提示：密码不能为空');
                return false;
    
            }
            var url = "<?php echo $this->createUrl("front/AjaxRegister"); ?>";
            $.post(url, {nickname: nickname, email: email, password: password}, function(d) {
                if (d == 'ok') {
                    location.href = "<?php echo $this->createUrl("user/ActiveMsg"); ?>";
                }
            });
        });
    });
</script>

<div class="login">
    <div class="logo"></div>
    <p class="tagline">曾经在这里埋下了一颗种子,如今它已经开花结果,人生就是要懂得分享.</p>
    <p class="started">开始吧- 已经有 3000 花草爱好者</p>
    <p class="twominutes">注册不费时只需要1分钟哟.</p>
    <p class="msg" id="msg"></p>
    <div class="signupform">
        <div class="signup">
            <form action="/register" id="signup_homepage" method="post" onsubmit="return false">
                <div style="display: none;"><input type="hidden" id="_authentication_token" name="_authentication_token" value="154893600809731969963739256413698098446"></div>
                <fieldset class="nickname name">
                    <label class="label" for="first_name">昵称</label>
                    <input type="text" name="first_name" id="nickname" class="text first_name" value="" xplaceholder="First name" maxlength="32">
                </fieldset>

                <fieldset class="password name">
                    <label class="label" for="first_name">密码</label>
                    <input type="password" name="first_name" id="password" class="text first_name" value="" xplaceholder="First name" maxlength="32">
                </fieldset>

                <fieldset class="email">
                    <label class="label" for="email">电子邮箱</label>
                    <input type="text" name="email" id="email" class="text email" value="" maxlength="254" xplaceholder="Your email address">
                </fieldset>
                <input type="hidden" value="homepage" name="location">
                <div class="buttons">
                    <input type="button" value="注 册" class="blue-button" id="comittrue">
                    <input type="button" value="注 册" class="blue-button dsnone" id="comitfalse">
                    <a href="<?php echo $this->createUrl('/login'); ?>" class="login_txt">已有账号？直接登录</a>
                </div>
            </form>
        </div>
    </div>

</div>