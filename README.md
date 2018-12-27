<h1 id="contenta-jsonapi-project">
  Contenta JSON API Project
  <img align="right" src="./logo.svg" alt="Contenta logo" title="Contenta logo" width="100">
</h1>

This repository is used in order to create a Contenta CMS project using Composer.

If you want to learn how to install Contenta CMS visit http://www.contentacms.org/#install. If you
want documentation about Contenta CMS visit http://www.contentacms.org.


# Custom upstream for Pantheon

1. Pull in Core from Pantheon's Upstream:
```
$ git remote add pantheon-drops-8 git://github.com/pantheon-systems/drops-8.git
$ git checkout master
$ git fetch pantheon-drops-8
$ git merge pantheon-drops-8/master
$ git push origin master
```
2. Connect Repository to Pantheon:

     ' **+ Add new upstream**

