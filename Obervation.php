<?php
trait ESaveAction3
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

class Observation
{
  use ESaveAction3;
  private $_SampleID;
  private $_Discipline;
  private $_Comment;
  private $_UserName;
  private $_DateTimeOfRecord;
  public $counter;
  public $ObservationArray = array();
  public function _SetSampleID(&$Value)
  {
    $this->_SampleID = $Value;
  }
  public function _GetSampleID()
  {
    return $this->_SampleID;
  }
  public function _SetDiscipline(&$Value)
  {
    $this->_Discipline = $Value;
  }
  public function _GetDiscipline()
  {
    return $this->_Discipline;
  }
  public function _SetComment(&$Value)
  {
    $this->_Comment = $Value;
  }
  public function _GetComment()
  {
    return $this->_Comment;
  }
  public function _SetUserName(&$Value)
  {
    $this->_UserName = $Value;
  }
  public function _GetUserName()
  {
    return $this->_UserName;
  }
  public function _SetDateTimeOfRecord(&$Value)
  {
    $this->_DateTimeOfRecord = $Value;
  }
  public function _GetDateTimeOfRecord()
  {
    return $this->_DateTimeOfRecord;
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

  public function PopulateObservation(&$IQ200Instance, $sql): bool
  {
    if ($sql['SampleID'] != NULL) {
      $IQ200Instance->_SetSampleID($sql['SampleID']);
    }
    if ($sql['Discipline'] != NULL) {
      $IQ200Instance->_SetDiscipline($sql['Discipline']);
    }
    if ($sql['Comment'] != NULL) {
      $IQ200Instance->_SetComment($sql['Comment']);
    }
    if ($sql['UserName'] != NULL) {
      $IQ200Instance->_SetUserName($sql['UserName']);
    }
    if ($sql['DateTimeOfRecord'] != NULL) {
      $IQ200Instance->_SetDateTimeOfRecord($sql['DateTimeOfRecord']);
    }
    return true;
  }
  public function PopulateObservationList(&$sql): array
  {

    include('connecting.php');
    $count = sqlsrv_has_rows($sql);
    if ($count == false) {
      return NULL;
    } else {

      while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)) {

        $NewObservation = new Observation();
        $NewObservation->PopulateObservation($NewObservation, $row);
        $this->Add($NewObservation);
      }

      return $this->ObservationArray;
    }
  }
  public function GetObservationList(): array
  {
    include('connecting.php');
    $sql = "SELECT *FROM Observations";
    $res = sqlsrv_query($conn_hq, $sql);
    $this->_SetCount();
    return $this->PopulateObservationList($res);
  }
  public function GetObservation(&$SampleID): bool
  {
    include('connecting.php');
    $sql = "SELECT *FROM Observations Where SampleID='$SampleID'";
    $res = sqlsrv_query($conn_hq, $sql);
    $row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC);

    if ($rows = sqlsrv_has_rows($res) == true) {
      $this->PopulateObservation($this, $row);
      return true;
    } else {
      return false;
    }
  }
  public function ObservationExists(&$SampleID, &$Discipline): bool
  {
    include('connecting.php');
    $sql = "SELECT *FROM Observations Where SampleId='$SampleID' and Discipline='$Discipline'";
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
    $val1 = $this->_GetSampleID();
    $val2 = $this->_GetDiscipline();
    $val3 = $this->_GetComment();
    $val4 = $this->_GetUserName();
    $val5 = $this->_GetDateTimeOfRecord();
    if ($ESaveAction == 0) {


      $sql = "insert into Observations (SampleID,Discipline,Comment,UserName,DateTimeOfRecord) values ('$val1','$val2','$val3','$val4','$val5')";
      $res = sqlsrv_query($conn_hq, $sql);

      return true;
    } else if ($ESaveAction == 1) {


      $sql = "Update Observations SET SampleID='$val1',Discipline='$val2',Comment='$val3',UserName='$val4',DateTimeOfRecord='$val5' Where SampleID='$val1' and Discipline='$val2'";
      $res = sqlsrv_query($conn_hq, $sql);
      return true;
    }
    return false;
  }
  public function Add(&$ObservationObj)
  {
    $this->ObservationArray[$this->counter] = new Observation();
    $this->ObservationArray[$this->counter] = $ObservationObj;
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
    }
  }
}

// $IQ200Array=array();
// $IQ200Array=$obj->GetObservationList();
// print_r($IQ200Array);
