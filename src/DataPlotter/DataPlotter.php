<?php

namespace DataVisualizer\DataPlotter;

use DataVisualizer\DataPlotter\Exception\Domain\DataArrayIsEmptyException;
use DataVisualizer\DataPlotter\Exception\Domain\SingleValueException;

class DataPlotter implements DataPlotterInterface {
    private const TERMINAL_WIDTH = 80;

    /**
     * @throws DataArrayIsEmptyException
     * @throws SingleValueException
     */
    public function plot(array $data): void {
        $this->validateData($data);

        $normalizedData = $this->normalizeData($data);
        $scaledData = $this->scaleData($normalizedData, self::TERMINAL_WIDTH);

        foreach ($scaledData as $scaledValue) {
            echo $this->generateLine($scaledValue) . PHP_EOL;
        }
    }

    private function normalizeData(array $data): array
    {
        $normalizedData = [];
        $min = (float)min($data);
        $max = (float)max($data);

        foreach ($data as $value) {
            $normalizedData[] = ($value - $min) / ($max - $min);
        }

        return $normalizedData;
    }

    private function scaleData(array $normalizedData): array
    {
        $scaledData = [];

        foreach ($normalizedData as $normalizedValue) {
            $scaledData[] = (int) ($normalizedValue * self::TERMINAL_WIDTH);
        }

        return $scaledData;
    }

    private function generateLine(int $scaledValue): string
    {
        return str_repeat(' ', $scaledValue) . '*';
    }

    /**
     * @throws DataArrayIsEmptyException
     * @throws SingleValueException
     */
    private function validateData(array $data): void
    {
        if ($this->isEmpty($data)) {
            throw new DataArrayIsEmptyException();
        }

        if ($this->isSingleValue($data)) {
            throw new SingleValueException();
        }
    }

    private function isSingleValue(array $data)
    {
        return count($data) === 1;
    }

    private function isEmpty(array $data): bool {
        return empty($data);
    }
}
