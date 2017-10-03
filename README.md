CDatabaseModel for ANAX-MVC
===========================

A model for database-methods, made with guidelines by https://dbwebb.se/kunskap/skapa-basklasser-for-databasdrivna-modeller-i-anax-mvc (Swedish).

### Added extra: 

Limit: `$this->[your-class]->limit(1)`

Offset: `$this->[your-class]->offset(1)`

Count all: `$this->[your-class]->countAll()`

Find all with paging support: `$this->[your-class]->findAll($page, $perPage)`

--------------------

Made by Rasmus Berg, rasmus.berg@chibidesign.se


License
------------------

This software is free software and carries a MIT license.


Use of external libraries
-----------------------------------

The following external modules are excluded but will be needed for run this classes.

### Anax-MVC (Get this one first)
* Github: https://github.com/mosbth/Anax-MVC
* Version: v2.0.x or later
* License: MIT license

### Mos/CDatabase
* Github: https://github.com/mosbth/cdatabase/
* Version: v0.1.1*
* License: MIT license

Install instructions
--------------------

### 1. First you will need to install the other modules (if not got theim already). 

### 2. The easiest way to install this is using composer:

Write this in your composer: 

```javascript
    "chp/cdatabasemodel": "dev-master"
```


History
-----------------------------------

###History for CDatabaseModel for ANAX-MVC 

v2.0 (2017-10-03)
* Added: Paging support to Find all method (ex. `$this->users->findAll($page, $perPage)`)
* Added: Count all method (ex. `$this->users->countAll()`)
* Bugfix: User object was send with properties
* Bugfix: Update method never save id, when object was send for be edit

v1.0.1 (2017-03-09)
* Update: Remove short php-tag
* Bugfix: Fix wrong namespace

v1.0.0 (2016-11-20)

* First release on Github.



```
Copyright (c) 2016-2017 Rasmus Berg, rasmus.berg@chibidesign.se
```
