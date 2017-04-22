<?php 
$base_url = "http://cybersansar.com/";
$contents = getContent("http://www.cybersansar.com/model_main.php");
$pattern = "/thumbnail_view\.php\?gal_id=[0-9]+/";
//thumbnail_view.php?gal_id=2220&image_id=50617
preg_match_all($pattern, $contents, $matches);

if(!empty($matches[0])){
	foreach ($matches[0] as $match) {
		# code...
		$url = $base_url . $match;
		$modelContent = getContent($url);
		// graphics/model/miss_acnes_2017_contestan/thumb/miss acnes 2017_contestants_777307530.jpg
		$mpattern = "/(graphics)\/(model)\/(miss_acnes_2017_contestan)\/(thumb)\/(miss)\s+(acnes)\s+(2017_contestants_[0-9]+.jpg)/";
		/*echo $mpattern;*/

		preg_match_all($mpattern, $modelContent, $img);
		//print_r($img);
		if(!empty($img[0])){
			foreach ($img[0] as $modals) {
				# code...
				$new_image = str_replace("/thumb","",$modals);
				$imageurl = $base_url.$new_image;
				/*var_dump($imageurl);
				die();*/
				$imageurl = str_replace(" ", "%20", $imageurl);
				/*echo $imageurl;
				die();*/

				$tokens = explode("/",$imageurl);
				//download($imageurl,)
				
				$filename = $tokens[count($tokens)-1];

				$token2 = explode(" ",$filename);
				
				$new_finalname = $token2[count($token2)-1];
				
				/*echo '<pre>';*/
				var_dump($new_finalname);
				die();
				download($imageurl,$new_finalname);
				//exit;
			}
		}		
	}
}
function getContent($url){
	return $contents = file_get_contents($url);
}
function download($url,$filename){
	$file1=fopen($url,"r"); //url read mode ma kholne
	
	$file2=fopen($filename,"w+"); //local ko file write mode ma knolne

	while($data=fread($file1,1024)){
		fwrite($file2,$data);
	}
	fclose($file1);
	fclose($file2);
}
?>



