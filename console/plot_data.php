<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DataVisualizer\DataPlotter\DataPlotter;
use DataVisualizer\DataProvider\JsonDataProvider;
use DataVisualizer\Interactor\DataVisualizationInteractor;

const DATA_FILE_PATH = 'data/data.json';
$dataPlotter = new DataPlotter();
$dataProvider = new JsonDataProvider(DATA_FILE_PATH);

$dataVisualizationInteractor = new DataVisualizationInteractor($dataProvider, $dataPlotter);
$dataVisualizationInteractor->visualizeData();
