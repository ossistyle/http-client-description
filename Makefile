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

integ-webapi:
	vendor/bin/phpunit --debug --testsuite=integ-webapi

integ-webapi-auth:
	vendor/bin/phpunit --debug --testsuite=integ-webapi-auth

integ-webapi-post:
	vendor/bin/phpunit --debug --testsuite=integ-webapi-post

integ-webapi-patch:
	vendor/bin/phpunit --debug --testsuite=integ-webapi-patch

integ-webapi-get:
	vendor/bin/phpunit --debug --testsuite=integ-webapi-get

integ-webapi-delete:
	vendor/bin/phpunit --debug --testsuite=integ-webapi-delete

integ-webapi-products:
	vendor/bin/phpunit --debug --testsuite=integ-webapi-products
