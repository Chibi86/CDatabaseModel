CDatabaseModel for ANAX-MVC
===========================

A model for database-methods, made with guidelines by https://dbwebb.se/kunskap/skapa-basklasser-for-databasdrivna-modeller-i-anax-mvc.
But got some small moding like limit and offset can set by class-call ($this->db->limit(1) etc).

By Rasmus Berg, rasmus.berg@chibidesign.se


License
------------------

This software is free software and carries a MIT license.


Use of external libraries
-----------------------------------


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

### 2. The easiest way to install this is using add `src` to `src\` in your Anax-MVC installation.

You can also use this by composer, write this in your composer: 

```javascript
    "chp/cdatabasemodel": "dev-master"
```


History
-----------------------------------

###History for Database TextContent for ANAX-MVC 

v1.0.0 (2016-11-20)

* First release on Github.



```
Copyright (c) 2016 Rasmus Berg, rasmus.berg@chibidesign.se
```
