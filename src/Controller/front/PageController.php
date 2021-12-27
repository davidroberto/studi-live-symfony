<?php


namespace App\Controller\front;


use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $message = "Bonjour Studi";

        return $this->render('home.html.twig', [
            'message' => $message
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer)
    {
        $postRequest = $request->request;

        $firstNameUser = $postRequest->get('firstName');
        $lastNameUser = $postRequest->get('lastName');
        $emailUser = $postRequest->get('email');
        $messageUser = $postRequest->get('message');

        $emailToAdmin = new TemplatedEmail();
        $emailToAdmin->from('contact.davidrobert@gmail.com')
            ->to('contact.davidrobert@gmail.com')
            ->subject($emailUser.' vous a envoyé un message !')
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                'firstName' => $firstNameUser,
                'lastName' => $lastNameUser,
                'emailUser' => $emailUser,
                'message' => $messageUser
            ])
        ;

        $autoEmailToUser = new Email();
        $autoEmailToUser->from('contact.davidrobert@gmail.com')
            ->to($emailUser)
            ->subject('Votre demande a été reçue')
            ->text('Nous allons traiter votre demande après digestion du fois gras')
        ;


        $mailer->send($emailToAdmin);
        $mailer->send($autoEmailToUser);




        // au clic sur le bouton "envoyer", on va récuprer les données POST
        // avec les données de POST (du formulaire), on envoie un mail à l'administrateur

        return $this->render("contact.html.twig");

    }



}
