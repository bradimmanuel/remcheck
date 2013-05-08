<?php
$crcw_header = array('datepicker','title' => 'CRC RemCheck');

if ($_SERVER['HTTP_HOST'] == 'localhost') {
	include_once("../../crcw_proj/crcw/inc/header.php"); #path for DEV
} else {
	include_once("../crcw/inc/header.php"); #path for PROD
}
?>

  <div class="container left">
  	<div class="content">
  	<div class="row"><div class="span11">
<h1>RemCheck</h1>
&nbsp;<br />
<div class="well">
<form id="remForm" class="form-horizontal legend"> 
<!--Submitted or Closed? <select name="Status">
<option>Submitted</option>
<option>Closed</option>
</select>
<br>
<br>-->
<fieldset>
<legend>Remedy Guidelines Parameters</legend>
&nbsp;<br />
&nbsp;<br />
<div class="control-group">
<label class="control-label" for="Consultant">Group/Consultant:</label><div class="controls"><select name="Consultant" id="Consultant">
<option>All CRC</option>
<option>IT Sharks</option>
<option>Badgers</option>
<option>XST</option>
<option>Server Team</option>
<option>---------------</option>
<option>Aj Romey</option>
<option>Anthony Hom</option>
<option>Alexander Tayts</option>
<option>Bob Gallardo</option>
<option>Brian Palermo</option>
<option>Brian Wankel</option>
<option>David Acoba</option>
<option>Gaby Rodriguez</option>
<option>Gene Ren</option>
<option>George Dias</option>
<option>Greg Smith</option>
<option>Jay Heyman</option>
<option>Jeremy Fife</option>
<option>Jeremy Tavan</option>
<option>Jimmy Nguyen</option>
<option>John Nelson</option>
<option>Jon McDermott</option>
<option>Jonathan Parungao</option>
<option>Karen Zack</option>
<option>Ken Chan</option>
<option>Kevin Tai</option>
<option>Kurt Thompson</option>
<option>Martin Parkhurst</option>
<option>MaryAnn Woodall</option>
<option>Max Nguyen</option>
<option>Mike Birdwell</option>
<option>Michael Wakefield</option>
<option>Noah Abrahamson</option>
<option>Paul Abad</option>
<option>Philip Bailey</option>
<option>Philip Temiyasathit</option>
<option>Robin McClish</option>
<option>Rodney Carter</option>
<option>Sam Ablao</option>
<option>Shannon Santanocito</option>
<option>Todd Boyden</option>
<option>Tom Patterson</option>
<option>Troy Hernandez</option>
<option>Tyler Cooper</option>
<option>Varun Tansuwan</option>
<option>Will Alfonso</option>
<option>William Mingle</option>

</select></div></div>
<br>
<div class="control-group">
<label for="StartDate">Start Date:<span style="color: red;">*</span></label> <div class="controls"><div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input data-datepicker="datepicker" class="small" type="text"  name="StartDate" id="StartDate" readonly /></div></div><br />
<label for="EndDate">End Date:<span style="color: red;">*</span></label> <div class="controls"><div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input data-datepicker="datepicker" class="small" type="text" name="EndDate" id="EndDate" readonly /></div></div>
</div>
<br>
<!--Office Hours Included? <select name="OfficeHours">
<option>Yes</option>
<option>No</option>
</select>
<br><br>-->
<div class="control-group">
<label for="Fields">Field(s) to Check?</label> <div class="controls"><select name="Fields" id="Fields">
<option>All</option>
<option>Incident Type*</option>
<option>Operational Categorization Tier 1</option>
<option>Operational Categorization Tier 2</option>
<option>Operational Categorization Tier 3</option>
<option>Resolution</option>
<option>Resolution Method</option>
</select></div>
<br><br>
<label for="Empty">Completed or Empty?</label> <div class="controls"><select name="Empty" id="Empty">
<option>Complete</option>
<option selected>Empty</option>
</select></div>
</div>
</div>
<br />
<div class="row">
	<div class="span2 offset9">
		<a input id="submit" type="submit" class="btn btn-primary"><i class="icon-refresh icon-white"></i> Generate</a>
	</div>
</div>
</fieldset>
</form>
<script>
$(function(){
    $("#submit").click(function(e){
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
    <script>
      /* Update datepicker plugin so that MM/DD/YYYY format is used. */
      $.extend($.fn.datepicker.defaults, {
        parse: function (string) {
          var matches;
          if ((matches = string.match(/^(\d{2,2})\/(\d{2,2})\/(\d{4,4})$/))) {
            return new Date(matches[3], matches[1] - 1, matches[2]);
          } else {
            return null;
          }
        },
        format: function (date) {
          var
            month = (date.getMonth() + 1).toString(),
            dom = date.getDate().toString();
          if (month.length === 1) {
            month = "0" + month;
          }
          if (dom.length === 1) {
            dom = "0" + dom;
          }
          return month + "/" + dom + "/" + date.getFullYear();
        }
      });  
    </script>
</div></div>
</div>
</div>
<?php

if ($_SERVER['HTTP_HOST'] == 'localhost') {
	include_once("../../crcw_proj/crcw/inc/int-topbar.php");
} else {
	include_once("../crcw/inc/int-footer.php");
}

?>