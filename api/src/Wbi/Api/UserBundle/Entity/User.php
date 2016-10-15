<?php
// src/Acme/ApiBundle/Entity/User.php

namespace Wbi\Api\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Wbi\Api\UserBundle\Entity\Profile as Profile;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * User
 *
 * @ORM\Table("users")
 * @ORM\Entity
 * @ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;
	
	
	/**
	* @ORM\OneToOne(targetEntity="Profile", mappedBy="user", cascade={"persist", "remove"})
	*
	*/
	private $profile;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set profile
     *
     * @param \Wbi\Api\UserBundle\Entity\Profile $profile
     *
     * @return User
     */
    public function setProfile(\Wbi\Api\UserBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \Wbi\Api\UserBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
