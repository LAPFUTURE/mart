<?php session_start();?>
<!DOCTYPE html>
<html>
<head> 
	<title>用户中心</title>
	<link rel="stylesheet" type="text/css" href="./static/bootstrap.min.css">
	<style type="text/css">
	*{border: 1px solid rgb(227,227,227);}
		body{max-width: 1720px;
	         text-align: center;
	         font-size: 15px;
			 margin: 0 auto;}
	    th{text-align: center;}
	    .td_class{
	    	font-weight: bold;
            color:black;
            height:39px; 
            border: 1px solid rgb(227,227,227);
        }/*为新增的td添加样式*/
        .td_fundns_class{
	    	font-weight: bold;
            color:black;
            height:39px; 
            border: 1px solid rgb(227,227,227);
        }/*为新增的眼底表格td添加样式*/

/*点击放大效果*/
#real{
  /*点击弹出模态框的图片*/
  margin: 30px;
  width: 250px;
  border-radius:6px;
  opacity: 0.9;
 }
 #real:hover{
  opacity: 1;
 }
 #mo{
  display: none;/*隐藏*/
  width: 100%;
  height: 100%;
  position: fixed;
  overflow: auto;
  background-color: rgba(0,0,0,0.7);
  top: 0px;
  left: 0px;
  z-index: 1;
 }
 #moimg{
  display: block;
  margin:25px auto;
  width: 60%;
  max-width: 1720px;
 }
 #moimg{
  -webkit-animation: first 1s;
  -o-animation: first 1s;
  animation: first 1s;
 }
 @keyframes first{
  from{transform: scale(0.1);}
  to{transform: scale(1);}
 }
 .close{
  font-size: 40px;
  font-weight: bold;
  position: absolute;
  top: 20px;
  right: 14%;
  color:#f1f1f1;
 }
 .close:hover,
 .close:focus{
  color:black;
  cursor:pointer;
 }
