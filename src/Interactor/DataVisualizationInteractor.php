<?php

namespace DataVisualizer\Interactor;

use DataVisualizer\DataPlotter\DataPlotter;
use DataVisualizer\DataProvider\JsonDataProvider;

class DataVisualizationInteractor implements Interactor {
    private JsonDataProvider $dataProvider;
    private DataPlotter $dataPlotter;

    public function __construct(JsonDataProvider $dataProvider, DataPlotter $dataPlotter) {
        $this->dataProvider = $dataProvider;
        $this->dataPlotter = $dataPlotter;
    }

    public function visualizeData(): void {
        try {
            $data = $this->dataProvider->getData();
            $this->dataPlotter->plot($data);
        } catch (\Exception $exception) {
            echo $exception->getMessage() . PHP_EOL;
        }
    }
}