<?php

namespace OpenLMS\H5PBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * LibrariesLanguagesRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class LibrariesLanguagesRepository extends EntityRepository
{
    public function findForLibrary($machineName, $majorVersion, $minorVersion, $languageCode)
    {
        $qb = $this->createQueryBuilder('ll')
            ->select('ll.languageJson')
            ->join('ll.library', 'l', 'WITH', 'l.machineName = :machineName and l.majorVersion = :majorVersion and l.minorVersion = :minorVersion')
            ->where('ll.languageCode = :languageCode')
            ->setParameters(['majorVersion' => $majorVersion, 'machineName' => $machineName, 'minorVersion' => $minorVersion, 'languageCode' => $languageCode]);

        try {
            $result = $qb->getQuery()->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
        return $result['languageJson'] ? $result['languageJson'] : null;
    }
}