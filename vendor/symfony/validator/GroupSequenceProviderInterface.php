<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator;

<<<<<<< HEAD
use Symfony\Component\Validator\Constraints\GroupSequence;

=======
>>>>>>> pantheon-drops-8/master
/**
 * Defines the interface for a group sequence provider.
 */
interface GroupSequenceProviderInterface
{
    /**
     * Returns which validation groups should be used for a certain state
     * of the object.
     *
<<<<<<< HEAD
     * @return string[]|GroupSequence An array of validation groups
=======
     * @return array An array of validation groups
>>>>>>> pantheon-drops-8/master
     */
    public function getGroupSequence();
}
