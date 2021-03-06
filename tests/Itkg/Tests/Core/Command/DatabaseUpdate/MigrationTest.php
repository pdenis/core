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

/**
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class MigrationTest extends \PHPUnit_Framework_TestCase
{
    public function testQueries()
    {
        $queries = array('QUERY 1', 'QUERY 2');
        $rollbackQueries = array('ROLLBACK QUERY 1', 'ROLLBACK QUERY 2');

        $migration = new Migration($queries, $rollbackQueries);
        $this->assertEquals($queries, $migration->getQueries());
        $this->assertEquals($rollbackQueries, $migration->getRollbackQueries());
    }
}
