@include('Admin::common-file.header')
@include('Admin::common-file.sidebar')

<?php 
if(count($data)>0)
{
 $uniqueid=$data[0]->uniqueid;
 $title=$data[0]->title;
 $slug=$data[0]->slug;
 $description=$data[0]->description; 
 $image=$data[0]->image;
 $img_alt=$data[0]->img_alt;
 $category=$data[0]->category;
 $blog_short_desc=$data[0]->blog_short_desc;

 $created_at=$data[0]->created_at;

 $metaTitle=$data[0]->metatitle;
 $metaKeywords=$data[0]->metakeywords;
 $metaDesc=$data[0]->metadesc;
////metatitle metakeywords metadesc  
 $btnName="Update";
 $pagetitle="Update blog information";
 $status=$data[0]->status;
}
else
{
$uniqueid =  "";//Request::segment(3);
$title='';
$slug='';
$blog_short_desc='';
$description='';
$image='';
$img_alt='';
$category='';

$created_at='';
$btnName="Add";
$pagetitle="Create blog information";

 $metaTitle="";
 $metaKeywords="";
 $metaDesc="";
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

<?php 
$getcategory=DB::table('tbl_blog_category')->where('status','=','1')->get();
?>
     <section class="content">
      <div class="row">
          <div class="col-md-1"></div>
            <div class="col-md-12">       
          <div class="box box-info">
            <form action="" onsubmit="return upatecmsdata()">    
             <div class="form-group">
                    <label for="">Blog Image<span class="astric">*</span></label>
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
                <img src="{{url('/')}}/assets/upload/blog/{{$image}}" class="img-responsive maxheightclass">
                @endif
                    </div>
                    <p class="" id="imgTest"> </p>
                </div> 
                <div class="form-group">
                    <label for="">Img Alt <span class="astric">*</span></label>
                    <input type="text" class="form-control" id="img_alt" name="img_alt" value="<?php echo $img_alt;?>" maxlength="300">
                </div>
                <div class="form-group">
                    <label for="">Select category <span class="astric">*</span></label>                  
                  @if($btnName!="Update")
                    <select class="form-control" id="catgoryName" name="catgoryName">                 
                      <option value="">Select category</option>
                      @foreach($getcategory as $categorydata)
                     <option value="{{$categorydata->category_name}}" >{{ucwords($categorydata->category_name)}}</option>                     
                     @endforeach
                    </select>
                  @else


                  <select class="form-control" id="catgoryName" name="catgoryName">                 
                      <option value="">Select category</option>
                      @foreach($getcategory as $categorydata)
                     <option value="{{$categorydata->category_name}}" <?php if($category==$categorydata->category_name){ echo 'selected';}?> >{{ucwords($categorydata->category_name)}}</option>                     
                     @endforeach
                    </select>

                  @endif
                </div>
                                         
                <div class="form-group">
                    <label for="">Title <span class="astric">*</span></label>
                    <input type="text" class="form-control" id="blogtitle" name="blogtitle" value="<?php echo $title;?>" maxlength="300">
                </div>
                <div class="form-group">
                    <label for="">Slug <span class="astric">*</span></label>
                    <input type="text" class="form-control" id="blogslug" name="blogslug" value="<?php echo $slug;?>" maxlength="300">
                </div>  


                <div class="form-group">
                  <label for="">Short Description <span class="astric">*</span></label>                 
                  <textarea rows="5" class="form-control ckeditor" id="blogShortdescription" name="blogShortdescription"><?php echo $blog_short_desc;?></textarea>                    
                </div> 


                <div class="form-group">
                  <label for="">Description <span class="astric">*</span></label>                 
                  <textarea rows="5" class="form-control ckeditor" id="blogdescription" name="blogdescription"><?php echo $description;?></textarea>                    
                </div>  

                 <div class="form-group">
                    <label for="metaTitle">Meta Title <span class="astric"></span></label>
                    <input type="text" class="form-control" id="metaTitle" name="metaTitle" value="<?php echo $metaTitle;?>" maxlength="300">
                </div>  
                 <div class="form-group">
                    <label for="metaKeywords">Meta Keywords<span class="astric"></span></label>
                    <input type="text" class="form-control" id="metaKeywords" name="metaKeywords" value="<?php echo $metaKeywords;?>" maxlength="300">
                </div>  
                 <div class="form-group">
                    <label for="meta_desc">Meta Description <span class="astric"></span></label>                    
                     <textarea rows="5" class="form-control" id="meta_desc" name="meta_desc"><?php echo $metaDesc;?></textarea>
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
  function upatecmsdata()
  {
     var catgoryName = $("#catgoryName").val();

    
    var blogtitle = $("#blogtitle").val();
    var blogslug = $("#blogslug").val();
    //var blogdescription = $("#blogdescription").val();
    var blogdescription = CKEDITOR.instances['blogdescription'].getData();
    var blogShortdescription = CKEDITOR.instances['blogShortdescription'].getData();

    var imageidd =document.getElementById("imageidd").value.trim();
    var imageidd = $('#imageidd')[0].files[0];
    var image_name = $("#image_name").val();
    var imagePath = $("#imagePath").val();
    var metaTitle = $("#metaTitle").val();
    var img_alt = $("#img_alt").val();
    var metaKeywords = $("#metaKeywords").val();
    var metaDesc = $("#meta_desc").val();
    var publishingOption = $("#publishingOption").val();
          

  if(imageidd =='')
        {
        document.getElementById("wordCnt").innerHTML="Please choose blog image." ;
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
        document.getElementById("wordCnt").innerHTML="Please choose blog image." ;
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
        
        if(catgoryName =='')
        {
        document.getElementById("wordCnt").innerHTML="Please select blog category." ;
        $("#catgoryName").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#catgoryName").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        } 

        if(blogtitle =='')
        {
        document.getElementById("wordCnt").innerHTML="Please enter blog title." ;
        $("#blogtitle").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#blogtitle").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        }
        if(blogslug =='')
        {
        document.getElementById("wordCnt").innerHTML="Please enter blog slug." ;
        $("#blogtitle").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        { 
          $("#blogtitle").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        } 

       if(blogShortdescription =='')
        {
        document.getElementById("wordCnt").innerHTML="Please enter blog short description." ;
        $("#blogShortdescription").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#blogShortdescription").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        } 

       
         if(blogdescription =='')
        {
        document.getElementById("wordCnt").innerHTML="Please enter blog description." ;
        $("#blogdescription").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#blogdescription").css("border","#d3d3d3 solid 1px"); 
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
        form.append('catgoryName', catgoryName);
        form.append('blogtitle', blogtitle);
        form.append('blogslug', blogslug);      
        form.append('blogdescription', blogdescription);
        form.append('imageidd', imageidd);      
        form.append('image_name', image_name);  
        form.append('imagePath', imagePath);   
        form.append('img_alt', img_alt);   
        form.append('blogShortdescription', blogShortdescription);         
        form.append('metatitle', metaTitle);      
        form.append('metakeywords', metaKeywords);      
        form.append('metadesc', metaDesc);  
        form.append('publishingStatus', publishingOption);      

        form.append('uniqueid', '{{$uniqueid}}');     
   $("#pleasewaitimage").css('display','block'); 
  // console.log('datat:');
        $.ajax({
          headers: {'X-CSRF-Token':'{{ csrf_token() }}'},
          type:'POST',
          url: "{{url('/admin/addbloginfo')}}",
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
          
            if(status=="200"){
              document.getElementById("wordCnt").style.color = "#278428";
              document.getElementById("wordCnt").innerHTML=msg;           
              setTimeout(function() { window.location="/admin/blog/bloglisting" }, 2000);
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
  function uploadimg() 
  {
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

