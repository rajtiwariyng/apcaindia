@include('Admin::common-file.header')
@include('Admin::common-file.sidebar')

<?php 

if(count($data)>0)
{
 $uniqueid=$data[0]->uniqueid;
 $home=$data[0]->home; 
 $question=$data[0]->question; 
 $answer=$data[0]->answer;
 $created_at=$data[0]->created_at;

 $btnName="Update";
 $pagetitle="Update Faqs";
 $status=$data[0]->status;
}
else
{
$uniqueid =  Request::segment(4);
$question='';
$answer='';
$home='';
$created_at='';
$btnName="Add";
$pagetitle="Create Faqs";
$status="";
}
?>

<style type="text/css">
  .adminUploadbtn input {
    position: absolute;
    top: 0;
    /* opacity: 0; */
    cursor: pointer;
    text-indent: -9999px;
    height: 100%;
    max-width: 113px;
}
 .content-wrapper .btn {
    /* background: #b61d22; */
    padding: 7px 15px;
    border: 0;
    box-shadow: none;
    outline: none;
    color: #fff;
    border-radius: 0px;
    font-size: 14px;
}
</style>
  <div class="content-wrapper">
   
    <section class="content-header">
      <h1 class="info-box-text"> {{$pagetitle}}   
      </h1>
   
    </section>

    <br/><br/>

     <section class="content">
      <div class="row">
          <div class="col-md-1"></div>
            <div class="col-md-12">       
          <div class="box box-info">
            <form action="" onsubmit="return upatecmsdata()">    
               <div class="form-group">
                  <label for="">Question<span class="astric">*</span></label>                              
                  <input type="text" name="question" id="question" placeholder="Enter Your question" class="form-control" value="<?php echo $question;?>">                    
                </div>
                 <div class="form-group">
                  <label for="">Answer <span class="astric">*</span></label>                 
                  <textarea rows="5" class="form-control ckeditor" id="answer" name="answer"><?php echo $answer;?></textarea>                    
                </div>

                <div class="form-group">
                    <label for="">Show on Homepage<span class="astric"></span></label>                 
                <select class="form-control" id="home" name="home">                 
                      <option value="">Please select display options</option>
                      <option value="0" <?php if($home=="0"){echo "selected";}?> >No</option>
                      <option value="1" <?php if($home=="1"){echo "selected";} ?> >Yes</option>                 
                </select>                 
                </div> 
 

                 
                  <div class="form-group">
                    <label for="">Status<span class="astric"></span></label>                  
                         
                    <select class="form-control" id="publishingOption" name="publishingOption">                 
                          <option value="">Please select</option>
                          <option value="1" <?php if($status=="1"){echo "selected";}?> >Published</option>
                          <option value="0" <?php if($status=="0"){echo "selected";} ?> >Unpublished</option>
                    </select>
                  </div> 

                               
                    <div class="clearfix"></div>
                    <div id="wordCnt" style="color:red"></div>
                    <div class="clearfix"></div>
                    <div class="al-product-btn">                   
                <input type="button" onclick="goBack()" class="al-attribute" value="Back">
                <input type="submit" id="btnSubmit" class="al-attribute" value="{{$btnName}}">
            </div>
        </form>
        
          <div class="col-md-1"></div>
      </div>
    </section>
    
  </div>
  <style type="text/css">
    .maxheightclass{
      height:300px;
    }
  </style>
 @include('Admin::common-file.footer') 

   <script type="text/javascript">
  function upatecmsdata()
  {
   
   
    var question = $("#question").val();
    var answer = CKEDITOR.instances['answer'].getData();
    var home = $("#home").val();
    var publishingOption = $("#publishingOption").val();

    if(question =='')
      {
      document.getElementById("wordCnt").innerHTML="Please enter question." ;
      $("#question").css("border","#ff1346 solid 1px"); 
         $("#wordCnt").css("text-align", "center");
      return false;
      }
      else
      {
        $("#question").css("border","#d3d3d3 solid 1px"); 
        document.getElementById("wordCnt").innerHTML="";
      } 
      

      if(answer =='')
        {
        document.getElementById("wordCnt").innerHTML="Please enter answer." ;
        $("#answer").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#answer").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        } 
        
              

  
   
   if(publishingOption =='')
        {
        document.getElementById("wordCnt").innerHTML="Please select publishing options" ;
        $("#publishingOption").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#publishingOption").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        } 



        $("#wordCnt").css("text-align", "center");
        document.getElementById("wordCnt").style.color = "#333333";
        document.getElementById("wordCnt").innerHTML="Please wait..." ;

        var form = new FormData();         
        form.append('question', question);        
        form.append('answer', answer);        
        form.append('home', home);        
        form.append('publishingStatus', publishingOption);   

        form.append('uniqueid', '{{$uniqueid}}');     
   $("#pleasewaitimage").css('display','block'); 
  // console.log('datat:');
        $.ajax({
          headers: {'X-CSRF-Token':'{{ csrf_token() }}'},
          type:'POST',
          url: "{{url('/admin/faqs/addupdate')}}",
          data:form, 
          contentType: false,
          processData: false,
          success:function(data){
           console.log(data);
          // return false;
         $("#pleasewaitimage").css('display','none'); 
       //   $("#btnSubmit").attr("disabled", true);
            
             document.getElementById("wordCnt").innerHTML="" ; 
             document.getElementById("wordCnt").style.color = "#ff0000";
             var status = data.status;
             var msg = data.msg;            
          
            if(status=="200"){
              document.getElementById("wordCnt").style.color = "#278428";
              document.getElementById("wordCnt").innerHTML=msg;           
              setTimeout(function() { window.location = "/admin/faqs/listing"; }, 2000);
            } else {
              document.getElementById("wordCnt").style.color = "#ff0000";
                  document.getElementById("wordCnt").innerHTML=msg ;
            } 
          }
          }); 

      return false; 
  }
  </script>

