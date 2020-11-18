

<!DOCTYPE html>
<html>
 
   <head> 
      <meta charset = "utf-8"> 
      <title>Formulář</title> 
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

   </head>

<body>
            <div><br>&nbsp</div>
        <div><br>&nbsp</div>

    <div class="container">	
    <form method="post" action="http://localhost/Kurzy/index.php/Pages/save">
    <h4 style="text-align: center">Vytvoření kurzu</h4>
    <?php
    if (isset($error)) {
        echo $error;
    }
        
    ?>
    <div class="row">
        <div class="col-md-6">
             <label>Název kurzu</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                </div>
                <input type="text" class="form-control" name="nazev">
            </div>
        </div>      
   
    
        <div class="col-md-6">
                <label>Počet účastníků</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                </div>
                <input type="number" min="5" max="50" class="form-control" name="pocet_mist">
            </div> 
        </div>
         </div>
    
    
      <div class="form-group">
    <label>Popis</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="popis"></textarea>
                   
  </div>
    
    
    
    
    
    <div style="text-align: left">
        <button type="submit" name="register" class="btn btn-primary">Odeslat</button>
    </div>
</form>
    
            
           
</div>
</body>
</html>