<!DOCTYPE html>
<html>
	<head>
		<title>
			Add your events
		</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
  			<h2>Add Items Along with their Calorie Value</h2>
  			<form  method="post" action="add.php" enctype="multipart/form-data">
    			<div class="form-group">
      				<label for="item">Item:</label>
      				<input type="text" class="form-control" id="item" placeholder="Enter your Item" name="item" required>
    			</div>
    			<div class="form-group">
				      <label for="value">Calorie Value:</label>
				      <input type="text" class="form-control" id="value" placeholder="Enter Calorie Value" name="value" required>
			    </div>
			    <div class="dropdown">
			    	<button class=" btn btn-default dropdown-toogle" data-toggle="dropdown">
			    		Minor
			    		<span class="caret"></span>
			    	</button>
			    	<ul class="dropdown-menu" role="menu">
			    		<li>
			    			Veg
			    		</li>
			    		<li>
			    			Non Veg
			    		</li>
			    	</ul>
			    </div>
			    <div class="dropdown">
			    	<button class="btn btn-default dropdown-toogle" data-toggle="dropdown">
			    		Major
			    		<span class="caret"></span>
			    	</button>
			    	<ul class="dropdown-menu" role="menu">
			    		<li>
			    			Eatables
			    		</li>
			    		<li>
			    			Beverages
			    		</li>
			    	</ul>
			    </div>   
			    <!--<div class="form-group">
			    	<label for="big">
			    		Image of event(if have):
			    	</label>
			    	<input type="file" name="img" id="img" required>
			    </div>-->
			    <button type="submit" class="btn btn-default">Create Entry</button>
			 </form>
		</div>
	</body>
</html>