<?php
/**
 * Copyright 2017 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\Tests\Unit\BigQuery;

use Google\Cloud\BigQuery\JobConfigurationTrait;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;

/**
 * @group bigquery
 */
class JobConfigurationTraitTest extends TestCase
{
    const PROJECT_ID = 'project-id';
    const JOB_ID = '1234';

    private $trait;

    public function setUp()
    {
        $this->trait = \Google\Cloud\Core\Testing\TestHelpers::impl(JobConfigurationTrait::class);
    }

    public function testJobConfigurationProperties()
    {
        $this->trait->call('jobConfigurationProperties', [
            self::PROJECT_ID,
            ['jobReference' => ['jobId' => self::JOB_ID]]
        ]);

        $this->assertEquals([
            'projectId' => self::PROJECT_ID,
            'jobReference' => [
                'jobId' => self::JOB_ID,
                'projectId' => self::PROJECT_ID
            ]
        ], $this->trait->call('toArray'));
    }

    public function testJobConfigurationPropertiesSetsJobIDWhenNotProvided()
    {
        $this->trait->call('jobConfigurationProperties', [
            self::PROJECT_ID,
            []
        ]);
        $jobId = $this->trait->call('toArray')['jobReference']['jobId'];

        $this->assertInternalType('string', $jobId);
        $this->assertTrue(Uuid::isValid($jobId));
    }

    public function testDryRun()
    {
        $isDryRun = true;
        $this->trait->call('dryRun', [$isDryRun]);

        $this->assertEquals(
            $isDryRun,
            $this->trait->call('toArray')['configuration']['dryRun']
        );
    }

    public function testJobIdPrefix()
    {
        $jobIdPrefix = 'prefix';
        $this->trait->call('jobConfigurationProperties', [
            self::PROJECT_ID,
            ['jobReference' => ['jobId' => self::JOB_ID]]
        ]);
        $this->trait->call('jobIdPrefix', [$jobIdPrefix]);

        $this->assertEquals(
            sprintf('%s-%s', $jobIdPrefix, self::JOB_ID),
            $this->trait->call('toArray')['jobReference']['jobId']
        );
    }

    public function testLabels()
    {
        $labels = ['test' => 'label'];
        $this->trait->call('labels', [$labels]);

        $this->assertEquals(
            $labels,
            $this->trait->call('toArray')['configuration']['labels']
        );
    }

    public function testGenerateJobId()
    {
        $uuid = $this->trait->call('generateJobId');
        $this->assertInternalType('string', $uuid);
        $this->assertTrue(Uuid::isValid($uuid));
    }
}
