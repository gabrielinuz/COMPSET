<?php
/**
* Copyright (c) 2013-2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/Authorizer/interface/AuthorizerInterface.php';
// require_once 'components/Authorizer/interface/AuthenticatorInterface.php';
// require_once 'components/Authorizer/interface/SessionHandlerInterface.php';
// require_once 'components/Authorizer/interface/DatabaseHandlerInterface.php';
// require_once 'components/Authorizer/interface/ActionInterface.php';

class Authorizer implements AuthorizerInterface
{
    private $authenticator;
    private $sessionHandler;
    private $dbh;

    public function __construct()
    {
        $this->adminRoleId = 1;
    }

    public function setAuthenticator(AuthenticatorInterface $authenticator)
    {
        $this->authenticator = $authenticator;
        $this->setSessionHandler($this->authenticator->getSessionHandler());
        $this->setDBHandler($this->authenticator->getDBHandler());
    }

    public function getAuthenticator()
    {
        return $this->authenticator;
    }

    public function setSessionHandler(CSessionHandlerInterface $sessionHandler)
    {
        $this->sessionHandler = $sessionHandler;
    }

    public function getSessionHandler()
    {
        return $this->sessionHandler;
    }

    public function setDBHandler(DatabaseHandlerInterface $dbh)
    {
        $this->dbh = $dbh;
    }

    public function getDBHandler()
    {
        return $this->dbh;
    }

    public function setAdminRoleId($adminRoleId)
    {
        $this->adminRoleId = $adminRoleId;
    }

    public function getAdminRoleId()
    {
        return $this->adminRoleId;
    }

    private function setAction(ActionInterface $action)
    {
        $this->action = $action;
    }

    private function getActionId()
    {
        $actionName =  get_class( $this->action );
        return $this->dbh->exec('select actions.id 
                                        from actions
                                        where actions.name = ?',
                                        $actionName)[0]['id'];
    }

    private function isAdmin()
    {
        $userId = $this->sessionHandler->get('sessionUserId'); 
        $adminRoleId = $this->adminRoleId; 

        $isAdmin = $this->dbh->exec('select roles.* 
                                        from roles
                                        left join users_has_roles
                                        on users_has_roles.roles_id = roles.id
                                        where users_has_roles.users_id = ?
                                        and users_has_roles.roles_id = ?',
                                        array($userId, $adminRoleId)); 
        return ( $isAdmin != array() );
    }

    private function isAllowed()
    {
        $userId = $this->sessionHandler->get('sessionUserId'); 
        $actionId = $this->getActionId(); 

        $isAllowed = $this->dbh->exec('select roles.* 
                                        from roles
                                        left join users_has_roles
                                        on users_has_roles.roles_id = roles.id

                                        inner join roles_has_actions
                                        on roles_has_actions.roles_id = roles.id

                                        where users_has_roles.users_id = ?
                                        and roles_has_actions.actions_id = ?',
                                        array($userId, $actionId));

        return ( $isAllowed != array() );
    }

    public function authorize(ActionInterface $action)
    {
        $this->setAction( $action );
        // if( $this->sessionHandler->get('authenticated') and !$this->sessionHandler->get('authorized'))
        // {
            $isAllowedRole = ( $this->isAdmin() || $this->isAllowed() );
            if( $isAllowedRole )
            {
                $this->sessionHandler->set("authorized", true);
            }
            else
            {
                $this->sessionHandler->set("authorized", false);
            } 
        // }
        return $this->sessionHandler->get("authorized");
    }
}
?>