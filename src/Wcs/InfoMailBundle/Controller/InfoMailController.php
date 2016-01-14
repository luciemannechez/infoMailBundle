<?php

namespace Wcs\InfoMailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InfoMailController extends Controller
{
    public function indexAction()
    {
        $this->sendMail();
        return $this->render('WcsInfoMailBundle::index.html.twig');
    }

    public function sendMail()
    {
        $mail = $this->get('doctrine')->getRepository('WcsInfoMailBundle:InfoMail');

        $config = $this->container->getParameter('wcs_info_mail.recipients');

        $user_class = $config['user_class'];
        $mail_field = $config['mail_field'];

        $users = $this->get('doctrine')->getRepository($user_class)->findAll();

        $recipients = [];
        foreach($users as $user)
        {
            if ( $user->$mail_field() != null )
            {
                $recipients[] = $user->$mail_field();
            }
        }

        $sendMessage = \Swift_Message::newInstance()
            ->setSubject('sujet')
            ->setFrom('no-reply@gmail.com')
            ->setTo($recipients)
            ->setBody(
                $this->renderView(
                    'WcsInfoMailBundle::index.html.twig'
                ),
                'text/html'
            );
        $this->get('mailer')->send($sendMessage);
    }
}