/* @media only screen and(max-width:750px ) {
  #moimg{
   width: 100%;
  }
 }*/
	</style> 
	<script type="text/javascript" src="./static/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
		let buttonclick = function(ev){//点击日期表的ID按钮
			let patientId= ev.currentTarget.innerHTML;

			let tabofpatient = document.getElementById('tabofpatient');//获取患者信息表格
			let taboffundus  = document.getElementById('taboffundus');//获取眼底信息表格
			let tabofresult  = document.getElementById('tabofresult');//获取诊疗结果表单

                for (let i = tabofpatient.childNodes.length-1;i>=4;i--) {
                	tabofpatient.removeChild(tabofpatient.childNodes[i]);
                }//删除之前添加的tabofpatient的列

                for (let i = taboffundus.childNodes.length-1;i>=4;i--) {
                	taboffundus.removeChild(taboffundus.childNodes[i]);
                }//删除之前添加的taboffundus的列
                
                for (let i = tabofresult.childNodes.length-1;i>=3;i--) {
                	    tabofresult.removeChild(tabofresult.childNodes[i]);
                    }//删除之前添加的tabofresult的列，这里的循环条件是i>=3,删除两次，另一次在后面点击影像ID

              $.ajax({
			            type: "POST",
			            url: "http://localhost/pacs/info_patient_fundus.php",
			            data: {'patientID':patientId},
			            success: function(data)
			            {  
			            	let res = JSON.parse(data);//返回的数据类型为string，要转为对象
			            	alert(res.message);
                            let arr = Object.values(res.dataofpatient);//将值加入到数字arr来获取数组长度
                            let oTr = document.createElement('tr');
                            for(let i=0;i<arr.length;i++){
							    tabofpatient.appendChild(oTr);
							    var oTd=document.createElement('td');//创建节点
							    oTd.setAttribute("class","td_class");
					            oTd.innerHTML=arr[i];//给表格赋内容
					            oTr.appendChild(oTd);//加入到tr
                            }//患者表格信息
                            
                            for(let i=0;i<res.dataoffundus.length;i++){
                                let arr = Object.values(res.dataoffundus[i]);//后台返回的完整的眼底信息
                                let arrs = [arr[0],arr[11],arr[4],arr[8],arr[7],arr[9]];//前台展示眼底信息
                                let oTr = document.createElement('tr');    
                                for(let i=0;i<arrs.length;i++){
								    taboffundus.appendChild(oTr);
								    var oTd=document.createElement('td');//创建节点
								    oTd.setAttribute("class","td_fundns_class");
						            oTd.innerHTML=arrs[i];//给表格赋内容
						            oTr.appendChild(oTd);//加入到tr
                                }//眼底表格信息
                            }
			            }, 	
			            error:function(jqXHR, textStatus, errorThrown){
			            	console.log("jqXHR.responseText",jqXHR.responseText);
			            	console.log("jqXHR.status",jqXHR.status);
			            	console.log("jqXHR.readyState",jqXHR.readyState);
				            }
				    })
		}//为两个表格添加tr,td
        
        
        
        let fundusonclick = function(ev){//点击眼底信息的影像ID
                                for (let i = tabofresult.childNodes.length-1;i>=3;i--) {
                	                tabofresult.removeChild(tabofresult.childNodes[i]);
                                }//删除之前添加的tabofresult的列，这里的循环条件是i>=3,跟之前的i>=4不同
                                
                                var reg = /^[0-9]*$/ ;
                                if(ev.target.tagName === 'TD' && reg.test(ev.target.innerHTML)){
                                   //判断点击的是否为td并且里面的内容是否为纯数字（影像ID）
                                   let imgID = ev.target.innerHTML;
                                   $.ajax({
							            type: "POST",
							            url: "http://localhost/pacs/img_result.php",
							            data: {'imgID':imgID},
							            success: function(data)
							            {   let res = JSON.parse(data);
							            	let arr = Object.values(res);
							            	let arrs = [
							            	            arr[3],//医生
							            	            arr[2],//日期
							            	            arr[0],//图像ID
							            	            arr[4],//结果
							            	            //arr[5]ImgageName
							            	           ];
							            	let oTr = document.createElement('tr');
							            	for(let i=0;i<arrs.length;i++){
                                                tabofresult.appendChild(oTr);
								                var oTd=document.createElement('td');//创建节点
								                oTd.setAttribute("class","td_fundns_class");
						                        oTd.innerHTML=arrs[i];//给表格赋内容
						                        oTr.appendChild(oTd);//加入到tr
							            	}
	                                    },
	                                   
                                    })

                                    // let imgfundus = document.getElementById('imgfundus');
                                    // console.log(imgfundus);
                                    // imgfundus.src = "../pacs/static/img/test1.png";
                                    // imgfundus.onclick = function(){
        	                           // alert("click");
                                    // } 
                                    
                                    let motai=document.getElementById('mo')
                                    let moimg=document.getElementById("moimg")
                                    let realimg=document.getElementById("real")
                                    realimg.onclick=function(){
                                     motai.style.display="block"
                                     moimg.src=this.src
                                    }
                                    var span=document.getElementById("close");
                                    span.onclick=function(){
                                     motai.style.display="none";
                                    }

                                }else{
                                	alert("请点击影像ID号！");
                                }
                            }
        
	</script>                              
