<?php
namespace EasyRest\App\Controllers;

use GuzzleHttp\Client;
use EasyRest\System\Controller;
use EasyRest\System\Response\Response;
use GuzzleHttp\Exception\ServerException;
use EasyRest\System\Response\HtmlResponse;
use EasyRest\System\Response\JsonResponse;
use Symfony\Component\Filesystem\Filesystem;

class YoutubeController extends Controller
{
    public function index()
    {
        (new HtmlResponse('youtube'));
    }

    public function getLanguageDefinitions(string $language)
    {
        $fileSystem = new Filesystem();
        $baseDir = realpath(__DIR__.'/../../assets/content');
        $filePath = $baseDir . '/' . $language . '/youtube.json';

        if (!$fileSystem->exists($filePath) || !is_file($filePath)) {
            throw new InvalidFileException("Invalid language file", $filePath);
        }

        return new JsonResponse(json_decode(file_get_contents($filePath)));
    }

    public function getMP3()
    {
        $parsedUrl = parse_url($this->request->payload->get('link'));
        if (!$parsedUrl || !array_filter($parsedUrl) || !isset($parsedUrl['host']) || !isset($parsedUrl['query'])) {
            return (new JsonResponse(['error' => 'INVALID_LINK']))->withStatus(Response::BAD_REQUEST);
        }

        $hostArray = explode('.', $parsedUrl['host']);
        if (!in_array('youtube', $hostArray)) {
            return (new JsonResponse(['error' => 'NOT_YOUTUBE']))->withStatus(Response::BAD_REQUEST);
        }

        $parsedUrl['query'] = sprintf("?%s", $parsedUrl['query']);
        unset($parsedUrl['scheme']);
        $videoLink = implode('', $parsedUrl);

        $downloaderHost = $this->injector->inject('Environment')->get('yt-downloader-host');
        $requestUrl = sprintf("http://%s/dl/%s", $downloaderHost, $videoLink);

        $client = new Client();
        try {
            $response = $client->get($requestUrl);
        } catch (ServerException $ex) {
            return (new JsonResponse(
                json_decode($ex->getResponse()->getBody()->getContents())
            ))->withStatus($ex->getResponse()->getStatusCode());
        }

        $downloadsPath = $this->injector->inject('Environment')->get('yt-downloads-folder');
        $decodedResponse = json_decode($response->getBody()->getContents());
        $fileName = sprintf("%s/%s.mp3", $downloadsPath, $decodedResponse->data);
        $this->startDownload($fileName);
    }

    private function startDownload(string $filepath)
    {
        header('Content-Type: audio/mp3');
        header('Content-Disposition: attachment; filename=teste.mp3');
        header('Pragma: no-cache');
        header('Cache-Control: public, must-revalidate, max-age=0');
        header("Content-Length: ".filesize($filepath));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        ob_clean();
        flush();
        readfile($filepath);
        unlink($filepath);
    }
}
