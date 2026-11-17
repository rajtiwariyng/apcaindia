 <?php 

$da = date_default_timezone_set('Asia/Kolkata');

$date='Contact_request-'.date('Y-m-d-G.i');

header("Content-type: application/vnd.ms-excel; name='excel'");

header("Content-Disposition: attachment; filename=$date.xls");

header("Pragma: no-cache");

?>    

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
    if(count($bannerifo)>0)
    {     ?>

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

    <?php

     }

     else

     {?>

        

     <tr><td></td><td></td><td><h5>No record found.</h5></td><td></td></tr>

  <?php } ?>

   

  </table>