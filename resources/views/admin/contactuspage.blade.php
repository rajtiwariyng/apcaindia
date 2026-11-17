@include('Admin::common-file.header')
@include('Admin::common-file.sidebar')
<?php
//print_r($data['taglinksdata']); 
if(count($data['taglinksdata'])>0){
$id=$data['taglinksdata'][0]->id;
$inhead=$data['taglinksdata'][0]->head;
$endhead=$data['taglinksdata'][0]->body;
$endfooter=$data['taglinksdata'][0]->footer;
$facebook=$data['taglinksdata'][0]->facebook;
$linkedin=$data['taglinksdata'][0]->linkedin;
$youtube=$data['taglinksdata'][0]->youtube;
$email=$data['taglinksdata'][0]->email;
$phone=$data['taglinksdata'][0]->phone;
$tollfree=$data['taglinksdata'][0]->tollfree;
$btn="Save";
}else{
$inhead='';
$endhead='';
$endfooter='';
$facebook='';
$linkedin='';  
$youtube='';
$email='';
$phone='';
$tollfree='';
$id='';
$btn="Save";
}

?>

<style type="text/css">

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
      <h1 class="info-box-text"> {{$btn}} Taglinks
      </h1>
   
    </section>

    <br/><br/>

     <section class="content">
      <div class="row">
          <div class="col-md-1"></div>
            <div class="col-md-12">       
          <div class="box box-info">
            <form action="" onsubmit="return upatetaglinksdata()" enctype="multipart/form-data">
                <h3>You can use the field below to add your custom scripts(javascript) or tags(html).</h3><br/>
                <div class="form-group">
                  <label for="inhead">Scripts from this field will be print in the beginning of HEAD section. Do not place plain text in this. <span class="astric">*</span></label>                 
                  <textarea rows="5" class="form-control ckeditor" id="inhead" name="inhead"><?php echo $inhead;?></textarea>                    
                </div>

                <div class="form-group">
                  <label for="endhead">Scripts from this field will be print in the end of HEAD section. Do not place plain text in this. <span class="astric">*</span></label>                 
                  <textarea rows="5" class="form-control ckeditor" id="endhead" name="endhead"><?php echo $endhead;?></textarea>                    
                </div>

                <div class="form-group">
                  <label for="endfooter">Scripts from this field will be print in the end of Footer section. Do not place plain text in this. <span class="astric">*</span></label>                 
                  <textarea rows="5" class="form-control ckeditor" id="endfooter" name="endfooter"><?php echo $endfooter;?></textarea>                    
                </div>  

                <div class="form-group">
                    <label for="facebook">facebook URL <span class="astric">*</span></label>
                    <input type="text" class="form-control" id="facebook" name="facebook" value="<?=$facebook?>" maxlength="300">
                </div>

                <div class="form-group">
                    <label for="linkedin">linkedin URL <span class="astric">*</span></label>
                    <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?=$linkedin?>" maxlength="300">
                </div>

                <div class="form-group">
                    <label for="youtube">youtube URL <span class="astric">*</span></label>
                    <input type="text" class="form-control" id="youtube" name="youtube" value="<?=$youtube?>" maxlength="300">
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="astric">*</span></label>
                    <input type="text" class="form-control" id="email" name="email" value="<?=$email?>" maxlength="300">
                </div>
                <div class="form-group">
                    <label for="phone">Phone <span class="astric">*</span></label>[add multiple number with comma(,) seperated without space]
                    <input type="text" class="form-control" id="phone" name="phone" value="<?=$phone?>" maxlength="300">
                </div>
                <div class="form-group">
                    <label for="tollfree">Toll Free Support <span class="astric">*</span></label>
                    <input type="text" class="form-control" id="tollfree" name="tollfree" value="<?=$tollfree?>" maxlength="300">
                </div>  
                      
                    <div class="clearfix"></div>
                    <center><div id="wordCnt" style="color:red"></div></center>
                    <div class="clearfix"></div>
                    <div class="al-product-btn">                   
                <input type="button" onclick="goBack()" class="al-attribute" value="Back">
                <input type="submit" id="btnSubmit" class="al-attribute" value="{{$btn}}">
            </div>
        </form>
        
          <div class="col-md-1"></div>
      </div>
    </section>
    
  </div>

 @include('Admin::common-file.footer') 

   <script type="text/javascript">
  function upatetaglinksdata()
  { 
    var facebook = $("#facebook").val();   
    var youtube = $("#youtube").val();   
    var email = $("#email").val();   
    var phone = $("#phone").val();   
    var tollfree = $("#tollfree").val();   
    var linkedin = $("#linkedin").val();   
    var inhead = CKEDITOR.instances['inhead'].getData();    
    var endhead = CKEDITOR.instances['endhead'].getData();    
    var endfooter = CKEDITOR.instances['endfooter'].getData();    


        var form = new FormData();            
        form.append('facebook', facebook);
        form.append('youtube', youtube);
        form.append('email', email);
        form.append('phone', phone);
        form.append('tollfree', tollfree);
        form.append('linkedin', linkedin);
        form.append('inhead', inhead);
        form.append('endhead', endhead);
        form.append('endfooter', endfooter);
        form.append('id', "{{$id}}"); 
            
        $("#pleasewaitimage").css('display','block'); 
        $.ajax({
          headers: {'X-CSRF-Token':'{{ csrf_token() }}'},
          type:'POST',
          url: "{{url('/admin/taglinksdata')}}",
          data:form, 
          contentType: false,
          processData: false,
          success:function(data){
           console.log(data);
            $("#pleasewaitimage").css('display','none');               
             document.getElementById("wordCnt").innerHTML="" ; 
             document.getElementById("wordCnt").style.color = "#ff0000";
             var status = data.status;
             var msg = data.msg;            
          
            if(status=="200"){
              document.getElementById("wordCnt").style.color = "#278428";
              document.getElementById("wordCnt").innerHTML=msg;           
              setTimeout(function() { window.location="/admin/taglinks"; }, 2000);
            } else {
              document.getElementById("wordCnt").style.color = "#ff0000";
                  document.getElementById("wordCnt").innerHTML=msg ;
            } 
          }
          }); 

      return false; 
  }
    
 
  </script>

