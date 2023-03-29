<?php

namespace DataVisualizer\DataPlotter\Exception\Domain;

class SingleValueException extends PlotterDataValidationException
{
    protected $message = "Data array has single value.";
}