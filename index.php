<!DOCTYPE html>
<html>
<head>
	<title>File Writer</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  
   <div class="container">
     
     <div class="button-main">
     <form method="post">	
      <div class="get">
         <input type="text" name="first" value="" />
         <input type="text" name="second" value="" />
         <button type="submit" name="post" class="btn btn-primary">Post</button> 
      </div>
     </form> 
     </div>

     <table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
   <?php 
       $str = file_get_contents('data.json'); 
       $json = json_decode($str, true);
       
       foreach ($json as $data) {
       
       
     ?> 	
      <tr>
        <td><?php  echo  $data['name']; ?></td>
        <td><?php  echo  $data['name']; ?></td>
        <td><?php  echo  $data['email']; ?></td>
      </tr>      
     <?php } ?>
    </tbody>
  </table>


   </div>


 <?php 
  include('./httpful.phar');
 
  if(isset($_POST['post'])){

    $url = 'http://192.168.20.135:8084';
    $field1 = $_POST['first'];
    $field2 = $_POST['second'];
    $url = $url.'?'.$field1.'&'.$field2;
    echo $url;
    $response = \Httpful\Request::post($url)
       // Sugar: You can also prefix the method with "with"
      //->addHeader('cookie', 'sid=' . $sid)    // Or use the addHeader method
      ->sendsJson()

    ->send();
    $data = json_encode($response->body);
    echo $data;
    //file_put_contents('newdata.json', $data);

    if($data){
     echo "success";
    }
    else{
     echo "Error in fetching data";
    }
  }

?>
</body>
</html>