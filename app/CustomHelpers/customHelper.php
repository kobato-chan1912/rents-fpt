<?php
use  \Carbon\Carbon;
function formatMonth($month): string
{
    return sprintf("%02d", $month);
}

function formatTimeLine($seconds) : string

{
  $hours = floor($seconds / 3600);
  $minutes = floor(($seconds % 3600) / 60);
  $seconds = $seconds % 60;
  $milliseconds = round(fmod($seconds, 1) * 1000);



  if ($hours > 0) {
    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
  } else {
    return sprintf('%02d:%02d', $minutes, $seconds);
  }

}

function getGenderPortfolio($sex)
{
  if ($sex == 0){
    return "Nam";
  }

  if ($sex == 1){
    return "Nữ";
  }

  if ($sex == 2){
    return "LGBT";
  }

}

function formatUrl($inputUrl)
{
  if (\Illuminate\Support\Str::contains($inputUrl, "/shorts")){
    $pattern = '/\/shorts\/([A-Za-z0-9_-]{11})/';
    preg_match($pattern, $inputUrl, $matches);

    if (count($matches) > 1) {
      $yId =  $matches[1];
      return "https://www.youtube.com/watch?v=$yId";
    }

  }

  return $inputUrl;
}

function get_youtube_video_id($url) {
  if (\Illuminate\Support\Str::contains($url, "/shorts")){
    $pattern = '/\/shorts\/([A-Za-z0-9_-]{11})/';
    preg_match($pattern, $url, $matches);

    if (count($matches) > 1) {
      return $matches[1];
    }

  } else {
    $url_parts = parse_url($url);
    if ($url_parts['host'] == 'youtu.be') {
      return substr($url_parts['path'], 1);
    }
    else {
      parse_str($url_parts['query'], $query_params);
      return $query_params['v'];
    }
  }


}


function get_youtube_preview($id): string
{
  return "https://i3.ytimg.com/vi/$id/hqdefault.jpg";
}


function Last12Months()
{
  $currentMonth = Carbon::today();// Get the current date
  $months = [];


  for ($i = 0; $i < 13; $i++) {
    $months[] = $currentMonth->copy();
    $currentMonth->subMonth();
  }
  usort($months, function ($a, $b) {
    return $a <=> $b;
  });

  return $months;
}

?>
