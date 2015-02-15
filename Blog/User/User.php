<?php

namespace Baileylo\Blog\User;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Str;

class User implements AuthenticatableContract
{
    use Authenticatable;

    /** @var \MongoId|String UUID */
    protected $id;

    /** @var String Name to be shown with account */
    protected $name;

    /** @var String Unique URL safe identifier */
    protected $slug;

    /** @var String Email address */
    protected $email;

    /** @var String Hashed password */
    protected $password;

    /** @var String Token used to do stuff */
    protected $rememberToken;

    /**
     * @param String $email
     * @param String $passwordHash
     * @param String $name
     *
     * @return \Baileylo\Blog\User\User
     */
    public static function register($email, $passwordHash, $name)
    {
        $user = new User;
        $user->update($name, $email);
        $user->password = $passwordHash;

        $user->slug = Str::slug($name);

        return $user;
    }

    /**
     * Updates the name and/or email for the given user.
     *
     * @param String $name
     * @param String $email
     */
    public function update($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return \MongoId|String
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Updates and hashes a user's password
     *
     * @param Hasher $hasher Object used to hash password
     * @param String $password
     */
    public function changePassword(Hasher $hasher, $password)
    {
        $this->password = $hasher->make($password);
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return String|\MongoId
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     *
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->rememberToken = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        throw new \BadMethodCallException(__FUNCTION__ . ' should never be called');
    }
}
