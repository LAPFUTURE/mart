<!DOCTYPE html>
<html>
<head> 
	<title>用户中心</title>
	<link rel="stylesheet" type="text/css" href="./static/bootstrap.min.css">
	<style type="text/css">
	div{border: 1px solid rgb(227,227,227);}
		body{max-width: 1366px;
             /*height:768*/
	         text-align: center;
	         font-size: 15px;
			 margin: 0 auto;}
		/*h3{margin-top:1%;}*/
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
		window.onload = function(){        	
		let parentOfDetails = document.getElementById('parentOfDetails');//获取查看详情按钮，然后再获取隐藏input
        }

	    let patientId = '';
		let submitID = function(a){//点击日期表的姓名按钮，难点在于阻止表单提交的同时获取隐藏input携带的Patient_ID
            //console.log(a);a表示onsubmit="return submitID(this)"传过来的this，this此时表示表单，通过表单获取隐藏input
                patientId    = a.childNodes[1].value;//全局变量,将隐藏input的value赋给patientId.
			let divOfPatient = document.getElementById('divOfPatient');//获取患者信息表格
			// let tabofpatient = document.getElementById('tabofpatient');//获取患者信息表格
			let taboffundus  = document.getElementById('taboffundus');//获取眼底信息表格
			let tabofresult  = document.getElementById('tabofresult');//获取诊疗结果表单
			let treatResult  = document.getElementById("treatResult");//获取诊疗结果面板
			    motai        = document.getElementById('mo');//定义为全局变量，后面使用
		        moImg        = document.getElementById("moimg");//定义为全局变量，后面使用
		        realImg      = document.getElementById("real");//定义为全局变量，后面使用
                realImg.style.opacity = "0";//点击其他病人时将眼底图片的opacity从1置为0

                // for (let i = tabofpatient.childNodes.length-1;i>=4;i--) {
                // 	tabofpatient.removeChild(tabofpatient.childNodes[i]);
                // }//删除之前添加的tabofpatient的列

                for (let i = taboffundus.childNodes.length-1;i>=4;i--) {
                	taboffundus.removeChild(taboffundus.childNodes[i]);
                }//删除之前添加的taboffundus的列
                
                for (let i = tabofresult.childNodes.length-1;i>=3;i--) {
                	    tabofresult.removeChild(tabofresult.childNodes[i]);
                    }//删除之前添加的tabofresult的列，这里的循环条件是i>=3.这个表格要删除两次，另一次在后面点击影像ID
                treatResult.innerHTML = '';//将诊疗面板置空 

              $.ajax({
			            type: "POST",
			            url: "http://localhost/pacs/info_patient_fundus.php",
			            data: {'patientID':patientId},
			            success: function(data)
			            {  
			            	let res = JSON.parse(data);//返回的数据类型为string，要转为对象
			            	alert(res.message);
                            let arr = Object.values(res.dataofpatient);//将值加入到数字arr来获取数组长度
                            divOfPatient.childNodes[1].innerHTML = "姓名:"+res.dataofpatient.PatientName;
                            divOfPatient.childNodes[3].innerHTML = "生日:"+res.dataofpatient.PatientBirthDate;
                            divOfPatient.childNodes[7].innerHTML = "联系方式:"+res.dataofpatient.PatientTel;
                            divOfPatient.childNodes[9].innerHTML = "地址:"+res.dataofpatient.Address;
                            divOfPatient.childNodes[11].innerHTML = "身份证:"+res.dataofpatient.Card_id;
                           
                            // console.log("divOfPatient.childNodes[1]["innerHTML"]:",divOfPatient.childNodes[1]["innerHTML"]);

           //                  let oTr = document.createElement('tr');
           //                  for(let i=0;i<arr.length;i++){
							    // tabofpatient.appendChild(oTr);
							    // var oTd=document.createElement('td');//创建节点
							    // oTd.setAttribute("class","td_class");
					      //       oTd.innerHTML=arr[i];//给表格赋内容
					      //       oTr.appendChild(oTd);//加入到tr
           //                  }//患者表格信息
                            
                            for(let i=0;i<res.dataoffundus.length;i++){
                                let arr = Object.values(res.dataoffundus[i]);//后台返回的完整的眼底信息
                                //console.log("arr:",arr);arr[2]是ImageName;
                                let arrs = [arr[2],arr[11],arr[4],arr[8],arr[7],arr[9]];//前台展示眼底信息
                                let oTr = document.createElement('tr');    
                                for(let i=0;i<arrs.length;i++){

								    taboffundus.appendChild(oTr);
								    var oTd=document.createElement('td');//创建节点
								    oTd.setAttribute("class","td_fundns_class");
								   
								    // if(i==0){arrs[i] = "<button class='btn btn-default'>"+arrs[i]+"</button>"; }//判断是否影响ID
						            oTd.innerHTML=arrs[i];//给表格赋内容
						            oTr.appendChild(oTd);//加入到tr
                                }//影像记录信息
                            }
			            }, 	
			            error:function(jqXHR, textStatus, errorThrown){
			            	console.log("jqXHR.responseText",jqXHR.responseText);
			            	console.log("jqXHR.status",jqXHR.status);
			            	console.log("jqXHR.readyState",jqXHR.readyState);
				            }
				    })
        return false;//阻止表单默认提交
		}//为两个表格添加tr,td
        
        let fundusonclick = function(ev){//点击眼底信息的列
                                for (let i = tabofresult.childNodes.length-1;i>=2;i--) {
                	                tabofresult.removeChild(tabofresult.childNodes[i]);
                                }//删除之前添加的tabofresult的列，这里的循环条件是i>=2,跟之前的i>=4不同
                                
                                let imgID = +ev.target.innerHTML;//一元运算符将字符串转化为number
                                window.imgID = imgID;//将imgID作为全局变量给showDetails()函数使用
                                let ImageNames = ev.target.parentNode.childNodes[0].innerHTML;
                                if(ev.target.tagName === 'TD'){
                                   //判断点击的是否为TD（传给后台的是ImgName)
                                   $.ajax({
							            type: "POST",
							            url: "http://localhost/pacs/img_result.php",
							            data: {'ImageNames':ImageNames},
							            success: function(data)
							            {   let res = JSON.parse(data);
							                let arr = Object.values(res);
							                window.ImgName = arr[0].ImageName;
							            	for(let i=0;i<arr.length;i++){
							            		let arrs = [
                                                    arr[i].DoctorName,//医生
                                                    arr[i].Date,//日期
                                                    // childArr[0],//图像ID
                                                    // childArr[4],//结果
                                                    // childArr.ImageName,//ImageName
							            		];
							            		
                                                let oTr = document.createElement('tr');
                                                for(let j=0;j<arrs.length;j++){
                                                    tabofresult.appendChild(oTr);
									                var oTd=document.createElement('td');//创建节点
									                oTd.setAttribute("class","td_fundns_class");
							                        oTd.innerHTML=arrs[j];//给表格赋内容
							                        oTr.appendChild(oTd);//加入到tr
                                                }
							            	}
							            	// let arrs = [
							            	//             arr[3],//医生
							            	//             arr[2],//日期
							            	//             // arr[0],//图像ID
							            	//             //arr[4],//结果
							            	//             //arr[5],//ImageName
							            	//            ];
							            	// window.ImgName = arr[5];//将ImageName作为全局变量给submitValue()函数使用
							            	// let oTr = document.createElement('tr');
							            	// for(let i=0;i<arrs.length;i++){
                    //                             tabofresult.appendChild(oTr);
								            //     var oTd=document.createElement('td');//创建节点
								            //     oTd.setAttribute("class","td_fundns_class");
						              //           oTd.innerHTML=arrs[i];//给表格赋内容
						              //           oTr.appendChild(oTd);//加入到tr
							            	// }
							            	// treatResult.innerHTML = arr[4];
		                                        realImg.src="../pacs/static/img/"+window.ImgName;
		                                        realImg.style.opacity = "1";//之前将照片opacity置为1是为了不让默认照片显示,现在置1将图标显示出来
			                                    realImg.onclick=function(){
				                                    motai.style.display="block";
				                                    moImg.src=this.src;
			                                    }
		                                    var span=document.getElementById("close");
			                                    span.onclick=function(){
			                                        motai.style.display="none";
			                                    }
	                                    },
                                    })
                                }else{
                                	alert("请点击影像ID按钮！");
                                }
                            }
        let submitValue = function(b){//提交文本框的value
        	let value = b.parentNode.parentNode.childNodes[1].value;//获取文本域的值
        	if(value === '' ){alert("病历不能为空！");}//提示空值提交
            else{
                let date = new Date();
                        let year = ''+date.getFullYear();
                        if(date.getMonth()<9){
                        	var month = '0'+ (date.getMonth()+1);
                        }else{
                        	var month = date.getMonth() + 1;
                        }
                        if(date.getDate()<10){
                        	var day= '0'+ date.getDate();
                        }else{
                        	var day = date.getDate();
                        }
                        let fullDate = year + month + day;//获取完整日期
                
                let nameCookie = (document.cookie).substring(5);//现在cookie只有一个，可以不需要进行字符串处理
                //console.log("patientId:",patientId,"fullDate:",fullDate,"nameCookie:",nameCookie,"value:",value,"window.ImgName:",window.ImgName);
                if(!document.cookie){
                    alert("登录已失效,请重新登录页面！");
                    window.location.href = "admin.php";
                }
            	let p = new Promise(function(resolve,reject){
	            	$.ajax({
	            	    type:"post",
	            		url:"img_result.php",
	            		data:{"patientId"  :patientId,
	            		      "fullDate"   :fullDate,
	            		      "DoctorName" :nameCookie,
	            			  "readRecords":value,
	            		      "ImgName"    :window.ImgName
	            		      },//patient_ID,Date,DoctorName,Result(value),imageName
	            		success(data){
	            			resolve(data);
	            		},
	            		error(err){
	            			alert("保存失败，请刷新重试!");
	            			reject(err);
	            		}
	            	})
                });
                p.then(function(data){
                	// let res = JSON.parse(data);
	                //     console.log("res:",res);
	                    alert("提交成功！");
                },function(err){
                	console.log(err);
                })
            }
        }

        let showDetails = function(){//点击查看详情按钮
        	//let parentOfDetails = document.getElementById('parentOfDetails');//获取查看详情按钮，然后再获取隐藏input
        	// console.log("window.imgID:",window.imgID);
        	let link ="details.php" + '?imgID='+window.imgID;
            window.location.href=link;   //携参跳到details.php
            // console.log(parentOfDetails.childNodes[1].value);
            // console.log(parentOfDetails.childNodes[3].value);
        }

        let showResult = function(ev){
            // console.log(ev.target.parentNode.childNodes[0].innerHTML);
            let doctorNames = ev.target.parentNode.childNodes[0].innerHTML
            let p = new Promise(function(resolve,reject){
	            	$.ajax({
	            	    type:"post",
	            		url:"img_result.php",
	            		data:{"doctorNames"  : doctorNames,
	            		      "ImgNamess"    : window.ImgName
	            		      },
	            		success(data){
	            			resolve(data);
	            		},
	            		error(err){
	            			reject(err);
	            		}
	            	})
                });
                p.then(function(data){
                	let res = JSON.parse(data);
                	    treatResult.innerHTML = res.res;//诊疗结果
                },function(err){
                	    console.log(err);
                })

        } 
	</script>                              
