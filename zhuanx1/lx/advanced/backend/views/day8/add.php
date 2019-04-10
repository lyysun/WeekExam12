<?php 
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="<?=Url::to(['day8/add'])?>" method="post">

       <div id="div1">
        <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
    </div>
    <textarea id="text1" name="content" style="width:100%; height:200px;"></textarea>


	<input type="submit" value="提交">
</form>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="js/wangEditor.js"></script>
<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#div1')
    var $text1 = $('#text1')
    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        $text1.val(html)
    }
    editor.create()
    // 初始化 textarea 的值
    $text1.val(editor.txt.html())
</script>	
</body>
</html>