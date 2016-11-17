<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title> TMNT - Rancid Tomatoes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="movie.css">
        <link rel="shortcut icon" type="image/gif" href="images/rotten.gif">
    </head>

    <?php
  //variables
  $movie = $_GET["film"];
  $raw_info = file_get_contents("$movie/info.txt");
  $raw_overview = file_get_contents("$movie/overview.txt");
  $info = explode("\n", $raw_info);
  $overview = explode("\n", $raw_overview);
  $count = 0;
  $freshness = "";
  $freshAlt = "";
  $printThis="";



function sidebar(){
  global $overview;
  $strmy="";
  foreach ($overview as $row) {
      $row=explode(":",$row);
      $strmy=$strmy. "<dt>{$row[0]}</dt><dd>{$row[1]}</dd>";
  }
  return $strmy;
}


function getRev(){
  global $movie;
  global $count;
  $strmy="";
  $raw_review = array();
  foreach (glob("$movie/review*.txt") as $filename) {
    $raw_review[$count]=file_get_contents("$filename");
    $count++;
  }
  for ($i=0; $i<$count ; $i++) {
    $review=explode("\n",$raw_review[$i]);
    $strmy=$strmy. displayReview($review,$i);
  }
  return $strmy;
}

function displayReview($review,$i){
  global $count;
  $strmy="";
  $i++;
  $review[1]=strtolower($review[1]);
  $strmy=$strmy. "
  <div class='reviewquote'>
  <img class='likeimg' src='images/{$review[1]}.gif' alt='{$review[1]}'>
  	&ldquo;{$review[0]}&rdquo; <br><br></div>



  <div class='personalquote'>
  	<img class='personimg' src='images/critic.gif' alt='Critic' />
    {$review[2]}<br/>
    {$review[3]}
    </div>";
  if($i==ceil($count/2)){
     $strmy=$strmy. "</div>
          <div class='reviewcol'>";
  }
  return $strmy;
}
if (intval($info[2]) > 59){
    $freshness = "freshbig.png";
    $freshAlt = "Fresh";
  }
  else{
    $freshness = "rottenbig.png";
    $freshAlt = "Rotten";
  }

     ?>
    <body>
        <div id="banner"><img src="images/banner.png" alt="banner"></div>
        <div>
        <h1> <?=$info[0]?> (<?=$info[1]?>)</h1>

        <div id="overall">
          <div id="reviewsbar">
            <img id="reviewsbarimg" src="images/<?=$freshness?>" alt="<?=$freshAlt?>" />
            <div  id="rate" > <?=$info[2]?>%</div>
          </div>
            <div id="Overview">
                <img src="<?=$movie?>/overview.png" alt="overview">
                <dl class="OverViewdl">
                  <?=sidebar();?>
                </dl>
            </div>
            <div id="reviews">


                <div class="reviewcol">
                    <?=getRev(); ?>
                </div>
            </div>
            <div id="bottombar">
                (1-<?=$count?>) of <?=$count?>
            </div>
            <div id="reviewsbar">
              <img id="reviewsbarimg" src="images/<?=$freshness?>" alt="<?=$freshAlt?>" />
              <div  id="rate" > <?=$info[2]?>%</div>
            </div>

        </div>
        <div id="w3ccheck">
            <a href="http://validator.w3.org/check/referer"><img src="images/w3c-html.png" alt="Valid HTML5"></a> <br>
            <a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="images/w3c-css.png" alt="Valid CSS"></a>

	</div>
  <div id="banner1"><img src="images/banner.png" alt="banner"></div>

</div)
</body></html>
