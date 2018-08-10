<!DOCTYPE html>
<html>
	<head>
		<title>登录</title>
		<link rel="stylesheet" type="text/css" href="./static/bootstrap.min.css">
		<style type="text/css">
	    body{max-width: 1500px;
	         text-align: center;
	         font-size: 15px;
			 margin: 0 auto;}
		</style>
		<script type="text/javascript">
			window.onload = function(){
				var oForm = document.getElementById("form");
				    oForm.onsubmit = function(){
					    var oInput1 = document.getElementById("account");
					    var reg = /^[0-9]*$/ ;
					    if(!reg.test(oInput1.value)){
					    	alert("请输入正确的账号！");
					        return false;
	                    }
				    }
			} 
		</script>
	</head>
	<body class="well">
		<div style="background: rgb(103,174,201);min-height: 750px;">
			<nav class="navbar navbar-default" role="navigation">
			    <div class="container-fluid">
				    <div class="navbar-header" style="margin: 0 auto;">
				        <a class="navbar-brand" href="#" style="color: black;font-size: 30px;">
				        江西省眼科专科联盟远程阅片中心</a>
				    </div>
				</div>    
			</nav>

			<div style="margin: 20% auto;width:40%;">
				<form class="bs-example bs-example-form" role="form" method="post" action="" id="form">
					<div class="input-group">
						<span class="input-group-addon">账号:</span>
						<input type="text" class="form-control" placeholder="请输入账号" name="account" id="account">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon">密码:</span>
						<input type="password" class="form-control" placeholder="请输入密码" name="password" id="password">
					</div>
					<br>
					<p align="center">
						<button type="submit" class="btn btn-default" name="sub">登录</button>
					</p>

				</form>
			</div>
		</div>
	</body>
</html>

<?php
require('conn.php');
if(isset($_POST['sub']))
{	$account   = $_POST['account'];
    $password  = $_POST['password'];
        $being = $conn->query("SELECT * from user where account=$account");
        $res   = $being->fetch_assoc();
        if($res){
        	if($res["password"] == $password){
	        	setcookie('name',$res["name"]);
	        	echo"<script>
	        	     alert('登录成功！即将前往用户界面');
	        	     window.location.href='user.php';
	        	     </script>";
            }else{
                echo"<script>alert('密码错误，请重新输入！');</script>";
            }
        }else{
        	echo"<script>alert('账号错误，请重新输入！');</script>";
        }

}
?>