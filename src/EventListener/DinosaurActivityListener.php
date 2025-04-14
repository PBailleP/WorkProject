<?php
namespace App\EventListener;

use App\Entity\DinosaurLog;
use App\Entity\Dinosaurs;
use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\EntityManagerInterface;

#[AsEntityListener(event: Events::postPersist, method: 'postPersist', entity: Dinosaurs::class)]
#[AsEntityListener(event: Events::postUpdate, method: 'postUpdate', entity: Dinosaurs::class)]
class DinosaurActivityListener
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    { }

    public function postPersist(Dinosaurs $dinosaur): void
    {
        $this->logAction($dinosaur, 'created');
    }

    public function postUpdate(Dinosaurs $dinosaur): void
    {
        $this->logAction($dinosaur, 'updated');
    }

    private function logAction(Dinosaurs $dinosaur, string $action): void
    {
        $log = new DinosaurLog();
        $log->setAction($action);
        $log->setDinosaur($dinosaur);
        $now = new \DateTimeImmutable();
        $log->setCreatedAt($now);
        $log->setUpdatedAt($now);

        $this->entityManager->persist($log);
        $this->entityManager->flush();
    }
}