<?php
include('mode.php');
include('IQ200.php');
include('IQ200TestDefination.php');
include('Obervation.php');
include('connecting.php');
include('functions.php');

$Orderid = "";
$TestRequests = True;

function findclient()
{
    include('connecting.php');
    $portable = 10001;
    $output = array();
    $options = (strtolower(trim(@PHP_OS)) === 'linux') ? '-atn' : '-an';

    ob_start();
    system('netstat ' . $options);

    foreach (explode("\n", ob_get_clean()) as $line) {
        $line = trim(preg_replace('/\s\s+/', ' ', $line));
        $parts = explode(' ', $line);

        if (count($parts) > 3) {
            $state = strtolower(array_pop($parts));
            $foreign = array_pop($parts);
            $local = array_pop($parts);

            if (!empty($state) && !empty($local)) {
                $final = explode(':', $local);
                $port = array_pop($final);

                if (is_numeric($port)) {
                    $output[$state][$port] = $port;
                }
            }
        }
    }

    $check = ($output['established']);

    if (in_array($portable, $check)) {

        return 0;
    } else {

        return 1;
    }
}

function Explicit($arr): string
{
    $array = (explode("|", $arr));
    unset($array[0]);
    $msg2 = implode("|", $array);
    return $msg2;
}

function checksymbol($msg)
{
    $arr = (explode("|", $msg));
    $str1 = $arr[0];
    $arr1 = str_split($str1);
    $count = count($arr1);
    $msg2 = $arr1[$count - 1];
    return $msg2;
}

$ENQ = "05";
$EOT = "04";
$ETX = "03";
$ACK = "06";
$x1 = "UWAMResultIPAddress";
$x2 = "UWAMResultPort";
$val1 = "127.0.0.1";
$val2 = "8080";

  $host="10.124.208.39";
    $port=10001;
$socket = socket_create(AF_INET, SOCK_STREAM, 0)
    or die('NOT CREATED');
$result = socket_bind($socket, $host, $port) or die('not binding');
$result = socket_listen($socket, 3) or die('not listening');