</head>
<body class="well">
	<div  style="min-height: 800px; border: 1px solid rgb(227,227,227);">
		<nav class="navbar navbar-defaul" role="navigation">
		    <div class="container-fluid">
			    <div class="navbar-header">
			        <a class="navbar-brand" href="#" style="color: black;font-size: 30px;">
			        江西省眼科专科联盟远程阅片中心</a>
	            	<form class="navbar-form navbar-left" role="search" method="post" action="" id="submitsort" 
	            	      style="margin-left:180px;">
			            <div class="form-group" >
				            <input class="form-control" form="submitsort" name="sortbyname" id="sort" 
				                   placeholder="请输入姓名" 
				                    style="width:100px;">
			            </div>
			            <button type="submit" class="btn btn-success">查询</button>
	                </form>
	                 <div class="navbar-brand" href="#">
	            		<?php 
	            		if(isset($_SESSION["name"])){
	            		 	echo"--欢迎您，".$_SESSION["name"];
	            		}
	            		?>
	            	</div>
			    </div>
			    <form class="navbar-form navbar-right" method="post" action="" style="margin-right: 0px;">
		    	    <button type="submit" class="btn btn-danger" name="exit">退出登录</button>
                </form>
			</div>
		</nav>
	<div class="row container-fluid" style="margin:auto 0;">

		<div class="col-md-3" style="min-height: 600px;">
			<form class="navbar-form navbar-left" 
			      role="search" method="post" 
			      action="" id="sortbydate"
			      style="margin-left: 24%;">
	            <div class="form-group">
		            <input type="date" name="sortbydate" class="form-control">
		            <button type="submit" class="btn btn-success">查询</button>
	            </div>
	        </form>
			<div class="col-md-12" style="overflow-y: scroll;height: 600px;" >
				<table class="table table-bordered" >
						<thead>
							<tr>
								<th>ID</th>
								<th>姓名</th>
								<th>性别</th>
                               	<th>年龄</th>
							</tr>
						</thead>
						<tbody>
						    <?php require('conn.php');
								if(isset($_POST["sortbydate"])){//日期查询
                                    $sortbydate = $_POST["sortbydate"];
                                    $sort_StudyDate_Ymd = str_replace("-","",$sortbydate);
                                    $sql1 = "SELECT Patient_ID from fundus where StudyDate_Ymd = '$sort_StudyDate_Ymd' group by Patient_ID";
									$data1 = $conn->query($sql1);
									if($data1->num_rows > 0){
									    while($arr = $data1->fetch_assoc()){
										    $res1[] = $arr;//$res1表示同一个日期看病的人
									    }
									    for($i = 0;$i<count($res1);$i++){
                                            $sql2 = "SELECT * from patient where Patient_ID = '".$res1[$i]['Patient_ID']."'";
                                            $data2 = $conn->query($sql2);
	                                            if($data2->num_rows > 0){
		                                            while($arr = $data2->fetch_assoc()){
												    $res2[] = $arr;
											        } 
											    ?>  <tr>
												        <th>
												        	<form>
												        	<input type="hidden" name="" value="<?php echo $res1[$i]["Patient_ID"]?>">
												        	<button class="btn btn-sm btn-default">
												        	<?php echo $res2[$i]["PatientName"]?></th>
												            </buton>
												            </form>
	                                                    <th><?php if($res2[$i]["PatientSex"] == "F"){echo "女";}else{echo "男";}?>
	                                                    </th>        
	                                                    <th><?php $x = substr($res2[$i]["PatientBirthDate"],0,4);//病人出生年
	                                                              $y = substr(date("Y/m/d"),0,4);//今年
	                                                              echo $y-$x;?>
	                                                    </th>
	                                                    <th>
											    	    	<button class="btn btn-sm btn-default" onclick="buttonclick(event)"><?php echo $res1[$i]["Patient_ID"]?></button>
											    	    </th>

                                                    </tr>
											    <?
											    }else{
											    	echo '$data2为空';
											    }
									    }
								    }else{
									    echo "数据库无此日期的病人";
								    }
								}elseif(isset($_POST["sortbyname"])) {//姓名查询
									    require('conn.php');
									    $sortbyname = $_POST["sortbyname"];
									    $sql1 = "SELECT * from patient where PatientName = '$sortbyname'";
									    $data1 = $conn->query($sql1);
									    if($data1->num_rows > 0){
										    while($arr = $data1->fetch_assoc()){
											    $res1[] = $arr;//$res1为姓名为$sortbyname的所有人
											}
											for($i=0;$i<count($res1);$i++){
												?><tr>
													
											    	<th><?php echo $res1[$i]["PatientName"]; ?></th>
													<th><?php if($res1[$i]["PatientSex"] == "F"){echo "女";}else{echo "男";}?></th>
													<th><?php $x = substr($res1[$i]["PatientBirthDate"],0,4);//病人出生年
                                                              $y = substr(date("Y/m/d"),0,4);//今年
                                                              echo $y-$x;?>
                                                    </th>
                                                    <th>
										    	    	<button class="btn btn-sm btn-default" onclick="buttonclick(event)"><?php echo $res1[$i]["Patient_ID"]?></button>
											    	</th>
												    </tr>

												<?
											}
									    }else{
									    	echo "<script>alert('查无此人，请检查输入');</script>";
									    }

								}else{//默认今日显示
									require('conn.php');
									$sortbydate  = date("Y/m/d");
									$sort_StudyDate_Ymd = str_replace("/","",$sortbydate);
									//echo $sort_StudyDate_Ymd;
									$sql1 = "SELECT Patient_ID from fundus where StudyDate_Ymd = '$sort_StudyDate_Ymd' group by Patient_ID";
									$data1 = $conn->query($sql1);
									if($data1->num_rows > 0){
									    while($arr = $data1->fetch_assoc()){
										    $res1[] = $arr;//$res1表示同一个日期看病的人
									    }
									    for($i = 0;$i<count($res1);$i++){
                                            $sql2 = "SELECT * from patient where Patient_ID = '".$res1[$i]['Patient_ID']."'";
                                            $data2 = $conn->query($sql2);
	                                            if($data2->num_rows > 0){
		                                            while($arr = $data2->fetch_assoc()){
												    $res2[] = $arr;
											        } 
											    ?>  <tr>
											    	    <th>
											    	    	<button class="btn btn-sm btn-default" onclick="buttonclick(event)"><?php echo $res2[$i]["Patient_ID"]?></button>
											    	    </th>
												        <th><?php echo $res2[$i]["PatientName"];?></th>
	                                                    <th><?php if($res2[$i]["PatientSex"] == "F"){echo "女";}else{echo "男";}?>
	                                                    </th>        
	                                                    <th><?php $x = substr($res2[$i]["PatientBirthDate"],0,4);//病人出生年
	                                                              $y = substr(date("Y/m/d"),0,4);//今年
	                                                              echo $y-$x;?>
	                                                    </th> 
                                                    </tr>
											    <?
											    }else{
											    	echo '$data2为空';
											    }
									    }
								    }else{
									    echo "数据库无此日期的病人";
								    }
								}
						    ?>
						</tbody>
				</table>
			</div>
		</div><!-- 根据日期查询病人，默认显示当天的病人 -->

        <div class="col-md-9" style="max-height: 392px;">
        	<div class="col-md-12"  >
	        	<h2>患者信息</h2>
	        	<div style="height: 100px;">
		            <table class="table table-bordered" id="tabofpatient"><!--眼底信息表，后续添加tr,td-->
						<thead>
							<tr>
								<th style="width: 220px;">ID</th>
								<th>姓名</th>
								<th>性别</th>
								<th>生日</th>
								<th>联系方式</th>
								<th>地址</th>
		                       	<th>身份证</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
			    </div>
			</div>
			<div class="col-md-12"  style="min-height: 200px;overflow-y: scroll;"">
				<h2>影像记录</h2>
				<div style="height: 140px;overflow-y: scroll;">
					<table class="table table-bordered" id="taboffundus" onclick="fundusonclick(event)"><!--病人信息表，后续添加tr,td.添加点击事件，捕获冒泡-->
						<thead>
							<tr>
								<th>影像ID</th>
								<th>采集日期</th>
								<th>采集设备</th>
								<th>眼别</th>
								<th>操作员</th>
								<th>阅片状态</th>
							</tr>
						</thead>
					</table>
			    </div>
			</div>
        </div>

        <div class="col-md-3" style="min-height: 300px;" id="divfundus">
        	<h2>眼底图片</h2>
        	<div class="col-md-12">
			    <!-- <img id="imgfundus" src="" style="width:100%;color: red;margin-top: 10%;"> -->
			    <img src="../pacs/static/img/test1.png" id="real" alt="model test picture">
                <div class="motai" id="mo">
                   <span class="close" id="close">×</span>
                   <img class="motaiimg" id="moimg">
                </div>
			</div>
        </div>
 
        <div class="col-md-3" style="min-height: 300px;">
        	<h2>诊疗结果</h2>
				<table class="table table-bordered" id="tabofresult">
						<thead>
							<tr>
								<th>医生</th>
								<th>日期</th>
								<th>图像ID</th>
                               	<th>结果</th>
							</tr>
						</thead>
				</table>

        </div>

        <div class="col-md-3" style="min-height: 300px;">
        	<h2>阅片病历</h2>
        	    <div class="panel panel-default" style="min-height: 200px;">
				    <div class="panel-body">
				       
				    </div>
	            </div>
        </div>

