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
       // $mail = $this->get('doctrine')->getRepository('IuchBundle:WelcomeMail')->findOneById(1);

        $user_class = $this->container->getParameter('wcs_info_mail.recipients');

        print_r($user_class);
        die();

        $destinataire = 'wcs.hopital@gmail.com';
        $sendMessage = \Swift_Message::newInstance()
            ->setSubject('sujet')
            ->setFrom('no-reply@gmail.com')
            ->setTo($destinataire)
            ->setBody(
                $this->renderView(
                    'WcsInfoMailBundle::index.html.twig'
                ),
                'text/html'
            );
        $this->get('mailer')->send($sendMessage);
    }
}
