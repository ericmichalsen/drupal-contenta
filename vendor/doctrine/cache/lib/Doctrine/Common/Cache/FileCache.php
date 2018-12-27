<?php
<<<<<<< HEAD

namespace Doctrine\Common\Cache;

use const DIRECTORY_SEPARATOR;
use const PATHINFO_DIRNAME;
use function bin2hex;
use function chmod;
use function defined;
use function disk_free_space;
use function file_exists;
use function file_put_contents;
use function gettype;
use function hash;
use function is_dir;
use function is_int;
use function is_writable;
use function mkdir;
use function pathinfo;
use function realpath;
use function rename;
use function rmdir;
use function sprintf;
use function strlen;
use function strrpos;
use function substr;
use function tempnam;
use function unlink;

/**
 * Base file cache driver.
=======
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\Common\Cache;

/**
 * Base file cache driver.
 *
 * @since  2.3
 * @author Fabio B. Silva <fabio.bat.silva@gmail.com>
 * @author Tobias Schultze <http://tobion.de>
>>>>>>> pantheon-drops-8/master
 */
abstract class FileCache extends CacheProvider
{
    /**
     * The cache directory.
     *
     * @var string
     */
    protected $directory;

    /**
     * The cache file extension.
     *
     * @var string
     */
    private $extension;

<<<<<<< HEAD
    /** @var int */
    private $umask;

    /** @var int */
    private $directoryStringLength;

    /** @var int */
    private $extensionStringLength;

    /** @var bool */
    private $isRunningOnWindows;

    /**
=======
    /**
     * @var int
     */
    private $umask;

    /**
     * @var int
     */
    private $directoryStringLength;

    /**
     * @var int
     */
    private $extensionStringLength;

    /**
     * @var bool
     */
    private $isRunningOnWindows;

