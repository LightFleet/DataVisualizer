<?php

namespace DataVisualizer\DataProvider;

class JsonDataProvider
{
    private string $filePath;

    public function __construct(string $filePath) {
        $this->filePath = $filePath;
    }

    public function getData(): array {
        $dataJson = $this->readJson($this->filePath);

        return $this->decodeJson($dataJson);
    }

    private function readJson(string $filePath): string
    {
        if (!file_exists($filePath)) {
            throw new \RuntimeException("Data file not found: {$filePath}");
        }

        $dataJson = file_get_contents($filePath);

        if ($dataJson === false) {
            throw new \RuntimeException("Error occurred while trying to read data from file {$filePath}");
        }

        return $dataJson;
    }

    private function decodeJson(string $dataJson): array
    {
        $data = json_decode($dataJson, true);

        if ($data === null) {
            throw new \RuntimeException("Error occured while decoding data from file {$this->filePath}");
        }

        return $data;
    }
}