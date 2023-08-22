<?php namespace Ascension\Emulator\Commands;

use Ascension\Emulator\Abstracts\BaseCommand;

/**
 * Class Send
 *  @package Ascension\Emulator\Commands
 * @codeCoverageIgnore
 */
class Send extends BaseCommand
{

    /**
     * Send Items To The Player
     * @param string $playerName
     * @param string $mailSubject
     * @param string $mailText
     * @param Items $items
     * @return array|string
     */
    public function items(string $items)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Send mail to the player
     * @param string $playerName
     * @param string $mailSubject
     * @param string $mailText
     * @return array|string
     */
    public function mail(string $playerName, string $mailSubject, string $mailText)
    {
        return $this->executeCommand(__FUNCTION__, [
            'playerName'    =>  $playerName,
            'mailSubject'   =>  $this->inQuotes($mailSubject),
            'mailText'      =>  $this->inQuotes($mailText)
        ]);
    }

    /**
     * Send message to the player which will appear in the middle of the screen
     * @param string $playerName
     * @param string $message
     * @return array|string
     */
    public function message(string $playerName, string $message)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Send money to the player
     * @param string $playerName
     * @param string $mailSubject
     * @param string $mailText
     * @param int $amount
     * @return array|string
     */
    public function money(string $playerName, string $mailSubject, string $mailText, int $amount)
    {
        return $this->executeCommand(__FUNCTION__, [
            'playerName'    =>  $playerName,
            'mailSubject'   =>  $this->inQuotes($mailSubject),
            'mailText'      =>  $this->inQuotes($mailText),
            'amount'        =>  $amount
        ]);
    }
}
