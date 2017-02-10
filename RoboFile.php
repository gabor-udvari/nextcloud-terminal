<?php
/**
 * Build script using the Robo task runner.
 *
 * @see http://robo.li/
 */

use Symfony\Component\Filesystem\Filesystem;

class RoboFile extends \Robo\Tasks
{

  private function createPaths($paths){
    // iterate through paths array and create folder
    foreach ($paths as $path) {
      // use Symfony 2 mkdir for recursive directory creation
      if (! is_dir($path)) {
        $this->_mkdir($path);
      }
    }
  }

  /**
   * Main build step, included to be compatible with Sage gulp
   */
  public function build() {
    // check the build folder
    $buildDirs = array(
      'dist/styles',
      'dist/scripts',
      'dist/fonts',
      'dist/images'
    );
    // $this->createPaths($buildDirs);

    $this->styles();
    $this->scripts();
  }

  public function styles() {
    // Copy xterm.js styles to css
    $this->_copy('vendor/bower-asset/xterm.js/dist/xterm.css', 'css/vendor/xterm.js/xterm.css', true);
  }

  public function scripts() {
    // Copy xterm.js scripts to js
    $this->_copy('vendor/bower-asset/xterm.js/dist/xterm.js', 'js/vendor/xterm.js/xterm.js', true);
    $this->_copyDir('vendor/bower-asset/xterm.js/dist/addons/fit', 'js/vendor/xterm.js/addons/fit', true);
  }
}
