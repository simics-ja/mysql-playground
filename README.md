# MySQL Playground
This is my technical testing environment for MySQL. 

# Requirements

- Docker/docker-compose
- PHP
  - The use of mise, the development tool manager, is recommended.
- PHP Libraries
  - Execute `composer install`

# Usage
1. Select a case you want to test. This command creates the  'current_case' symlink in the project root.
```
command/set_case.php 00_sample
```
2. Generate initial data. This command generates a sql file that is used to create tables and insert records as initialization into MySQL. The sql file should be placed in "case/casename/init" to use "docker-entrypoint-initdb.d".
```
command/generate_data.php
```
3. Start MySQL with docker.
```
docker-compose up -d
```
4. Start the test. This command execute test.php in the current case directory.
```
command/test_case.php
```
5. Stop MySQL
```
docker-compose down --volumes
```