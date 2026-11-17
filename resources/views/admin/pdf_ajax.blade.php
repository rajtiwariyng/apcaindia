   <script type="text/javascript">
        $( document ).ready(function() {
   $(".pagination a").addClass("intro");
});      
   </script>

         <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <th>S.N.</th>                        
                        <th>Title</th>                      
                        <th>PDF name</th>                      
                        <th>Course Type&nbsp;</th>                      
                        <th>Action</th>
                        <th>Status</th>
                      </thead>
                      <?php 

                      $i=1;
                      $sn=0;
                      if(count($pdfinfo)>0)
                      { 
                      ?>
                      @foreach($pdfinfo as $dataresult)

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

                 ?>
                      <tr>
                       <td> {{$i}} </td>
                         
            

                        <td>{{$dataresult->title}}</td>                       
                         
                         <td>
                             <a href="{{ url('/assets/upload/pdf/' . $dataresult->pdf_path) }}" target="_blank" class="btn btn-sm btn-primary">Download PDF</a>
                         </td>
                         <td>{{ str_replace('-', ' ', $dataresult->page) }}</td>
                         <td>                         
                        <div class="editDlt">                       
                          <a href="{{url('/')}}/admin/pdf/create/<?php echo $dataresult->uniqueid;?>" title="Edit details">
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
                        {{$pdfinfo->links()}}
                    </ul>
                  </nav>    
               
                </div>
            <?php session()->forget('search'); ?>