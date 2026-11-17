   <script type="text/javascript">
        $( document ).ready(function() {
   $(".pagination a").addClass("intro");
});      
   </script>

         <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <th>S.N.</th>
                        <th style="width: 200px">Title</th>
                        <th>Description</th>
                        <!-- <th>Category</th> -->
                        <th>Image</th>                        
                        <th>Action</th>
                        <th>Status</th>
                      </thead>
                      <?php 

                      $i=1;
                      $sn=0;
                      if(count($bannerifo)>0)
                      { 
                      ?>
                      @foreach($bannerifo as $dataresult)

                   <?php
                      $status=$dataresult->status;
                      $sn++;
                      if($status=="1")
                       {
                        $stts="checked"; 
                                                    
                        }
                       else 
                        {
                         $stts="";
                                                   
                         }
                  $blogdescp=$dataresult->description;
                  $blogshortdesc=substr($blogdescp,0,250);
                  $totalWord = str_word_count($blogdescp);

                 ?>
                      <tr>
                       <td> {{$i}} </td>
                        <td><?php echo $dataresult->title;?></td>              
                      <td>
                      <?php if($totalWord >5){ ?>

                      <span id="longMsg<?php echo $sn; ?>" style="display:none;"><?php echo $blogdescp ; ?></span>               
                   <span id="shortMsg<?php echo $sn; ?>">
                   <?php echo $blogshortdesc." "; ?>
                  <!--  <span style="color:red;cursor:pointer;" onclick="abc(<?php //echo $sn; ?>)">Read more...</span> -->
                    <a href="{{url('/')}}/admin/blog/createnewblog/<?php echo $dataresult->uniqueid;?>" title="Edit details"> <span style="color:red;cursor:pointer;">Read more...</span></a>
                   </span>

                   <br/>
                    
                   <?php
                      }
                      else
                      {                  
                      echo $blogdescp ;
                      }
                    ?>
                    </td>


                        <!-- <td><?php // echo ucwords($dataresult->category);?></td> -->
                        <td><img src="{{url('/')}}/assets/upload/blog/<?php echo $dataresult->image;?>" style="width: 200px"></td>                       
                         
                         <td>                         
                        <div class="editDlt">                       
                          <a href="{{url('/')}}/admin/blog/createnewblog/<?php echo $dataresult->uniqueid;?>" title="Edit details">
                          <img src="{{url('/')}}/admin_assets/img/Vedit.png" alt=""></a>

                          <a href="javascript:void(0)" onclick="deletefunction('<?php echo $dataresult->uniqueid;?>')"><img src="{{url('/')}}/admin_assets/img/delete.png" alt="" title="Delete"></a>
                          </div>
                        </td>
                        <td>
                         <label class="switch">
                            <input type="checkbox" <?php echo $stts;?> onchange="check_status('<?php echo $dataresult->uniqueid;?>')" id="check_box_<?php echo $dataresult->uniqueid;?>">
                            <span class="sliderswitch round"></span>
                          </label>
                        </td>
                      </tr>
                      <?php $i++ ;?>
                      @endforeach
                      <?php
                       }
                       else
                       {?>
                          
                       <tr><td></td><td></td><td></td><td><h5>No record found.</h5></td><td></td></tr>
                    <?php } ?>
                     
                    </table>
                  </div>             
               <div class="text-center tmsPagination">
               <nav>
                    <ul class="pagination justify-content-end">   
                        {{$bannerifo->links()}}
                    </ul>
                  </nav>    
               
                </div>
            <?php session()->forget('search'); ?>