    /**
     * Constructor.
     *
>>>>>>> pantheon-drops-8/master
     * @param string $directory The cache directory.
     * @param string $extension The cache file extension.
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($directory, $extension = '', $umask = 0002)
    {
        // YES, this needs to be *before* createPathIfNeeded()
<<<<<<< HEAD
        if (! is_int($umask)) {
=======
        if ( ! is_int($umask)) {
>>>>>>> pantheon-drops-8/master
            throw new \InvalidArgumentException(sprintf(
                'The umask parameter is required to be integer, was: %s',
                gettype($umask)
            ));
        }
        $this->umask = $umask;

<<<<<<< HEAD
        if (! $this->createPathIfNeeded($directory)) {
=======
        if ( ! $this->createPathIfNeeded($directory)) {
>>>>>>> pantheon-drops-8/master
            throw new \InvalidArgumentException(sprintf(
                'The directory "%s" does not exist and could not be created.',
                $directory
            ));
        }

<<<<<<< HEAD
        if (! is_writable($directory)) {
=======
        if ( ! is_writable($directory)) {
>>>>>>> pantheon-drops-8/master
            throw new \InvalidArgumentException(sprintf(
                'The directory "%s" is not writable.',
                $directory
            ));
        }

        // YES, this needs to be *after* createPathIfNeeded()
        $this->directory = realpath($directory);
        $this->extension = (string) $extension;

        $this->directoryStringLength = strlen($this->directory);
        $this->extensionStringLength = strlen($this->extension);
        $this->isRunningOnWindows    = defined('PHP_WINDOWS_VERSION_BUILD');
    }

    /**
     * Gets the cache directory.
     *
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * Gets the cache file extension.
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string $id
     *
     * @return string
     */
    protected function getFilename($id)
    {
        $hash = hash('sha256', $id);

        // This ensures that the filename is unique and that there are no invalid chars in it.
<<<<<<< HEAD
        if ($id === ''
=======
        if (
            '' === $id
>>>>>>> pantheon-drops-8/master
            || ((strlen($id) * 2 + $this->extensionStringLength) > 255)
            || ($this->isRunningOnWindows && ($this->directoryStringLength + 4 + strlen($id) * 2 + $this->extensionStringLength) > 258)
        ) {
            // Most filesystems have a limit of 255 chars for each path component. On Windows the the whole path is limited
            // to 260 chars (including terminating null char). Using long UNC ("\\?\" prefix) does not work with the PHP API.
            // And there is a bug in PHP (https://bugs.php.net/bug.php?id=70943) with path lengths of 259.
            // So if the id in hex representation would surpass the limit, we use the hash instead. The prefix prevents
            // collisions between the hash and bin2hex.
            $filename = '_' . $hash;
        } else {
            $filename = bin2hex($id);
        }

        return $this->directory
            . DIRECTORY_SEPARATOR
            . substr($hash, 0, 2)
            . DIRECTORY_SEPARATOR
            . $filename
            . $this->extension;
    }

    /**
     * {@inheritdoc}
     */
    protected function doDelete($id)
    {
        $filename = $this->getFilename($id);

        return @unlink($filename) || ! file_exists($filename);
    }

    /**
     * {@inheritdoc}
     */
    protected function doFlush()
    {
        foreach ($this->getIterator() as $name => $file) {
            if ($file->isDir()) {
                // Remove the intermediate directories which have been created to balance the tree. It only takes effect
                // if the directory is empty. If several caches share the same directory but with different file extensions,
                // the other ones are not removed.
                @rmdir($name);
            } elseif ($this->isFilenameEndingWithExtension($name)) {
                // If an extension is set, only remove files which end with the given extension.
                // If no extension is set, we have no other choice than removing everything.
                @unlink($name);
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function doGetStats()
    {
        $usage = 0;
        foreach ($this->getIterator() as $name => $file) {
<<<<<<< HEAD
            if ($file->isDir() || ! $this->isFilenameEndingWithExtension($name)) {
                continue;
            }

            $usage += $file->getSize();
=======
            if (! $file->isDir() && $this->isFilenameEndingWithExtension($name)) {
                $usage += $file->getSize();
            }
>>>>>>> pantheon-drops-8/master
        }

        $free = disk_free_space($this->directory);

<<<<<<< HEAD
        return [
=======
        return array(
>>>>>>> pantheon-drops-8/master
            Cache::STATS_HITS               => null,
            Cache::STATS_MISSES             => null,
            Cache::STATS_UPTIME             => null,
            Cache::STATS_MEMORY_USAGE       => $usage,
            Cache::STATS_MEMORY_AVAILABLE   => $free,
<<<<<<< HEAD
        ];
=======
        );
>>>>>>> pantheon-drops-8/master
    }

    /**
     * Create path if needed.
     *
<<<<<<< HEAD
     * @return bool TRUE on success or if path already exists, FALSE if path cannot be created.
     */
    private function createPathIfNeeded(string $path) : bool
    {
        if (! is_dir($path)) {
            if (@mkdir($path, 0777 & (~$this->umask), true) === false && ! is_dir($path)) {
=======
     * @param string $path
     * @return bool TRUE on success or if path already exists, FALSE if path cannot be created.
     */
    private function createPathIfNeeded($path)
    {
        if ( ! is_dir($path)) {
            if (false === @mkdir($path, 0777 & (~$this->umask), true) && !is_dir($path)) {
>>>>>>> pantheon-drops-8/master
                return false;
            }
        }

        return true;
    }

    /**
     * Writes a string content to file in an atomic way.
     *
     * @param string $filename Path to the file where to write the data.
     * @param string $content  The content to write
     *
     * @return bool TRUE on success, FALSE if path cannot be created, if path is not writable or an any other error.
     */
<<<<<<< HEAD
    protected function writeFile(string $filename, string $content) : bool
    {
        $filepath = pathinfo($filename, PATHINFO_DIRNAME);

        if (! $this->createPathIfNeeded($filepath)) {
            return false;
        }

        if (! is_writable($filepath)) {
=======
    protected function writeFile($filename, $content)
    {
        $filepath = pathinfo($filename, PATHINFO_DIRNAME);

        if ( ! $this->createPathIfNeeded($filepath)) {
            return false;
        }

        if ( ! is_writable($filepath)) {
>>>>>>> pantheon-drops-8/master
            return false;
        }

        $tmpFile = tempnam($filepath, 'swap');
        @chmod($tmpFile, 0666 & (~$this->umask));

        if (file_put_contents($tmpFile, $content) !== false) {
<<<<<<< HEAD
            @chmod($tmpFile, 0666 & (~$this->umask));
=======
>>>>>>> pantheon-drops-8/master
            if (@rename($tmpFile, $filename)) {
                return true;
            }

            @unlink($tmpFile);
        }

        return false;
    }

<<<<<<< HEAD
    private function getIterator() : \Iterator
=======
    /**
     * @return \Iterator
     */
    private function getIterator()
>>>>>>> pantheon-drops-8/master
    {
        return new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->directory, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );
    }

    /**
     * @param string $name The filename
<<<<<<< HEAD
     */
    private function isFilenameEndingWithExtension(string $name) : bool
    {
        return $this->extension === ''
=======
     *
     * @return bool
     */
    private function isFilenameEndingWithExtension($name)
    {
        return '' === $this->extension
>>>>>>> pantheon-drops-8/master
            || strrpos($name, $this->extension) === (strlen($name) - $this->extensionStringLength);
    }
}
