<?php

namespace DataVisualizer\DataPlotter;

interface DataPlotterInterface {
    public function plot(array $data): void;
}