<?php
	require('conn.php');
	if(isset($_POST["patient_name"])){
		$patientName = (string)$_POST["patient_name"];
		$StudyDate_Ymd = str_replace("-","",$_POST["date"]);
		$sql = "SELECT * from patient where PatientName='$patientName' and StudyDate_Ymd='$StudyDate_Ymd'";
		$data = $conn->query($sql);
		
		if($data->num_rows > 0){
			while($arr = $data->fetch_assoc()){
				$res[] = $arr;}
?>	    
        
        	<div class="col-md-1" style="border: 1px solid rgb(227,227,227);min-height: 350px;">
        		<table class="table table-bordered">
        			<h3 style="margin: 10.5% auto;">病例信息</h3>
					<thead>
						<tr>
							<th>医院名称</th>
							<th>未阅病例</th>
						</tr>
					</thead>
					<tbody>
						<th>南昌第一眼科</th>
						 
					</tbody>
				</table>
        	</div>
        	<div class="col-md-8"  style="border: 1px solid rgb(227,227,227);min-height: 350px;">
				<table class="table table-bordered" >
					<h3 style="margin: 5% auto;">病患信息</h3>
					<thead>
						<tr>
							<th>病患ID</th>
							<th>姓名</th>
							<th>性别</th>
							<th>生日</th>
							<th>联系方式</th>
							<th>采集日期</th>
						</tr>
					</thead>
					<tbody>
						<?php    $k = 0;
							for($k;$k<count($res);$k++){
						 ?>
						<tr>
							<th><?php echo $res[$k]["Patient_ID"];?></th>	
							<td><?php echo $res[$k]["PatientName"];?></td>
							<td><?php if($res[$k]["PatientSex"] == "M"){echo "男";}else{echo "女";} ?></td>
							<td><?php echo $res[$k]["PatientBirthDate"];?></td>
							<th><?php echo $res[$k]["PatientTel"]?></th>
							<td> 
							    <?php 
							        echo substr($res[$k]["StudyDate_Ymd"],0,4)."-";
							        echo substr($res[$k]["StudyDate_Ymd"],4,2)."-";
							        echo substr($res[$k]["StudyDate_Ymd"],6,2)."-";
							        echo substr($res[$k]["StudyDate_His"],0,2).":";
							        echo substr($res[$k]["StudyDate_His"],2,2).":";
							        echo substr($res[$k]["StudyDate_His"],4,2);	;
							          ?>
							</td>
						</tr>
					       
					    <?php }   ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4" style="min-height: 30%;border: 1px solid rgb(227,227,227);min-height: 350px;">
				<div class="col-md-12">
				    <img src="<?php echo "../pacs/static/img/".$res[1]["ImageName"]; ?>" 
				         style="width:100%;color: red;margin-top: 10%;" 
				           alt="图片暂时不可见！" >
				</div>
                <div class="col-md-12">
				<a href="#" style="color: black;">点击查看详细信息</a>
				</div>
			</div>
			<div class="col-md-4" style="min-height: 350px;border: 1px solid rgb(227,227,227);">
				<h3>阅片病历</h3>
				<div class="panel panel-default" style="min-height: 200px;">
				    <div class="panel-body">
				        <?php 
				            if($res[1]["result"]){
				        	    echo $res[0]["result"];
				        	}else{
				        		echo "暂无结果，请稍后再试！";
				        	}
				        ?>
				    </div>
	            </div>
			</div>
			<div class="col-md-4" style="min-height: 350px;border: 1px solid rgb(227,227,227);">
				<h3>诊疗结果</h3>
				<div class="panel panel-default" style="min-height: 200px;">
				    <div class="panel-body">
				        <?php 
				            if($res[0]["result"]){
				        	    echo $res[0]["result"];
				        	}else{
				        		echo "暂无结果，请稍后再试！";
				        	}
				        ?>
				    </div>
	            </div>
			</div>
	    </div>
	<nav class="navbar navbar-default" role="navigation">
		    <div class="container-fluid">
		        <div class="navbar-form navbar-right">
		    	    <button type="submit" class="btn btn-success" id="requiread">请求转阅</button>
                </div>
	        </div>
	</nav>

<?php
	    }else{echo"<script>alert('日期或ID不正确，请重新输入!');</script>";}
	}

	if(isset($_POST['exit'])){
		$_SESSION['name'] = '';
		echo "<script>alert('退出成功!');window.location.href='admin.php'</script>";
	}
