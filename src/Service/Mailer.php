<?php
namespace App\Service;

use App\Entity\Usuario;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class Mailer
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendWelcomeMessage(Usuario $user)
    {
        $email = (new TemplatedEmail())
            ->from(new Address('asajiradio@gmail.com', 'Los juegos hermanos'))
            ->to(new Address($user->getEmail(), $user->getNombre()))
            ->subject('¡Bienvenido a la familia de los juegos hermanos!')
            ->htmlTemplate('emailTemplates/welcome.html.twig')
            ->context([
                // You can pass whatever data you want
                //'user' => $user,
            ]);
        $this->mailer->send($email);
    }

}


?>