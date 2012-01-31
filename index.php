<?php
$titleHeader = "RemCheck";
$cssHeader = '<script language="JavaScript" src="datepicker.js" type="text/javascript"></script>';
$jsHeader = '<link href="datepicker.css" rel="stylesheet" />';
//include_once("../../crcw_proj/crcw/inc/int-header.php"); #path for DEV
//include_once("../../crcw_proj/crcw/inc/int-topbar.php");
include_once("../crcw/inc/int-header.php"); #path for PROD
include_once("../crcw/inc/int-topbar.php");
?>

  <div class="container left">
  	<div class="content">
<h1>RemCheck</h1>
<div class="well">
<form id="remForm"> 

<!--Submitted or Closed? <select name="Status">
<option>Submitted</option>
<option>Closed</option>
</select>
<br>
<br>-->
&nbsp;<br />
<fieldset>
<legend>Remedy Guidelines Parameters</legend>
&nbsp;<br />
<label for="Consultant">Group/Consultant:</label> <div class="input"><select name="Consultant" id="Consultant">
<option>All CRC</option>
<option>H&S</option>
<option>Big Dogs</option>
<option>PitCrew</option>
<option>---------------</option>
<option>Aj Romey</option>
<option>Anthony Hom</option>
<option>Alexander Tayts</option>
<option>Bob Gallardo</option>
<option>Brian Palermo</option>
<option>Brian Wankel</option>
<option>David Acoba</option>
<option>Dodi Lota</option>
<option>Gaby Rodriguez</option>
<option>George Dias</option>
<option>Greg Smith</option>
<option>Jay Heyman</option>
<option>Jeremy Fife</option>
<option>Jeremy Tavan</option>
<option>John Nelson</option>
<option>Jon McDermott</option>
<option>Jonathan Parungao</option>
<option>Kevin Tai</option>
<option>Martin Parkhurst</option>
<option>MaryAnn Woodall</option>
<option>Mike Birdwell</option>
<option>Noah Abrahamson</option>
<option>Robin McClish</option>
<option>Rodney Carter</option>
<option>Russell Scheil</option>
<option>Sam Ablao</option>
<option>Sam Kim</option>
<option>Shahn Karp</option>
<option>Tom Chou</option>
<option>Troy Hernandez</option>
<option>Tyler Cooper</option>
<option>Varun Tansuwan</option>
<option>Will Alfonso</option>
<option>William Mingle</option>
<option>William Wong</option>

</select></div>
<br>
<br>
<label for="StartDate">Start Date:<span style="color: red;">*</span></label> <div class="input"><input type="text" name="StartDate" id="StartDate" readonly onClick="GetDate(this);" /></div><br />
<label for="EndDate">End Date:<span style="color: red;">*</span></label> <div class="input"><input type="text" name="EndDate" id="EndDate" readonly onClick="GetDate(this);" /></div>
<br>
<br>
<!--Office Hours Included? <select name="OfficeHours">
<option>Yes</option>
<option>No</option>
</select>
<br><br>-->
<label for="Fields">Field(s) to Check?</label> <div class="input"><select name="Fields" id="Fields">
<option>All</option>
<option>Incident Type*</option>
<option>Operational Categorization Tier 1</option>
<option>Operational Categorization Tier 2</option>
<option>Operational Categorization Tier 3</option>
<option>Resolution</option>
<option>Resolution Method</option>
</select></div>
<br><br>
<label for="Empty">Completed or Empty?</label> <div class="input"><select name="Empty" id="Empty">
<option>Complete</option>
<option selected>Empty</option>
</select></div>
</div>
<br />
<div class="row">
	<div class="span2 offset9">
		<input id="submit" type="submit" class="btn primary" value="Generate" />
	</div>
</div>
</fieldset>
</form>
<script>
$(function(){
    $("#remForm").submit(function(e){
       e.preventDefault();

		if ( $("#StartDate").val() < 1 || $("#EndDate").val() < 1 )
		{
			$(".help-inline").remove();
			if ( $("#StartDate").val() < 1 ) {
			$("#StartDate").after( '<span class="help-inline" style="color: red;"> start date required</span>' );
			}
			if ( $("#EndDate").val() < 1 ) {
			$("#EndDate").after( '<span class="help-inline" style="color: red;"> end date required</span>' );
			}
		}
		else if ( $("#StartDate").val() > $("#EndDate").val() )
		{
			$(".help-inline").remove();
			$("#EndDate").after( '<span class="help-inline" style="color: red;"> end date is before start date</span>' );
		}
		else
		{

        dataString = $("#remForm").serialize();

        $.ajax({
        type: 'get',
        url: 'processcheck.php',
        data: dataString,
        dataType: "html",
        success: function(data) {
        
			var shah = '<pre>' + $( data ).contents().find('pre').text() + '</pre>';
			$(".help-inline").remove();
			
            $('#theresults').empty().append( shah );
            $('#mymodal').modal({
				show : true,
				keyboard : true,
				backdrop : true
			});
        	}
        });         
        } 

    });
});
</script>

<div id="mymodal" class="modal fade">
	<div class="modal-header">
		<h2>RemCheck Results</h2>
	</div>
	<div class="modal-body">
	Paste the following code into a Remedy advanced search.<br />
	    <p><div id="theresults"></div></p>
	</div>
</div>


</div>
</div>
<?php
//include_once("../../crcw_proj/crcw/inc/int-footer.php");
include_once("../crcw/inc/int-footer.php");

?>