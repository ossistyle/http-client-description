test:
	vendor/bin/phpunit --debug --testsuite=unit

coverage:
	vendor/bin/phpunit --testsuite=unit --coverage-html=build/artifacts/coverage

view-coverage:
	open build/artifacts/coverage/index.html

clean:
	rm -rf build/artifacts
	cd docs && make clean

docs:
	cd docs && make html

view-docs:
	open docs/_build/html/index.html

integ:
	vendor/bin/phpunit --debug --testsuite=integ

integ-post:
	vendor/bin/phpunit --debug --testsuite=integ-post

integ-patch:
	vendor/bin/phpunit --debug --testsuite=integ-patch

integ-get:
	vendor/bin/phpunit --debug --testsuite=integ-get
