<?php

set_error_handler (
    function($errno, $errstr, $errfile, $errline) {
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);     
    }
);
class ASTMHeader
{
    Private $_RecordType;
    Private $_DelimeitersDefinition;
    Private $_MessageControlID;
    Private $_AccessPassword;
    Private $_SenderNameOrID;
    Private $_SenderStreetAddress; 
    Private $_ReservedField ;
    Private $_SenderPhoneNumber; 
    Private $_CharacteristicsOfSender ;
    Private $_ReceiverID;
    Private $_CommentOrSpecialIns;
    Private $_ProcessingID ;
    Private $_VersionNumber ;
    Private $_MessageDateAndTime ;
    public function _SetRecordType(&$Value)
    {
        $this->_RecordType = $Value; 
    }
    public function _GetRecordType()
    {
        return $this->_RecordType;
    }
    public function _SetDelimeitersDefinition(&$Value)
    {
        $this->_DelimeitersDefinition=$Value;
       
    }
    public function _GetDelimeitersDefinition()
    {
        return $this->_DelimeitersDefinition;
    }
    public function  _SetMessageControlID(&$Value)
    {
        $this->_MessageControlID=$Value;
    }
    public function _GetMessageControlID()
    {
        return $this->_MessageControlID;
    }
    public function _SetAccessPassword(&$Value)
    {
        $this->_AccessPassword=$Value;
    
    }
    public function _GetAccessPassword()
    {
        return $this->_AccessPassword;
    }
    public function _SetSenderNameOrID(&$Value)
    {
        $this->_SenderNameOrID=$Value;
    }  
    public function _GetSenderNameOrID()
    {
        return $this->_SenderNameOrID;
    }
    
    public function _SetSenderStreetAddress(&$Value)
    {
        $this->_SenderStreetAddress=$Value;
        
    }
    public function _GetSenderStreetAddress()
    {
        return $this->_SenderStreetAddress;
    }
    public function  _SetReservedField(&$Value)
    {
        $this->_ReservedField=$Value;
    }
    public function  _GetReservedField()
    {
        return $this->_ReservedField;
    }
    public function  _SetSenderPhoneNumber(&$Value)
    {
        $this->_SenderPhoneNumber=$Value;
    }
    public function  _GetSenderPhoneNumber()
    {
        return $this->_SenderPhoneNumber;
    }
    public function  _SetCharacteristicsOfSender(&$Value)
    {
        $this->_CharacteristicsOfSender=$Value;
        
    }
    public function  _GetCharacteristicsOfSender()
    {
        return $this->_CharacteristicsOfSender;
    }
    public function  _SetReceiverID(&$Value)
    {
        $this->_ReceiverID=$Value;
    }
    public function  _GetReceiverID()
    {
        return $this->_ReceiverID;
    }
    public function _SetCommentOrSpecialIns(&$Value)
    {
        $this->_CommentOrSpecialIns=$Value;  
    }
    public function  _GetCommentOrSpecialIns()
    {
        return $this->_CommentOrSpecialIns;
    }
    public function _SetProcessingID(&$Value)
    {
        $this->_ProcessingID=$Value;
       
    }
    public function  _GetProcessingID()
    {
        return $this->_ProcessingID;
    }
    public function _SetVersionNumber(&$Value)
    {
        $this->_VersionNumber=$Value;
    }
    public function  _GetVersionNumber()
    {
        return $this->_VersionNumber;
    }
    public function  _SetMessageDateAndTime(&$Value)
    {
        $this->_MessageDateAndTime=$Value;
    }
    public function  _GetMessageDateAndTime()
    {
        return $this->_MessageDateAndTime;
    }
    public function GenerateHeader(&$FrameNumber):string
    {
        $HeaderRecord=$FrameNumber;
        try
        {
        foreach ($this as $key => $value) 
        {
            if($value==''||$value==NULL)
            {
               $HeaderRecord=$HeaderRecord."|";
            }
            else{
               $HeaderRecord=$HeaderRecord.$value."|";
            }
        }
        return $HeaderRecord;
    }
    catch(Exception $ex)
    {
        echo " Class: ASTMHeader Function: GenerateHeader"  .$ex->getMessage();
        return $HeaderRecord;
    }
       
    }
    public static function ParseHeader(&$HeaderRecord) : ASTMHeader
    {
       $AR=new ASTMHeader();
       $ComponentIndex=0;
       $Components="";
       try
       {
       $Components = explode("|", $HeaderRecord);
       $counter=count($Components);
       if($counter>0)
       {
       foreach ($AR as $key => &$value) 
       {
        $value=$Components[$ComponentIndex];
        $ComponentIndex++;
        if($ComponentIndex>$counter-1)
        {
            break;
        }
       }
       return $AR;
       } 
       else{
        return NULL;
       }
    }
    catch(Exception $ex)
    {
        echo " Class: ASTMHeader Function: ParseHeader"  .$ex->getMessage();
        return NULL;
    }

    }

