<?php

namespace App\Services;

use \App\Models;

class ParserService
{
    private $file;

    public function __construct()
    {
        $this->file = $_SERVER["DOCUMENT_ROOT"] . '/log';
    }

    private function getLines($file)
    {
        $f = fopen($file, 'r');
        if (!$f) {
            throw new \Exception('Log file not found');
        }
        while ($line = fgets($f)) {
            yield $line;
        }
        fclose($f);
    }

    protected function getErrorData(string $line)
    {
        preg_match('/(?P<to>((?<=to=<)(.*?)(?=>))).*?(?P<ctladdr>((?<=ctladdr=<)(.*?)(?=>))).*?(?P<stat>((?<=stat=)(.*)))/', $line, $matches);
        $error['to'] = $matches['to'];
        $error['ctladdr'] = $matches['ctladdr'];
        $error['stat'] = $matches['stat'];
        return $error;
    }

    protected function findErrorOrCreate(string $errorName)
    {
        $error = Models\Error::firstOrCreate([
            'name' => $errorName,
        ]);
        return $error->id;
    }

    protected function storeEmailLog(int $errorId, array $data)
    {
        $emailLog = Models\Log::firstOrCreate([
            'error_id' => $errorId,
            'to' => $data['to'],
            'ctladdr' => $data['ctladdr'],
        ]);
        return $emailLog;
    }

    public function parsingProcess()
    {
        try {
            $lines = $this->getLines($this->file);
            foreach ($lines as $value) {
                $errorData = $this->getErrorData($value);
                $errorId = $this->findErrorOrCreate($errorData['stat']);
                $this->storeEmailLog($errorId, $errorData);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }
}
