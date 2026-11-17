   <script type="text/javascript">
        $( document ).ready(function() {
   $(".pagination a").addClass("intro");
});      
   </script>

         <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <th>S.N.</th>                        
                        <th>Caption&nbsp;</th>                        
                        <th>&nbsp;page</th>
                        <th>&nbsp;Image</th>
                        <th>Order</th>                        
                        <th>Action</th>
                        <th>Status</th>
                      </thead>
                      <?php 

                      $i=1;
                      $sn=0;
                      if(count($homesliderinfo)>0)
                      { 
                      ?>
                      @foreach($homesliderinfo as $dataresult)

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
                  $page=$dataresult->page;
                  $caption=$dataresult->caption;
                  $order_by=$dataresult->order_by;
                  

                 ?>
                      <tr>
                       <td> {{$i}} </td>
                       <td> {{$caption}} </td>
                         
                      <td> {{ str_replace('-', ' ', $dataresult->page) }} </td>

                        <td><img src="{{url('/')}}/assets/upload/studentsection/<?php echo $dataresult->image;?>" style="width: 130px;height: 70px;"></td>                       
                         <td> {{$order_by}} </td>
                         <td>                         
                        <div class="editDlt">                       
                          <a href="{{url('/')}}/admin/studentsection/create/<?php echo $dataresult->uniqueid;?>" title="Edit details">
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
                        {{$homesliderinfo->links()}}
                    </ul>
                  </nav>    
               
                </div>
            <?php session()->forget('search'); ?>