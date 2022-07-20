<?php

namespace App\Security;

use App\Model\OwnedInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\The;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class OwnerVoter extends Voter
{

    const VIEW = "view";
    const EDIT = "edit";

    protected function supports(string $attribute, mixed $subject): bool
    {
        return (is_a($subject, OwnedInterface::class));
    }

    /**
     * @param string $attribute
     * @param OwnedInterface $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        if ($attribute == self::VIEW) {
            return true;
        }

        $user = $token->getUser();
        if (!$user) {
            return false;
        }

        return $subject->getOwner() == $user;
    }
}