    public function display()
    {
      
      foreach ($this as $key => $value) 
      {
        echo $key."=>".$value;
        echo".\n";
      }
      
    }

    
}
class ASTMPatient
{
    Private $_RecordType;
    Private $_SequenceNumber ;
    Private $_PracticeAssignedPatientID;
    Private $_LaboratoryAssignedPatientID;
    Private $_PatientIDNo3 ;
    Private $_PatientName ;
    Private $_MothersMaidenName ;
    Private $_BirthDate ;
    Private $_PatientSex ;
    Private $_PatientRace ;
    Private $_PatientAddress ;
    Private $_ReservedField ;
    Private $_PatientTelephone ;
    Private $_AttendingPhysicianID ;
    Private $_SpecialField1 ;
    Private $_SpecialField2 ;
    Private $_PatientHeight ;
    Private $_PatientWeight ;
    Private $_PatientDiagnosis ;
    Private $_PatientMedications ;
    Private $_PatientDiet ;
    Private $_PatientFieldNo1 ;
    Private $_PatientFieldNo2 ;
    Private $_AdmissionDischargeDates ;
    Private $_AdmissionStatus ;
    Private $_Location ;
    Private $_NatureCodeClass ;
    Private $_AlternativeCodeClass ;
    Private $_PatientReligion ;
    Private $_MaritalStatus ;
    Private $_IsolateStatus ;
    Private $_Language ;
    Private $_HospitalService ;
    Private $_HospitalInstitution ;
    Private $_DosageCategory ;
    //getter setters for data members
    public function _SetRecordType(&$Value)
    {
        $this->_RecordType = $Value;
    }
    public function _GetRecordType()
    {
        return $this->_RecordType;
    }
    public function _SetSequenceNumber(&$Value)
    {
        $this->_SequenceNumber = $Value;
    }
    public function _GetSequenceNumber()
    {
        return $this->_SequenceNumber;
    }
    public function _SetPracticeAssignedPatientID(&$Value)
    {
        $this->_PracticeAssignedPatientID = $Value;
    }
    public function _GetPracticeAssignedPatientID()
    {
        return $this->_PracticeAssignedPatientID;
    }
    public function _SetLaboratoryAssignedPatientID(&$Value)
    {
        $this->_LaboratoryAssignedPatientID = $Value;
    }
    public function _GetLaboratoryAssignedPatientID()
    {
        return $this->_LaboratoryAssignedPatientID;
    }
    public function _SetPatientIDNo3(&$Value)
    {
        $this->_PatientIDNo3 = $Value;
    }
    public function _GetPatientIDNo3()
    {
        return $this->_PatientIDNo3;
    }
    public function _SetPatientName(&$Value)
    {
        $this->_PatientName = $Value;
    }
    public function _GetPatientName()
    {
        return $this->_PatientName;
    }
    public function _SetMothersMaidenName(&$Value)
    {
        $this->_MothersMaidenName= $Value;
    }
    public function _GetMothersMaidenName()
    {
        return $this->_MothersMaidenName;
    }
    public function  _SetBirthDate(&$Value)
    {
        $this->_BirthDate = $Value;
    }
    public function  _GetBirthDate()
    {
        return $this->_BirthDate;
    }
    public function _SetPatientSex(&$Value)
    {
        $this->_PatientSex = $Value;
    }
    public function _GetPatientSex()
    {
        return $this->_PatientSex;
    }
    public function _SetPatientRace(&$Value)
    {
        $this->_PatientRace = $Value;
    }
    public function _GetPatientRace()
    {
        return $this->_PatientRace;
    }
    public function _SetPatientAddress(&$Value)
    {
        $this->_PatientAddress = $Value;
    }
    public function _GetPatientAddress()
    {
        return $this->_PatientAddress;
    }
    public function _SetReservedField(&$Value)
    {
        $this->_ReservedField = $Value;
    }
    public function _GetReservedField()
    {
        return $this->_ReservedField;
    }
    public function _SetPatientTelephone(&$Value)
    {
        $this->_PatientTelephone = $Value;
        
    }
    public function _GetPatientTelephone()
    {
        return $this->_PatientTelephone;
    }
    public function _SetAttendingPhysicianID(&$Value)
    {
        $this->_AttendingPhysicianID = $Value;
    }
    public function _GetAttendingPhysicianID(): string
    {
        return $this->_AttendingPhysicianID;
    }
    public function _SetSpecialField1(&$Value)
    {
        $this->_SpecialField1 = $Value;
        return $this->_SpecialField1;
    }
    public function _GetSpecialField1()
    {
        return $this->_SpecialField1;
    }
    public function _SetSpecialField2(&$Value)
    {
        $this->_SpecialField2 = $Value;
    }
    public function _GetSpecialField2()
    {
        return $this->_SpecialField2;
    }
    public function _SetPatientHeight(&$Value)
    {
        $this->_PatientHeight = $Value;
    }
    public function _GetPatientHeight()
    {
        return $this->_PatientHeight;
    }
    public function _SetPatientWeight(&$Value)
    {
        $this->_PatientWeight = $Value;
    }
    public function _GetPatientWeight()
    {
        return $this->_PatientWeight;
    }
    public function _SetPatientDiagnosis(&$Value)
    {
        $this->_PatientDiagnosis = $Value;
    }
    public function _GetPatientDiagnosis()
    {
        return $this->_PatientDiagnosis;
    }
    public function _SetPatientMedications(&$Value)
    {
        $this->_PatientMedications = $Value;
    }
    public function _GetPatientMedications()
    {
        return $this->_PatientMedications;
    }
    public function _SetPatientDiet(&$Value)
    {
        $this->_PatientDiet = $Value;
    }
    public function _GetPatientDiet()
    {
        return $this->_PatientDiet;
    }
    public function _SetPatientFieldNo1(&$Value)
    {
        $this->_PatientFieldNo1 = $Value;
    }
    public function _GetPatientFieldNo1()
    {
        return $this->_PatientFieldNo1;
    }
    public function _SetPatientFieldNo2(&$Value)
    {
        $this->_PatientFieldNo2 = $Value;
    }
    public function _GetPatientFieldNo2()
    {
        return $this->_PatientFieldNo2;
    }
    public function _SetAdmissionDischargeDates(&$Value)
    {
        $this->_AdmissionDischargeDates = $Value;
    }
    public function _GetAdmissionDischargeDates()
    {
        return $this->_AdmissionDischargeDates;
    }
    public function _SetAdmissionStatus(&$Value)
    {
        $this->_AdmissionStatus = $Value;
    }
    public function _GetAdmissionStatus()
    {
        return $this->_AdmissionStatus;
    }
    public function _SetLocation(&$Value)
    {
        $this->_Location = $Value;
    }
    public function _GetLocation()
    {
        return $this->_Location;
    }
    public function _SetNatureCodeClass(&$Value)
    {
        $this->_NatureCodeClass = $Value;
    }
    public function _GetNatureCodeClass()
    {
        return $this->_NatureCodeClass;
    }
    public function _SetAlternativeCodeClass(&$Value)
    {
        $this->_AlternativeCodeClass = $Value;
    }
    public function _GetAlternativeCodeClass()
    {
        return $this->_AlternativeCodeClass;
    }
    public function _SetPatientReligion(&$Value)
    {
        $this->_PatientReligion = $Value;
    }
    public function _GetPatientReligion()
    {
        return $this->_PatientReligion;
    }
    public function _SetMaritalStatus(&$Value)
    {
        $this->_MaritalStatus = $Value;
    }
    public function _GetMaritalStatus()
    {
        return $this->_MaritalStatus;
    }
    public function _SetLanguage(&$Value)
    {
        $this->_Language = $Value;
    }
    public function _GetLanguage()
    {
        return $this->_Language;
    }
    public function _SetIsolateStatus(&$Value)
    {
        $this->_IsolateStatus = $Value;
    }
    public function _GetIsolateStatus()
    {
        return $this->_IsolateStatus;
    }
    public function _SetHospitalService(&$Value)
    {
        $this->_HospitalService = $Value;
    }
    public function _GetHospitalService()
    {
        return $this->_HospitalService;
    }
    public function _SetHospitalInstitution(&$Value)
    {
        $this->_HospitalInstitution= $Value;
    }
    public function _GetHospitalInstitution()
    {
        return $this->_HospitalInstitution;
    }
    public function _SetDosageCategory(&$Value)
    {
        $this->_DosageCategory = $Value;
    }
    public function _GetDosageCategory()
    {
        return $this->_DosageCategory;
    }
    public function GeneratePatient(&$FrameNumber):string
    {
        $PatientRecord=$FrameNumber;
        try
        {
        foreach ($this as $key => $value) 
        {
            if($value==''||$value==NULL)
            {
               $PatientRecord=$PatientRecord."|";
            }
            else{
               $PatientRecord=$PatientRecord.$value."|";
            }
        }
        return $PatientRecord;
    }
    catch(Exception $ex)
    {
        echo " Class: ASTMPatient Function: GeneratePatient"  .$ex->getMessage();
        return $PatientRecord;
    }
    }
    public static function ParsePatient(&$PatientRecord) : ASTMPatient
    {
       $AP=new ASTMPatient();
       $ComponentIndex=0;
       $Components="";
       try
       {
       $Components = explode("|", $PatientRecord);
       $counter=count($Components);
       if($counter>0)
       {
       foreach ($AP as $key => &$value) 
       {
        $value=$Components[$ComponentIndex];
        $ComponentIndex++;
        if($ComponentIndex>$counter-1)
        {
            break;
        }
       }
       return $AP;
       } 
       else{
        return NULL;
       }
    }
    catch(Exception $ex)
    {
        echo " Class: ASTMPatient Function: PaesePatient"  .$ex->getMessage();
        return NULL;
    }

    }

