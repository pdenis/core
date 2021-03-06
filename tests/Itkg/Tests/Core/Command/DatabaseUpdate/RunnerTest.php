<?php

/*
 * This file is part of the Itkg\Core package.
 *
 * (c) Interakting - Business & Decision
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Itkg\Tests\Core\Command\DatabaseUpdate;

use Itkg\Core\Command\DatabaseUpdate\Migration;
use Itkg\Core\Command\DatabaseUpdate\Query;
use Itkg\Core\Command\DatabaseUpdate\Runner;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;


/**
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class RunnerTest extends \PHPUnit_Framework_TestCase
{
    public function testRun()
    {
        $queries = array(new Query('QUERY 1'), new Query('QUERY 2'));
        $rollbackQueries = array(new Query('ROLLBACK QUERY 1'), new Query('ROLLBACK QUERY 2'));

        $migration = new Migration($queries, $rollbackQueries);

        $runner = $this->createRunner();
        $runner->run($migration);

        $this->assertEquals($queries, $runner->getPlayedQueries());
        $runner->run($migration, false, true);

        $this->assertEquals(array_merge($queries, $queries, $rollbackQueries), $runner->getPlayedQueries());
    }

    /**
     * @expectedException \Exception
     */
    public function testRunException()
    {
        $queries = array(new Query('QUERY 1'), new Query('QUERY 2'));
        $rollbackQueries = array(new Query('ROLLBACK QUERY 1'), new Query('ROLLBACK QUERY 2'));

        $migration = new Migration($queries, $rollbackQueries);

        $runner = $this->createRunner();

        $runner->run($migration, true, true);

    }

    private function createRunner()
    {
        $params = array(
            'dbname' => 'DBNAME',
            'user'   => 'USER',
            'password' => 'PWD',
            'host' => '',
            'driver' => 'oci8'
        );

        $config = new Configuration();
        $connection = DriverManager::getConnection($params, $config);

        return new Runner($connection);
    }
}