<html>
<head><title>Remedy Record Checker Search String Generator</title></head>
<style type="text/css">
body {
   font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
   font-weight: 300;
}
</style>

<body>
<?php
#Set varibles from data submitted on form.
$Consultant = $_POST['Consultant'];
$StartDate = $_POST['StartDate'];
$EndDate = $_POST['EndDate'];
$OfficeHours = $_POST['OfficeHours'];
$Status = 'Closed' ;
#$OpCat = $_POST['OpCat'];
$Fields = $_POST['Fields'];
$string=nl2br($string);

$Empty = $_POST['Empty'] ;

#if ( $Status == "Closed" ) {
#$action = 'forgot to fill out at least one required field' ;
#} else {
#$action = 'has not yet filled out' ;
#}
#Set office hours prose variable for the words above the search string.  
if ( $OfficeHours == "No" ) {
$ohprose = '.' ;
} else {
$ohprose = ' excluding office hours tickets.' ;
}
#Commented out January 19, 2012 as OH should be included.  Set variable for Office Hours.  Need to change this to OpCat once they are used more.
#if ( $OfficeHours == "No" ) {
#$oh = 'AND (\'Incident Type*\' = $NULL$ OR \'Incident Type*\' != "Project") AND NOT (\'Summary*\'    LIKE "%Office Hours%" OR \'Summary*\' LIKE "%OH%" OR \'Summary*\' LIKE "Team Lead%" OR \'Summary*\' LIKE "%Depot%" or \'Summary*\' LIKE "%office Hours%" OR \'Summary*\' LIKE "%Office hours%" OR \'Summary*\' LIKE "Lab Management" OR \'Summary*\' LIKE "%depot%" OR \'Summary*\' LIKE "%office hours%" OR \'Summary*\' LIKE "BF CO%") ' ;
#} else {
#$oh = '' ;
#}
#set variables for creating the find string around the resolved date
#if ( $Status == "Closed" ) {
$Resolvedstart = '( \'Last Resolved Date\' >= "' ;
$Resolvedmid = ' 8:00:00 AM") AND (\'Last Resolved Date\' <= "' ;
$ResolvedEnd = ' 5:00:00 PM") ' ;
$SubmitStart = '' ;
$SubmitMid = '' ;
$SubmitEnd = '' ;


#} else {
#$Resolvedstart = '' ;
#$Resolvedmid = '' ;
#$ResolvedEnd = '' ;
#$SubmitStart = '( \'Submit Date\' >= "' ;
#$SubmitMid = ' 5:00:00 PM") AND (\'Submit Date\' <= "' ;
#$SubmitEnd = ' 5:00:00 PM") ' ;
#}

