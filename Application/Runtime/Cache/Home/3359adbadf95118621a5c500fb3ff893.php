<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>注册页面</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="/api49/Public/Admin/css/admin-login.css" />
<script type="text/javascript" src="/api49/Public/js/jquery.min.js"></script>
<script type="text/javascript">
    var userAgent = navigator.userAgent, // userAgent
    rMsie = /.*(msie) ([\w.]+).*/, // ie
    rFirefox = /.*(firefox)\/([\w.]+).*/, // firefox
    rOpera = /(opera).+version\/([\w.]+)/, // opera
    rChrome = /.*(chrome)\/([\w.]+).*/, // chrome
    rSafari = /.*version\/([\w.]+).*(safari).*/;// safari
    jMeteor={};
    jMeteor.browser = {};
    var ua = userAgent.toLowerCase();
    function uaMatch(ua) {
      var match = rMsie.exec(ua);
      if (match != null) {
        return { browser : match[1] || "", version : match[2] || "0" };
      }
      var match = rFirefox.exec(ua);
      if (match != null) {
        return { browser : match[1] || "", version : match[2] || "0" };
      }
      var match = rOpera.exec(ua);
      if (match != null) {
        return { browser : match[1] || "", version : match[2] || "0" };
      }
      var match = rChrome.exec(ua);
      if (match != null) {
        return { browser : match[1] || "", version : match[2] || "0" };
      }
      var match = rSafari.exec(ua);
      if (match != null) {
        return { browser : match[2] || "", version : match[1] || "0" };
      }
      if (match != null) {
        return { browser : "", version : "0" };
      }
    }
    var browserMatch = uaMatch(userAgent.toLowerCase());
    if (browserMatch.browser) {
      jMeteor.browser[browserMatch.browser] = true;
      jMeteor.browserName = browserMatch.browser;
      jMeteor.browser.version = browserMatch.version;
      jMeteor.browser.language = (navigator.language ? navigator.language
          : navigator.userLanguage || "");
    }
    if(jMeteor.browser.msie && jMeteor.browser.version <20){
      location="<?php echo U('Admin/Login/brower');?>";
    }
    </script>
<script>
// var count = 0;
// var blur = 0;
// function loginok(form){
//   var check = true;
//     if (form.verify.value==""){
//     $('#verify').addClass('wrong');
//     //alert("验证码不能为空！");
//     form.verify.focus();
//     check = false;

//     //return (false);
//   }



//   if (form.login_pwd.value==""){
//     //alert("密码不能为空！");
//     $('#login_pwd').addClass('wrong');
//     form.login_pwd.focus();
//     check = false;

//     //return (false);
//   }

//     if (form.login_name.value==""){
//     //alert("用户名不能为空！");
//     form.login_name.focus();
//     $('#login_name').addClass('wrong');
//     check = false;
//     //return (false);
//   }
//   if (!check) {
//     if (++count >= 2) {
//       // do something evil
//       $('html')[0].style.webkitFilter = 'blur(' + blur + 'px)';
//       blur++;
//     }
//   }
//   return check;
// }

// $(function() {
//   $('form').on('webkitAnimationEnd animationend', function(event) {
//     $('input').each(function() {
//       $(this).removeClass('wrong');
//     });
//   });

// if(self!=top){
//   top.location=self.location;
// }
// });

</script>
</head>
<body>
<div id="popover" style="display: none;">
  <p>heihei</p>
</div>

<div class="container">
  <h2>一起努力，我们的不平凡！</h2>
  <form action="<?php echo U('Home/User/register');?>" method="post" name="cms" onSubmit="return loginok(this)">
    <div class="form-control">
      <label for="login_name">用户名</label>
      <input type="text" name="username" id="login_name" placeholder="用户名"/>
    </div>

    <div class="form-control">
      <label for="login_pwd">密码</label>
      <input type="password" name="password" id="login_pwd" placeholder="密码"/>
    </div>

    <div class="form-control">
      <label for="mail">邮箱</label>
      <input type="text" name="mail" placeholder="邮箱地址"/>
    </div>

    <!-- <div class="form-control verify">
      <label for="verify">验证码</label>
      <input type="text" name="verify" id="verify" placeholder="验证码"/>
      <img id="verifyImg" SRC="<?php echo U('Admin/Public/verify');?>"
      onclick='this.src=this.src+"&"+Math.random()' BORDER="0" ALT="点击刷新验证码" style="cursor:pointer" align="absmiddle">
    </div> -->
    <button type="submit">
      注册
    </button>
  </form>
  <div class="copyright">
    Powered by <a href="http://www.itcast.cn" target="_blank">itcast&nbsp;</a>&nbsp;Copyright&nbsp;&copy;2016
  </div>
</div>
</body>
</html>