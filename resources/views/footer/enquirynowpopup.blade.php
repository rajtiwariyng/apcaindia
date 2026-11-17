<style>

.zf_lB_Dimmer_670730{ 
    position: fixed;
    top: 0px;
    left: 0px;
    right: 0px;
    bottom: 0px;
    background: rgb(0, 0, 0);
    opacity: 0.8;
    z-index: 10000000;
}

.zf_lB_Container_670730{
  position: fixed;
  background-color: white;
  margin: 0;
  margin-right: 0px;
  padding: 0;
  height: 1168px;
  width:  70%;
  top: 50%;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%);
  border: 7px solid none;
  max-height: calc(100% - 60px);
  z-index: 999999;
  transition: height 0.5s ease;
  outline : none;
}

p{
margin-bottom: 10px;
}

.zf_lB_Wrapper_670730{
  position: fixed;
    top: 50%;
    left: 50%;
    margin-left: 0;
    margin-top: -180px;
    z-index: 10000001;
}

.zf_main_id_670730{
  height: calc(100% - 0px);
  display: flex;
  overflow-y: auto;
  overflow-x: hidden;
}

.zf_lb_closeform_670730 {
    position: absolute;
    right: -20px;
    background: #2f2e2e;
    padding: 0;
    border-radius: 50%;
    width: 34px;
    height: 34px;
    top: -15px;
    cursor: pointer;
    border: 2px solid #d9d9d9;
}
.zf_lb_closeform_670730:before, .zf_lb_closeform_670730:after {
    position: absolute;
    left: 16px;
    content: ' ';
    height: 19px;
    width: 2px;
    top: 7px;
    background-color: #f7f7f7;
}

.zf_lb_closeform_670730:before {
  transform: rotate(45deg);
}
.zf_lb_closeform_670730:after {
  transform: rotate(-45deg);
} 



@media screen and (min-device-width: 10px) and (max-device-width: 380px) {  
   .zf_lB_Container_670730 {
  width: 270px !important;
} 
}

@media screen and (min-device-width: 360px) and (max-device-width: 480px) {  
   .zf_lB_Container_670730 {
  width: 350px !important;
} 
}

@media screen and (min-device-width: 440px) and (max-device-width: 500px) {  
   .zf_lB_Container_670730 {
  width: 380px !important;
} 
}

@media only screen  and (min-width:500px) and (max-width:600px)  {  
  .zf_lB_Container_670730 {
  width: 450px;
 }
}

@media only screen  and (min-width:601px) and (max-width:700px)  {  
  .zf_lB_Container_670730 {
  width: 540px;
 }
}

@media only screen  and (min-width:700px) and (max-width:800px)  { 
.zf_lB_Container_670730 {
  width: 650px;
 }
}

@media screen and (min-device-width: 801px) and (max-device-width: 1268px) {  
   .zf_lB_Container_670730 {
  width: 750px !important;
} 
}

</style>      





