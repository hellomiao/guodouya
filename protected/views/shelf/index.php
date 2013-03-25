<script>
    $(function() {
        $("#guest_go").click(function() {
            var content = $("#guest_content").val();
            var sid = <?php echo $shelf->ID; ?>;
            var pid = 0;
            var url = "/shelf/AjaxAddGuestBook";
            $(this).text("传送中...");
            $(this).addClass('blueactive');
            var that = this;
            $.post(url, {sid: sid, pid: pid, content: content}, function(d) {
                if (d){
                $.get("/shelf/ajaxGuestBookList/type/one", function(dt) {
                    $("#guest_content").val('');
                    $("#guestBookList").prepend(dt);
                    $("#glist"+d).slideDown();
                    $(that).text ("留 言");
                    $(that).removeClass('blueactive');
                });
                }
            });
            return false;
        });

        $.get("/shelf/ajaxGuestBookList", function(d) {
            $("#guestBookList").html(d);
        });
    })
</script>
<div id="content" class="container">

    <div class="container-fluid">

        <div class="row-fluid">
            <div class="span2 plant-left">
                <img src="<?php echo $picture; ?>" class="img-rounded img-polaroid"/>
                <h6 class="text-center"><?php echo $user->NickName; ?></h6>
                <p class="text-center"><a href="" class="red-button">♥ 喜欢</a> <span class="fontgreen">123</span></p>
                <p class="muted">他们也喜欢...</p>

                <ul  class="leftpic-list planted">
                    <li><a href=""><img src="./img/a1.jpg" class="picture"></a></li>
                    <li><a href=""><img src="./img/a2.jpg" class="picture"></a></li>
                    <li><a href=""><img src="./img/a3.jpg" class="picture"></a></li>
                    <li><a href=""><img src="./img/a4.jpg" class="picture"></a></li>
                    <li><a href=""><img src="./img/a5.jpg" class="picture"></a></li>
                    <li><a href=""><img src="./img/a6.jpg" class="picture"></a></li>
                    <li><a href=""><img src="./img/a7.jpg" class="picture"></a></li>
                    <li><a href=""><img src="./img/a8.jpg" class="picture"></a></li>
                    <li><a href=""><img src="./img/a9.jpg" class="picture"></a></li>
                </ul>

            </div>

            <div class="span9 plant-right">
                <div class="text-center plant-header">
                    <h3><?php echo $shelf->Name; ?></h3>
                    <?php echo $shelf->Info; ?>
                </div>

                <div class="media-list">
                    <ul class="photo-list  clearfix" id="plant-list">
                        <li><a href=""
                               data-original-title="多肉 ♥" data-content="有种子哟"  data-placement="top" data-toggle="popover">
                                <img src="img/01.jpg"  style="opacity: 1; width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>

                        <li><a href=""
                               data-original-title="多肉" data-content="我什么都不是啊"  data-placement="top" data-toggle="popover"
                               >
                                <img src="img/02.jpg"  style="opacity: 1; width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>

                            </a></li>

                        <li><a href="">
                                <img src="img/03.jpg"  style="opacity: 1;  width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>

                        <li><a href="">
                                <img src="img/04.jpg"  style="opacity: 1; width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>

                        <li><a href="">
                                <img src="img/05.jpg"  style="opacity: 1;  width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>

                        <li><a href="">
                                <img src="img/06.jpg"  style="opacity: 1;  width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>

                        <li><a href=""
                               data-original-title="多肉" data-content="我什么都不是啊"  data-placement="top" data-toggle="popover"
                               >
                                <img src="img/07.jpg"  style="opacity: 1;  width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>

                            </a></li>

                        <li><a href="">
                                <img src="img/08.jpg"  style="opacity: 1;  width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>

                        <li><a href="">
                                <img src="img/09.jpg"  style="opacity: 1;  width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>
                        <li><a href="">
                                <img src="img/10.jpg"  style="opacity: 1;  width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>
                        <li><a href="">
                                <img src="img/11.jpg"  style="opacity: 1;  width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>
                        <li><a href="">
                                <img src="img/12.jpg"  style="opacity: 1;  width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>

                        <li><a href="">
                                <img src="img/13.jpg"  style="opacity: 1;  width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>
                        <li><a href="">
                                <img src="img/12.jpg"  style="opacity: 1;  width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>

                        <li><a href="">
                                <img src="img/13.jpg"  style="opacity: 1;  width: 130px; height: 117px; margin-left: 0px; margin-top: 0px;"/>
                            </a></li>


                    </ul>
                </div>

                <div class="comments">
                    <p class="lead"><img src="img/icon-title.png" />留言板(<?php echo $bookCount;?>)</p>
                    <div class="comment-box" style="width: 98%;">
                        <textarea  cols="60" style="width: 98%;" id="guest_content"></textarea>
                        <a class="blue-button pull-right" href="#" id="guest_go">留 言</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="list" >
                        <ul id="guestBookList">

                            <ul>

                                </div>


                        
                                </div>

                                </div>
                                </div>
                                </div>

                                </div>

