<?php

namespace App\Service;

use Google\Client;
use Google\Service\Sheets\CellFormat;
use Google\Service\Sheets;
use Google\Service\Sheets\Color;
use Google\Service\Sheets\ValueRange;

class GoogleSheetsService
{
    private Sheets $sheets;
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName('ceosheets');
        $this->client->setScopes(Sheets::SPREADSHEETS);
        $this->client->setAuthConfig(__DIR__ . '/../../credentials.json');
        $this->sheets = new Sheets($this->client);
    }

    public function clearSheet(string $spreadsheetId, string $range): bool
    {
        try {
            $this->sheets->spreadsheets_values->clear(
                $spreadsheetId,
                $range,
                new Sheets\ClearValuesRequest()
            );
            return true;
        } catch (\Exception $e) {
            error_log("Error clearing sheet: " . $e->getMessage());
            return false;
        }
    }

    public function appendToSpreadsheet(string $spreadsheetId, string $range, array $values): bool
    {
        $body = new ValueRange();
        $body->setValues($values);

        try {
            $result = $this->sheets->spreadsheets_values->append(
                $spreadsheetId,
                $range,
                $body,
                ['valueInputOption' => 'RAW'] // Ou 'USER_ENTERED' selon vos besoins
            );

            return !empty($result);
        } catch (\Exception $e) {
            error_log("Error appending values to spreadsheet: " . $e->getMessage());
            return false;
        }
    }
    public function autoResizeColumns(string $spreadsheetId): bool
{
    // Créer une demande pour ajuster automatiquement la largeur des colonnes
    $request = new Sheets\AutoResizeDimensionsRequest();
    $request->setDimensions(new Sheets\DimensionRange([
        'sheetId' => 0, // L'ID de la feuille de calcul (0 pour la première feuille)
        'dimension' => 'COLUMNS',
        'startIndex' => 0, // L'indice de la première colonne
        'endIndex' => 26 // L'indice de la dernière colonne (26 pour la colonne Z)
    ]));

    // Créer la demande de mise à jour de la feuille de calcul
    $batchUpdateRequest = new Sheets\Request([
        'autoResizeDimensions' => $request
    ]);

    try {
        // Envoyer la demande à l'API Google Sheets
        $response = $this->sheets->spreadsheets->batchUpdate(
            $spreadsheetId,
            new Sheets\BatchUpdateSpreadsheetRequest([
                'requests' => [$batchUpdateRequest]
            ])
        );

        // Vérifier si la demande a réussi
        if (!empty($response->getReplies())) {
            return true; // Les colonnes ont été ajustées avec succès
        } else {
            return false; // La demande a échoué
        }
    } catch (\Exception $e) {
        error_log("Error auto resizing columns: " . $e->getMessage());
        return false;
    }
}
}
