

<!DOCTYPE html>
<html>
 
   <head> 
      <title>Nový kurz </title> 
  </head>

<body>
            <div><br>&nbsp</div>
        <div><br>&nbsp</div>

    <div class="container">	
    <form method="post" action="http://localhost/Kurzy/index.php/main/save">
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