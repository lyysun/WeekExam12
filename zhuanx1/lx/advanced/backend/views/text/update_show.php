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
                                <form action="<?=Url::to(['text/update_do'])?>"  role="form" method="post">
                                <input type="hidden" name="id" value="<?php echo $id?>">
                                    <div class="form-group">
                                        <label>商品</label>
                                        <input type="text" name="name" value="<?php echo $name?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>价钱</label>
                                        <input type="text" name="num" value="<?php echo $num?>" class="form-control">
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>修改</strong>
                                        </button>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</body>
</html>