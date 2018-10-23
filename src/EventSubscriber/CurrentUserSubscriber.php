<?php
namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CurrentUserSubscriber implements EventSubscriberInterface
{
    
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
          KernelEvents::VIEW => [['setCurrentUser', EventPriorities::PRE_WRITE]],
        ];
    }
    
    public function setCurrentUser(GetResponseForControllerResultEvent $event) {
        
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
    
        if (!$user instanceof User || Request::METHOD_POST !== $method) {
            return;
        }
    
        $user->setParent($this->tokenStorage->getToken()->getUser());
        $event->setControllerResult($user);
    }
}