
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>IG AI</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="style.css">
  
  
</head>

<body>

  <div class="flexbox">
      
   
      
  <div class="search">
    <h1>Instagram AI</h1>
    <h3>Click on search icon, then paste the post URL.</h3>
    <div>
      <input type="text" id="URL" placeholder="       instagram.com/p/BwIg5v8hnMF/" required>
    </div>
  </div>
  
  <br>
   
        <div class="data">
          <a href="#" class="button1" id="G-T">Get Details</a>

<div class="post-content" style="display: none;">
    <br>
    <h4>Post Details</h4>
    <p><span id="Details"></span></p>
   
   
    <div class="pic">
        
    </div>
    
</div>
   </div>
   
 <h3 class="me">Coded by HadySata</h3>
   
</div>



  
  
  
  <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>


<script>

$(document).ready(function(){
        $('#G-T').click(function(){
         
        var URL = $('#URL').val();
        $.ajax({
           type: "POST",
    url: 'api.php',
            dataType: "json",
    data: {URL: URL},
            success:function(data){
                    $('#Details').text(data.result);
                  $('.pic').html(data.pic);
            $('.post-content').slideDown();
         
            }
        });
    });
});




</script>

</body>

</html>
