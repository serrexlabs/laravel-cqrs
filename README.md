
**Initiating Project**

`` php artisan init:project <project-name>``

**Module creation**

 `` php artisan make:module ``
 
 
 **Command creation**
 
  `` php artisan make:cqrs:command <command-name> ``
 
 * As a convention, append Command postfix end of every command (Ex: SampleCommand)
  
**Query creation**

`` php artisan make:cqrs:query <cquery-name> ``

* As a convention, append Query postfix end of every query (Ex: SampleQuery)

**Repository creation**

`` php artisan make:repository <repository-name> ``

* As a convention, append Repository postfix end of every repository (Ex: SampleRepository)
