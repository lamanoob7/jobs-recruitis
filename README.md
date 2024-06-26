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

Drobne upravy v openapi schematu, kvuli blokum pro autogenerator

##### Chybejici typy poli

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

V jobech se vratil `employment` jako single object a ne jako pole objektu jak je definovano v https://docs.recruitis.io/api/#tag/Jobs/paths/~1jobs/get

```json
"employment": {
        "id": 1,
        "name": "Práce na zkrácený úvazek"
    },
```

##### 

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

##### /jobs/{id}

Return object Job not Job[]