<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Feed\Writer\Renderer\Feed\Atom;

use Datetime;
use DOMDocument;
use DOMElement;
use Zend\Feed;
use Zend\Feed\Writer\Version;

class AbstractAtom extends Feed\Writer\Renderer\AbstractRenderer
{
    /**
     * Constructor
     *
     * @param  \Zend\Feed\Writer\Feed $container
     */
    public function __construct($container)
    {
        parent::__construct($container);
    }

    /**
     * Set feed language
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setLanguage(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
=======
    protected function _setLanguage(DOMDocument $dom, DOMElement $root)
    {
>>>>>>> pantheon-drops-8/master
        if ($this->getDataContainer()->getLanguage()) {
            $root->setAttribute('xml:lang', $this->getDataContainer()
                ->getLanguage());
        }
    }

    /**
     * Set feed title
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     * @throws Feed\Exception\InvalidArgumentException
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setTitle(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        if (! $this->getDataContainer()->getTitle()) {
            $message = 'Atom 1.0 feed elements MUST contain exactly one'
                . ' atom:title element but a title has not been set';
            $exception = new Feed\Exception\InvalidArgumentException($message);
            if (! $this->ignoreExceptions) {
=======
    protected function _setTitle(DOMDocument $dom, DOMElement $root)
    {
        if (!$this->getDataContainer()->getTitle()) {
            $message = 'Atom 1.0 feed elements MUST contain exactly one'
                . ' atom:title element but a title has not been set';
            $exception = new Feed\Exception\InvalidArgumentException($message);
            if (!$this->ignoreExceptions) {
>>>>>>> pantheon-drops-8/master
                throw $exception;
            } else {
                $this->exceptions[] = $exception;
                return;
            }
        }

        $title = $dom->createElement('title');
        $root->appendChild($title);
        $title->setAttribute('type', 'text');
        $text = $dom->createTextNode($this->getDataContainer()->getTitle());
        $title->appendChild($text);
    }

    /**
     * Set feed description
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setDescription(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        if (! $this->getDataContainer()->getDescription()) {
=======
    protected function _setDescription(DOMDocument $dom, DOMElement $root)
    {
        if (!$this->getDataContainer()->getDescription()) {
>>>>>>> pantheon-drops-8/master
            return;
        }
        $subtitle = $dom->createElement('subtitle');
        $root->appendChild($subtitle);
        $subtitle->setAttribute('type', 'text');
        $text = $dom->createTextNode($this->getDataContainer()->getDescription());
        $subtitle->appendChild($text);
    }

    /**
     * Set date feed was last modified
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     * @throws Feed\Exception\InvalidArgumentException
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setDateModified(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        if (! $this->getDataContainer()->getDateModified()) {
            $message = 'Atom 1.0 feed elements MUST contain exactly one'
                . ' atom:updated element but a modification date has not been set';
            $exception = new Feed\Exception\InvalidArgumentException($message);
            if (! $this->ignoreExceptions) {
=======
    protected function _setDateModified(DOMDocument $dom, DOMElement $root)
    {
        if (!$this->getDataContainer()->getDateModified()) {
            $message = 'Atom 1.0 feed elements MUST contain exactly one'
                . ' atom:updated element but a modification date has not been set';
            $exception = new Feed\Exception\InvalidArgumentException($message);
            if (!$this->ignoreExceptions) {
>>>>>>> pantheon-drops-8/master
                throw $exception;
            } else {
                $this->exceptions[] = $exception;
                return;
            }
        }

        $updated = $dom->createElement('updated');
        $root->appendChild($updated);
        $text = $dom->createTextNode(
            $this->getDataContainer()->getDateModified()->format(DateTime::ATOM)
        );
        $updated->appendChild($text);
    }

    /**
     * Set feed generator string
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setGenerator(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        if (! $this->getDataContainer()->getGenerator()) {
            $this->getDataContainer()->setGenerator(
                'Zend_Feed_Writer',
                Version::VERSION,
                'http://framework.zend.com'
            );
=======
    protected function _setGenerator(DOMDocument $dom, DOMElement $root)
    {
        if (!$this->getDataContainer()->getGenerator()) {
            $this->getDataContainer()->setGenerator('Zend_Feed_Writer',
                Version::VERSION, 'http://framework.zend.com');
>>>>>>> pantheon-drops-8/master
        }

        $gdata = $this->getDataContainer()->getGenerator();
        $generator = $dom->createElement('generator');
        $root->appendChild($generator);
        $text = $dom->createTextNode($gdata['name']);
        $generator->appendChild($text);
        if (array_key_exists('uri', $gdata)) {
            $generator->setAttribute('uri', $gdata['uri']);
        }
        if (array_key_exists('version', $gdata)) {
            $generator->setAttribute('version', $gdata['version']);
        }
    }

    /**
     * Set link to feed
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setLink(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        if (! $this->getDataContainer()->getLink()) {
=======
    protected function _setLink(DOMDocument $dom, DOMElement $root)
    {
        if (!$this->getDataContainer()->getLink()) {
>>>>>>> pantheon-drops-8/master
            return;
        }
        $link = $dom->createElement('link');
        $root->appendChild($link);
        $link->setAttribute('rel', 'alternate');
        $link->setAttribute('type', 'text/html');
        $link->setAttribute('href', $this->getDataContainer()->getLink());
    }

    /**
     * Set feed links
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     * @throws Feed\Exception\InvalidArgumentException
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setFeedLinks(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        $flinks = $this->getDataContainer()->getFeedLinks();
        if (! $flinks || ! array_key_exists('atom', $flinks)) {
=======
    protected function _setFeedLinks(DOMDocument $dom, DOMElement $root)
    {
        $flinks = $this->getDataContainer()->getFeedLinks();
        if (!$flinks || !array_key_exists('atom', $flinks)) {
>>>>>>> pantheon-drops-8/master
            $message = 'Atom 1.0 feed elements SHOULD contain one atom:link '
                . 'element with a rel attribute value of "self".  This is the '
                . 'preferred URI for retrieving Atom Feed Documents representing '
                . 'this Atom feed but a feed link has not been set';
            $exception = new Feed\Exception\InvalidArgumentException($message);
<<<<<<< HEAD
            if (! $this->ignoreExceptions) {
=======
            if (!$this->ignoreExceptions) {
>>>>>>> pantheon-drops-8/master
                throw $exception;
            } else {
                $this->exceptions[] = $exception;
                return;
            }
        }

        foreach ($flinks as $type => $href) {
            $mime = 'application/' . strtolower($type) . '+xml';
            $flink = $dom->createElement('link');
            $root->appendChild($flink);
            $flink->setAttribute('rel', 'self');
            $flink->setAttribute('type', $mime);
            $flink->setAttribute('href', $href);
        }
    }

    /**
     * Set feed authors
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setAuthors(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        $authors = $this->container->getAuthors();
        if (! $authors || empty($authors)) {
=======
    protected function _setAuthors(DOMDocument $dom, DOMElement $root)
    {
        $authors = $this->container->getAuthors();
        if (!$authors || empty($authors)) {
>>>>>>> pantheon-drops-8/master
            /**
             * Technically we should defer an exception until we can check
             * that all entries contain an author. If any entry is missing
             * an author, then a missing feed author element is invalid
             */
            return;
        }
        foreach ($authors as $data) {
            $author = $this->dom->createElement('author');
            $name = $this->dom->createElement('name');
            $author->appendChild($name);
            $root->appendChild($author);
            $text = $dom->createTextNode($data['name']);
            $name->appendChild($text);
            if (array_key_exists('email', $data)) {
                $email = $this->dom->createElement('email');
                $author->appendChild($email);
                $text = $dom->createTextNode($data['email']);
                $email->appendChild($text);
            }
            if (array_key_exists('uri', $data)) {
                $uri = $this->dom->createElement('uri');
                $author->appendChild($uri);
                $text = $dom->createTextNode($data['uri']);
                $uri->appendChild($text);
            }
        }
    }

    /**
     * Set feed identifier
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     * @throws Feed\Exception\InvalidArgumentException
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setId(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        if (! $this->getDataContainer()->getId()
        && ! $this->getDataContainer()->getLink()) {
=======
    protected function _setId(DOMDocument $dom, DOMElement $root)
    {
        if (!$this->getDataContainer()->getId()
        && !$this->getDataContainer()->getLink()) {
>>>>>>> pantheon-drops-8/master
            $message = 'Atom 1.0 feed elements MUST contain exactly one '
                . 'atom:id element, or as an alternative, we can use the same '
                . 'value as atom:link however neither a suitable link nor an '
                . 'id have been set';
            $exception = new Feed\Exception\InvalidArgumentException($message);
<<<<<<< HEAD
            if (! $this->ignoreExceptions) {
=======
            if (!$this->ignoreExceptions) {
>>>>>>> pantheon-drops-8/master
                throw $exception;
            } else {
                $this->exceptions[] = $exception;
                return;
            }
        }

<<<<<<< HEAD
        if (! $this->getDataContainer()->getId()) {
            $this->getDataContainer()->setId(
                $this->getDataContainer()->getLink()
            );
=======
        if (!$this->getDataContainer()->getId()) {
            $this->getDataContainer()->setId(
                $this->getDataContainer()->getLink());
>>>>>>> pantheon-drops-8/master
        }
        $id = $dom->createElement('id');
        $root->appendChild($id);
        $text = $dom->createTextNode($this->getDataContainer()->getId());
        $id->appendChild($text);
    }

    /**
     * Set feed copyright
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setCopyright(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        $copyright = $this->getDataContainer()->getCopyright();
        if (! $copyright) {
=======
    protected function _setCopyright(DOMDocument $dom, DOMElement $root)
    {
        $copyright = $this->getDataContainer()->getCopyright();
        if (!$copyright) {
>>>>>>> pantheon-drops-8/master
            return;
        }
        $copy = $dom->createElement('rights');
        $root->appendChild($copy);
        $text = $dom->createTextNode($copyright);
        $copy->appendChild($text);
    }
<<<<<<< HEAD

=======
>>>>>>> pantheon-drops-8/master
    /**
     * Set feed level logo (image)
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setImage(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        $image = $this->getDataContainer()->getImage();
        if (! $image) {
=======
    protected function _setImage(DOMDocument $dom, DOMElement $root)
    {
        $image = $this->getDataContainer()->getImage();
        if (!$image) {
>>>>>>> pantheon-drops-8/master
            return;
        }
        $img = $dom->createElement('logo');
        $root->appendChild($img);
        $text = $dom->createTextNode($image['uri']);
        $img->appendChild($text);
    }

    /**
     * Set date feed was created
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setDateCreated(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        if (! $this->getDataContainer()->getDateCreated()) {
            return;
        }
        if (! $this->getDataContainer()->getDateModified()) {
=======
    protected function _setDateCreated(DOMDocument $dom, DOMElement $root)
    {
        if (!$this->getDataContainer()->getDateCreated()) {
            return;
        }
        if (!$this->getDataContainer()->getDateModified()) {
>>>>>>> pantheon-drops-8/master
            $this->getDataContainer()->setDateModified(
                $this->getDataContainer()->getDateCreated()
            );
        }
    }

    /**
     * Set base URL to feed links
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setBaseUrl(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        $baseUrl = $this->getDataContainer()->getBaseUrl();
        if (! $baseUrl) {
=======
    protected function _setBaseUrl(DOMDocument $dom, DOMElement $root)
    {
        $baseUrl = $this->getDataContainer()->getBaseUrl();
        if (!$baseUrl) {
>>>>>>> pantheon-drops-8/master
            return;
        }
        $root->setAttribute('xml:base', $baseUrl);
    }

    /**
     * Set hubs to which this feed pushes
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setHubs(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        $hubs = $this->getDataContainer()->getHubs();
        if (! $hubs) {
=======
    protected function _setHubs(DOMDocument $dom, DOMElement $root)
    {
        $hubs = $this->getDataContainer()->getHubs();
        if (!$hubs) {
>>>>>>> pantheon-drops-8/master
            return;
        }
        foreach ($hubs as $hubUrl) {
            $hub = $dom->createElement('link');
            $hub->setAttribute('rel', 'hub');
            $hub->setAttribute('href', $hubUrl);
            $root->appendChild($hub);
        }
    }

    /**
     * Set feed categories
     *
     * @param  DOMDocument $dom
     * @param  DOMElement $root
     * @return void
     */
<<<<<<< HEAD
    // @codingStandardsIgnoreStart
    protected function _setCategories(DOMDocument $dom, DOMElement $root)
    {
        // @codingStandardsIgnoreEnd
        $categories = $this->getDataContainer()->getCategories();
        if (! $categories) {
=======
    protected function _setCategories(DOMDocument $dom, DOMElement $root)
    {
        $categories = $this->getDataContainer()->getCategories();
        if (!$categories) {
>>>>>>> pantheon-drops-8/master
            return;
        }
        foreach ($categories as $cat) {
            $category = $dom->createElement('category');
            $category->setAttribute('term', $cat['term']);
            if (isset($cat['label'])) {
                $category->setAttribute('label', $cat['label']);
            } else {
                $category->setAttribute('label', $cat['term']);
            }
            if (isset($cat['scheme'])) {
                $category->setAttribute('scheme', $cat['scheme']);
            }
            $root->appendChild($category);
        }
    }
}
