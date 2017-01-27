<?php

namespace gestorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="gestorBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 4,
     *      max = 32,
     *      minMessage = "Minimo 4",
     *      maxMessage = "Maximo 32"
     * )
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "No es un email correcto",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
    * @Assert\NotBlank(
    *     message="No la dejes en blanco,si no va a ser un poco dificil hacer login"
    * )
    * @Assert\Regex(
    *     pattern="/^.*[A-Z]+.*$/",
    *     match=true,
    *     message="Usa al menos una mayuscula"
    * )
    * @Assert\Regex(
    *     pattern="/^.*[0-9].*$/",
    *     match=true,
    *     message="Usa al menos un numero"
    * )
    * @Assert\Regex(
    *     pattern="/^.*[a-z].*$/",
    *     match=true,
    *     message="Usa al menos una minuscula"
    * )
    * @Assert\Length(
    *      min = 8,
    *      minMessage = "Usa al menos 8 caracteres"
    * )
    */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="json_array")
     */
     private $roles = array();

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */

     public function getPlainPassword()
     {
       return $this->plainPassword;
     }

     public function setPlainPassword($password)
     {
       $this->plainPassword = $password;
     }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return usuarios
     */
     public function setRoles(array $roles)
     {
       $this->roles = $roles;

       // allows for chaining
       return $this;
     }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    //Metodos que debe implementar el Entity por User interface_exists
    public function getSalt()
    {
      // The bcrypt algorithm doesn't require a separate salt.
      // You *may* need a real salt if you choose a different encoder.
      return null;
    }

    public function getRoles()
    {
      return $this->roles;
    }

    public function eraseCredentials() {}
}
