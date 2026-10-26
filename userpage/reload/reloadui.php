<html>
  <head>
    <title>register</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff;
        margin: 0;
        padding: 20px;
        color: #333;
        line-height: 1.6;
      }
      
      p {
        background-color: #e6f7ff;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        color: #0066cc;
        border: 1px solid #b3e0ff;
        max-width: 500px;
        margin: 20px auto;
      }
      
      form {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        max-width: 500px;
        margin: 0 auto;
      }
      
      div {
        margin-bottom: 20px;
      }
      
      label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
      }
      
      input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
      }
      
      input:focus {
        border-color: #4da6ff;
        outline: none;
        box-shadow: 0 0 5px rgba(77, 166, 255, 0.5);
      }
      
      button {
        padding: 12px 20px;
        margin-right: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        background-color: #4da6ff;
        color: white;
        transition: background-color 0.3s;
      }
      
      button:hover {
        background-color: #3385ff;
      }
      
      button[type="reset"] {
        background-color: #ff6666;
      }
      
      button[type="reset"]:hover {
        background-color: #ff4d4d;
      }
      
      a {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #0066cc;
        text-decoration: none;
        padding: 10px;
        border: 1px solid #4da6ff;
        border-radius: 5px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        background-color: white;
      }
      
      a:hover {
        background-color: #4da6ff;
        color: white;
      }
    </style>
  </head>
  <body>
    <p>
	Your balance:$
	<?php 
	session_start();
	echo $_SESSION["balance"]?>
	</p>
    <form id="reloadform" action="reload.php" method="post">
      <div>
      credit card id:
      <label><input type="text"name="credit_card_id" id="credit_card_id" required></label>
	  </div>
      <div>
      money you want to reload:
      <label><input type="text"name="reload" id="reload" required></label>
      </div>
      <button type="submit">submit</button>
      <button type="reset">reset</button>
    </form>
	  <script>
    document.getElementById('reloadform').addEventListener('submit', function(event) {
    var reloadamount = document.getElementById('reload').value;
    var creditcardid = document.getElementById('credit_card_id').value;
    let isValid = true;
    
    if (reloadamount === '') {
        alert('Please enter the amount');
        isValid = false;
    } else if (isNaN(reloadamount)) {
        alert('Amount must be a number');
        isValid = false;
    } else {
        var amount = parseFloat(reloadamount);
        if (amount <= 0) {
            alert('Amount must be greater than 0');
            isValid = false;
        }
    }
    
    if (creditcardid === '') {
        alert('Please enter credit card id');
        isValid = false;
    } else if (isNaN(creditcardid)) {
        alert('Credit id must be a number');
        isValid = false;
    }
    
    if (!isValid) {
        event.preventDefault(); 
    }
});
    </script>
	<a href='../userpage.php' class='back'>click to go back</a>
  </body>
</html>