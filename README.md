# Jobs Recruitis

PHP Symfony project to test skills for PHP Developer job position at Recruitis.io

## Task

Acceptance job task in PDF file.

## Solution

### Symfony

Using Symfony and Composer install `symfony/skeleton` and running local server using Symfony's `symfony server:start` command set up to PHP 8.1 vie `.php-version` file.

### OpenApi

```bash
docker run --rm \
    -v "${PWD}:/local" openapitools/openapi-generator-cli generate \
    -i https://docs.recruitis.io/api/docs/openapi/openapi.yaml \
    -g php \
    -o /local/src/Module/Recruitis \
    --invoker-package "App\\Module\\Recruitis" \
    --skip-validate-spec
```