    public function display()
    {
      
      foreach ($this as $key => $value) 
      {
        echo $key."=>".$value;
        echo".\n";
      }
      
    }
}
class ASTMQuery
{
    Private $_RecordType ;
    Private $_SequenceNumber ;
    Private $_StartingRangeIDNumber ;
    Private $_EndingRangeNumber ;
    Private $_UniversalTestID ;
    Private $_RangeOfRequestTimeLimits ;
    Private $_StartingDateTimeOfResultsRequest ;
    Private $_EndingDateTimeOfResultsRequest ;
    Private $_RequestingPhysicianName ;
    Private $_RequestingPhysicianTelephoneNumber ;
    Private $_UserFieldNo1 ;
    Private $_UserFieldNo2 ;
    Private $_RequestedInformationStatusCodes ;
    public function _SetRecordType(&$Value)
    {
        $this->_RecordType = $Value;
    }
    public function _GetRecordType()
    {
        return $this->_RecordType;
    }
    public function _SetSequenceNumber(&$Value)
    {
        $this->_SequenceNumber = $Value;
    }
    public function _GetSequenceNumber()
    {
        return $this->_SequenceNumber;
    }
    public function _SetStartingRangeIDNumber(&$Value)
    {
        $this->_StartingRangeIDNumber = $Value;
    }
    public function _GetStartingRangeIDNumber()
    {
        return $this->_StartingRangeIDNumber;
    }
    public function _SetEndingRangeNumber(&$Value)
    {
        $this->_EndingRangeNumber = $Value;
    }
    public function _GetEndingRangeNumber()
    {
        return $this->_EndingRangeNumber;
    }
    public function _SetUniversalTestID(&$Value)
    {
        $this->_UniversalTestID = $Value;
    }
    public function _GetUniversalTestID()
    {
        return $this->_UniversalTestID;
    }
    public function _SetRangeOfRequestTimeLimits(&$Value)
    {
        $this->_RangeOfRequestTimeLimits = $Value;
    }
    public function _GetRangeOfRequestTimeLimits()
    {
        return $this->_RangeOfRequestTimeLimits;
    }
    public function _SetStartingDateTimeOfResultsRequest(&$Value)
    {
        $this->_StartingDateTimeOfResultsRequest= $Value;
    }
    public function _GetStartingDateTimeOfResultsRequest()
    {
        return $this->_StartingDateTimeOfResultsRequest;
    }
    public function  _SetEndingDateTimeOfResultsRequest(&$Value)
    {
        $this->_EndingDateTimeOfResultsRequest = $Value;
    }
    public function  _GetEndingDateTimeOfResultsRequest()
    {
        return $this->_EndingDateTimeOfResultsRequest;
    }
    public function  _SetRequestingPhysicianName(&$Value)
    {
        $this->_RequestingPhysicianName = $Value;
    }
    public function  _GetRequestingPhysicianName()
    {
        return $this->_RequestingPhysicianName;
    }
    public function  _SetRequestingPhysicianTelephoneNumber(&$Value)
    {
        $this->_RequestingPhysicianTelephoneNumber = $Value;
    }
    public function  _GetRequestingPhysicianTelephoneNumber()
    {
        return $this->_RequestingPhysicianTelephoneNumber;
    }
    public function  _SetUserFieldNo1(&$Value)
    {
        $this->_UserFieldNo1 = $Value;
    }
    public function  _GetUserFieldNo1()
    {
        return $this->_UserFieldNo1;
    }
    public function  _SetUserFieldNo2 (&$Value)
    {
        $this->_UserFieldNo2  = $Value;
    }
    public function  _GetUserFieldNo2 ()
    {
        return $this->_UserFieldNo2 ;
    }
    public function  _SetRequestedInformationStatusCodes (&$Value)
    {
        $this->_RequestedInformationStatusCodes  = $Value;
    }
    public function  _GetRequestedInformationStatusCodes ()
    {
        return $this->_RequestedInformationStatusCodes ;
    }
    public static function ParseQuery(&$QueryRecord) : ASTMQuery
    {
       $AQ=new ASTMQuery();
       $ComponentIndex=0;
       $Components="";
       try
       {
       $Components = explode("|", $QueryRecord);
       $counter=count($Components);
       if($counter>0)
       {
       foreach ($AQ as $key => &$value) 
       {
        $value=$Components[$ComponentIndex];
        $ComponentIndex++;
        if($ComponentIndex>$counter-1)
        {
            break;
        }
       }
       return $AQ;
       } 
       else{
        return NULL;
       }
    }
    catch(Exception $ex)
    {
        echo " Class: ASTMQuery Function: ParseQuery"  .$ex->getMessage();
        return NULL;
    }

    }

