<?php

use Binafy\LaravelStub\Facades\LaravelStub;

test('generate stub successfully with all options', function () {
    $stub = __DIR__ . '/test.stub';

    $generate = LaravelStub::from($stub)
        ->to(__DIR__ . '/../App')
        ->replaces([
            'CLASS' => 'Milwad',
            'NAMESPACE' => 'App\Models'
        ])
        ->replace('TRAIT', 'HasFactory')
        ->name('new-test')
        ->ext('php')
        ->generate();

    \PHPUnit\Framework\assertTrue($generate);
    \PHPUnit\Framework\assertFileExists(__DIR__ . '/../App/new-test.php');
    \PHPUnit\Framework\assertFileDoesNotExist(__DIR__ . '/../App/test.stub');
});

test('throw exception when stub path is invalid', function () {
    $generate = LaravelStub::from('test.stub')
        ->to(__DIR__ . '/../App')
        ->name('new-test')
        ->ext('php')
        ->generate();

    \PHPUnit\Framework\assertFileDoesNotExist(__DIR__ . '/../App/new-test.php');
    \PHPUnit\Framework\assertFileExists(__DIR__ . '/../App/test.stub');
})->expectExceptionMessage('The stub file is not exists, please enter a valid path.');
