<?php

namespace Unit\DataPlotter;

use DataVisualizer\DataPlotter\DataPlotter;
use DataVisualizer\DataPlotter\Exception\Domain\DataArrayIsEmptyException;
use DataVisualizer\DataPlotter\Exception\Domain\PlotterDataValidationException;
use DataVisualizer\DataPlotter\Exception\Domain\SingleValueException;
use PHPUnit\Framework\TestCase;

class DataPlotterTest extends TestCase
{
    private DataPlotter $plotter;

    protected function setUp(): void
    {
        $this->plotter = new DataPlotter();
    }

    /**
     * @test
     * @tests_errors
     * @dataProvider plotDataProvider
     */
    public function E_plot(array $data, PlotterDataValidationException $expectedException): void
    {
        if ($expectedException) {
            self::expectException($expectedException::class);
            self::expectExceptionMessage($expectedException->getMessage());
        }

        $this->plotter->plot($data);
    }

    public function plotDataProvider(): iterable
    {
        yield "Data is empty" => [[], new DataArrayIsEmptyException()];
        yield "Data array has single value" => [[1], new SingleValueException()];
    }
}