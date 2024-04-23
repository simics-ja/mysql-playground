<?php
declare(strict_types=1);

namespace Lib;

class TimeMeter
{
    private array $results = [];
    private int $timeStart;
    private int $timeEnd;

    public function start(): void
    {
        $this->timeStart = hrtime(true);
    }

    public function end(): void
    {
        $this->timeEnd = hrtime(true);
    }

    public function next(): void
    {
        $this->results[] = $this->getNanoSec();
        $this->timeStart = 0;
        $this->timeEnd = 0;
    }

    public function getNanoSec(): int
    {
        return $this->timeEnd - $this->timeStart;
    }

    public function result(): string
    {
        if (count($this->results) === 0) {
            return "No results.";
        }
        $total = 0;
        $output = "";
        $output .= "Trial\tTime(ns)\tTime(ms)\tTime(s)\n";
        foreach ($this->results as $index => $result) {
            $total += $result;
            $output .= ($index + 1) . ":\t";
            $output .= $result . "\t"; // ns
            $output .= sprintf('%.6f', ($result / 1000000)) . "\t"; // ms
            $output .= sprintf('%.9f', ($result / 1000000000)) . "\n"; // s
        }
        if (count($this->results) === 1) {
            return $output;
        }
        $avg = round($total / count($this->results));
        $output .= "Avg:\t";
        $output .= $avg . "\t";
        $output .= sprintf('%.6f', ($avg / 1000000)) . "\t";
        $output .= sprintf('%.9f', ($avg / 1000000000)) . "\n";
        return $output;
    }
}