if ( $Consultant == "All CRC" ) {
$ConsultantStringStart = ' AND ' ;
$ConsultantStringEnd = '' ;
$ConsultantName = '(\'Assigned Group*+\' = "HR Computer Support" OR \'Assigned Group*+\' = "ITS * CSLI" OR \'Assigned Group*+\' = "ITS * EPGY" OR \'Assigned Group*+\' = "ITS * Earth Sciences"  OR \'Assigned Group*+\' = "ITS * HEPL" OR \'Assigned Group*+\' = "ITS * IT Services" OR \'Assigned Group*+\' = "ITS * Orthopaedic Surgery" OR \'Assigned Group*+\' = "ITS * Pain Management Center" OR \'Assigned Group*+\' = "ITS * Procurement" OR \'Assigned Group*+\' = "ITS * Research Compliance" OR \'Assigned Group*+\' = "ITS * Vaden Health" OR \'Assigned Group*+\' = "ITS * Y2E2" OR \'Assigned Group*+\' = "ITS * GLAM" OR \'Assigned Group*+\' = "ITS * Dean of Research" OR \'Assigned Group*+\' = "ITS * Athletics" OR \'Assigned Group*+\' = "ITS * CFO" OR \'Assigned Group*+\' = "ITS * Internal Audit" OR \'Assigned Group*+\' = "ITS * Nanofabrication" OR \'Assigned Group*+\' = "ITS * OPA" OR \'Assigned Group*+\' = "ITS * Research Admin" OR \'Assigned Group*+\' = "ITS * RiceHadley" OR \'Assigned Group*+\' = "ITS * Stanford Center on Longevity" OR \'Assigned Group*+\' = "ITS * UGA" OR \'Assigned Group*+\' = "ITS * Woods Institute" OR \'Assigned Group*+\' = "ITS * Global Climate" OR \'Assigned Group*+\' = "ITS * H&S" OR \'Assigned Group*+\' = "ITS * General Counsel" OR \'Assigned Group*+\' = "ITS * H&S CrashPlan") AND NOT (\'Assignee+\' = "Fred Broome" OR \'Assignee+\' = "Jamie Martinez" OR \'Assignee+\' = "Julie Reynolds-Grabbe" OR \'Assignee+\' = "Jennifer Honciano")';
$ConsultantNameProse = "All CRC" ;
#Bio-x Removed due to not tracking remedy tickets OR \'Assigned Group*+\' = "ITS * Bio-X"  
} else {

if ( $Consultant == "PitCrew" ) {
$ConsultantStringStart = ' AND ' ;
$ConsultantStringEnd = '' ;
$ConsultantName = '(\'Assigned Group*+\' = "HR Computer Support" OR \'Assigned Group*+\' = "ITS * CSLI" OR \'Assigned Group*+\' = "ITS * EPGY" OR \'Assigned Group*+\' = "ITS * Earth Sciences"  OR \'Assigned Group*+\' = "ITS * HEPL" OR \'Assigned Group*+\' = "ITS * IT Services" OR \'Assigned Group*+\' = "ITS * Orthopaedic Surgery" OR \'Assigned Group*+\' = "ITS * Pain Management Center" OR \'Assigned Group*+\' = "ITS * Procurement" OR \'Assigned Group*+\' = "ITS * Research Compliance" OR \'Assigned Group*+\' = "ITS * Vaden Health" OR \'Assigned Group*+\' = "ITS * Y2E2") AND NOT (\'Assignee+\' = "Fred Broome" OR \'Assignee+\' = "Jamie Martinez" OR \'Assignee+\' = "Julie Reynolds-Grabbe" OR \'Assignee+\' = "Jennifer Honciano")' ;
$ConsultantNameProse = "PitCrew" ;
#Fred Broome, Jamie Martinez, Julie Reynolds-Grabbe and Jennifer Honciano removed as members of queues who are no CRC personnel.  Their tickets should not be found.
} else {

if ( $Consultant == "Big Dogs" ) {
$ConsultantStringStart = ' AND ' ;
$ConsultantStringEnd = '' ;
$ConsultantName = '(\'Assigned Group*+\' = "ITS * GLAM" OR \'Assigned Group*+\' = "ITS * Dean of Research" OR \'Assigned Group*+\' = "ITS * Athletics" OR \'Assigned Group*+\' = "ITS * CFO" OR \'Assigned Group*+\' = "ITS * Internal Audit" OR \'Assigned Group*+\' = "ITS * Nanofabrication" OR \'Assigned Group*+\' = "ITS * OPA" OR \'Assigned Group*+\' = "ITS * Research Admin" OR \'Assigned Group*+\' = "ITS * RiceHadley" OR \'Assigned Group*+\' = "ITS * Stanford Center on Longevity" OR \'Assigned Group*+\' = "ITS * UGA" OR \'Assigned Group*+\' = "ITS * Woods Institute" OR \'Assigned Group*+\' = "ITS * Global Climate")' ;
$ConsultantNameProse = "Big Dogs" ;
#Bio-x Removed due to not tracking remedy tickets OR \'Assigned Group*+\' = "ITS * Bio-X" 
} else {

if ( $Consultant == "H&S" ) {
$ConsultantStringStart = ' AND ' ;
$ConsultantStringEnd = '' ;
$ConsultantName = '(\'Assigned Group*+\' = "ITS * H&S" OR \'Assigned Group*+\' = "ITS * General Counsel" OR \'Assigned Group*+\' = "ITS * H&S CrashPlan")' ;
$ConsultantNameProse = "H&S" ;
} else {
$ConsultantStringStart = ' AND \'Assignee+\' = "' ;
$ConsultantStringEnd = '"' ;
$ConsultantName = $Consultant ;
$ConsultantNameProse = $Consultant ;
}}}}

if ( $Fields == "All" && $Empty == "Empty") {
$FieldStringStart = '' ;
$FieldStringEnd = '' ;
$FieldName = 'AND (\'Operational Categorization Tier 1\' = $NULL$ OR \'Operational Categorization Tier 2\' = $NULL$ OR \'Operational Categorization Tier 3\' = $NULL$ OR \'Incident Type*\' = $NULL$ OR \'Resolution\' = $NULL$ OR \'Resolution Method\' = $NULL$)' ;
$FieldNameProse = "" ;
$FieldNameSpace = "" ;
$action = 'forgot to fill out at least one of the required fields on' ;
} 

if ( $Fields == "All" && $Empty == "Complete") {
$FieldStringStart = '' ;
$FieldStringEnd = '' ;
$FieldName = 'AND (\'Operational Categorization Tier 1\' != $NULL$ AND \'Operational Categorization Tier 2\' != $NULL$ AND \'Operational Categorization Tier 3\' != $NULL$ AND \'Incident Type*\' != $NULL$ AND \'Resolution Method\' != $NULL$)' ;
$FieldNameProse = "" ;
$FieldNameSpace = "" ;
$action = 'filled out all of the required fields on' ;
} 

if ( $Fields !== "All" && $Empty == "Empty") {
$FieldStringStart = ' AND \'' ;
$FieldStringEnd = '\'= $NULL$' ;
$FieldName = $Fields ;
$FieldNameProse = "" ;
$FieldNameSpace = "" ;
}

if ( $Fields !== "All" && $Empty == "Complete") {
$FieldStringStart = ' AND \'' ;
$FieldStringEnd = '\'!= $NULL$' ;
$FieldName = $Fields ;
$FieldNameProse = "" ;
$FieldNameSpace = "" ;
}

echo "This search string will find closed or resolved tickets " . $ConsultantNameProse . " " . $action ." " . between ." ". $StartDate . " and " . $EndDate . "" . $ohprose . "<br><br>" ;

echo "" . $Resolvedstart . "" . $SubmitStart . "" . $StartDate . "" . $Resolvedmid . "" . $SubmitMid . "" . $EndDate . "" . $ResolvedEnd . "" . $SubmitEnd . "" . $oh . "" . $ConsultantStringStart . "" . $ConsultantName . "" . $ConsultantStringEnd . "" . $FieldStringStart . "" . $FieldName . "" . $FieldStringEnd . "" ;



?>
</body></html>