    public function display()
    {
      
      foreach ($this as $key => $value) 
      {
        echo $key."=>".$value;
        echo".\n";
      }
      
    }
}
class ASTMOrder
{
         Private $_RecordType ;
        Private $_SequenceNumber ;
        Private $_SpecimenID ;
        Private $_InstrumentSpecimenID ;
        Private $_UniversalTestID ;
        Private $_Priority ;
        Private $_RequestedDateTime ;
        Private $_CollectionDateTime ;
        Private $_CollectionVolumn ;
        Private $_CollectorID ;
        Private $_ActionCode ;
        Private $_DangerCode ;
        Private $_RelevantClinicalInfo ;
        Private $_DateTimeSpecimenReceived ;
        Private $_SpecimenDescriptor ;
        Private $_OrderingPhysician ;
        Private $_PhysicianPhoneNumber ;
        Private $_UserFieldNumber1 ;
        Private $_UserFieldNumber2 ;
        Private $_LaboratoryFieldNo1 ;
        Private $_LaboratoryFieldNo2 ;
        Private $_DateTime ;
        Private $_InstrumentChargeToComputer ;
        Private $_InstrumentSectionID ;
        Private $_ReportTypes ;
        Private $_ReservedField ;
        Private $_LocationOrWard ;
        Private $_NosocomialFlag ;
        Private $_SpecimenService ;
        Private $_SpecimenInstitution ;
        public function _SetRecordType(&$Value)
        {
            $this->_RecordType = $Value;
        }
        public function _GetRecordType()
        {
            return $this->_RecordType;
        }
        public function _SetSequenceNumber(&$Value)
        {
            $this->_SequenceNumber = $Value;
        }
        public function _GetSequenceNumber()
        {
            return $this->_SequenceNumber;
        }
        public function _SetSpecimenID(&$Value)
        {
            $this->_SpecimenID = $Value;
        }
        public function _GetSpecimenID()
        {
            return $this->_SpecimenID;
        }
        public function _SetInstrumentSpecimenID(&$Value)
        {
            $this->_InstrumentSpecimenID = $Value;
        }
        public function _GetInstrumentSpecimenID()
        {
            return $this->_InstrumentSpecimenID;
        }
        public function _SetUniversalTestID(&$Value)
        {
            $this->_UniversalTestID = $Value;
        }
        public function _GetUniversalTestID()
        {
            return $this->_UniversalTestID;
        }
        public function _SetPriority(&$Value)
        {
            $this->_Priority = $Value;
        }
        public function _GetPriority()
        {
            return $this->_Priority;
        }
        public function _SetRequestedDateTime(&$Value)
        {
            $this->_RequestedDateTime= $Value;
        }
        public function _GetRequestedDateTime()
        {
            return $this->_RequestedDateTime;
        }
        public function  _SetCollectionDateTime(&$Value)
        {
            $this->_CollectionDateTime = $Value;
        }
        public function  _GetCollectionDateTime()
        {
            return $this->_CollectionDateTime;
        }
        public function _SetCollectionVolumn(&$Value)
        {
            $this->_CollectionVolumn = $Value;
        }
        public function _GetCollectionVolumn()
        {
            return $this->_CollectionVolumn;
        }
        public function _SetCollectorID(&$Value)
        {
            $this->_CollectorID = $Value;
        }
        public function _GetCollectorID()
        {
            return $this->_CollectorID;
        } public function _SetActionCode(&$Value)
        {
            $this->_ActionCode = $Value;
        }
        public function _GetActionCode()
        {
            return $this->_ActionCode;
        }
        public function _SetDangerCode(&$Value)
        {
            $this->_DangerCode = $Value;
        }
        public function _GetDangerCode()
        {
            return $this->_DangerCode;
        }
        public function _SetRelevantClinicalInfo(&$Value)
        {
            $this->_RelevantClinicalInfo = $Value;
        }
        public function _GetRelevantClinicalInfo()
        {
            return $this->_RelevantClinicalInfo;
        }
        public function _SetDateTimeSpecimenReceived(&$Value)
        {
            $this->_DateTimeSpecimenReceived= $Value;
        }
        public function _GetDateTimeSpecimenReceived()
        {
            return $this->_DateTimeSpecimenReceived;
        }
        public function _SetSpecimenDescriptor(&$Value)
        {
            $this->_SpecimenDescriptor = $Value;
        }
        public function _GetSpecimenDescriptor()
        {
            return $this->_SpecimenDescriptor;
        }
        public function _SetOrderingPhysician(&$Value)
        {
            $this->_OrderingPhysician = $Value;
        }
        public function _GetOrderingPhysician()
        {
            return $this->_OrderingPhysician;
        }
        public function _SetPhysicianPhoneNumber(&$Value)
        {
            $this->_PhysicianPhoneNumber= $Value;
        }
        public function _GetPhysicianPhoneNumber()
        {
            return $this->_PhysicianPhoneNumber;
        }
        public function  _SetUserFieldNumber1(&$Value)
        {
            $this->_UserFieldNumber1 = $Value;
        }
        public function  _GetUserFieldNumber1()
        {
            return $this->_UserFieldNumber1;
        }
        public function _SetUserFieldNumber2(&$Value)
        {
            $this->_UserFieldNumber2 = $Value;
        }
        public function _GetUserFieldNumber2()
        {
            return $this->_UserFieldNumber2;
        }
        //----------
        public function _SetLaboratoryFieldNo1(&$Value)
    {
        $this->_LaboratoryFieldNo1 = $Value;
    }
    public function _GetLaboratoryFieldNo1()
    {
        return $this->_LaboratoryFieldNo1;
    }
    public function _SetLaboratoryFieldNo2 (&$Value)
    {
        $this->_LaboratoryFieldNo2  = $Value;
    }
    public function _GetLaboratoryFieldNo2 ()
    {
        return $this->_LaboratoryFieldNo2;
    }
    public function _SetDateTime(&$Value)
    {
        $this->_DateTime = $Value;
    }
    public function _GetDateTime()
    {
        return $this->_DateTime;
    }
    public function _SetInstrumentChargeToComputer(&$Value)
    {
        $this->_InstrumentChargeToComputer = $Value;
    }
    public function _GetInstrumentChargeToComputer()
    {
        return $this->_InstrumentChargeToComputer;
    }
    public function _SetInstrumentSectionID(&$Value)
    {
        $this->_InstrumentSectionID = $Value;
    }
    public function _GetInstrumentSectionID()
    {
        return $this->_InstrumentSectionID;
    }
    public function _SetReportTypes(&$Value)
    {
        $this->_ReportTypes = $Value;
    }
    public function _GetReportTypes()
    {
        return $this->_ReportTypes;
    }
    public function _SetReservedField(&$Value)
    {
        $this->_ReservedField= $Value;
    }
    public function _GetReservedField()
    {
        return $this->_ReservedField;
    }
    public function  _SetLocationOrWard(&$Value)
    {
        $this->_LocationOrWard = $Value;
    }
    public function  _GetLocationOrWard()
    {
        return $this->_LocationOrWard;
    }
    public function _SetNosocomialFlag(&$Value)
    {
        $this->_NosocomialFlag = $Value;
    }
    public function _GetNosocomialFlag()
    {
        return $this->_NosocomialFlag;
    }
    public function _SetSpecimenService(&$Value)
    {
        $this->_SpecimenService = $Value;
    }
    public function _GetSpecimenService()
    {
        return $this->_SpecimenService;
    }
    public function _SetSpecimenInstitution(&$Value)
    {
        $this->_SpecimenInstitution = $Value;
    }
    public function _GetSpecimenInstitution()
    {
        return $this->_SpecimenInstitution;
    }
    public function GenerateOrder(&$FrameNumber)
    {
        $OrderRecord =$FrameNumber;
        try
        {
        foreach ($this as $key => $value) 
        {
            if($value==''||$value==NULL)
            {
               $OrderRecord=$OrderRecord."|";
            }
            else{
               $OrderRecord=$OrderRecord.$value."|";
            }
        }
        return $OrderRecord;
    }
    catch(Exception $ex)
    {
        echo " Class: ASTMOrder Function: GenerateOrder"  .$ex->getMessage();
        return $OrderRecord;
    }
       
    }
    public static function ParseOrder(&$OrderRecord) : ASTMOrder
    {
       $AO=new ASTMOrder();
       $ComponentIndex=0;
       $Components="";
       try
       {
       $Components = explode("|", $OrderRecord);
       $counter=count($Components);
       if($counter>0)
       {
       foreach ($AO as $key => &$value) 
       {
        $value=$Components[$ComponentIndex];
        $ComponentIndex++;
        if($ComponentIndex>$counter-1)
        {
            break;
        }
       }
       return $AO;
       } 
       else{
        return NULL;
       }
    }
    catch(Exception $ex)
    {
        echo " Class: ASTMOrder Function: ParseOrder"  .$ex->getMessage();
        return NULL;
    }

    }

