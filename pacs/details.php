<!DOCTYPE html>
<html>
<head>
	<title>详细信息</title>
	<link rel="stylesheet" type="text/css" href="./static/bootstrap.min.css">
	<style type="text/css">
		div{border: 1px solid rgb(227,227,227);}
		body{max-width: 1366px;
             /*height:768*/
	         text-align: center;
	         font-size: 15px;
			 margin: 0 auto;}
	</style>
</head>
	<body>
		<div  style="min-height: 768px;">
			<h1>详细信息</h1>
			<div class="row">
			    <div class="col-md-10">
			    	<?php require("conn.php");
					    if(isset($_GET["imgID"])){
					    	$imgID = $_GET["imgID"];
					    	$sql = "SELECT * from fundus where id = $imgID";
                            $data = $conn->query($sql);
                            if($data->num_rows > 0){
							    while($arr = $data->fetch_assoc()){
								    $res[] = $arr;
							    }
							}
							$imgFullPath = $res[0]["ImageAddress"].$res[0]["ImageName"]; 
							echo $imgFullPath;
							?>
							<div class="col-md-12">
                                <img src="<?php echo $imgFullPath;?>" style="width: 100%;">
                            </div>
							<?
					    }else{
					    	echo "加载失败，请返回上一级页面刷新重试！";
					    }
			        ?>
			    </div>
		    </div>
        </div>
	</body>
</html>
