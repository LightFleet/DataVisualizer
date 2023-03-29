<?php

namespace Unit\DataProvider;

use DataVisualizer\DataProvider\JsonDataProvider;
use PHPUnit\Framework\TestCase;

class JsonDataProviderTest extends TestCase
{
    private string $validJsonFilePath;
    private string $invalidJsonFilePath;
    private string $nonexistentFilePath;

    protected function setUp(): void
    {
        $this->validJsonFilePath = __DIR__ . '/fixtures/valid.json';
        $this->invalidJsonFilePath = __DIR__ . '/fixtures/invalid.json';
        $this->nonexistentFilePath = __DIR__ . '/fixtures/nonexistent.json';
    }

    /**
     * @test
     */
    public function it_can_read_valid_json(): void
    {
        $dataProvider = new JsonDataProvider($this->validJsonFilePath);
        $data = $dataProvider->getData();

        $expectedData = [
            1.3,
            1.5,
            1.6,
        ];

        self::assertEquals($expectedData, $data);
    }

    /**
     * @test
     */
    public function it_throws_exception_when_reading_nonexistent_file(): void
    {
        $dataProvider = new JsonDataProvider($this->nonexistentFilePath);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage("Data file not found: {$this->nonexistentFilePath}");

        $dataProvider->getData();
    }

    /**
     * @test
     */
    public function it_throws_exception_when_decoding_invalid_json(): void
    {
        $dataProvider = new JsonDataProvider($this->invalidJsonFilePath);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage("Error occured while decoding data from file {$this->invalidJsonFilePath}");

        $dataProvider->getData();
    }
}