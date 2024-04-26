<?php
declare(strict_types=1);

namespace Lib;

class BulkInsertSQLGenerator
{
    private string $outputPath;
    private string $tableName;
    private array $columnList;
    private int $statementSizeLimit;

    private string $buffer = '';

    public function __construct(
        string $outputPath,
        string $tableName,
        array $columnList,
        int $statementSizeLimit = 10 * 1024 * 1024
        )
    {

        $this->outputPath = $outputPath;
        $this->tableName = $tableName;
        $this->columnList = $columnList;
        $this->statementSizeLimit = $statementSizeLimit;
    }

    private function getFirstLine(): string
    {
        $columns = array_map(fn($column) => "`{$column}`", $this->columnList);
        $columns = implode(', ', $columns);
        return "\n" . "INSERT INTO `{$this->tableName}` ({$columns}) VALUES\n";
    }

    public function writeValues(array $values): void
    {
        $this->buffer = strlen($this->buffer) === 0 ? $this->getFirstLine() : $this->buffer;
        $line = '(' . implode(', ', array_map(fn($value) => "'{$value}'", $values)) . '),' ."\n";
        if (strlen($this->buffer . $line) > $this->statementSizeLimit) {
            $this->flush();
            $this->buffer = $this->getFirstLine();
        }
        $this->buffer .= $line;
    }

    public function flush(): void
    {
        $this->buffer = substr($this->buffer, 0, -2) . ";\n";
        $file = fopen($this->outputPath, 'a');
        fwrite($file, $this->buffer);
        fclose($file);
        $this->buffer = '';
    }
}
