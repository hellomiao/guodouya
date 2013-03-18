<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; Twitter Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

     <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css"    rel="stylesheet"/>
     <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common.css"    rel="stylesheet"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css"    rel="stylesheet"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css"    rel="stylesheet"/>
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>

  </head>

  <body>

    <div class="container">

      <form class="form-signin">
        <h2 class="form-signin-heading">果豆芽后台管理系统</h2>
        <input type="text" class="input-block-level" placeholder="用户名">
        <input type="password" class="input-block-level" placeholder="密码">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> 记住我
        </label>
        <button class="blue-button" type="submit">登 录</button>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript


  </body>
</html>
