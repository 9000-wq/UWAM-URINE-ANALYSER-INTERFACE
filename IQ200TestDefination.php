<?php
trait ESaveAction2
{
  public $ESaveActionAdd;
  public  $ESaveActionUpdate;
  public function _GetESaveActionAdd(): int
  {
    $ESaveActionAdd = 0;
    return $ESaveActionAdd;
  }
  public function _GetESaveActionUpdate(): int
  {
    $ESaveActionUpdate = 1;
    return $ESaveActionUpdate;
  }
}

class IQ200TestDefinition
{
  use ESaveAction2;
  private $_Code;
  private $_HostCode;
  private $_SampleType;
  private $_longname;
  private $_shortname;
  private $_PrintPriority;
  private $_dp;
  private $_units;
  private $_Category;
  private $_Printable;
  private $_KnownToAnalyser;
  private $_InUse;
  private $_Analyser;
  public $counter;
  public $IQ200TestArray = array();
  public function _SetCode(&$Value)
  {
    $this->_Code = $Value;
  }
  public function _GetCode()
  {
    return $this->_Code;
  }
  public function _SetHostCode(&$Value)
  {
    $this->_HostCode = $Value;
  }
  public function _GetHostCode()
  {
    return $this->_HostCode;
  }
  public function _SetSampleType(&$Value)
  {
    $this->_SampleType = $Value;
  }
  public function _GetSampleType()
  {
    return $this->_SampleType;
  }
  public function _Setlongname(&$Value)
  {
    $this->_longname = $Value;
  }
  public function _Getlongname()
  {
    return $this->_longname;
  }
  public function _Setshortname(&$Value)
  {
    $this->_shortname = $Value;
  }
  public function _Getshortname()
  {
    return $this->_shortname;
  }
  public function _SetPrintPriority(&$Value)
  {
    $this->_PrintPriority = $Value;
  }
  public function _GetPrintPriority()
  {
    return $this->_PrintPriority;
  }
  public function _Setdp(&$Value)
  {
    $this->_dp = $Value;
  }
  public function _Getdp()
  {
    return $this->_dp;
  }
  public function _Setunits(&$Value)
  {
    $this->_units = $Value;
  }
  public function _Getunits()
  {
    return $this->_units;
  }
  public function _SetCategory(&$Value)
  {
    $this->_Category = $Value;
  }
  public function _GetCategory()
  {
    return $this->_Category;
  }
  public function _SetPrintable(&$Value)
  {
    $this->_Printable = $Value;
  }
  public function _GetPrintable()
  {
    return $this->_Printable;
  }
  public function _SetKnownToAnalyser(&$Value)
  {
    $this->_KnownToAnalyser = $Value;
  }
  public function _GetKnownToAnalyser()
  {
    return $this->_KnownToAnalyser;
  }
  public function _SetInUse(&$Value)
  {
    $this->_InUse = $Value;
  }
  public function _GetInUse()
  {
    return $this->_InUse;
  }
  public function _SetAnalyser(&$Value)
  {
    $this->_Analyser = $Value;
  }
  public function _GetAnalyser()
  {
    return $this->_Analyser;
  }
  public function _SetCount()
  {
    $this->counter = 0;
  }
  public function _GetCount()
  {
    return $this->counter;
  }
  public function _IncrCount()
  {
    $this->counter = $this->counter + 1;
  }
  public function PopulateIQ200TestDefinition(&$IQ200TestInstance, $sql): bool
  {
    if ($sql['Code'] != NULL) {
      $IQ200TestInstance->_SetCode($sql['Code']);
    }
    if ($sql['HostCode'] != NULL) {
      $IQ200TestInstance->_SetHostCode($sql['HostCode']);
    }
    if ($sql['SampleType'] != NULL) {
      $IQ200TestInstance->_SetSampleType($sql['SampleType']);
    }
    if ($sql['longname'] != NULL) {
      $IQ200TestInstance->_Setlongname($sql['longname']);
    }
    if ($sql['shortname'] != NULL) {
      $IQ200TestInstance->_Setshortname($sql['shortname']);
    }
    if ($sql['PrintPriority'] != NULL) {
      $IQ200TestInstance->_SetPrintPriority($sql['PrintPriority']);
    }
    if ($sql['dp'] != NULL) {
      $IQ200TestInstance->_Setdp($sql['dp']);
    }
    if ($sql['units'] != NULL) {
      $IQ200TestInstance->_Setunits($sql['units']);
    }
    if ($sql['Category'] != NULL) {
      $IQ200TestInstance->_SetCategory($sql['Category']);
    }
    if ($sql['Printable'] != NULL) {
      $IQ200TestInstance->_SetPrintable($sql['Printable']);
    }
    if ($sql['KnownToAnalyser'] != NULL) {
      $IQ200TestInstance->_SetKnownToAnalyser($sql['KnownToAnalyser']);
    }
    if ($sql['InUse'] != NULL) {
      $IQ200TestInstance->_SetInUse($sql['InUse']);
    }
    if ($sql['Analyser'] != NULL) {
      $IQ200TestInstance->_SetAnalyser($sql['Analyser']);
    }
    return true;
  }
  public function  PopulateIQ200TestDefinitionList(&$sql): array
  {
    include('connecting.php');
    $count = sqlsrv_has_rows($sql);
    if ($count == false) {
      return NULL;
    } else {

      while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)) {

        $NewIQ200Test = new IQ200TestDefinition();
        $NewIQ200Test->PopulateIQ200TestDefinition($NewIQ200Test, $row);
        $this->Add($NewIQ200Test);
      }

