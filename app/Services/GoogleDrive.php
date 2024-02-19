<?php
namespace App\Services;


use Google\Client as GoogleClient;
use Google\Service\Drive;
use Illuminate\Support\Facades\Auth;

class GoogleDrive
{

  private $driveService;

  public function init($serviceLocation)
  {
    $serviceAccountKey = storage_path($serviceLocation);
    // Create a Google API client
    $client = new GoogleClient();
    $client->setAuthConfig($serviceAccountKey);
    $client->setScopes([Drive::DRIVE]);
    // Authenticate using the service account
    $client->setAccessType('offline');
    $this->driveService = new Drive($client);
  }


  public function uploadFile($filePath, $folderId, $serviceAccount)
  {
    $this->init($serviceAccount);

    $fileMetadata = new \Google_Service_Drive_DriveFile([
      'name' => basename($filePath),
      'parents' => [$folderId]
    ]);


    try {
      $content = file_get_contents($filePath);
      $file = $this->driveService->files->create($fileMetadata, [
        'data' => $content,
        'mimeType' => mime_content_type($filePath),
        'uploadType' => 'multipart'
      ]);

      // Make the file public
      $this->driveService->permissions->create(
        $file->id,
        new \Google_Service_Drive_Permission([
          'type' => 'anyone',
          'role' => 'reader'
        ])
      );

      // Return the URL of the uploaded file
      return $file->id;
//      return 'file here webViewLink';

    } catch (\Exception $e) {
      // Handle any exceptions that occur during the upload
      return null;
    }


  }

  private function getFolderIdFromPath($drivePath, $serviceAccount)
  {
    $this->init($serviceAccount);
    $folderNames = explode('/', $drivePath);

    $parent = 'root';
    foreach ($folderNames as $folderName) {
      $folder = $this->findFolderByName($folderName, $parent, $serviceAccount);
      if (!$folder) {
        return null;
      }
      $parent = $folder->id;
    }

    return $parent;
  }

  private function findFolderByName($folderName, $parent, $serviceAccount)
  {
    $this->init($serviceAccount);
    $params = [
      'q' => "mimeType='application/vnd.google-apps.folder' and name='$folderName' and '$parent' in parents",
      'fields' => 'files(id)',
    ];

    $response = $this->driveService->files->listFiles($params);
    $folders = $response->getFiles();

    return count($folders) ? $folders[0] : null;
  }

  public function createFolderByPath($drivePath, $shareEmail, $serviceAccount)
  {
    $this->init($serviceAccount);
    $folderNames = explode('/', $drivePath);

    $parent = 'root';
    foreach ($folderNames as $folderName) {
      $existingFolder = $this->findFolderByName($folderName, $parent, $serviceAccount);

      if ($existingFolder) {
        $parent = $existingFolder->id;
      } else {
        $folder = new \Google_Service_Drive_DriveFile([
          'name' => $folderName,
          'mimeType' => 'application/vnd.google-apps.folder',
          'parents' => [$parent],
        ]);

        $createdFolder = $this->driveService->files->create($folder);
        $parent = $createdFolder->id;

        $permission = new \Google_Service_Drive_Permission([
          'type' => 'user',
          'role' => 'writer', // Adjust the role accordingly
          'emailAddress' => $shareEmail,
        ]);
        $this->driveService->permissions->create($parent, $permission);


      }
    }

    return $parent;
  }


  public function getFileInFolders($folderId)
  {
    $pageSize = 1000;
    $results = [];

    $params = [
      'q' => "'$folderId' in parents",
      'fields' => 'nextPageToken, files(id, name, webViewLink, webContentLink, thumbnailLink, mimeType)',
      'pageSize' => $pageSize
    ];

    do {
      $response = $this->driveService->files->listFiles($params);
      $results = array_merge($results, $response->getFiles());

      $params['pageToken'] = $response->getNextPageToken();
    } while ($response->getNextPageToken());


    return $results;
  }


  public function getFileDownload($fileId): string
  {
      return "https://www.googleapis.com/drive/v3/files/$fileId?alt=media&key=". env("GOOGLE_DRIVE_KEY");
  }



}

?>
