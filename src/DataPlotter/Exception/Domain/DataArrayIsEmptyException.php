<?php

namespace DataVisualizer\DataPlotter\Exception\Domain;

class DataArrayIsEmptyException extends PlotterDataValidationException
{
    protected $message = "Data array is empty.";
}