      return $this->IQ200TestArray;
    }
  }
  public function GetIQ200TestDefinitionList(): array
  {
    include('connecting.php');
    $sql = "SELECT *FROM IQ200TestDefinitions";
    $res = sqlsrv_query($conn_hq, $sql);
    $this->_SetCount();
    return $this->PopulateIQ200TestDefinitionList($res);
  }
  public function  GetIQ200TestDefinition(&$hostCode): bool
  {
    include('connecting.php');
    $temp = str_replace("'", "", $hostCode);
    $temp2 = str_replace("-", "", $temp);
    $HostCode = $temp2;
    $sql = "SELECT *FROM IQ200TestDefinitions Where HostCode='$HostCode'";
    $res = sqlsrv_query($conn_hq, $sql);
    $row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC);

    if ($rows = sqlsrv_has_rows($res) == true) {
      $this->PopulateIQ200TestDefinition($this, $row);
      return true;
    } else {
      return false;
    }
  }
  public static function IQ200TestDefinitionExists(&$Code): bool
  {
    include('connecting.php');
    echo $sql = "SELECT *FROM IQ200TestDefinitions Where Code='$Code'";

    $res = sqlsrv_query($conn_hq, $sql);

    if ($rows = sqlsrv_has_rows($res) == true) {
      return true;
    } else {
      return false;
    }
  }
  public function Save(&$ESaveAction): bool
  {
    include('connecting.php');
    $RowAffected = False;
    $sql = "";
    $val1 = $this->_GetCode();
    $val2 = $this->_GetHostCode();
    $val3 = $this->_GetSampleType();
    $val4 = $this->_Getlongname();
    $val5 = $this->_Getshortname();
    $val6 = $this->_GetPrintPriority();
    $val7 = $this->_Getdp();
    $val8 = $this->_Getunits();
    $val9 = $this->_GetCategory();
    $val10 = $this->_GetPrintable();
    $val11 = $this->_GetKnownToAnalyser();
    $val12 = $this->_GetInUse();
    $val13 = $this->_GetAnalyser();
    switch ($ESaveAction) {

      case $this->_GetESaveActionAdd():
        $sql = "insert into IQ200TestDefinitions (Code,HostCode,SampleType,longname,shortname,PrintPriority,dp
        ,units,Category,Printable,KnownToAnalyser,InUse,Analyser) values ('$val1','$val2','$val3','$val4','$val5','$val6','$val7','$val8','$val9','$val10','$val11','$val12','$val3')";
        $res = sqlsrv_query($conn_hq, $sql);
        return true;
      case $this->_GetESaveActionUpdate():
        $sql = "Update IQ200 SET Code='$val1',HostCode='$val2',SampleType='$val3',longname='$val4',shortname='$val5',PrintPriority='$val6',dp='$val7'
          ,units='$val8',Category='$val9',Printable='$val10',KnownToAnalyser='$val11',InUse='$val12',Analyser='$val13' Where Code='$val1' and HostCode='$val2'";
        $res = sqlsrv_query($conn_hq, $sql);
        return true;
        break;
        return false;
    }
  }
  public function Add(&$IQ200TestObj)
  {
    $this->IQ200TestArray[$this->counter] = new IQ200TestDefinition();
    $this->IQ200TestArray[$this->counter] = $IQ200TestObj;
    $this->counter++;
  }
  // public function display2()
  // {
  //    $IQ200Array[0]->display();
  // }
  public function display()
  {
    foreach ($this as $key => $value) {
      echo $key . "=>" . $value;
      echo "\n";
    }
  }
}
// $obj=new IQ200TestDefinition();
// $code="WBC";
// $obj->GetIQ200TestDefinition($code);
// $obj->display();
// echo $obj->_Getunits();