?>
	</div>
	<script type="text/javascript">
		
		window.onload=function(){
	
			var submitSort = document.getElementById("submitsort");
			    submitSort.onsubmit = function(){
		            var InputSort = document.getElementById("sort");
	            	var reg = /\p{Unified_Ideograph}/u ;
				    if(!reg.test(InputSort.value)){
				    	alert("请输入正确的名字！");
				        return false;
                    }
			    }
            
            

            // let buttonclick = function(){
            // 	alert("click");
            // }


            // var da  = document.getElementById("da");
            //     da.oninput = function(){
            //     	var dates = da.value;
            //     	$.ajax({
				        //     type: "POST",
				        //     url: "http://localhost/pacs/dates.php",
				        //     data: {'dates':dates},
				        //     success: function(data)
				        //     {   var res = JSON.parse(data);
				        //     	console.log("返回的数据",res);
				        //     	// console.log(typeof(res));
				        //     	//var arr = Object.keys(res);将索引值加到数组arr
				        //     	var arr = Object.values(res);//将值加入到数组arr1
				        //     	const array = [...new Set(arr)];//arr数组去重
            //                     var len = array.length;//获取对象的长度
				        //     	console.log(array);
				            	
				        //     	if(res.message){alert(res.message);}//没有查找到病人
				        //         else{
				        //         var oSelect = document.getElementById("sort");
				        //         for(var i = 0;i<len;i++)
				        //         {
            // 				    oSelect.add(new Option(array[i],array[i]));//添加option
            //                     // console.log(Object.getOwnPropertyNames(oSelect).length);
				        //         }
				        //         }//返回病人姓名并加到select的option

				        //     },
				        //     // error:function(jqXHR, textStatus, errorThrown){
				        //     // 	console.log("jqXHR.responseText",jqXHR.responseText);
				        //     // 	console.log("jqXHR.status",jqXHR.status);
				        //     // 	console.log("jqXHR.readyState",jqXHR.readyState);
				        //     // }
				        //  });
            //     }
             }
            
			var requiRead = document.getElementById("requiread");
				if(requiRead){
                    var id = <?php if(isset($_POST["patient_name"]) && isset($res["ID"]))
                                   {echo $res["ID"];}else{echo "''";} 
                              ?>;
					requiRead.onclick = function requiRead(){   
					 	$.ajax({
				            type: "POST",
				            url: "http://192.168.0.120/server/returnResult.php",
				            data: {'id':id},
				            dataType: "json",
				            success: function(data)
				            {
				            	console.log(data);
				            	if(data.code == 1){
                                console.log("asd");
				            	}
				            }
				         });
				    }
				}//转阅片

	</script>
</body>
</html>