<script type="text/javascript">(function() {
  try{

      if( document.readyState == "complete" ){ 
        onloadActions_670730();
      }  else {
          window.addEventListener('load', function (){
            onloadActions_670730();
          }, false);
      }

      function onloadActions_670730(){
        constructDiv_670730();
        
      }

      function constructDiv_670730(){
        var iframeDiv = document.createElement("div");
        iframeDiv.setAttribute('id','TNIcvYckBnvnBBYebQKYxoZRFU-w299wuiBDrsVzyB0_670730');
        iframeDiv.setAttribute('class','zf_main_id_670730');

        var closeFormDiv = document.createElement("div");
        closeFormDiv.setAttribute('id','deleteform_670730');
        closeFormDiv.setAttribute('class','zf_lb_closeform_670730');
        closeFormDiv.setAttribute('tabindex', 0);
        

        var containerDiv = document.createElement("div");
        containerDiv.setAttribute('id','containerDiv_670730');
        containerDiv.setAttribute('class','zf_lB_Container_670730 ');
        containerDiv.appendChild(iframeDiv);
        containerDiv.appendChild(closeFormDiv);
        
        var wrapperDiv = document.createElement("div");
        wrapperDiv.setAttribute('class','zf_lB_Wrapper_670730');
        wrapperDiv.appendChild(containerDiv);


        var dimmerDiv = document.createElement("div");
        dimmerDiv.setAttribute('class','zf_lB_Dimmer_670730');
        dimmerDiv.setAttribute('elname','popup_box');

        var mainDiv = document.createElement("div");
        mainDiv.setAttribute('id','formsLightBox_670730');
        mainDiv.style.display = "none";
        mainDiv.appendChild(wrapperDiv);
        mainDiv.appendChild(dimmerDiv);

        document.body.appendChild(mainDiv);

      }

      function showZForm_670730(){
        var iframe = document.getElementById("TNIcvYckBnvnBBYebQKYxoZRFU-w299wuiBDrsVzyB0_670730").getElementsByTagName("iframe")[0];
        if(iframe == undefined ||iframe.length == 0){
          loadZForm_670730();
          
        } 
        document.getElementById("formsLightBox_670730").style.display = "block"; 
        document.body.style.overflow = "hidden";
        setTimeout(function() {
            var containerDiv = document.getElementById("containerDiv_670730");
            containerDiv.setAttribute('tabindex', '-1');
            containerDiv.focus();
        }, 100);
      }

      function deleteZForm_670730() {
        var divCont = document.getElementById("formsLightBox_670730");
        divCont.style.display="none";
        document.body.style.overflow = "";

        var iframe = document.getElementById("TNIcvYckBnvnBBYebQKYxoZRFU-w299wuiBDrsVzyB0_670730").getElementsByTagName("iframe")[0];
        iframe.remove();
      }

      function loadZForm_670730() {
        var iframe = document.getElementById("TNIcvYckBnvnBBYebQKYxoZRFU-w299wuiBDrsVzyB0_670730").getElementsByTagName("iframe")[0];
        if(iframe == undefined ||iframe.length == 0){
          var f = document.createElement("iframe");
          f.src = getsrcurlZForm_670730('https://forms.zohopublic.com/academyofpastryandculinaryarts/form/CuriousaboutourprogramsLetschat/formperma/TNIcvYckBnvnBBYebQKYxoZRFU-w299wuiBDrsVzyB0?zf_rszfm=1');
            
          f.style.border="none";
          f.style.minWidth="100%";
          f.style.overflow="hidden";
          var d = document.getElementById("TNIcvYckBnvnBBYebQKYxoZRFU-w299wuiBDrsVzyB0_670730");
          d.appendChild(f);

          var deleteForm = document.getElementById("deleteform_670730");
          deleteForm.onclick =  deleteZForm_670730;
          deleteForm.addEventListener("keydown", function (event) {
            if (event.key === "Enter" || event.keyCode === 13 || event.key === " " || event.keyCode === 32) {
              event.preventDefault();
              deleteZForm_670730();
            }
          });

          

          window.addEventListener('message', function (){
            var evntData = event.data;
            if( evntData && evntData.constructor == String ){
              var zf_ifrm_data = evntData.split("|");
              if ( zf_ifrm_data.length == 2 || zf_ifrm_data.length == 3 ) {
                var zf_perma = zf_ifrm_data[0];
                var zf_ifrm_ht_nw = ( parseInt(zf_ifrm_data[1], 10) + 15 ) + "px";
                var iframe = document.getElementById("TNIcvYckBnvnBBYebQKYxoZRFU-w299wuiBDrsVzyB0_670730").getElementsByTagName("iframe")[0];
                if ( (iframe.src).indexOf('formperma') > 0 && (iframe.src).indexOf(zf_perma) > 0 ) {
                  var prevIframeHeight = iframe.style.height;

                  var zf_tout = false;
                  if( zf_ifrm_data.length == 3 ) {
                      iframe.scrollIntoView();
                      zf_tout = true;
                  }

                  if ( prevIframeHeight != zf_ifrm_ht_nw ) {
                    if( zf_tout ) {
                      setTimeout(function(){
                            iframe.style.minHeight = zf_ifrm_ht_nw;
                        var containerDiv = document.getElementById("containerDiv_670730");
                        containerDiv.style.height=zf_ifrm_ht_nw;
                        },500);
                    } else {
                        iframe.style.minHeight = zf_ifrm_ht_nw;
                      var containerDiv = document.getElementById("containerDiv_670730");
                      containerDiv.style.height=zf_ifrm_ht_nw;
                    }
                  }
                }
              }
            }

          }, false);
        }
      }

      

      function getsrcurlZForm_670730(zf_src) {
        try {
          
          if ( typeof ZFAdvLead !== "undefined" && typeof zfutm_zfAdvLead !== "undefined" ) {
            for( var prmIdx = 0 ; prmIdx < ZFAdvLead.utmPNameArr.length ; prmIdx ++ ) {
                  var utmPm = ZFAdvLead.utmPNameArr[ prmIdx ];
                  var utmVal = zfutm_zfAdvLead.zfautm_gC_enc( ZFAdvLead.utmPNameArr[ prmIdx ] );
                  if ( typeof utmVal !== "undefined" ) {
                    if ( utmVal != "" ){
                      if(zf_src.indexOf('?') > 0){
                        zf_src = zf_src+'&'+utmPm+'='+utmVal;//No I18N
                      }else{
                        zf_src = zf_src+'?'+utmPm+'='+utmVal;//No I18N
                      }
                    }
                  }
                }
          }

          if ( typeof ZFLead !== "undefined" && typeof zfutm_zfLead !== "undefined" ) {
            for( var prmIdx = 0 ; prmIdx < ZFLead.utmPNameArr.length ; prmIdx ++ ) {
                  var utmPm = ZFLead.utmPNameArr[ prmIdx ];
                  var utmVal = zfutm_zfLead.zfutm_gC_enc( ZFLead.utmPNameArr[ prmIdx ] );
                  if ( typeof utmVal !== "undefined" ) {
                    if ( utmVal != "" ){
                      if(zf_src.indexOf('?') > 0){
                        zf_src = zf_src+'&'+utmPm+'='+utmVal;//No I18N
                      }else{
                        zf_src = zf_src+'?'+utmPm+'='+utmVal;//No I18N
                      }
                    }
                  }
                }
          }
        }catch(e){}
        return zf_src;
      }
      var buttonElem = document.getElementById("zf_button_670730");
      buttonElem.style.display = "block";
      buttonElem.addEventListener("click", showZForm_670730);
    
      
  }catch(e){}
})();
</script>   
