


<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home | Battleship</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
    <html>
<style>
h1 {
    font-size: 5vh;
}
h5 {
    font-size: 3vh;
}
div.fixed {
  position: fixed;
  bottom: 0;
  right: 0;
  width: 300px;
}
.container {
  padding: 12% 0;
  text-align: center;
}
button[button] {
   font-size: 2.5vh;


  margin: 5px;
justify-content: center; 
  text-align: center;
}
.flex {
    display: flex;
  align-items: center;
justify-content: center; 

}
</style>
 </head>
    <body>
        

    
<center>
<div class="container">
        <br><br><h1>Welcome to BattleShip!</h1>
    
        
        <br>
      <!-- <a href="play.php"><img src = "LogoMakr-7hm9Gd.png" height="200" width="200"></a>  -->
        <br><br><br><br>
        <div class="flex">
        <button type="button" onclick="computer()"class="btn btn-primary" button>Play against Computer!</button>
                 <button type="button" onclick="human()"class="btn btn-secondary" button>Play multiplayer!</button>
                </div>
                </center>
</div>
            <script>
            
                function computer() {
                    location.href = "computer.php"
                }
                function human() {
                    location.href = "human.php"
                }
            </script>


</html>