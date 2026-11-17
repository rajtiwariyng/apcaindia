@include('Admin::common-file.header')
@include('Admin::common-file.sidebar')
<style type="text/css">
  
</style>
<?php
  $pageurl =  Request::segment(2);
$pagetitle="Manage coursepage";
 ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="content-wrapper moncord-navigator-main-container">
 <section class="content-header">
      <h1 class="info-box-text">{{$pagetitle}}      
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i>Admin</a></li>
        <li class="active">{{$pagetitle}} </li>
      </ol>
    </section>

  <section class="content">
    <div class="moncord-navigator-container">
       
        <div class="moncord-navi-main-container mnCreatReports Documents">
          <div class="row">
            <div class="Start_Transaction_container">
              <div class="documentsBox">
                <div class="documentsBoxTopFlex">
                   <div class="searchBox">
                    <input class="form-control searchwidth" id="search" value="" onkeydown="if (event.keyCode == 13) ajaxLoad('{{url('admin/coursepage/listing')}}?search='+this.value)" placeholder="Search by title" name="search" type="text" id="search" autocomplete="off" />
                   <!--  <button><i class="fa fa-search"></i></button> -->
                   <button type="submit" onclick="ajaxLoad('{{url('admin/coursepage/listing')}}?search='+$('#search').val())"
                    >
                       <i class="fa fa-search"></i>
                    </button>

                  </div>                  
                  <div class="btn" onclick="gotopage('coursepage/create')">Add Course Page</div>
                </div>

                <div class="documentTable"  id="content">
                  @include('Admin::coursepage_ajax')                 
                </div>
                  <div class="loading">
                    <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i><br/>
                    <span></span>
                 </div>
              
                <div class="totalCountDocuments">
                  <p><strong>Total Record</strong> : {{count($bannerifo)}}</p>
                </div>
              </div>
            </div>

          </div>
        </div>
    </div>

  </section>
</div>

<!--  -->
<script>
    function abc(count){
    document.getElementById('shortMsg'+count).style.display="none";
    document.getElementById('longMsg'+count).style.display="block" ;
        
    }
  </script>

<div class="control-sidebar-bg"></div>

</div>
<!-- Modal -->
<div id="deletebtn" class="modal fade" role="dialog" >
<div class="modal-dialog" style="width:340px !important;">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<input type="hidden" id="rowidd" name="rowidd" />
<h4 class="modal-title">Are you sure you want to delete ?</h4>
</div>            
<div class="modal-body" style="text-align: center;">
<button type="button" class="btn btn-danger btn-sx" onclick=" return deleterow()" >Delete</button>&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-success btn-sx" data-dismiss="modal">Cancel</button>
</div>      
<span id="deleteresponse" style="margin-left: 32px;"></span>
</div>
</div>
</div>
<!-- Modal -->


 @include('Admin::common-file.footer') 

<script type="text/javascript">
function deletefunction(userid)
{   
$("#rowidd").val(userid);
$("#deletebtn").modal("show");


}

/**/
function deleterow()
{
var useridd =$("#rowidd").val();
var formdata={'useridd':useridd,'table':'courses','colmn':'uniqueid'};
var myJSON = JSON.stringify(formdata);
//console.log(myJSON);
//return false
$.ajax({    
headers: {'X-CSRF-Token':'{{ csrf_token() }}'}, 
type: 'POST',
url: "{{url('admin/deletecoursepage')}}",
data: myJSON,
cache: false,
contentType: false,
processData: false,
success:function(response) 
{

//var response=JSON.parse(response);
var resmessage =response.msg;
var statusmessage = response.status;

if(statusmessage=="200")
{
$("#deleteresponse").css("color","#ff0000");
$("#deleteresponse").html(resmessage);
setTimeout(function(){ location.reload();} ,3000);
}
else
{ 

$("#deleteresponse").css("color","#ff0000");
$("#deleteresponse").html(resmessage);
}


}

});
return false;
}

</script>
<script type="text/javascript">

$( document ).ready(function() {
   $(".pagination a").addClass("intro");
});

    $(document).on('click', 'a.intro', function (event) {
    event.preventDefault();
    ajaxLoad($(this).attr('href'));
});

function ajaxLoad(filename, content) {
    content = typeof content !== 'undefined' ? content : 'content';
//console.log(filename);
//return false;
    $('.loading').show();
    $.ajax({
        type: "GET",
        url: filename,
        contentType: false,
        success: function (data) {
            $("#" + content).html(data);
            //console.log(data);
            $('.loading').hide();
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}
</script>

<script>

function check_status(id)
{
   
   var tblname='courses';
   var status_val;
   var id=id;
   var new_value="check_box"+"_"+id;
   
   var check_box_1= document.getElementById("check_box"+"_"+id).checked;
      
   if(check_box_1==true)
   {
    status_val="1";     
   }
   else
   {    
     status_val="0";
   }
  
    $.ajax({
      headers: {'X-CSRF-Token':'{{ csrf_token() }}'},   
      method: "POST",
      url: "{{url('/admin/coursepage/coursepage_status')}}",
      data: { id: id, status: status_val,tblname: tblname},
      success:function(response) 
      {
        //console.log(response);
      //  return false;
         if(response=="1")
         {

           if(status_val=="1")
           {
             document.getElementById("check_box"+"_"+id).checked="true";
           }
            else
           {
              document.getElementById("check_box"+"_"+id).checked="";
           }
           
         }
          if(response=="3")
         {              
             $('#notdeleteModal').modal('show');
             document.getElementById("check_box"+"_"+id).checked="true";   
         }
        
      }

    })    
  
}
</script>


