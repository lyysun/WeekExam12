<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 基本表单</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css?v=4.1.0" rel="stylesheet">

</head>
<div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="<?=Url::to(['text/add'])?>"  role="form" method="post">
                                    <div class="form-group">
                                        <label>商品</label>
                                        <input type="text" name="name" placeholder="请输入您商品" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>价钱</label>
                                        <input type="text" name="num" placeholder="请输入价钱" class="form-control">
                                    </div>
                                      <div id="div1">
                                            <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
                                        </div>
                                        <textarea id="text1" name="content" style="width:100%; height:200px;"></textarea>





                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>购买</strong>
                                        </button>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</body>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="js/wangEditor.js"></script>
<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#div1')
    var $text1 = $('#text1')
    editor.customConfig.onchange = function (text) {
    // 监控变化，同步更新到 textarea
    $text1.val(text)
    }
    editor.create()
    // 初始化 textarea 的值
    $text1.val(editor.txt.text())
</script>
</html>