</head>
<body class="well">
	<div  style="min-height: 768px; border: 1px solid rgb(227,227,227);">
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
	            		if(isset($_COOKIE["name"])){
	            		 	echo"--欢迎您，".$_COOKIE["name"];
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

		<div class="col-md-2" style="min-height: 600px;padding:0px;">
			<form  method="post" action="" id="sortbydate" class="navbar-form navbar-left" role="search">
	            <div class="form-group">
		            <input type="date" name="sortbydate" class="form-control" style="width: 72%;padding: 0px; "> 
		            <button type="submit" class="btn btn-success btn-sm">查询</button>
	            </div>
	        </form>
			<div class="col-md-12" style="overflow-y: scroll;height: 600px;padding:0px;" >
				<table class="table table-bordered" >
						<thead>
							<tr>
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
											    	        <form id="submitPatient_ID" 
											    	    	      onsubmit="return submitID(this)" 
											    	    	      style="width: 50%;margin-left: 10%;">
												    	    	<input value="<?php echo $res1[$i]["Patient_ID"]?>" type="hidden">
												    	    	<button class="btn btn-sm btn-default" style="width: 180%;">
												    	    	<?php echo $res2[$i]["PatientName"];?></button>
											    	    	</form>
											    	    </th>
												        
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
											    	    <th>
											    	        <form id="submitPatient_ID" 
											    	    	      onsubmit="return submitID(this)" 
											    	    	      style="width: 50%;margin-left: 10%;">
												    	    	<input value="<?php echo $res1[$i]["Patient_ID"]?>" type="hidden">
												    	    	<button class="btn btn-sm btn-default" style="width: 180%;">
												    	    	<?php echo $res1[$i]["PatientName"];?></button>
											    	    	</form>
											    	    </th>
												        
	                                                    <th><?php if($res1[$i]["PatientSex"] == "F"){echo "女";}else{echo "男";}?>
	                                                    </th>        
	                                                    <th><?php $x = substr($res1[$i]["PatientBirthDate"],0,4);//病人出生年
	                                                              $y = substr(date("Y/m/d"),0,4);//今年
	                                                              echo $y-$x;?>
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
											    	        <form id="submitPatient_ID" 
											    	    	      onsubmit="return submitID(this)" 
											    	    	      style="width: 50%;margin: 10%;">
												    	    	<input value="<?php echo $res1[$i]["Patient_ID"]?>" type="hidden">
												    	    	<button class="btn btn-sm btn-default" style="width: 180%;">
												    	    	<?php echo $res2[$i]["PatientName"];?></button>
											    	    	</form>
											    	    </th>
												        
	                                                    <th><?php if($res2[$i]["PatientSex"] == "F"){echo "女";}else{echo "男";}?>
	                                                    </th>        
	                                                    <th><?php $x = substr($res2[$i]["PatientBirthDate"],0,4);//病人出生年
	                                                              $y = substr(date("Y/m/d"),0,4);//今年
	                                                              echo $y-$x;?>
	                                                    </th> 
                                                    </tr>
											    <?
											    }else{
											    	echo '今日病人暂无';
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

        <div class="col-md-10" style="height: 292px;">
        	<div class="col-md-2">
	        	<h4>患者信息</h4>
	        	<div style="height: 230px;" id="divOfPatient">
					<p align="left"></p>
					<p align="left"></p>
					<p align="left"></p>
					<p align="left"></p>
					<p align="left"></p>
					<p align="left"></p>
					<!-- <table class="table table-bordered" id="tabofpatient">眼底信息表，后续添加tr,td
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
					</table> -->
			    </div>
			</div>
			<div class="col-md-10"  style="min-height: 190px;"">
				<h3>影像记录</h3>
				<div style="height: 213px;overflow-y: scroll;">
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

        <div class="col-md-3" style="min-height: 200px;" id="divfundus">
        	<div class="col-md-12" style="padding: 0px;min-height: 280px;margin-top: 7%;">
			    <img id="real" src="#" 
			         style="margin:0 auto;width: 100%;opacity: 0;">
                <div class="motai" id="mo">
                   <span class="close" id="close">×</span>
                   <img class="motaiimg" id="moimg">
                </div>
			</div>
			<div id="parentOfDetails">
				<input type="hidden" value="lalala">
				<input type="hidden" value="lalalala">
			    <button class="btn btn-success" onclick="showDetails()">查看详情</button>
			</div>
        </div>
 
        <div class="col-md-4" style="min-height: 307px;">
        	    <div class="col-md-12" style="padding: 0px;height: 110px;margin-top: 5%;overflow-y: scroll;">
					<table class="table table-bordered" id="tabofresult" onclick="showResult(event)">
						    <thead>
								<tr>
									<th>医生</th>
									<th>日期</th>
								</tr>
						    </thead>
					</table>
				</div>
				<div class="col-md-12" style="padding:0;">
	                <div class="panel panel-success" class="col-md-12" style="height: 210px;padding:0px;">
	                	<div class="panel-heading" >
                            <div style="width:10%;">结果:</div>
	                    </div>
			            <div class="panel-body" style="padding: 0px;" id="treatResult">
			            </div>
	                </div>
	            </div>
        </div>
        <div class="col-md-3">
    	    <div class="panel panel-success" style="min-height: 300px;margin-top: 6%;">
                <div class="panel-heading">
	                <h3 class="panel-title">阅片病历</h3>
                </div>
	            <div class="panel-body" style="padding: 0px 0px;">
                        <textarea class="form-control" style="height:233px;"></textarea>
                    <div style="margin-left:0px;display: inline-block;">
                    <button class="btn btn-success" onclick="submitValue(this)">保存</button>
                    </div>
                    <div style="margin-left:30%;margin-top: 4%; display: inline-block;">
                    <button type="submit" class="btn btn-success" id="requiread">请求转阅</button>
                    </div>
	            </div>
            </div>
        </div>
    </div>
<!-- <nav class="navbar navbar-default" role="navigation">
		    <div class="container-fluid">
		        <div class="navbar-form navbar-right">
		    	    <button type="submit" class="btn btn-success" id="requiread">请求转阅</button>
                </div>
	        </div>
</nav> -->
<?php
	if(isset($_POST['exit'])){
		$_COOKIE['name'] = '';
		echo "<script>alert('退出成功!');window.location.href='admin.php'</script>";
	}
?>
	<script type="text/javascript">
			var submitSort = document.getElementById("submitsort");
			    submitSort.onsubmit = function(){
		            var InputSort = document.getElementById("sort");
	            	var reg = /\p{Unified_Ideograph}/u ;
				    if(!reg.test(InputSort.value)){
				    	alert("请输入正确的名字！");
				        return false;
                    }
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

