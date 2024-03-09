<?php

namespace App\Security;

use App\Entity\Seeder;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class SeederVoter extends Voter
{
    public const VIEW = 'view';
    public const EDIT = 'edit';

    /**
     * @inheritDoc
     */
    protected function supports(string $attribute, mixed $subject): bool
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }
        if (!$subject instanceof Seeder) {
            return false;
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }


        return match($attribute) {
            self::VIEW => $this->canView($subject, $user),
            self::EDIT => $this->canEdit($subject, $user),
            default => throw new \LogicException('This code should not be reached!')
        };
    }

    private function canView(Seeder $seeder, User $user): bool
    {
        // if they can edit, they can view
        if ($this->canEdit($seeder, $user)) {
            return true;
        }

        // the Post object could have, for example, a method `isPrivate()`
        return ($seeder instanceof Seeder);
    }



}
