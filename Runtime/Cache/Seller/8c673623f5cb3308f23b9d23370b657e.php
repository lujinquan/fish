<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php $shoname = D('Home/Front')->get_config_by_name('shoname'); ?>
        <title><?php echo $shoname; ?></title>
        <link rel="shortcut icon" href="" />
        <link href="/static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
        <link href="/static/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
        <link href="/static/css/animate.css" rel="stylesheet">
        <link href="/static/css/v3.css?v=4.1.0" rel="stylesheet">
        <link href="/static/css/common_v3.css?v=2.0.0" rel="stylesheet">
		
        <link href="/static/css/snailfish.css?v=2.0.0" rel="stylesheet">
        <link href="/static/css/weizan.common.css" rel="stylesheet">
		
		
        <link rel="stylesheet" type="text/css" href="/static/fonts/v3/iconfont.css?v=2016070717">
        <link rel="stylesheet" type="text/css" href="/static/fonts/iconfont.css?v=2016070717">
		 <link rel="stylesheet" type="text/css" href="/static/css/p_login.css">
        <script src="/static/fonts/iconfont.js"></script>

        <script src="/web/resource/js/lib/jquery-1.11.1.min.js"></script>
        <script src="/static/js/dist/jquery/jquery.gcjs.js"></script>
        <script src="/web/resource/js/app/util.js"></script>


        <script type="text/javascript">
            window.sysinfo = {
				siteroot : '/'
            };
        </script>

        <script type="text/javascript" src="/web/resource/js/lib/bootstrap.min.js"></script>
        <script type="text/javascript" src="/web/resource/js/app/common.min.js?v=20170802"></script>
        
        <script src="/static/js/require.js"></script>

        <script src="/web/resource/js/app/config.js"></script>
     

        <script>
            require.config({
                waitSeconds: 0
            });
        </script>
        <script src="/static/js/myconfig.js"></script>
        <script type="text/javascript">
                if (navigator.appName == 'Microsoft Internet Explorer') {
                    if (navigator.userAgent.indexOf("MSIE 5.0") > 0 || navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0) {
                        alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
                    }
                }
                myrequire.path = "/static/js/";

            function preview_html(txt)
            {
                var win = window.open("", "win", "width=300,height=600"); // a window object
                win.document.open("text/html", "replace");
                win.document.write($(txt).val());
                win.document.close();
            }
        </script>
    

    <body>


<div class="wrapper page-login">

	<div class="container">
		<h1>供应商管理平台</h1>
		<form class="form form-login form-horizontal form-validate" enctype="multipart/form-data" action="<?php echo U('supply/login_do');?>" method="post">
			<input type="text" placeholder="请输入登录账号" name="mobile">
			<input type="password" placeholder="请输入登录密码" name="password">
			<input type="submit" name="submit" value="登录">
		</form>
	</div>
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>

<script type="text/javascript">
var s_url ="<?php echo U('supply/login_do');?>";

$(function(){

	$('.form-login').submit(function(){
		var mobile = $.trim($(':text[name="mobile"]').val());
		if(!mobile) {
			alert('账户不能为空');
			return false;
		}
		var password = $.trim($('input[name="password"]').val());
		if(!password) {
			alert('密码不能为空');
			return false;
		}
		$.ajax({
			url: s_url,
			type:'post',
			data:{mobile:mobile, password:password},
			dataType:'json',
			success:function(ret){
				if(ret.code == 1)
				{
					alert(ret.msg);
					return false;
				}else if(ret.code == 0){
					location.href = ret.url;
					return false;
				}
			}
		})
		
		return false;
	});
});
</script>