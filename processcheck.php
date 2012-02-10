<?php
$titleHeader = "RemCheck - Advanced Search Code";

#include_once("../../crcw_proj/crcw/inc/int-header.php"); #path for DEV
#include_once("../../crcw_proj/crcw/inc/int-topbar.php");

include_once("../crcw/inc/int-header.php"); #path for PROD
include_once("../crcw/inc/int-topbar.php");

#Set varibles from data submitted on form.
$Consultant = $_GET['Consultant'];
$StartDate = $_GET['StartDate'];
$EndDate = $_GET['EndDate'];
#$OfficeHours = $_GET['OfficeHours'];
#$Status = 'Closed' ;
#$OpCat = $_GET['OpCat'];
$Fields = $_GET['Fields'];
$string=nl2br($string);

$Empty = $_GET['Empty'] ;

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

if ( $Consultant == "Server Team" ) {
$ConsultantStringStart = ' AND ' ;
$ConsultantStringEnd = '' ;
$ConsultantName = '(\'Assigned Group*+\' = "ITS * CRC Server Group")';
$ConsultantNameProse = "the Server Team" ;  
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

//echo "This search string will find closed or resolved tickets " . $ConsultantNameProse . " " . $action ." " . between ." ". $StartDate . " and " . $EndDate . "" . $ohprose . "<br><br>" ;

echo '<div class="container left"><div class="content"><h1>RemCheck Results</h1><pre>' . $Resolvedstart . "" . $SubmitStart . "" . $StartDate . "" . $Resolvedmid . "" . $SubmitMid . "" . $EndDate . "" . $ResolvedEnd . "" . $SubmitEnd . "" . $oh . "" . $ConsultantStringStart . "" . $ConsultantName . "" . $ConsultantStringEnd . "" . $FieldStringStart . "" . $FieldName . "" . $FieldStringEnd . '</pre>&nbsp;<br /><h2>Instructions</h2>&nbsp;<br /><center><img src="howto-search.png"></center>&nbsp;<br /><form action="index.php"><input class="btn small" type="submit" value="Go Back" /></form></div></div>' ;


include_once("../crcw/inc/int-footer.php");
?>