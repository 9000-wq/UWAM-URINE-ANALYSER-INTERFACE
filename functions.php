<?php
function SaveOptionSetting(&$Description,&$Contents,&$UserName="")
{

    include('connecting.php');
    $sql="";
    try{
    $CX=$Contents;
    $UX=$UserName;
    $sql="IF EXISTS(Select *FROM Options Where Description='$Description') UPDATE Options SET Contents='$CX' Where Description='$Description'
    ELSE 
    Insert into Options (Description,Contents)
    Values ('$Description','$CX') ";
    $res = sqlsrv_query($conn_hq, $sql);

    }
    catch(Exception $ex)
{
    echo "  Function: SaveOptionsSettings"  .$ex->getMessage();
    return NULL;
}
  
}
 Function GetOptionSetting(&$Description,&$DefaultValue,&$UserName="")
 {
    include('connecting.php');
  $RetVal=$DefaultValue;
  $sql="";
  try{
  $sql="Select Contents From Options Where Description='$Description'";
  $res = sqlsrv_query($conn_hq, $sql);
  if($res)
  {
    $row=sqlsrv_fetch_array($res,SQLSRV_FETCH_ASSOC);
    $RetVal=$row['Contents'];
  }
}
catch(Exception $ex)
{
    echo " Function: GetOptionsSettings"  .$ex->getMessage();
    return NULL;
}
  return $RetVal;
 }
 function  LogTrace(&$strTraceMessage,&$SampleID="")
 {
    include('connecting.php');
    $sql="";
    try { 
        
      
        $Description="UWAMTraceEnabled";
        $DefVal="0";
        $analyser="none";
        $date=date("Y/m/d")." ".date("h:i:sa");
            $str=str_replace("'","",$strTraceMessage);
            $sql="insert into TraceUWAM (Trace,DateTime,Analyser,SampleID) values ('$str','$date','$analyser','$SampleID')";
            $res = sqlsrv_query($conn_hq, $sql);
       

    }
    catch(Exception $ex)
{
    echo "  Function: Logtrace"  .$ex->getMessage();
    return NULL;
}
 }

 ?>
 