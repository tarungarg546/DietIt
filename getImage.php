<?php
	include 'testmysql.php';
	$toSearch=$_GET['item']' india -wikipedia -pixabay';
	//echo $toSearch;
	search($toSearch,$con);
	function search($query,$con)
	{
		$url = "https://www.googleapis.com/customsearch/v1?key=**YOUR API KEY HERE**&cx=**YOUR CX HERE**&num=1&q=".urlencode( $query ).  "&fileType=png,jpg&searchType=image&fields=items(link)&alt=json";
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
      		if($temp=='http'){
      			$tlen=$len-$index-11;
      			$final=substr($ans,$index,$tlen);
      			//echo $final;
      			$msqli=mysqli_query($con,"UPDATE calorietable SET imageURI='$final'  WHERE item='$query' ") or die(mysqli_error($con));
      			if($msqli)
      			{
      				echo "UPDATED";
      			}
      			else
      			{
      				echo "Damn";
      			}
      			break;
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
	  	//echo $err;
	  	//echo $errmsg;
	  	return $header;
	}
?>
