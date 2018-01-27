# sql2orm
Console utility for automatic generation of classes of my mini ORM

## Prepare of start
First, you must install additional php packages. Execute:

``` 
composer install
```

### Using Docker

#### Build docker image
If you don`t have php and composer in your computer, you can use docker image.

Build docker image. 
```cmd
cd docker
docker build -t snowserge/php-composer .
```
#### Run composer from docker image

- in Windows:

```
build.bat
``` 
- in Linux:

```bash
docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    snowserge/php-composer:latest \
    composer install
```
 
## Using util

Coming soon... 
