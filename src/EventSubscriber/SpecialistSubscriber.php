<?php

namespace App\EventSubscriber;

use App\Entity\Specialist;
use App\Entity\Mail;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class SpecialistSubscriber implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        // Vérifie si l'entité est bien un Specialist
        if (!$entity instanceof Specialist) {
            return;
        }

        $entityManager = $args->getObjectManager();

        // Crée une nouvelle entrée Mail en base
        $mail = new Mail();
        $mail->setDate(new \DateTime());
        $mail->setSubject("Nouveau psychologue ajouté");
        $mail->setContent("Le psychologue {$entity->getFirstName()} {$entity->getLastName()} a été ajouté.");

        // Sauvegarde en base
        $entityManager->persist($mail);
        $entityManager->flush();
    }
}