    public function display()
    {
      
      foreach ($this as $key => $value) 
      {
        echo $key."=>".$value;
        echo".\n";
      }
      
    }

}
class  ASTMResult
{
    Private $_RecordType ;
    Private $_SequenceNumber ;
    Private $_UniversalTestID ;
    Private $_DataMeasurement ;
    Private $_Units ;
    Private $_ReferenceRanges ;
    Private $_ResultAbnormalFlags ;
    Private $_NatureOfAbnormalityTesting ;
    Private $_ResultStatus ;
    Private $_DateOfChange ;
    Private $_OperatorIdentification ;
    Private $_DateTimeTestStarted ;
    Private $_DateTimeTestCompleted ;
    Private $_InstrumentIdentification ;
    public function _SetRecordType(&$Value)
        {
            $this->_RecordType = $Value;
        }
        public function _GetRecordType()
        {
            return $this->_RecordType;
        }
        public function _SetSequenceNumber(&$Value)
        {
            $this->_SequenceNumber = $Value;
        }
        public function _GetSequenceNumber()
        {
            return $this->_SequenceNumber;
        }
        public function _SetUniversalTestID(&$Value)
        {
            $this->_UniversalTestID= $Value;
        }
        public function _GetUniversalTestID()
        {
            return $this->_UniversalTestID;
        }
        public function _SetDataMeasurement(&$Value)
        {
            $this->_DataMeasurement = $Value;
        }
        public function _GetDataMeasurement()
        {
            return $this->_DataMeasurement;
        }
        public function _SetUnits(&$Value)
        {
            $this->_Units = $Value;
        }
        public function _GetUnits ()
        {
            return $this->_Units ;
        }
        public function _SetReferenceRanges(&$Value)
        {
            $this->_ReferenceRanges = $Value;
        }
        public function _GetReferenceRanges()
        {
            return $this->_ReferenceRanges;
        }
        public function _SetResultAbnormalFlags(&$Value)
        {
            $this->_ResultAbnormalFlags= $Value;
        }
        public function _GetResultAbnormalFlags()
        {
            return $this->_ResultAbnormalFlags;
        }
        public function  _SetNatureOfAbnormalityTesting(&$Value)
        {
            $this->_NatureOfAbnormalityTesting = $Value;
        }
        public function  _GetNatureOfAbnormalityTesting()
        {
            return $this->_NatureOfAbnormalityTesting;
        }
        public function _SetResultStatus(&$Value)
        {
            $this->_ResultStatus = $Value;
        }
        public function _GetResultStatus()
        {
            return $this->_ResultStatus;
        }
        public function _SetDateOfChange (&$Value)
        {
            $this->_DateOfChange  = $Value;
        }
        public function _GetDateOfChange ()
        {
            return $this->_DateOfChange ;
        } 
        public function _SetOperatorIdentification(&$Value)
        {
            $this->_OperatorIdentification = $Value;
        }
        public function _GetOperatorIdentification()
        {
            return $this->_OperatorIdentification;
        }
        public function _SetDateTimeTestStarted(&$Value)
        {
            $this->_DateTimeTestStarted= $Value;
        }
        public function _GetDateTimeTestStarted()
        {
            return $this->_DateTimeTestStarted;
        }
        public function _SetDateTimeTestCompleted (&$Value)
        {
            $this->_DateTimeTestCompleted = $Value;
        }
        public function _GetDateTimeTestCompleted ()
        {
            return $this->_DateTimeTestCompleted ;
        } 
        public function _SetInstrumentIdentification(&$Value)
        {
            $this->_InstrumentIdentification = $Value;
        }
        public function _GetInstrumentIdentification()
        {
            return $this->_InstrumentIdentification;
        }
        public function GenerateResult()
        {
            $ResultRecord="";
           try
           {
            foreach ($this as $key => $value) 
            {
                if($value==''||$value==NULL)
                {
                   $ResultRecord=$ResultRecord."|";
                }
                else{
                   $ResultRecord=$ResultRecord.$value."|";
                }
            }
            return $ResultRecord;
          }
          catch(Exception $ex)
          {
              echo " Class: ASTMResult Function: GenerateResult"  .$ex->getMessage();
              return $ResultRecord;
          }
           
        }
        public static function ParseResult(&$ResultRecord) : ASTMResult
        {
           $AR=new ASTMResult();
           $ComponentIndex=0;
           $Component="";
           try
           {
           $Components = explode("|", $ResultRecord);
           $counter=count($Components);
           if($counter>0)
           {
           foreach ($AR as $key => &$value) 
           {
            $value=$Components[$ComponentIndex];
            $ComponentIndex++;
            if($ComponentIndex>$counter-1)
            {
                break;
            }
           }
           return $AR;
           } 
           else{
            return NULL;
           }
        }    catch(Exception $ex)
        {
            echo " Class: ASTMResult Function: ParseResultr"  .$ex->getMessage();
            return NULL;
        }
    
        }
    
