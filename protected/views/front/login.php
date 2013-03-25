<script>
    $(function() {
        $("#email").blur(function() {
            var email = $(this).val();
            var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
            if (!myreg.test(email))
            {
                $("#msg").show();
                $("#msg").html('提示：请输入有效的电子邮箱！');
                $(this).focus();
                $("#comittrue").hide();
                $("#comitfalse").show();
            }
        });

        $("#comittrue").click(function() {
            var LoginForm = {};
            LoginForm['Email'] = $("#email").val();
            LoginForm['PassWord'] = $("#password").val();
            var url = "/front/AjaxLogin";
            $(this).attr("value", "登录中...");
            $(this).addClass('blueactive');
            var that = this;
            $.post(url, {LoginForm: LoginForm}, function(d) {
                if (d == 'ok') {
                    alert('登录成功');
                } else {
                    $("#msg").show();
                    $("#msg").html('提示：邮箱或者密码错误！');
                    $(that).attr("value", "登 录");
                    $(that).removeClass('blueactive');
                }
            });
        });
    })
</script>
<div class="login">
    <div class="logo"></div>
    <p class="tagline">曾经在这里埋下了一颗种子,如今它已经开花结果,人生就是要懂得分享.</p>
    <p class="started">登录- 已经有 3000 花草爱好者</p>
    <p class="msg" id="msg"></p>
    <div class="signupform">
        <div class="signup">
            <form action="/register" id="signup_homepage" method="post" onsubmit="return false">


                <fieldset class="email">
                    <label class="label" for="email">电子邮箱</label>
                    <input type="text" name="email" id="email" class="text email" value="" maxlength="254" xplaceholder="Your email address">
                </fieldset>

                <fieldset class="email">
                    <label class="label" for="first_name">密码</label>
                    <input type="password" name="first_name" id="password" class="text first_name" value="" xplaceholder="First name" maxlength="254">
                </fieldset>


                <input type="hidden" value="homepage" name="location">
                <div class="buttons">
                    <input type="button" value="登 录" class="blue-button" id="comittrue">
                    <input type="button" value="登 录" id="comitfalse" class="blue-button dsnone"><a href="./" class="login_txt">没有账号？立刻注册</a>
                </div>
            </form>
        </div>
    </div>

</div>