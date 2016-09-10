<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-reg.css" />
<title>移动办公自动化系统</title>
</head>

<body>
<div class="title"><h2>信息登记</h2></div>
<form action="/index.php/Admin/Dept/addOK" method="post">
	<div class="main">
	    <p class="short-input ue-clear">
	    	<label>部门名称：</label>
	        <input type="text" name="bumenmingchen" placeholder="部门名称" />
	    </p>
	    <div class="short-input select ue-clear">
	    	<label>上级部门：</label>
	        <div class="select-wrap">
	        	<select name="pid">
	                <option value="0">顶级部门</option>
	            </select>
	        </div>
	    </div>
	    <p class="short-input ue-clear">
	    	<label>排序：</label>
	        <input type="text" name="paixu" placeholder="排序" />
	    </p>
	    <p class="short-input ue-clear">
	    	<label>备注：</label>
	        <textarea placeholder="备注" name="beizhu"></textarea>
	    </p>
	</div>
	<div class="btn ue-clear">
		<a href="javascript:;" class="confirm">确定</a>
	    <a href="javascript:;" class="clear">清空内容</a>
	</div>
</form>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript">
$(".select-title").on("click",function(){
	$(".select-list").toggle();
	return false;
});
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(".select-title").find("span").text(txt);
});



showRemind('input[type=text], textarea','placeholder');

//jQuery 代码
$(function(){
	//给确定按钮添加点击事件
	$('.confirm').on('click',function(){
		//事件的处理程序
		$('form').submit();
	});
	//给清空按钮添加点击事件
	$('.clear').on('click',function(){
		//事件的处理的程序
		$('form')[0].reset();
	});
});

</script>
</html>