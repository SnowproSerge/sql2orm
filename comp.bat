@ECHO OFF
for /f %%i in ('cd ,') do set VAR=%%i
ECHO %VAR%
docker run --rm  -v %VAR%:/opt  -w /opt  snowserge/php-composer:latest  composer install