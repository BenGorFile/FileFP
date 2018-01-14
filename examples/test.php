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

require_once __DIR__ . '/../vendor/autoload.php';

function createCommandBus(array $handlers) : callable
{
    return function ($command) use ($handlers) : void {
        $handlers[get_class($command)]($command);
    };
}

$uploadFile = \BenGorFile\File\Application\upload(
    new \BenGorFile\File\Infrastructure\Domain\Model\InMemoryFilesystem(),
    new \BenGorFile\File\Infrastructure\Persistence\InMemory\InMemoryFileRepository()
);

$uploadFileCommand = new \BenGorFile\File\Application\UploadFileCommand(
    'testname.png',
    'testfilecontent',
    'image/png'
);

$commandBus = createCommandBus([
    \BenGorFile\File\Application\UploadFileCommand::class => $uploadFile,
]);

$commandBus($uploadFileCommand);
