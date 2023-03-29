<?php

namespace Unit\Interactor;

use DataVisualizer\DataPlotter\DataPlotter;
use DataVisualizer\DataProvider\JsonDataProvider;
use DataVisualizer\Interactor\DataVisualizationInteractor;
use PHPUnit\Framework\TestCase;

class DataVisualizationInteractorTest extends TestCase
{
    /**
     * @var DataPlotter|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    private mixed $plotter;
    /**
     * @var JsonDataProvider|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    private mixed $provider;

    private DataVisualizationInteractor $interactor;

    protected function setUp(): void
    {
        $this->plotter = $this->createMock(DataPlotter::class);
        $this->provider = $this->createMock(JsonDataProvider::class);

        $this->interactor = new DataVisualizationInteractor($this->provider, $this->plotter);
    }

    /**
     * @test
     */
    public function visualizeData(): void
    {
        $this->plotter->expects(self::once())->method('plot');
        $this->provider->expects(self::once())->method('getData');

        $this->interactor->visualizeData();
    }
}