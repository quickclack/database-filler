<?php

declare(strict_types = 1);

namespace Quickclack\Fillers\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Console\OutputStyle;
use Quickclack\Fillers\DTO\FillerDTO;
use Illuminate\Console\View\Components\Info;
use Illuminate\Console\View\Components\Task;

final class FillerRunningService
{
    private const DEFAULT_PATH = './database/fillers';

    public function __construct(
        private OutputStyle $output,
    ) {
    }

    public function runAll(): void
    {
        $fillers = $this->defineFillers();

        if ($fillers->isEmpty()) {
            (new Info($this->output))
                ->render('Nothing to fill.');

            return;
        }

        (new Info($this->output))
            ->render('Running fillers.');

        $fillers->map(fn(FillerDTO $fillerDTO) => $this->runFiller($fillerDTO));
    }

    public function defineFillers(): Collection
    {
        $completed = DB::table('fillers')
            ->pluck('filler');

        $unfulfilled = new Collection();

        $this->fillUnfulfilledFillers(self::DEFAULT_PATH, $completed, $unfulfilled);

        return $unfulfilled;
    }

    private function fillUnfulfilledFillers(string $path, Collection $completed, Collection $unfulfilled): void
    {
        $all = (new Collection(scandir($path)))->diff(['.', '..']);

        $all->diff($completed)->map(function ($file) use ($path, $completed, $unfulfilled): void {
            if (is_file("$path/$file") && preg_match('/\.php$/', $file) === 1) {
                $unfulfilled->add(new FillerDTO($file, $path));
            }

            if (is_dir("$path/$file")) {
                $this->fillUnfulfilledFillers("$path/$file", $completed, $unfulfilled);
            }
        });
    }

    private function runFiller(FillerDTO $fillerDTO): void
    {
        $filler = $this->getInstance($fillerDTO);
        $fileName = $fillerDTO->getFileName();

        (new Task($this->output))->render($fileName, function() use ($filler, $fileName) {
            if (method_exists($filler, 'run')) {
                $filler->run();
            }

            DB::table('fillers')
                ->insert(['filler' => $fileName]);
        });
    }

    private function getInstance(FillerDTO $fillerDTO): object
    {
        $filler = require_once ($fillerDTO->getPath() . '/' . $fillerDTO->getFileName());

        if (is_object($filler)) {
            return $filler;
        }

        return new ($fillerDTO->getClassName());
    }
}
