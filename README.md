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
    -i /local/docs/openapi.yaml \
    -g php \
    -o /local/recruitisApi \
    --invoker-package "RecruitisApi"
```

#### Fixy

Small fixes in openapi file, because found error during openapi generation.

##### Missing type of arrays

```
Semantic error at paths./activity_feed.get.responses.200.content.application/json.schema.properties.payload.properties.feed.items.anyOf.2.properties.badges
Schemas with 'type: array', require a sibling 'items: ' field
Jump to line 4701
Semantic error at paths./answers/{answer_id}/extra.put.responses.200.content.application/json.schema.properties.payload
Schemas with 'type: array', require a sibling 'items: ' field
Jump to line 4886
Semantic error at paths./candidates/{user_id}/extra.put.responses.200.content.application/json.schema.properties.payload
Schemas with 'type: array', require a sibling 'items: ' field
Jump to line 5002
```

##### job/employment

Field `employment` in job response object is single object and not array of object as it is defined in  v https://docs.recruitis.io/api/#tag/Jobs/paths/~1jobs/get

```json
"employment": {
        "id": 1,
        "name": "Práce na zkrácený úvazek"
    },
```

##### Missing second possibility of response

```json
date_assigned:
    type: string
    format: date-time
```


```json
date_assigned:
    oneOf:
    -   type: string
        format: date-time
    -   type: boolean
```

##### Missing null possibility of response

Few datetime field returning null, but schema does not define it.

##### /jobs/{id}

Endpoint return object `Job` instead of `Job[]` defined in API schema

### Unfinished tasks

I did not solve all tasks due to exceeding the time frame that I assigned myself to work on.

#### API result paging solution

Possible way of solution is change cache key from `all` to `page-{number}` and save meta data for rendering pagination.