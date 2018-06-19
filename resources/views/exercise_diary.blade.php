<!DOCTYPE html>
<html>
<head>
  <title>บันทีกการออกกำลังกายย้อนหลัง</title>

</head>
<meta charset="utf-8">

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}


th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
     background-color:#80bfff;
}

td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    /*background-color: #dddddd;
*/}
</style>
<body>
       

   <u><h3>บันทีกการออกกำลังกายย้อนหลัง</h3></u>
   <h2></h2>
 <div>
  <table id="customers">
    <thead>
        <tr>
            <th>วันที่</th>
            <th>การออกกำลังกาย</th>
        
        </tr>
    </thead>
    <tbody>
          @foreach ($record as $records)
          <tr>
              <td>{{ date('d-m-Y', strtotime($records->created_at))}}</td>

              <?php  
              if ($records->exercise == 'ยัง'){
                $a = 'ไม่ได้ออกกำลังกาย';
              }elseif($records->exercise == 'NULL'){
                $a = 'ไม่มีการบันทึก';
              }else{
                $a = $records->exercise;
              }
              ?>
              <td>{{ $a}}</td>

          </tr>
         @endforeach
   </tbody>
</table></div>
</body>
</html>




