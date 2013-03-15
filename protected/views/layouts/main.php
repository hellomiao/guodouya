<!DOCTYPE html>
<html>
<head>
    <meta http-equiv=Content-Type content="text/html;charset=utf-8"/>
    <title>果豆芽</title>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <![endif]-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/pic.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css"    rel="stylesheet"/>
    <link href="css/bootstrap.css"    rel="stylesheet"/>
    <link href="css/bootstrap-responsive.css"    rel="stylesheet"/>
    <script>
        $(function(){
            $('#plant-list li a').popover({trigger:'hover'})
        })
    </script>
</head>
<body>
<header class="nav-header header">
    <div class="inner">
        <h3><a class="logo" href>果豆芽</a></h3>
        <form class="form-search" >
            <input type="text" class="input-large" placeholder="搜索植物"/>
            <input type="button" class="icon-search"/>   </form>
        <ul class="nav nav-pills">
            <li class=""><a href="#">首页</a></li>
            <li class="sign">/</li>
            <li class="active"><a href="#">花堡</a></li>
            <li class="sign">/</li>
            <li class=""><a href="#">创意</a></li>
        </ul>
        <div class="info pull-right"><img src="img/1.jpg" class="picture img-rounded"/>
            <ul class="nav1">

                <li class="dropdown"> <a class="dropdown-toggle" id="drop4" role="button" data-toggle="dropdown" href="#">我叫喵二狗
                    <b class="caret"></b></a>

                    <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">设置</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">我的花架</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">提醒</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">注销</a></li>
                    </ul>
                </li>
                <li id="msgblock"><a href="" class="msg">12</a></li>
            </ul>


        </div>
    </div>
</header>
    
    
    <?php echo $content;?>
    
    <footer class="footer">
    <div class="footer_bottom">
        <div class="wrap">
            <div class="container">
                <div class="row">
                    <div class="span5">
                        <div class="foot_logo"><a href="index.html"><img src="img/footer.png" alt=""></a></div>
                        <div class="copyright">© 2020 果豆芽版权所有</div>
                    </div>
                    <div class="span7">
                        <div class="foot_right_block">


                            <div class="clear"></div>

                            <div class="clear"></div>
                            <div class="foot_menu">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html">关于果豆芽</a></li>
                                    <li><a href="about.html">隐私条款</a></li>
                                    <li><a href="about.html">联系我们</a></li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>