        public function display()
        {
          
          foreach ($this as $key => $value) 
          {
            echo $key."=>".$value;
            echo".\n";
          }
          
        }
    
}
Class ASTMComment
{
    Private $_RecordType ;
    Private $_SequenceNumber;
    Private $_CommentSource;
    Private $_CommentText;
    Private $_CommentType;
    public function _SetRecordType(&$Value)
    {
        $this->_RecordType = $Value;
    }
    public function _GetRecordType()
    {
        return $this->_RecordType;
    }
    public function _SetSequenceNumber(&$Value)
    {
        $this->_SequenceNumber = $Value;
    }
    public function _GetSequenceNumber()
    {
        return $this->_SequenceNumber;
    }
    public function _SetCommentSource (&$Value)
    {
        $this->_CommentSource = $Value;
    }
    public function _GetCommentSource()
    {
        return $this->_CommentSource ;
    }
    public function _SetCommentText(&$Value)
    {
        $this->_CommentText = $Value;
    }
    public function _GetCommentText()
    {
        return $this->_CommentText;
    }
    public function _SetCommentType(&$Value)
    {
        $this->_CommentType = $Value;
    }
    public function _GetCommentType()
    {
        return $this->_CommentType;
    }
    public function GenerateComment():string
        {
            $CommentRecord="";
           try
           {
            foreach ($this as $key => $value) 
            {
                if($value==''||$value==NULL)
                {
                   $CommentRecord=$CommentRecord."|";
                }
                else{
                   $CommentRecord=$CommentRecord.$value."|";
                }
            }
            return $CommentRecord;
        }
        catch(Exception $ex)
        {
            echo " Class: ASTMComment Function: GenerateComment"  .$ex->getMessage();
            return $CommentRecord;
        }
           
        }
        public static function ParseComment(&$CommentRecord) :  ASTMComment
        {
           $AC=new  ASTMComment();
           $ComponentIndex=0;
           $Components="";
           try
           {
           $Components = explode("|", $CommentRecord);
           $counter=count($Components);
           if($counter>0)
           {
           foreach ($AC as $key => &$value) 
           {
            $value=$Components[$ComponentIndex];
            $ComponentIndex++;
            if($ComponentIndex>$counter-1)
            {
                break;
            }
           }
           return $AC;
           } 
           else{
            return NULL;
           }
        }
        catch(Exception $ex)
        {
            echo " Class: ASTMComment Function: ParseComment"  .$ex->getMessage();
            return NULL;
        }
    
        }
    
        public function display()
        {
          
          foreach ($this as $key => $value) 
          {
            echo $key."=>".$value;
            echo".\n";
          }
          
        }
    
}
Class ASTMTerminator
{
    Private $_RecordType ;
    Private $_SequenceNumber ;
    Private $_TerminatorCode ;
    public function _SetRecordType(&$Value)
    {
        $this->_RecordType = $Value;
    }
    public function _GetRecordType()
    {
        return $this->_RecordType;
    }
    public function _SetSequenceNumber(&$Value)
    {
        $this->_SequenceNumber = $Value;
    }
    public function _GetSequenceNumber()
    {
        return $this->_SequenceNumber;
    }
    public function _SetTerminatorCode  (&$Value)
    {
        $this->_TerminatorCode  = $Value;
    }
    public function _GetTerminatorCode ()
    {
        return $this->_TerminatorCode ;
    }
    public function GenerateTerminator():string
        {
            $TerminatorRecord="";
           try
           {
            foreach ($this as $key => $value) 
            {
                if($value==''||$value==NULL)
                {
                   $TerminatorRecord=$TerminatorRecord."|";
                }
                else{
                   $TerminatorRecord=$TerminatorRecord.$value."|";
                }
            }
            return $TerminatorRecord;
        }
        catch(Exception $ex)
        {
            echo " Class: ASTMTerminator Function: GenerateTerminator"  .$ex->getMessage();
            return $TerminatorRecord;
        }
           
        }
        public static function ParseTerminator(&$TerminatorRecord) :  ASTMTerminator
        {
           $AT=new  ASTMTerminator();
           $ComponentIndex=0;
           $Components="";
           try
           {
           $Components = explode("|", $TerminatorRecord);
           $counter=count($Components);
           if($counter>0)
           {
           foreach ($AT as $key => &$value) 
           {
            $value=$Components[$ComponentIndex];
            $ComponentIndex++;
            if($ComponentIndex>$counter-1)
            {
                break;
            }
           }
           return $AT;
           } 
           else{
            return NULL;
           }
        }
        catch(Exception $ex)
        {
            echo " Class: ASTMTerminator Function: ParseTerminator"  .$ex->getMessage();
            return NULL;
        }
    
        }
    
        public function display()
        {
          
          foreach ($this as $key => $value) 
          {
            echo $key."=>".$value;
            echo".\n";
          }
          
        }
}
 Function GetStringComponent(&$str,&$Separator,&$ComponentNumber=0) :String
{
$Components="";
$Components = explode($Separator, $str);
$counter=count($Components);
if($counter>$ComponentNumber)
{
return $Components[$ComponentNumber];
}
else{
    return "";
}
}
 function ParseDateyyyyMMddhhmmss(&$DateString):string
{
$NewDate="";
try
{
    $NewDate=substr($DateString,0, 4)."/".
    substr($DateString,4,2)."/".
    substr($DateString, 6,2)." ".
    substr($DateString,8, 2).":".
    substr($DateString,10, 2).":".
    substr($DateString,12,2);
    return $NewDate;
}
catch(Exception $ex)
{
 echo " ModASTM Function: ParseDateyyyyMMddhhmmss"  .$ex->getMessage();
 return $NewDate;
}

}
$msg='5R|1|^^^RBC^A^1^S^000001^01|33.3^RAW|/µl||N||||^^device||20250114105339|UF-5000 4C  ';
$obj=new ASTMResult;
$obj=$obj->ParseResult($msg);
//$obj->display();
   $result = $obj->_GetDataMeasurement();
                $sep = "^";
                $num = 1;
                $m = GetStringComponent($result, $sep, $num);
             echo   $result1 = trim($m, " ");
