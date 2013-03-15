<style>
    #contain {margin: 0 auto; width: 200px;}
</style>
<?php  echo $this->createUrl('plant/add'); ?>
<div id="contain">
    <form action="<?php echo $this->createUrl('plant/add'); ?>" method="post">
        <input name="addForm[Name]" type="text" placeholder="植物名称"><br/>
        <input name="addForm[Tags]" type="text" placeholder="标签用，隔开"><br/>
        <input name="addForm[Info]" type="textarea" placeholder="简介">
        <input type="submit" value="提交">
    </form>
</div>