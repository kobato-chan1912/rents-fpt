<?php
namespace App\Services;

use Illuminate\Support\Str;

class VideoService
{
    public function createYoutubeEmbedLink($youtubeId): string
    {
        return $youtubeId;
    }
    public function createYoutubeLink($youtubeId): string
    {
        return $youtubeId;
    }

    public function getVideoDownload($videoId): ?array
    {
        $a[0] = 1;
        $a[1] = 1;
        return $a;
//        header('Content-Type: application/json');
//        $string = shell_exec("youtube-dl --get-url https://youtu.be/$videoId");
//        // Use regular expression to match both URLs
//        preg_match_all('/\bhttps?:\/\/\S+/', $string, $matches);
//        if (!empty($matches[0])) {
//            return $matches[0];
//        } else {
//            return null;
//        }
    }

    function crawlVideoSource($youtubeId): ?array // new function
    {
        $youtubeName = shell_exec(env("YOUTUBE_DL"). " --get-title $youtubeId");
        if ($youtubeName !== null)
        {
            $dlink = shell_exec(env("YOUTUBE_DL"). " -f best $youtubeId -g");
            return [$youtubeName ,  trim($dlink)];
        } else {
            return null;
        }
    }
//    function crawlVideoSource($youtubeId): ?array
//    {
//        $url = "https://dirpy.com/studio?url=https://youtu.be/$youtubeId&affid=tubeoffline&utm_source=tubeoffline&utm_medium=download";
//
//        // Send a request to the URL
//        $client = new \GuzzleHttp\Client();
//        $response = $client->request('GET', $url);
//        $html = $response->getBody()->getContents();
//
//        // Parse the HTML using Symfony DomCrawler
//        $crawler = new \Symfony\Component\DomCrawler\Crawler($html);
//
//        // Find the video tag and get the source URL
//        $videoTag = $crawler->filter('source');
//        $youtubeName = $crawler->filter('input[name="ID3[title]"]')->attr('value');
//        if ($videoTag->count() > 0) {
//            return [$youtubeName ,$videoTag->attr('src')];
//        }
//        else
//        {
//            return null;
//        }
//    }

    public function screenCapture($dLink, $seconds)
    {
        if ($dLink !== null)
        {
            $fileName = Str::random();
            $ffmpeg = \FFMpeg\FFMpeg::create([
                'ffmpeg.binaries'  => exec('which ffmpeg'),
                'ffprobe.binaries' => exec('which ffprobe')
            ]);
//            $hours = floor($seconds / 3600);
//            $minutes = floor(($seconds % 3600) / 60);
//            $seconds = $seconds % 60;
//            $milliseconds = round(fmod($seconds, 1) * 1000);
//            $timecode = sprintf('%02d:%02d:%02d.%03d', $hours, $minutes, $seconds, $milliseconds);
            $video = $ffmpeg->open($dLink);
            $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds($seconds))
                ->save(public_path("screenshots/$fileName.jpg"));
            return "/screenshots/$fileName.jpg";
        }
    }
}
