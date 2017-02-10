<?php

use Composer\Script\Event;

class ComposerHelper
{
  public static function skipAssets(Event $event)
  {
    $composer = $event->getComposer();
    $requires = $composer->getPackage()->getRequires();

    foreach ($requires as $key => $value) {
      // delete every bower-asset requirement
      if (preg_match('/bower-asset\/.*/', $key)) {
        unset($requires[$key]);
      }
    }

    $composer->getPackage()->setRequires($requires);
  }
}
