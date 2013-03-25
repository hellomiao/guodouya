  
<?php foreach ($models as $key => $val) { ?>
    <?php $user = User::model()->findByPk($val->UserId);
    $picture = $user->getPicture($val->UserId); ?>
    <li <?php if ($type == 'one') { ?>style="display:none"<?php } ?> id="glist<?php echo $val->ID; ?>"><span class="span1"><a href=""><img src="<?php echo $picture; ?>" class="img-rounded"/></a></span>
        <div class="span10">
            <span class="span12"><a href=""><?php echo $user->NickName; ?></a> <spna class="time"> <?php echo Utils::tranTime($val->CreateTime); ?></spna>

            </span>
            <div class="span10 content"> <?php echo $val->Content; ?></div>
            <div class="span10 reply"><a href="">回复(1)</a> | <a href="">删除</a></div>

        </div>
    </li>
<?php } ?>

<?php if ($type != 'one') { ?>
    <div class="pagers">
    <?php
    $this->widget('CLinkPager', array(
        'pages' => $pages,
        'header' => '',
        'firstPageLabel'=>'首页',
        'prevPageLabel'=>'上一页',
        'nextPageLabel'=>'下一页',
        'lastPageLabel'=>'尾页',
    ));
    ?> 
    </div>
<? } ?>

<script>
    $(function() {
        $('.yiiPager a').live('click', function() {

            $.ajax({
                url: $(this).attr('href'),
                success: function(html) {

                    $("#guestBookList").html(html);

                }

            });

            return  false;

        });
    })
</script>