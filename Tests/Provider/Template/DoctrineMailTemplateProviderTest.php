<?php

namespace Extellient\MailBundle\Tests\Provider\Template;

use Extellient\MailBundle\Entity\Mail;
use Extellient\MailBundle\Entity\MailTemplate;
use Extellient\MailBundle\Exception\MailTemplateNotFoundException;
use Extellient\MailBundle\Provider\Template\DoctrineMailTemplateProvider;
use Extellient\MailBundle\Repository\MailTemplateRepository;
use PHPUnit\Framework\TestCase;

class DoctrineMailTemplateProviderTest extends TestCase
{
    private $mailTemplateRepository;
    private $doctrineMailTemplateProvider;

    protected function setUp()
    {
        parent::setUp();
        $this->mailTemplateRepository = $this->createMock(MailTemplateRepository::class);
        $this->doctrineMailTemplateProvider = new DoctrineMailTemplateProvider($this->mailTemplateRepository);
    }

    public function testFindOneTemplateByCode()
    {
        $templateCode = 'test';
        $mailTemplate = new MailTemplate();
        $this->mailTemplateRepository->expects($this->once())->method('findOneByCode')->with($templateCode)
            ->willReturn($mailTemplate);
        $this->doctrineMailTemplateProvider->findOneTemplateByCode($templateCode);
    }

    public function testFindOneTemplaceByCodeWrongClass()
    {
        $templateCode = 'test';
        $mailTemplate = new Mail('Subject', 'body', ['recipient@test.com']);
        $this->mailTemplateRepository->expects($this->once())->method('findOneByCode')->with($templateCode)
            ->willReturn($mailTemplate);
        $this->expectException(MailTemplateNotFoundException::class);
        $this->doctrineMailTemplateProvider->findOneTemplateByCode($templateCode);
    }
}
