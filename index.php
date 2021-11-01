<?php 
    require('classes/Amount.php');  

    $input = 0;
    $out_string = "";
    $out_pence =  0;

    if (isset($_POST['amount'])){
        $input = trim($_POST['amount']);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
 
        $amount = new Amount($input);
      
        $out_string = $amount->cal();
        $out_pence = $amount->pence_amount;
    }

?>
<?php 
    $test_case = ['6', '75', '167p', '4p', '1.97', '£1.33', '£2', '£20', '£1.97p', '£1p', '£1.p', '001.61p', '6.235p', '£1.256532677p', '', '1x','£1x.0p', '£p'];
    $test_result = [6, 75, 167, 4, 197, 133, 200, 2000, 197, 100, 100, 161, 624, 126, 0, 0, 0, 0];
    $table = '
        <div class="col-sm-12 col-md-12 col-lg-7">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Input</th>
                <th scope="col">Expected Pence</th>
                <th scope="col">Output pence</th>
                <th scope="col">Min Sterling Coins</th>
                </tr>
            </thead>
            <tbody>';

            for($i=0; $i<count($test_case);$i++){
                
                $amount = new Amount($test_case[$i]);
                $amount->cal();
                $table .= '<tr>'. 
                '<td>'. $i .'</td>'. 
                '<td>' . $test_case[$i] . '</td>' . 
                '<td>' . $test_result[$i]. '</td>'. 
                '<td>' . $amount->pence_amount . '</td>'.
                '<td>' . $amount->output . '</td>'.
                '</tr>';
            }

    $table .= '</tbody></table></div>';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style/index.css" rel="stylesheet">
    <title>OM Coding Challenge</title>
  </head>
  <body class="container"> 
    <div class="row">
        <div class="col-sm-12 col-md-7 col-lg-5 mx-auto">
        <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="row mb-1">
                <div class="col-12 text-end screen">
                    <h3><?php echo empty($input)? "<br/>": $input . " -> " . $out_pence ; ?></h3>
                    <input 
                        type="text" 
                        id="amount" 
                        name="amount" 
                        class="form-control border-0 text-end" 
                        placeholder="<?php echo empty($out_string)? 'Type or press your amount..': $out_string; ?>"    
                    >
                </div>
            </div>
            <div class="row">
                <button class="col-12 btn reset-button" onClick="reset()">Reset</button>
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
                <button type="submit" name="submit" class="col-8 btn submit-button">Submit</button>
            </div>
            <div class="row">
                <button type="submit" name="test" class="col-12 btn btn-dark" style="height: 50px;">Run test case</button>
            </div>
        </form>
        </div>
    </div>
    
    <?php 
        echo isset($_POST['test'])? $table :"";
    ?>
    
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function add(val){
            let input = document.getElementById('amount');
            input.value = input.value + val;
        }

        function reset(){
            let input = document.getElementById('amount');
            input.value = "";
        }
    </script>
  </body>
</html>