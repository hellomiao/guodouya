<div class="login">
<div class="logo"></div>
<p class="tagline">曾经在这里埋下了一颗种子,如今它已经开花结果,人生就是要懂得分享.</p>
<p class="started">开始吧- 已经有 3000 花草爱好者</p>
<p class="twominutes">注册不费时只需要1分钟哟.</p>
<div class="signupform">
<div class="signup">
<form action="/register" id="signup_homepage" method="post" onsubmit="return false">
<div style="display: none;"><input type="hidden" id="_authentication_token" name="_authentication_token" value="154893600809731969963739256413698098446"></div>
<fieldset class="nickname name">
	<label class="label" for="first_name">昵称</label>
	<input type="text" name="first_name" id="first_name" class="text first_name" value="" xplaceholder="First name" maxlength="32">
</fieldset>

<fieldset class="password name">
	<label class="label" for="first_name">密码</label>
	<input type="text" name="first_name" id="first_name" class="text first_name" value="" xplaceholder="First name" maxlength="32">
</fieldset>

<fieldset class="email">
	<label class="label" for="email">电子邮箱</label>
	<input type="text" name="email" id="email" class="text email" value="" maxlength="254" xplaceholder="Your email address">
</fieldset>
<input type="hidden" value="homepage" name="location">
<div class="buttons">
    <input type="button" value="注 册" class="blue-button"> <a href="<?php echo $this->createUrl('/login');?>" class="login_txt">已有账号？直接登录</a>
</div>
</form>
</div>
			</div>

</div>