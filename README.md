# MailBundle
[![Build Status](https://travis-ci.org/GayKevin/test-bundle.svg?branch=master)](https://travis-ci.org/GayKevin/test-bundle)
[![codecov](https://codecov.io/gh/GayKevin/test-bundle/branch/master/graph/badge.svg)](https://codecov.io/gh/GayKevin/test-bundle)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/dd8a573f5ed2487a9773215803f1d991)](https://www.codacy.com/app/GayKevin/test-bundle?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=GayKevin/test-bundle&amp;utm_campaign=Badge_Grade)


Installation
------------

With [composer](http://packagist.org), require:

`composer require extellient/mail-bundle`

Then enable it in your kernel:

```php
// app/AppKernel.php Symfony 3.4+
public function registerBundles()
{
    $bundles = array(
        //...
        new Extellient\MailBundle\MailBundle(),
        //...
    );
```

```php
// config/bundles.php Symfony 4+

return [
    //...
    Extellient\MailBundle\MailBundle::class => ['all' => true],
    //...
];

```

Now you have to update your database to get the two tables (`Mail`, `MailTemplate`)
```bash
#Symfony 3.4+
php bin/console doctrine:migrations:update
```


Configuration
-------------

You need to configure the default mail.

```yaml
# app/config/services.yml Symfony 3.4+
# config/package/extellient_mail.yaml Symfony 4+
extellient_mail:
    mail_address_from: '<your-email@address.com>'
    mail_alias_from: '<your-email@address.com>'
    mail_reply_to: '<your-email@address.com>'
```

The default configuration use the Doctrine bridge for the database, Twig for the templating and SwiftMailer to send mail.
You don't need to create this file if you want to use the default configuration

```yaml
# app/config/extelient_mail.yml Symfony 3.4+
# config/package/extelient_mail.yml Symfony 4+
extellient_mail:
    mail_service_provider: 'Extellient\MailBundle\Provider\Mail\DoctrineMailProvider' #The database provider to get mails
    mail_template_service_provider: 'Extellient\MailBundle\Provider\Template\DoctrineMailTemplateProvider' # The database provider to get templates
    mail_sender_service_provider: 'Extellient\MailBundle\Sender\SwiftMailSender' #The Mail provider that will be use to send mails
```

## Usage



### Insert your first template inside your database


```sql
INSERT INTO `mail_template` (`id`, `created_at`, `updated_at`, `mail_subject`, `mail_body`, `code`) VALUES (1, '2018-03-14 09:44:28', '2018-04-20 15:11:38', 'Reset your password', '<p>Hello,<br /><br />{{link_password_reset}}', 'reset_password'),
```

```php
// src/controller/HomeController.php

<?php


namespace App\Controller;


use Extellient\MailBundle\Services\MailTemplating;
use Extellient\MailBundle\Services\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends Controller
{
    /**
     * Create your mail from a template
     * @Route("/", name="home")
     * @param MailTemplating $mailTemplating
     */
    public function indexAction(MailTemplating $mailTemplating)
    {
        $mail = $mailTemplating->createEmail('your_template', 'your-email@your-email.com', [
            'variable_twig' => 'test'
        ]);
        $mailTemplating->getMailService()->save($mail);
    }

    /**
     * Create your mail without a template
     * @Route("/mail", name="home")
     * @param Mailer $mailer
     */
    public function mailAction(Mailer $mailer)
    {
        $mail = $mailer->createEmail('subject', 'body', 'your-email@your-email.com');
        $mailer->save($mail);
    }

}

```

After to go to this page, check your data inside your table Mail and you should see your first entry inside it

### Send all your mail

This command will send all the mail inside your table Mail, where sent_date = null

```bash
php bin/console extellient:mail:send

```
