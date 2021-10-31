<?php 
    require('classes/Amount.php');  
    if (isset($_POST['amount'])){
        $amount = new Amount($_POST['amount']);
        echo $amount->input_amount;
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>OM Coding Challenge</title>
    <style>
      body{
        margin: 20px auto;
        background-color: #f3f3f3;
      }

      .screen{
          height: 120px;
          background-color: #fff;
      }

      .machine-button{
          height: 60px;
          background-color: #00638B;
          border-radius: 0;
          border: 1px solid #fff;
          color: #fff;
      }

      .machine-button:hover{
          background-color: #fff;
          color: #00638B;
      }

      .submit-button{
          background-color: #088D61;
          color: #fff;
      }

      .submit-button:hover{
          border: 1px solid #fff;
          color: #fff;
      }

    </style>
  </head>
  <body> 
    <div class="container col-sm-12 col-md-6 col-lg-4">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">    
        <div class="row mb-1">
            <input 
                type="text" 
                id="amount" 
                name="amount" 
                class="form-control border-0 text-end screen" 
                placeholder="Type or press your amount.."     
            >
        </div>
        
        <div class="row">
            <button type="button" onClick="add('1')" class="btn col-4 machine-button">1</button>
            <button type="button" onClick="add('2')" class="btn col-4 machine-button">2</button>
            <button type="button" onClick="add('3')" class="btn col-4 machine-button">3</button>
        </div>
        <div class="row">
            <button type="button" onClick="add('4')" class="col-4 btn machine-button">4</button>
            <button type="button" onClick="add('5')" class="btn col-4 machine-button">5</button>
            <button type="button" onClick="add('6')" class="btn col-4 machine-button">6</button>
        </div>
        <div class="row">
            <button type="button" onClick="add('7')" class="col-4 btn machine-button">7</button>
            <button type="button" onClick="add('8')" class="btn col-4 machine-button">8</button>
            <button type="button" onClick="add('9')" class="btn col-4 machine-button">9</button>
        </div>
        <div class="row">
            <button type="button" onClick="add('£')" class="col-4 btn machine-button">£</button>
            <button type="button" onClick="add('0')" class="btn col-4 machine-button">0</button>
            <button type="button" onClick="add('p')" class="btn col-4 machine-button">p</button>
        </div>
        <div class="row mb-3">
            <button type="button" onClick="add('.')" class="btn col-4 machine-button">.</button>
            <button type="submit" name="submit" class="btn col-8 submit-button">Submit</button>
        </div>
        </form>
    </div> <!-- end of container -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function add(val){
            let input = document.getElementById('amount');
            input.value = input.value + val;
        }
    </script>
  </body>
</html>