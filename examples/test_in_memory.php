<?php

/*
 * This file is part of the BenGorFile package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use BenGorFile\Application\UploadFileCommand;

require_once __DIR__ . '/../vendor/autoload.php';

function createCommandBus(array $handlers) : callable
{
    return function ($command) use ($handlers) : array {
        return $handlers[get_class($command)]($command);
    };
}

function printResult(string $when, array $files) : void
{
    echo "------------------------------------------------------------------------\n";
    echo(sprintf("%s, there are %d files stored in memory.\n", $when, count($files)));
}

$files = [];
printResult('At first', $files);

$uploadFile = \BenGorFile\Application\uploadFile(
    \BenGorFile\Domain\Model\File\save(
        [
            \BenGorFile\Infrastructure\Domain\Model\File\inMemoryPersist,
            \BenGorFile\Infrastructure\Domain\Model\File\inMemoryWrite,
        ],
        $files
    )
);

$uploadFileCommand = new UploadFileCommand(
    uniqid(),
    'testname.png',
    'testfilecontent',
    'image/png'
);

$commandBus = createCommandBus([
    UploadFileCommand::class => $uploadFile,
]);

$files = $commandBus($uploadFileCommand);
printResult('After execute upload file use case', $files);
