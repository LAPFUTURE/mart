<?php //患者信息和眼底信息
    require('conn.php');
    if(isset($_POST["patientID"])){
    	$patientID = $_POST["patientID"];
    	$sql = "SELECT * from patient where Patient_ID = '$patientID'";
    	$res = $conn->query($sql); 
    	if($res->num_rows > 0){//判断条数是否为0
			while($arr = $res->fetch_assoc()){
				$data[] = $arr;}
			if($data[0]['PatientSex'] == 'M'){
                $data[0]['PatientSex'] = '男';
			}else{
                $data[0]['PatientSex'] = '女';
			}
        }
        $PatientBirthDate = substr($data[0]["PatientBirthDate"],0,4)."-".substr($data[0]["PatientBirthDate"],4,2)."-".substr($data[0]["PatientBirthDate"],6,2);//出生日期字符串添加-分割
        $data[0]["PatientBirthDate"] = $PatientBirthDate;
        $dataofpatient = [
            "Patient_ID"  => $data[0]["Patient_ID"],
            "PatientName" => $data[0]["PatientName"],
            "PatientSex"  => $data[0]["PatientSex"],
            "PatientBirthDate" => $data[0]["PatientBirthDate"],
            "PatientTel"  => $data[0]["PatientTel"],
            "Address"     => $data[0]["Address"],
            "Card_id"     => $data[0]["Card_id"],
        ];//返回患者信息


        $sql = "SELECT * from fundus where Patient_ID = '$patientID' order by StudyDate_Ymd DESC"; 
        $res = $conn->query($sql);
        if($res->num_rows > 0){//判断条数是否为0
			while($arr = $res->fetch_assoc()){
				$data1[] = $arr;}//一般为二维数组
        }
        for($j=0;$j<count($data1);$j++){
            if($data1[$j]["askRead"] == '0'){
               $data1[$j]["askRead"] = "未转阅";
            }elseif($data1[$j]["askRead"] == '1'){
               $data1[$j]["askRead"] = "已转阅未出结果";
            }else{
            	$data1[$j]["askRead"] = "已转阅已出结果";
            }
            
            $StudyDate_Ymd = substr($data1[$j]["StudyDate_Ymd"],0,4)."-".
                             substr($data1[$j]["StudyDate_Ymd"],4,2)."-".
                             substr($data1[$j]["StudyDate_Ymd"],6,2)."-".
                             substr($data1[$j]["StudyDate_His"],0,2)."-".
                             substr($data1[$j]["StudyDate_His"],2,2)."-".
                             substr($data1[$j]["StudyDate_His"],4,2);

            $data1[$j]["StudyDate_Ymd"] = $StudyDate_Ymd;
            
        }
        
        $dataoffundus = $data1;

    	$arr = [
    		"dataofpatient" => $dataofpatient,
    		"dataoffundus"  => $dataoffundus, 
            "病人ID" => $_POST["patientID"],
    		"httpCode" => "200",
    		"message"  => "SUCCESS!"];
        echo json_encode((object)$arr);
    }
?>