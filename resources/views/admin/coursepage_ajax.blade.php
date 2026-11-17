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
                        <th>Duration</th>
                        <th>Image</th>                       
                        <th>Manage Section</th>                       
                        <th>Download Flyer Count</th>                       
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
                  $duration=$dataresult->duration;

                 ?>
                      <tr>
                       <td> {{$i}} </td>
                        <td><?php echo $dataresult->title;?></td>              
                      <td>
                      {{$duration}}
                    </td>


                        <!-- <td><?php // echo ucwords($dataresult->category);?></td> -->
                        <td><img src="{{url('/')}}/assets/upload/coursepage/<?php echo $dataresult->image;?>" style="width: 200px; height: 200px" ></td>                       
                         <td><a href="{{url('/')}}/admin/coursemodule/listing/<?php echo $dataresult->uniqueid;?>" class="btn btn-primary btn-xs">Manage</a></td>

                         <td>
                            {{ $dataresult->download_count ?? 0 }}
                        </td>  
                         <td>
                        
                        <div class="editDlt">                       
                          <a href="{{url('/')}}/admin/coursepage/create/<?php echo $dataresult->uniqueid;?>" title="Edit details">
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