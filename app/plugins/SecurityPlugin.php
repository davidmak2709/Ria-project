<?php

use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;


class SecurityPlugin extends Plugin
{
	public function getAcl()
	{
		$acl = new AclList();

		// The default action is DENY access
		$acl->setDefaultAction(
		    Acl::DENY
		);

		// Register two roles, Users is registered users
		// and guests are users without a defined identity
		$roles = [
		    "users"  => new Role("Users"),
		    "guests" => new Role("Guests"),
		    "admins" => new Role("Admins"),
		    "vlasnik" => new Role("Vlasnik")

		];

		foreach ($roles as $role) {
		    $acl->addRole($role);
		}

		// Private area resources (backend)
		$adminResources = [
		    "addevents" => ["index", "add"],
		    "admin" => ["index", "klub", "dogadaj", "korisnik", "admins", "addklub", "adddogadaj", "addkorisnik", "addadmins", "deleteklub", "deletedogadaj", "deletekorisnik", "deleteadmins", "updateklub", "updatedogadaj", "updatekorisnik", "updateadmins"],
		    "details" => ["index", "rate"],
		    "events" => ["index", "reserve", "unreserve"],
		    "index" => ["index", "folow", "unfolow"],
		    "login" => ["index", "login", "logout", "facebook", "callback"],
		    "signup" => ["index", "register", "facebook", "callback"],
		];

		foreach ($adminResources as $resourceName => $actions) {
		    $acl->addResource(
		        new Resource($resourceName),
		        $actions
		    );
		}
		$superprivateResources = [
		    "addevents" => ["index", "add"],
            "bars" => ["index","edit","update","delete"],
            "details" => ["index", "rate"],
		    "events" => ["index", "reserve", "unreserve"],
		    "index" => ["index", "folow", "unfolow"],
		    "login" => ["index", "login", "logout", "facebook", "callback"],
		    "signup" => ["index", "register", "facebook", "callback"],
		];

		foreach ($superprivateResources as $resourceName => $actions) {
		    $acl->addResource(
		        new Resource($resourceName),
		        $actions
		    );
		}

		$privateResources = [
		    "details" => ["index", "rate"],
		    "events" => ["index", "reserve", "unreserve"],
		    "index" => ["index", "folow", "unfolow"],
		    "login" => ["index", "login", "logout", "facebook", "callback"],
		    "signup" => ["index", "register", "facebook", "callback"],
		];

		foreach ($privateResources as $resourceName => $actions) {
		    $acl->addResource(
		        new Resource($resourceName),
		        $actions
		    );
		}

		// Public area resources (frontend)
		$publicResources = [
		    "details" => ["index"],
		    "errors" => ["index", "show404", "show500"],
		    "events" => ["index"],
		    "index" => ["index"],
		    "login" => ["index", "login", "facebook", "callback"],
		    "signup" => ["index", "register", "facebook", "callback"],
		];

		foreach ($publicResources as $resourceName => $actions) {
		    $acl->addResource(
		        new Resource($resourceName),
		        $actions
		    );
		}

		foreach ($roles as $role) {
		    foreach ($publicResources as $resource => $actions) {
		        $acl->allow(
		            $role->getName(),
		            $resource,
		            "*"
		        );
		    }
		}
		// Grant access to private area only to role Admin
		foreach ($adminResources as $resource => $actions) {
		    foreach ($actions as $action) {
		        $acl->allow(
		            "Admins",
		            $resource,
		            $action
		        );
		    }
		}// ...

		// Grant access to private area only to role Vlasnik
		foreach ($superprivateResources as $resource => $actions) {
		    foreach ($actions as $action) {
		        $acl->allow(
		            "Vlasnik",
		            $resource,
		            $action
		        );
		    }
		}// ...

		// Grant access to private area only to role Users
		foreach ($privateResources as $resource => $actions) {
		    foreach ($actions as $action) {
		        $acl->allow(
		            "Users",
		            $resource,
		            $action
		        );
		    }

		}// ...

		return $acl;
	}
	public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        // Check whether the "id" variable exists in session to define the active role
        $auth = $this->session->get("id");

        $vlasnik = $this->session->get("vlasnik");
        $admin = $this->session->get("admin");

        if ($admin==1) {
            $role = "Admins";
        } elseif($vlasnik==1) {
            $role = "Vlasnik";
        } elseif(!$auth){
        	$role = "Guests";
        } else{
        	$role = "Users";
        }


        // Take the active controller/action from the dispatcher
        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();

        // Obtain the ACL list
        $acl = $this->getAcl();

        // Check if the Role have access to the controller (resource)
        $allowed = $acl->isAllowed($role, $controller, $action);

        if (!$allowed) {
            // If he doesn't have access forward him to the index controller
            $this->flash->error(
                "You don't have access to this module"
            );

            $dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );

            // Returning "false" we tell to the dispatcher to stop the current operation
            return false;
        }
    }
}



?>