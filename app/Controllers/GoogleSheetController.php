<?php

namespace App\Controllers;

use App\Services\GoogleService;
use CodeIgniter\Controller;
use Google\Service\Drive;


class GoogleSheetController extends Controller
{
 

    public function createSheet($id=101)
    {
        try {
            // Get Google API Client
            $client = \App\Services\GoogleService::getClient();
            $service = new \Google\Service\Sheets($client);
    
            // Create the Google Sheet
            $spreadsheet = new \Google\Service\Sheets\Spreadsheet([
                'properties' => [
                    'title' => 'Form Data Sheet', // Title of the sheet
                ],
            ]);
            $spreadsheet = $service->spreadsheets->create($spreadsheet);
    
            // Retrieve the Spreadsheet ID and URL
            $spreadsheetId = $spreadsheet->spreadsheetId;
            $spreadsheetUrl = $spreadsheet->spreadsheetUrl;
    
            // Grant access using Drive API
            $driveService = new Drive($client);
            $permission = new Drive\Permission([
                'type' => 'user', // Can be 'user' or 'domain'
                'role' => 'writer', // Can be 'reader', 'writer', or 'owner'
                'emailAddress' => 'ronakvaya@gmail.com', // Replace with the admin's email
            ]);
            $driveService->permissions->create($spreadsheetId, $permission);
    
            // Save to database
            /*$db = \Config\Database::connect();
            $db->table('form_submissions')->where('id', $id)->update([
                'google_sheet_id' => $spreadsheetId,
                'google_sheet_url' => $spreadsheetUrl,
            ]);*/
    
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Google Sheet created successfully and shared.',
                'spreadsheetId' => $spreadsheetId,
                'spreadsheetUrl' => $spreadsheetUrl,
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
    
    
}