// $obj=new ASTMComment();
// function Explicit($arr):string
// {
// $array=(explode("|",$arr));
// unset($array[0]);
// $msg2=implode("|",$array);
// return $msg2;
// }
// function checksymbol($msg)
// {
//     $arr=(explode("|",$msg));
//     $str1=$arr[0];
//    $arr1 = str_split($str1);
//    $count=count($arr1);
//    $msg2=$arr1[$count-1];
//    return $msg2;
// }
//  $message="<STX>3C|1||P^Patient Comment<CR><ETX><CHK1><CHK2><CR><LF>";
// $msg=checksymbol($message);
// $msg2=Explicit($message);
// $msg2=$msg."|".$msg2;
// $obj=$obj->ParseComment($msg2);
// $obj->display();
// $m=$obj->_GetDataMeasurement();
// $sep="^";$num=1;
// echo $msg=GetStringComponent($m,$sep,$num);
// $trimmsg=trim($msg);
// echo $trimmsg;
// if($trimmsg=="RAW")
// {
//     echo "yes";
// }
// else
// {
//     echo "no";
// }
// $msg=$obj->_GetDateTimeTestCompleted();
// $str=ParseDateyyyyMMddhhmmss($msg);
// echo $str;
// $data=$obj->_GetCommentText();
// $sep="^";
// $num=1;
// $data2=GetStringComponent($data,$sep,$num);
// $output = strtok($data2,  '<');
// echo $output;

?>