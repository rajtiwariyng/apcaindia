   <script type="text/javascript">
        $( document ).ready(function() {
   $(".pagination a").addClass("intro");
});      
   </script>

         <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date Time</th>
                        <th>Program</th>
                        <th>Created At</th>
                      </thead>
                      <?php 
                      $i=1;
                      if(count($bannerifo)>0) { ?>
                      @foreach($bannerifo as $dataresult)
                      <tr>
                      <td> {{$i}} </td>
                      <td><?php echo $dataresult->full_name;?></td>
                      <td><?php echo $dataresult->email;?></td>
                      <td><?php echo $dataresult->mobile;?></td>
                      <td><?php echo $dataresult->date_time;?></td>
                      <td><?php echo $dataresult->program;?></td>
                      <td><?php echo $dataresult->created_at;?></td>
                      </tr>
                      <?php $i++ ;?>
                      @endforeach
                      <?php } else  { ?>                    

                       <tr><td></td><td></td><td><h5>No record found.</h5></td><td></td></tr>

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