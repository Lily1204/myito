<?php

namespace Myito\Controllers;

use User as UserEntity;
use Myito\Models\User;

class UserCtrl
{
    /**
     *
     * @return bool true if the user is new and it has never been saved
     */
    public function createUser(UserEntity $user)
    {
        echo "Nombre create user".$user->getNombre();
        return $user->isNew() ? $user->save() : false;
    }

    /**
     * Parse to User
     *
     * @return User
     */
    public static function parseToUserEntity(User $userToParse)
    {
        echo "Guardando".$userToParse->getNombre();
        $userEntity = new UserEntity();
        $userEntity->setNombre($userToParse->getNombre());
        $userEntity->setEdad($userToParse->getEdad());
        $userEntity->setSexo($userToParse->getSexo());
        $userEntity->setCorreo($userToParse->getCorreo());
        echo "Errores en user-ctrl";
        return $userEntity;
    }
}
