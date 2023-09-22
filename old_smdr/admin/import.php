<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<?php
ini_set("display_errors", "1");
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('America/Los_Angeles');
session_start();
if (!isset($_SESSION['USERNAME'])) {
     header("Location:/smdr/index.php");
     die();     // just to make sure no scripts execute
}
include_once $_SERVER['DOCUMENT_ROOT']."/smdr/config/config.php";
if(!empty($_GET['message'])) {
    $message = $_GET['message'];
	echo $message;
	}
include_once $_SERVER['DOCUMENT_ROOT']."/smdr/admin/menu.php";
?> 
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<div id="main" style="overflow-x:scroll;overflow-y:scroll;width:78%;height:90%"> 
<?php 
if($_FILES['xls_file']['tmp_name'])  
{   
    move_uploaded_file($_FILES['xls_file']['tmp_name'],'uploads/'.$_FILES['xls_file']['name']);  
    $xls_file = 'uploads/'.$_FILES['xls_file']['name'];  
      
    require_once 'Excel/reader.php';  
      
      
    // ExcelFile($filename, $encoding);  
    $data = new Spreadsheet_Excel_Reader();  
      
      
    // Set output Encoding.  
    $data->setOutputEncoding('CP1251');  
      
    /*** 
    * if you want you can change 'iconv' to mb_convert_encoding: 
    * $data->setUTFEncoder('mb'); 
    * 
    **/  
      
    /*** 
    * By default rows & cols indeces start with 1 
    * For change initial index use: 
    * $data->setRowColOffset(0); 
    * 
    **/  
      
      
      
    /*** 
    *  Some function for formatting output. 
    * $data->setDefaultFormat('%.2f'); 
    * setDefaultFormat - set format for columns with unknown formatting 
    * 
    * $data->setColumnFormat(4, '%.3f'); 
    * setColumnFormat - set format for column (apply only to number fields) 
    * 
    **/  
      
    $data->read($xls_file);  
      
    /* 
     
     
     $data->sheets[0]['numRows'] - count rows 
     $data->sheets[0]['numCols'] - count columns 
     $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column 
     
     $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell 
         
        $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown" 
            if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00'; 
        $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format  
        $data->sheets[0]['cellsInfo'][$i][$j]['colspan']  
        $data->sheets[0]['cellsInfo'][$i][$j]['rowspan']  
    */  
      
    $values = '';  
      
    for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {  
        $values[] = $data->sheets[0]['cells'][$i];  
    }  
    /*echo '<pre>'; 
    print_r($values);*/  
    $rownum = 0;  
    $case_count = 0;  
    $new = 0;  
    $update = 0;  
    $add_fail = 0;  
      
    foreach ($values as $colnum)  
    {  
        $rownum++;  
        if($rownum > 1)  
        {  
            $excel_ext_num = trim($colnum[1]);  
            $excel_ext_name = trim($colnum[2]);  

                  
            $query_test = mysqli_query("SELECT * FROM extension WHERE extension = '$excel_ext_num'  ");  
            if (mysqli_errno()) {   
                echo "mysqli error ".mysqli_errno().": ".mysqli_error()."\n\<br\>When selecting suite id\<br\>";   
                $add_fail++;  
                continue;  
            }  
            $res_test = mysqli_fetch_array($query_test);  
              
            if(count($res_test)>1)      
            {  
                //Test case already exists in the test suite, then we need to just update it  
                $testcase_id = $res_test['id'];  
                                 
                  
                mysqli_query("UPDATE extension SET first = '$excel_ext_name' WHERE id = '$testcase_id' ");
                if (mysqli_errno()) {   
                    echo "mysqli error ".mysqli_errno().": ".mysqli_error()."\n\<br\>When UPDATE ext. for row $rownum ...\<br\>";   
                    $add_fail++;  
                    continue;  
                }  
                 
  
                $update++;  
            }  
            else  {   
                //This is a new test and we need to add it in test suite  
                //*** Start Transaction ***//    
                mysqli_query("BEGIN");   
                $objQuery1 = mysqli_query("INSERT INTO extension "."(extension,first) "."VALUES('$excel_ext_num','$excel_ext_name')");  

                if($objQuery1) {    
                    //*** Commit Transaction ***//    
                    mysqli_query("COMMIT");    
                }    
                else  {    
                    //*** RollBack Transaction ***//    
                    echo "ERROR :: Rollbacked transaction of new for row $rownum ...";  
                    $add_fail++;  
                    continue;  
                }   
                                                          
                  
            $new++;  
            }  
        }  
    }      
    $case_count = $new + $update;      
    echo "<font color=#993300>Total <b>$case_count</b> updated successfully.</font>\<br\>";  
    echo "<font color=#0000ff>New  : <b>$new</b></font>\<br\>";  
    echo "<font color=#0000ff>updated : <b>$update</b> </font>\<br\>";  
    echo "<font color=#0000ff>update failed: <b>$add_fail</b> </font>\<br\>";  
}  
?>  
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<title>XLS Uploader</title>  
</head>  
<body>  
<form name="frm" action="" method="post" enctype="multipart/form-data">  
  
<table>  
<tr><td>Use this page to import Extension from Excel sheet to Portal, Excel file should have following columns:</td></tr>  
</table>  
  
<table border="1">  
<tr>  
<th>Extension Number</th>  
<th>Extension Name</th>  
</tr>  
</table>  
  
<p>  
  
<table>  
<tr>  
<th align="left">NOTE:</th>  
</tr>  
<tr>  
<td>  
<ol>  
<li>List should be in the first sheet of the excel file</li>  
<li>First row will be ignored as it will have column headers</li>  
</td>  
</tr>  
</table>  
  
<table>  
<tr>  
    <td><b>XLS Uploader:</b></td>  
</tr>  
<tr>  
    <td><input type="file" name="xls_file" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="sample_upload_format.xls">Sample file format</a> </td>  
</tr>  
<tr>  
    <td><input type="submit" name="submit" value="submit" /> </td>  
</tr>  
<tr>  
    <td></td>  
</tr>  
</table>  
</form>  
</body>
</div>   
</html> 