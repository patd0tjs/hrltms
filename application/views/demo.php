<!DOCTYPE html>
<html lang="en">
 
<head>
  <title>Select multiple Dates in jQuery DatePicker - Clue Mediator</title>
 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script
    src="https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI@master/jquery-ui.multidatespicker.js"></script>
 
  <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }
/*  
    input {
      width: 300px;
      padding: 7px;
    } */
 
    .ui-state-highlight {
      border: 0 !important;
    }
 
    .ui-state-highlight a {
      background: #363636 !important;
      color: #fff !important;
    }
  </style>
</head>
 
<body>
<form action="date" method="post">
<h3>Select multiple Dates in jQuery DatePicker - <a href="https://www.cluemediator.com" target="_blank" rel="noopener">Clue
      Mediator</a></h3>
  <input type="text" id="datePick" name="date" />
  <input type="submit" value="submit">
</form>

 
  <script>
    $(document).ready(function () {
      $('#datePick').multiDatesPicker();
    });
  </script>
</body>
 
</html>