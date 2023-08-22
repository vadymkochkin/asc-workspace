<?php namespace Ascension\Emulator\Commands;

use Ascension\Emulator\Abstracts\BaseCommand;

/**
 * Class GM
 * @package Ascension\Emulator\Commands
 * @codeCoverageIgnore
 */
class GM extends BaseCommand
{

    /**
     * @inheritdoc
     * @var array
     */
    protected $concatenate = [
        'announce',
        'nameAnnounce',
        'notify'
    ];

    /**
     * Send announcement to all Game Masters
     * @param string $announcement
     * @return array|string
     */
    public function announce(string $announcement)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Send announcement to all Game Masters (as console)
     * @param string $announcement
     * @return array|string
     */
    public function nameAnnounce(string $announcement)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Send notification ot all Game Masters
     * @param string $notification
     * @return array|string
     */
    public function notify(string $notification)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }
}
