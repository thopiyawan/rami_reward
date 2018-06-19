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
  <u><h3>น้ำหนักระหว่างการตั้งครรภ์</h3></u>
   <h4>ก่อนตั้งครรภ์น้ำหนัก : {{ $pre_weight->user_Pre_weight}}  </h4>
 <div>
  <table id="customers">
    <thead>
        <tr>
            <th>สัปดาห์</th>
            <th>น้ำหนัก</th>
        </tr>
    </thead>
    <tbody>
          @foreach ($record as $records)
          <tr>
              <td>{{ $records->preg_week}}</td>
              <td>{{ $records->preg_weight}}</td>
          </tr>
         @endforeach
   </tbody>
</body>
</html>




