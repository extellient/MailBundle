<?php

namespace Extellient\MailBundle\Command;

use Extellient\MailBundle\Sender\Sender;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MailSender.
 */
class MailSenderCommand extends Command
{
    /**
     * @var Sender
     */
    private $mailSenderService;

    /**
     * MailSenderCommand constructor.
     *
     * @param Sender $mailSenderService
     *
     * @codeCoverageIgnore
     */
    public function __construct(Sender $mailSenderService)
    {
        $this->mailSenderService = $mailSenderService;
        parent::__construct();
    }

    /**
     * Configure the command.
     *
     * @codeCoverageIgnore
     */
    protected function configure()
    {
        $this
            ->setDescription('Send mail from the database with Mail Bundle')
            ->setHelp('This command allows you to send mail')
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     *
     * @codeCoverageIgnore
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->mailSenderService->sendAll();
    }
}
