<?php
	include 'testmysql.php';
		$item=$_GET['item'];
		$major=$_GET['major'];
		$minor=$_GET['minor'];
		$unit=$_GET['unit'];
		$json=array();
	if(isset($_GET['calorie']))//calorie value is there the add new value or update earlier in db
	{
		$cValue=$_GET['calorie'];
		$q1=mysqli_query($con,"SELECT * FROM calorietable WHERE item='$item'") or die(mysqli_error($con));
		if($q1->num_rows<1)//entirely new item
		{
			$query=$item.' india -wikipedia -pixabay';
			$imgURI=getImg($query,$con);
			$ins=mysqli_query($con,"INSERT INTO calorietable(item,major,minor,unit,value,verified,tries,average,imageURI) VALUES ('$item','$major','$minor','$unit','$cValue','0','1','$cValue','$imgURI')") or die(mysqli_error($con));
			$json['inserted']=1;
			echo json_encode($json);

		}
		else//so called AI part
		{
			$res1=mysqli_fetch_array($q1);
			$triesEarlier=$res1['tries'];
			$avgEarlier=$res1['average'];
			$verified=$res1['verified'];
			$newavg=$avgEarlier*$triesEarlier+$cValue;
			$newavg=$newavg/($triesEarlier+1);
			if($verified==1){
				echo "Value is already verified";
				exit();
			}
			if($triesEarlier==9)//now verify it and update in db
			{
				$update=mysqli_query($con,"UPDATE calorietable SET value='$newavg',verified='1',tries='10',average='$newavg' where item='$item'") or die(mysqli_error($con));
				$json['inserted']=1;
				echo json_encode($json);
			}
			else//still not verified
			{
				$triesEarlier++;
				$update=mysqli_query($con,"UPDATE calorietable SET value='$newavg',verified='0',tries='$triesEarlier',average='$newavg' where item='$item'") or die(mysqli_error($con));
			}	$json['inserted']=1;
			echo json_encode($json);
		}

	}
	else//not adding new value
	{
		echo "No need to add!";
	}
	function getImg($query,$con)
    {
      $url = "https://www.googleapis.com/customsearch/v1?key=AIzaSyBKP23m6LOgkPdXUQuEW6tS6K0Sa0b73oo&cx=004304064422499840228:fj47nlhoyvw&num=1&q=".urlencode( $query ).  "&fileType=png,jpg&searchType=image&fields=items(link)&alt=json";
		  $result=perform_magic($url);
		  if ( $result['http_code'] == 403 )
      		echo "... error: daily limit exceeded ...";
  		if ( $result['errno'] != 0 )
      		echo "... error: bad url, timeout, redirect loop ...";
  		if ( $result['http_code'] != 200 )
      		echo "... error: no page, no permissions, no service ...";
      	//echo json_decode($result['content']);
      	//$json=array();
      	//echo var_dump(json_decode($result['content'],true));
      	//echo $json;
      	$ans=$result['content'];
      	//echo $ans;
      	$len=strlen($ans);
      	for($index=0;$index<$len;$index++)
      	{
      		$temp=substr($ans,$index,4);
      		if($temp=='http')
      		{
      			$tlen=$len-$index-11;
      			$final=substr($ans,$index,$tlen);
      			//echo $final;
      			//echo "\n";
      			return $final;
      			//$msqli=mysqli_query($con,"UPDATE calorietable SET imageURI='$final'  WHERE item='$item'") or die(mysqli_error($con));

      			//break;
      		}
      	}
      }
        function perform_magic($url)
        {
		      $options = array(
         		CURLOPT_RETURNTRANSFER => true,     // return web page
          		CURLOPT_HEADER         => false,    // don't return headers
    		    CURLOPT_FOLLOWLOCATION => true,     // follow redirects
    		    CURLOPT_ENCODING       => "",       // handle all encodings
    		    CURLOPT_AUTOREFERER    => true,     // set referer on redirect
    		    CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
    		    CURLOPT_TIMEOUT        => 120,      // timeout on response
    		    CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
  		    );
      		$ch      = curl_init( $url );
    	  	curl_setopt_array( $ch, $options );
    	  	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	  	$content = curl_exec( $ch );
    	  	$err     = curl_errno( $ch );
    	  	$errmsg  = curl_error( $ch );
    	  	$header  = curl_getinfo( $ch );
    	  	curl_close( $ch );
    	  	$header['errno']   = $err;
    	  	$header['errmsg']  = $errmsg;
    	  	$header['content'] = $content;
          return $header;
        }
?>