while (true) {
    $accept = socket_accept($socket) or die('not accept');
    while (true) {
        $msg = socket_read($accept, 1024);

        if ($msg != "") {
            $msg = str_replace("'", "''", $msg);
            LogTrace($msg, $Orderid);



            $str = bin2hex($msg);

            if ($str == $EOT) {
                $Orderid = "";
            } else {


                if ($TestRequests) {
                    if ($Orderid != "") {
                        $TestRequests = False;
                    }
                }
                $flag = 0;
                $DATA = $msg;
                $msg = checksymbol($DATA);
                $msg2 = Explicit($DATA);
                $msg2 = $msg . "|" . $msg2;
                if ($msg == 'H') {
                    //Header Message
                } else if ($msg == 'O') {

                    $obj = new ASTMOrder();
                    $obj = $obj->ParseOrder($msg2);
                    echo $Orderid = intval($obj->_GetSpecimenID()) + 20000000;
                    if (is_numeric($Orderid)) {

                        $data = $ACK;
                    } else {

                        $Orderid = "";
                    }
                } else if ($msg == 'P') {
                    //Patient Message
                } else if ($msg == 'R') {
                    $obj = new ASTMResult();
                    $obj = $obj->ParseResult($msg2);
                    $finalResult = "";
                    $result = $obj->_GetDataMeasurement();
                    $sep = "^";
                    $num = 1;
                    $m = GetStringComponent($result, $sep, $num);
                    echo $result1 = trim($m, " ");
                    if ($result1 == "RAW" && $Orderid != "") {
                        $UrineResult = new IQ200();
                        $UrineResult->_SetSampleId($Orderid);
                        $UtestId = $obj->_GetUniversalTestID();
                        $UtestId1 = str_replace("^^^", "", $UtestId);
                        $sep = "^";
                        $num = 0;
                        $UtestId2 = GetStringComponent($UtestId1, $sep, $num);

                        $UrineResult->_SetTestCode($UtestId2);
                        $finalResult = GetStringComponent($result, $sep, $num);
                        if (is_numeric($finalResult)) {
                        } else {
                            $finalResult = "";
                        }


                        $TD = new IQ200TestDefinition();
                        if ($TD->GetIQ200TestDefinition($UtestId2)) {

                            $SN = $TD->_Getshortname();
                            $LN = $TD->_Getlongname();
                            $range = $obj->_GetReferenceRanges();
                            $unit = $TD->_Getunits();
                            $val = false;
                            $val2 = "";
                            $UrineResult->_SetShortName($SN);
                            $UrineResult->_SetLongName($LN);
                            $UrineResult->_SetResult($finalResult);
                            $UrineResult->_SetRange($range);
                            $UrineResult->_SetWorklistPrinted($val);
                            $date = $obj->_GetDateTimeTestCompleted();
                            $dateandtime = ParseDateyyyyMMddhhmmss($date);
                            $UrineResult->_SetDateTimeOfRecord($dateandtime);
                            $UrineResult->_SetValidated($val);
                            $UrineResult->_SetPrinted($val);
                            $UrineResult->_SetValidatedBy($val2);
                            $UrineResult->_SetPrintedBy($val2);
                            $UrineResult->_SetUnit($unit);


                            if ($UrineResult->IQ200Exist($Orderid, $UtestId2)) {

                                $bit = 1;
                            } else {
                                $bit = 0;
                            }
                            $UrineResult->Save($bit);
                        }

                        $finalResult = intval($finalResult);
                        $UtestId2=str_replace("'","",$UtestId2);
                        if ($UtestId2 == 'WBC' || $UtestId2 == 'RBC' || $UtestId2 == 'EC' || $UtestId2 == 'XTAL') {
                            if ($UtestId2 == 'WBC') {


                                $demo = "Select *from demographics where sampleid='$Orderid'";
                                $query = sqlsrv_query($conn_hq, $demo);

                                while ($row1 = sqlsrv_fetch_array($query)) {

                                    echo $ward = $row1['Ward'];
                                    echo $Clinician = $row1['Clinician'];
                                    echo $gp = $row1['GP'];
                                    $age = str_replace('Yr', '', $row1['Age']?? '');

                                }


                                // $ward='A&E Surg.';
                                // $Clinician='CLIN';
                                // $gp='GPA';
                                $repo = 'I';

                                if ($finalResult < 40 && ($UtestId2 == 'WBC')) {
                                    // $age = 15;
                                    if ($age > 16) {

                                        // $ward = $row1['Ward'];
                                        // $Clinician = $row1['Clinician'];
                                        // $gp = $row1['GP'];

                                        $wards = "Select WardRuleForUWam from wards where text='$ward' and WardRuleForUWam='1'";
                                        $query = sqlsrv_query($conn_hq, $demo);
                                        $ftdata1 = sqlsrv_has_rows($query);

                                        if ($ftdata1 > 0) {  //test this
                                            $repo = 'F';
                                            echo $sql = "IF NOT EXISTS (select * from Observations where sampleid='$Orderid')
                                          
                                             BEGIN
                                          
                                            insert into Observations (SampleID, Discipline,Comment,DateTimeOfRecord,UserName)
                                            Values ('$Orderid','MicroCS','Screened Urine Not Culture',GETDATE(),'UWAM')
                                                    END
ELSE
BEGIN
Update Observations set Comment=Comment + 'Screened Urine Not Culture' where sampleid='$Orderid'
END";

                                            $result=sqlsrv_query($conn_hq, $sql);
                                             if(!$result)
                                             {

                                                   file_put_contents('Errorlogs.txt', "[" . date('Y-m-d H:i:s') . "] " . $sql . PHP_EOL, FILE_APPEND);
                                              }
                                         }


                                    }

                                  
                                }
                                   echo $insertSql = "INSERT INTO dbo.PrintPending (SampleID, Department, Initiator, UsePrinter, FaxNumber, ptime, UseConnection, Hyear, Ward, Clinician, GP, Printed, WardPrint, NoOfCopies, FinalInterim, PrintAction) 
                                    VALUES ($Orderid, 'N', 'UWAM', '', NULL, GETDATE(), NULL, NULL, '$ward', '$Clinician', '$gp', NULL, NULL, 1, '$repo', NULL)";
                                    // exit;
                                  $result=   sqlsrv_query($conn_hq, $insertSql);
  if(!$result)
                                             {

                                                   file_put_contents('Errorlogs.txt', "[" . date('Y-m-d H:i:s') . "] " . $insertSql . PHP_EOL, FILE_APPEND);
                                              }
                                       $sql="insert into PrintValidLog (SampleID, Department,Valid,ValidatedBy, ValidatedDateTime) Values ('$Orderid','U',1,'UWAM',GetDate())";
                                              sqlsrv_query($conn_hq,$sql);
 
                                $code = 'WCC';
                                if ($finalResult < 5) {
                                    $finalResult = "<5";
                                } else if ($finalResult > 200) {
                                    $finalResult = ">200";
                                }
                            } else if ($UtestId2 == 'RBC') {
                                $code = 'RCC';

                                if ($finalResult < 5) {
                                    $finalResult = "<5";
                                } else if ($finalResult > 200) {
                                    $finalResult = ">200";
                                }

                            } else if ($UtestId2 == 'EC') {
                                $ranges = "select *from UwamRanges where Test='Epthelial Cells'";
                                $query = sqlsrv_query($conn_hq, $ranges);
                                if(!$query)
                                             {

                                                   file_put_contents('Errorlogs.txt', "[" . date('Y-m-d H:i:s') . "] " . $ranges . PHP_EOL, FILE_APPEND);
                                              }

                                while ($ftdata = sqlsrv_fetch_array($query)) {
                                    if ($finalResult >= $ftdata['low'] && $finalResult <= $ftdata['high']) {
                                        $finalResult = 'Epithelial Cells ' . $ftdata['symbol'];
                                    }
                                }
                                $code = 'Misc0';


                            } else if ($UtestId2 == 'XTAL') {
                                $ranges = "select *from UwamRanges where Test='Crystals'";
                                $query = sqlsrv_query($conn_hq, $ranges);
                                while ($ftdata = sqlsrv_fetch_array($query)) {
                                    if ($finalResult >= $ftdata['low'] && $finalResult <= $ftdata['high']) {
                                        $finalResult = 'Crystals ' . $ftdata['symbol'];
                                    }
                                    $code = 'Crystals';

                                }

                            }

                            include('connecting.php');
                            echo $sql = "IF EXISTS (select *from Urine where sampleid='$Orderid')
                            BEGIN
                            Update Urine Set $code='$finalResult' where sampleid='$Orderid'
                            End
                            ELSE
                            BEGIN 
                            Insert into Urine (SampleID,$code,Valid,Printed) values ('$Orderid', '$finalResult',1,0)
                            END
                            ";


                           $result= sqlsrv_query($conn_hq, $sql);
  if(!$result)
                                             {

                                                   file_put_contents('Errorlogs.txt', "[" . date('Y-m-d H:i:s') . "] " . $sql . PHP_EOL, FILE_APPEND);
                                              }

                            // if ($finalResult < 40 && ($UtestId2 == 'WBC')) {
                            //     $sql = "insert into Observations (SampleID,Discipline,Comment,UserName,DateTimeOfRecord) values ('$Orderid','Micro','screened urine not culture(final report)','UWAM',GETDATE())";
                            //     $res = sqlsrv_query($conn_hq, $sql);
                            //     $row1 = sqlsrv_fetch_array($query);
                            // }







                        }
                    }
                } else if ($msg == 'C') {
                    $obj = new ASTMComment();
                    $obj = $obj->ParseComment($msg2);
                    if ($Orderid != "") {
                        $OB = new Observation();
                        if (is_numeric($Orderid)) {
                            $OB->_SetSampleID($Orderid);
                        }
                        $dicipline = "MicroGeneral";
                        $com = $obj->_GetCommentText();
                        $sep = "^";
                        $num = 1;
                        $data2 = GetStringComponent($com, $sep, $num);
                        $comment = strtok($data2, '<');
                        $date = date("Y/m/d") . " " . date("h:i:sa");
                        $username = "UWAM";
                        $OB->_SetDiscipline($dicipline);
                        $OB->_SetComment($comment);
                        $OB->_SetDateTimeOfRecord($date);
                        $OB->_SetUserName($username);
                        $data = $ACK;
                        if ($OB->GetObservation($Orderid)) {
                            $bit = 1;
                            $OB->Save($bit);
                        } else {
                            $bit = 0;
                            $OB->Save($bit);
                        }
                    }
                } else if ($msg == 'Q') {

                    $AQ = new ASTMQuery();
                    $AQ = $AQ->ParseQuery($msg2);
                    $range = $AQ->_GetStartingRangeIDNumber();
                    if (is_numeric($range)) {
                        $Orderid = $range;
                        $TestRequests = true;
                        $data = $ACK;
                    } else {
                        $Orderid = "";
                        $TestRequests = False;
                    }
                } else if ($msg == 'L') {

                    //Terminator

                }

                if ($DATA == "") {
                } else {
                    $c_msg = chr(06);
                    socket_write($accept, $c_msg, strlen($c_msg));
                    if ($str != $EOT) {
                        LogTrace($c_msg, $Orderid);
                    }
                }
            }
        }

        $check = findclient();
        if ($check == 1) {
            break;
        }
    }
}
socket_close($socket);
?>