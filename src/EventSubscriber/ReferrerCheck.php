<?php
namespace Drupal\referrer_gatekeep\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
//use Symfony\Component\EventDispatcher\Event;
//use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Session\AccountInterface;
use Drupal\user\UserInterface;
use Exception;

/**
 * Class SignUpRedirect.
 */
class ReferrerCheck implements EventSubscriberInterface
{

  /**
   * Constructor.
   */


  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents()
  {
    $events[KernelEvents::REQUEST][] = ['referer_check', 200];
    # $events[KernelEvents::REQUEST][] = ['onRequest', 1000];


    return $events;
  }


  function debug_to_console($data)
  {
    $output = $data;
    if (is_array($output))
      $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";

  }


  public function referer_check()
  {

    $logged_in = \Drupal::currentUser()->isAuthenticated();
    debug_to_console($logged_in);
    $referer = \Drupal::state()->get('ref');
    if (!str_contains($referer, "https")) {
      $referer = "https://$referer";
    }
    if ($referer[-1] != "/") {
      $referer .= "/";
    }
    $orig = $_SERVER['HTTP_REFERER'];
    if ($orig==null) {
      $orig="";
    }

    $ref_message = \Drupal::state()->get('ref_message');
    $user_check = "$_SERVER[REQUEST_URI]";
    if (!$logged_in && $user_check != "/drupal/web/user/login" && $orig !== $referer) {


      $red_target = \Drupal::state()->get('red_target');
      echo "<script type='text/javascript'>alert('$ref_message');</script>";
      header("Refresh: 1; URL =  $red_target");
      exit;
    }
  }
//}
}
