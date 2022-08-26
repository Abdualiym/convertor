#Console generate tree project on yii2 basic.

REQUIREMENTS
------------

docker, docker compose, make


INSTALLATION
------------

~~~
make d-install
~~~

Now you can be able to access the container through the following command

~~~
make de
~~~


# Put input.csv to ```files``` directory, so you can skip directory names


TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/):

- `unit`

Tests can be executed by running

```
vendor/bin/codecept run
```
or simple

```
make test
```