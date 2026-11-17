@include('Admin::common-file.header')
@include('Admin::common-file.sidebar')

<?php
if(count($data)>0)
{
 $uniqueid=$data[0]->uniqueid;
 $course_id=$data[0]->course_id;
 $title=$data[0]->title;
 $content =$data[0]->content ;
 $image=$data[0]->image;
 $order=$data[0]->order;
 $created_at=$data[0]->created_at;

 $btnName="Update";
 $pagetitle="Update course module";
 $status=$data[0]->status;
}
else
{
$uniqueid =  "";//Request::segment(3);
 $course_id =$course_id;
 $title='';
 $content ='';
 $image='';
 $order='';
 $created_at='';
$btnName="Add";
$pagetitle="Create course module";

 $status="";

}



//metaTitle metaKeywords metaDesc
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
            <form action=" " onsubmit="return upatecoursemoduledata()" method="POST" enctype="multipart/form-data">
               @csrf
                <div class="form-group">
                    <label for="title">Title<span class="astric">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $title;?>" maxlength="300">
                    <input type="hidden" id="course_id" name="course_id" value="<?php echo $course_id; ?>" maxlength="300">
                </div>
                 

                <div class="form-group">
                    <label for="overview_image">module Image<span class="astric">*</span></label>
                    <label for="" class="al-uploadfile">
                    <span class="error-msg" id="errorMessage"></span>
                    <span class="error-msg" id="errorMsg"></span>
                    <span class="">
                      <input type="file" id="imageidd" name="imageidd" onchange="uploadimg()" value="{{$image}}">
                    </span>                 
                 
                    <input type="hidden" id="image_name" name="image_name" value="{{$image}}">     
                    <input type="hidden" name="imagePath" id="imagePath" value="{{$image}}" >
                    <span id="error17" style="color:red"></span>
                    </label>

                    <div id="edit_image">
                    @if($image!="")
                      <img src="{{url('/')}}/assets/upload/coursemodule/{{$image}}" class="img-responsive maxheightclass">
                    @endif
                    </div>
                    <p class="" id="imgTest"> </p>
                </div> 

                <div class="form-group">
                  <label for="content">content <span class="astric">*</span></label>                 
                  <textarea rows="5" class="form-control ckeditor" id="content" name="content"><?php echo $content;?></textarea>                    
                </div>
                <div class="form-group">
                    <label for="order">Order<span class="astric">*</span></label>
                    <input type="text" class="form-control" id="order" name="order" value="<?php echo $order;?>" maxlength="2">     
                </div>
                   
                  
                  
                <div class="form-group">
                    <label for="">Publishing options <span class="astric"></span></label>
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
  function upatecoursemoduledata()
  {
    
    var title = $("#title").val();
    var course_id  = $("#course_id").val();

    var imageidd =document.getElementById("imageidd").value.trim();
    var imageidd = $('#imageidd')[0].files[0];
    var image_name = $("#image_name").val();
    var imagePath = $("#imagePath").val();

    var content = CKEDITOR.instances['content'].getData();
    var order = $("#order").val();

    var publishingOption = $("#publishingOption").val();
        

     if(title =='')
        {
        document.getElementById("wordCnt").innerHTML="Please enter title." ;
        $("#title").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#title").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        }
        

     if(imageidd =='')
        {
        document.getElementById("wordCnt").innerHTML="Please choose image." ;
        $("#imageidd").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#imageidd").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        }
         
         if('{{$uniqueid}}' ==""){
         if(imageidd ==undefined)
        {
        document.getElementById("wordCnt").innerHTML="Please choose image." ;
        $("#imageidd").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#imageidd").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        }
        }
         

         

       if(content =='')
        {
        document.getElementById("wordCnt").innerHTML="Please enter content." ;
        $("#content").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#content").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        } 

       
         if(order =='')
        {
        document.getElementById("wordCnt").innerHTML="Please enter order" ;
        $("#order").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#order").css("border","#d3d3d3 solid 1px"); 
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
        form.append('title', title);
        form.append('course_id', course_id);      
        form.append('content', content);
        form.append('order', order);
        
        form.append('imageidd', imageidd);      
        form.append('image_name', image_name);  
        form.append('imagePath', imagePath);   

        form.append('publishingStatus', publishingOption);
        form.append('uniqueid', '{{$uniqueid}}');

   $("#pleasewaitimage").css('display','block'); 
  // console.log('datat:');
        $.ajax({
          headers: {'X-CSRF-Token':'{{ csrf_token() }}'},
          type:'POST',
          url: "{{url('/admin/coursemodule/addupdate')}}",
          data:form, 
          contentType: false,
          processData: false,
          success:function(data){
           console.log(data);
         $("#pleasewaitimage").css('display','none'); 
       //   $("#btnSubmit").attr("disabled", true);
            
             document.getElementById("wordCnt").innerHTML="" ; 
             document.getElementById("wordCnt").style.color = "#ff0000";
             var status = data.status;
             var msg = data.msg;            
             var course_id = data.course_id;            
          
            if(status=="200"){
              document.getElementById("wordCnt").style.color = "#278428";
              document.getElementById("wordCnt").innerHTML=msg;           
              setTimeout(function() { window.location = "/admin/coursemodule/listing/" + course_id; }, 2000);
            } else {
              document.getElementById("wordCnt").style.color = "#ff0000";
                  document.getElementById("wordCnt").innerHTML=msg ;
            } 
          }
          }); 

      return false; 
  }
    
   
 var Image_64byte="";
 var filesSelected ="";
  function uploadimg() {
           document.getElementById('error17').innerHTML="";
           var image_name =document.getElementById("image_name").value;
          
           if(image_name!="")
           {
          
             document.getElementById('edit_image').style.display='none';
           }
           
          //$("#hidetxt").css("display", "none");
            var e = document.getElementById("imageidd"),
                t = e.value,
                n = $("#imageidd")[0].files[0].size / 1024;
                if (n > 2048) return document.getElementById("image_name").value = " ", document.getElementById("imageidd").value = "", document.getElementById("errorMsg").style.color = "#ff0000", document.getElementById("errorMsg").innerHTML = "Image size should be less than 2mb", !1;
               var m = document.getElementById("imageidd").value,
                m = m.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, "_");
                m = m.replace(/[^a-zA-Z0-9]/g, "_");
               var l = m.split("_"),
              d = t.substring(t.lastIndexOf(".") + 1).toLowerCase(),
              r = l[3] + "." + d;
          if ("png" != d && "jpeg" != d && "jpg" != d) return document.getElementById("image_name").value = "", document.getElementById("errorMsg").style.color = "#ff0000", document.getElementById("errorMsg").innerHTML = "Image only allows file types of PNG,JPG,JPEG", !1;
          if (document.getElementById("errorMsg").style.color = "", document.getElementById("errorMsg").innerHTML = "", filesSelected = document.getElementById("imageidd").files, filesSelected.length > 0) {
              var g = filesSelected[0],
                  a = new FileReader;
              a.onload = function(e) {
                  var t = e.target.result,
                      n = t.split(",");
                  document.getElementById("imagePath").value = n[1];
                  var m = document.createElement("img");

                  m.src = t, m.className = "img-responsive maxheightclass", document.getElementById("imgTest").innerHTML = m.outerHTML, document.getElementById("image_name").value = r, Image_64byte = document.getElementById("imgTest").innerHTML
                  document.getElementById('edit_image').style.display='none';
                
              }, a.readAsDataURL(g)
          }
    }
  </script>

