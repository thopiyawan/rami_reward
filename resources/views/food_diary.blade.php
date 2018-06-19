

<!DOCTYPE html>
<html>
<head>
  <title>บันทึกอาหารย้อนหลัง</title>

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
       

   <u><h3>บันทีกอาหารย้อนหลัง</h3></u>
   <h2></h2>
 <div>
  <table id="customers">
    <thead>
        <tr>
            <th>วันที่</th>
            <th>อาหารเช้า</th>
             <th>อาหารกลางวัน</th>
            <th>อาหารเย็น</th>
             <th>มื้อว่างรอบเช้า</th>
            <th>มื้อว่างรอบบ่าย</th>
        </tr>
    </thead>
    <tbody>
          @foreach ($record as $records)
          <tr>
              <td>{{ date('d-m-Y', strtotime($records->created_at))}}</td>

              <?php  
              if ($records->breakfast == 'NULL'){
                $breakfast = 'ไม่มีการบันทึก';
              }else{
                $breakfast = $records->breakfast ;
              }
              if ($records->lunch == 'NULL'){
                $lunch = 'ไม่มีการบันทึก';
              }else{
                $lunch = $records->lunch;
              }
              if ($records->dinner == 'NULL'){
                $din = 'ไม่มีการบันทึก';
              }else{
                $din = $records->dinner;
              }
              if ($records->dessert_lu == 'NULL'){
                $de_lu = 'ไม่มีการบันทึก';
              }else{
                $de_lu = $records->dessert_lu;
              }
              if ($records->dessert_din == 'NULL'){
                $de_din = 'ไม่มีการบันทึก';
              }else{
                $de_din= $records->dessert_din;
              }
              ?>
              <td>{{$breakfast}} </td>
              <td> {{$lunch}}</td>
              <td>{{$din}}</td>
              <td> {{$de_lu}} </td>
              <td>{{$de_din}}</td>
          </tr>
         @endforeach
   </tbody>
</table></div>
</body>
</html>




