var API_URL="http://127.0.0.1/zhuanx2.5/lx/3.27/api/";//定义的后台验证链接
var TOKEN="123";//定义的token
document.write('<script type="text/javascript" src="ksort.js"></script>');
document.write('<script type="text/javascript" src="md5.js"></script>');


function sendAjax(url,type,params,callback){
	var p= sign(params); //调用sign方法 获取加密的sign
	$.ajax({
		url:API_URL+url,
		type:type,
		data:p,
		dataType:"json",
		success:function(e){
			callback(e); //返回值
		}
	})

}

function sign(params){
    //定义发送参数的json数组
    var _params={};
    //定义加密的参数json数组
    var _mparams={};
    //定义签名
    var sign={};

    //没有参数的情况下
    if(params.length==0){
    	sign = $.md5(TOKEN);//加密token
    	_params.sign=sign;//{sign: "e344b8c13c5c52eb8fecd183417b77ba"}
       return _params;

    }

    //去掉空值
    $.each(params,function(k,v){
         
          if(v!=''){
          	_mparams[k]=v; //获取到没有空值  按字段存放值 {bbb: "hello", page: 1}
          	
          }
    })


    //字碘性排序
    _mparams=ksort(_mparams);


    //转换成a=b&c=d
    var s=[];
    $.each(_mparams,function(k,v) {
        var d=k+'='+v;
        s.push(d);//循环放进数组

    })
     var v=s.join("&");//bbb=hello&page=1
    sign = $.md5(v+TOKEN);//数据加密

    _mparams.sign=sign; //{bbb: "hello", page: 1,sign: "e344b8c13c5c52eb8fecd183417b77ba"}
  
     return _mparams;


}

