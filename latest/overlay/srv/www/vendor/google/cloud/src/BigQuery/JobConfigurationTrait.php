<?php
/**
 * Copyright 2017 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\BigQuery;

use Google\Cloud\Core\ArrayTrait;
use Ramsey\Uuid\Uuid;

/**
 * A utility trait implementing shared behavior between job configurations.
 */
trait JobConfigurationTrait
{
    use ArrayTrait;

    /**
     * @var string $jobIdPrefix
     */
    private $jobIdPrefix;

    /**
     * @var array $config
     */
    private $config = [];

    /**
     * Sets shared job configuration properties.
     *
     * @access private
     * @param string $projectId The project's ID.
     * @param array $config A set of configuration options for a job.
     */
    public function jobConfigurationProperties($projectId, array $config)
    {
        $this->config = array_replace_recursive([
            'projectId' => $projectId,
            'jobReference' => ['projectId' => $projectId]
        ], $config);

        if (!isset($this->config['jobReference']['jobId'])) {
            $this->config['jobReference']['jobId'] = $this->generateJobId();
        }
    }

    /**
     * Specifies the default dataset to use for unqualified table names in the
     * query.
     *
     * @param bool $dryRun
     * @return JobConfigInterface
     */
    public function dryRun($dryRun)
    {
        $this->config['configuration']['dryRun'] = $dryRun;

        return $this;
    }

    /**
     * Sets a prefix for the job ID.
     *
     * @param string $jobIdPrefix If provided, the job ID will be of format
     *        `{$jobIdPrefix}-{jobId}`.
     * @return JobConfigInterface
     */
    public function jobIdPrefix($jobIdPrefix)
    {
        $this->jobIdPrefix = $jobIdPrefix;

        return $this;
    }

    /**
     * Specifies the default dataset to use for unqualified table names in the
     * query.
     *
     * @param array $labels
     * @return JobConfigInterface
     */
    public function labels(array $labels)
    {
        $this->config['configuration']['labels'] = $labels;

        return $this;
    }

    /**
     * Returns the job config as an array.
     *
     * @access private
     * @return array
     */
    public function toArray()
    {
        if ($this->jobIdPrefix) {
            $this->config['jobReference']['jobId'] = sprintf(
                '%s-%s',
                $this->jobIdPrefix,
                $this->config['jobReference']['jobId']
            );
        }

        return $this->config;
    }

    /**
     * Generate a Job ID.
     *
     * @return string
     */
    protected function generateJobId()
    {
        return (string) Uuid::uuid4();
    }
}
