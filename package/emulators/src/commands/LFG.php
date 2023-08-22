<?php namespace Ascension\Emulator\Commands;

use Ascension\Emulator\Abstracts\BaseCommand;

/**
 * Class LFG
 *  @package Ascension\Emulator\Commands
 * @codeCoverageIgnore
 */
class LFG extends BaseCommand
{

    /**
     * Show information about current LFG queues
     * @return array|string
     */
    public function queue()
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Cleans current queue, only for DEBUG
     * @return array|string
     */
    public function clean()
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Shows current LFG options.
     * IF value is set, updates existing value.
     * @param string $value
     * @return array|string
     */
    public function options($value = '')
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }
}
