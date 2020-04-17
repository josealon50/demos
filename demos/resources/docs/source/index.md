---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Contracts Management

APIs for managing Contracts
<!-- START_3da6f13504d02ea0399d327d9d3c3110 -->
## Get All Contracts paginated
Endpoint will return a pagination object with all Contracts

> Example request:

```bash
curl -X GET \
    -G "http://localhost/v1/contracts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/v1/contracts"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": null,
            "contract": null,
            "vendor": null,
            "description": null,
            "budget": null,
            "demos": null,
            "endcaps": null,
            "start": "2020-04-17",
            "end": "2020-04-17"
        },
        {
            "id": null,
            "contract": null,
            "vendor": null,
            "description": null,
            "budget": null,
            "demos": null,
            "endcaps": null,
            "start": "2020-04-17",
            "end": "2020-04-17"
        }
    ]
}
```

### HTTP Request
`GET v1/contracts`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | The ID of the contract.

<!-- END_3da6f13504d02ea0399d327d9d3c3110 -->

<!-- START_2de675d948071352fffa72bebbe75442 -->
## Create new Contract
Enpoint will create a new contract.

> Example request:

```bash
curl -X POST \
    "http://localhost/v1/contracts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"contract":9,"vendor":9,"description":9,"budget":23022.12,"demos":9,"endcaps":9,"star":"9","end":"9"}'

```

```javascript
const url = new URL(
    "http://localhost/v1/contracts"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "contract": 9,
    "vendor": 9,
    "description": 9,
    "budget": 23022.12,
    "demos": 9,
    "endcaps": 9,
    "star": "9",
    "end": "9"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": null,
            "contract": null,
            "vendor": null,
            "description": null,
            "budget": null,
            "demos": null,
            "endcaps": null,
            "start": "2020-04-17",
            "end": "2020-04-17"
        },
        {
            "id": null,
            "contract": null,
            "vendor": null,
            "description": null,
            "budget": null,
            "demos": null,
            "endcaps": null,
            "start": "2020-04-17",
            "end": "2020-04-17"
        }
    ]
}
```

### HTTP Request
`POST v1/contracts`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `contract` | integer |  required  | The contract_num of the contract.
        `vendor` | integer |  required  | The contract_num of the contract.
        `description` | integer |  required  | The contract_num of the contract.
        `budget` | float |  required  | The budget of the contract.
        `demos` | integer |  required  | The num_demos (number of demos) of the contract.
        `endcaps` | integer |  required  | The num_endcaps (number of endcaps) of the contract.
        `star` | date |  required  | The start_at starting date of the contract.
        `end` | date |  required  | The end_at ending date of the contract.
    
<!-- END_2de675d948071352fffa72bebbe75442 -->

<!-- START_d0749e7a107f2895bded73c64fe2df09 -->
## Get Contract by id
Endpoiin will return contract by url param

> Example request:

```bash
curl -X GET \
    -G "http://localhost/v1/contracts/vero" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"contract":9,"vendor":9,"description":9,"budget":23022.12,"demos":9,"endcaps":9,"star":"9","end":"9"}'

```

```javascript
const url = new URL(
    "http://localhost/v1/contracts/vero"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "contract": 9,
    "vendor": 9,
    "description": 9,
    "budget": 23022.12,
    "demos": 9,
    "endcaps": 9,
    "star": "9",
    "end": "9"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": null,
            "contract": null,
            "vendor": null,
            "description": null,
            "budget": null,
            "demos": null,
            "endcaps": null,
            "start": "2020-04-17",
            "end": "2020-04-17"
        },
        {
            "id": null,
            "contract": null,
            "vendor": null,
            "description": null,
            "budget": null,
            "demos": null,
            "endcaps": null,
            "start": "2020-04-17",
            "end": "2020-04-17"
        }
    ]
}
```
> Example response (404):

```json
null
```

### HTTP Request
`GET v1/contracts/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | The ID of the contract.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `contract` | integer |  required  | The contract_num of the contract.
        `vendor` | integer |  required  | The contract_num of the contract.
        `description` | integer |  required  | The contract_num of the contract.
        `budget` | float |  required  | The budget of the contract.
        `demos` | integer |  required  | The num_demos (number of demos) of the contract.
        `endcaps` | integer |  required  | The num_endcaps (number of endcaps) of the contract.
        `star` | date |  required  | The start_at starting date of the contract.
        `end` | date |  required  | The end_at ending date of the contract.
    
<!-- END_d0749e7a107f2895bded73c64fe2df09 -->

<!-- START_c7524f825cf8834b5d3eb20cb54c189a -->
## Update existing Contract
Endpoint will update a contract.

> Example request:

```bash
curl -X PUT \
    "http://localhost/v1/contracts/repellat" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"contract":9,"vendor":9,"description":9,"budget":23022.12,"demos":9,"endcaps":9,"star":"9","end":"9"}'

```

```javascript
const url = new URL(
    "http://localhost/v1/contracts/repellat"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "contract": 9,
    "vendor": 9,
    "description": 9,
    "budget": 23022.12,
    "demos": 9,
    "endcaps": 9,
    "star": "9",
    "end": "9"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": null,
            "contract": null,
            "vendor": null,
            "description": null,
            "budget": null,
            "demos": null,
            "endcaps": null,
            "start": "2020-04-17",
            "end": "2020-04-17"
        },
        {
            "id": null,
            "contract": null,
            "vendor": null,
            "description": null,
            "budget": null,
            "demos": null,
            "endcaps": null,
            "start": "2020-04-17",
            "end": "2020-04-17"
        }
    ]
}
```
> Example response (404):

```json
null
```

### HTTP Request
`PUT v1/contracts/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | The ID of the contract.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `contract` | integer |  required  | The contract_num of the contract.
        `vendor` | integer |  required  | The contract_num of the contract.
        `description` | integer |  required  | The contract_num of the contract.
        `budget` | float |  required  | The budget of the contract.
        `demos` | integer |  required  | The num_demos (number of demos) of the contract.
        `endcaps` | integer |  required  | The num_endcaps (number of endcaps) of the contract.
        `star` | date |  required  | The start_at starting date of the contract.
        `end` | date |  required  | The end_at ending date of the contract.
    
<!-- END_c7524f825cf8834b5d3eb20cb54c189a -->

<!-- START_9147df1e06095d45b549a1f00c002ff7 -->
## Delete existing Contract
Endpoint will do a soft delete on contrat record.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/v1/contracts/nam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/v1/contracts/nam"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": null,
            "contract": null,
            "vendor": null,
            "description": null,
            "budget": null,
            "demos": null,
            "endcaps": null,
            "start": "2020-04-17",
            "end": "2020-04-17"
        },
        {
            "id": null,
            "contract": null,
            "vendor": null,
            "description": null,
            "budget": null,
            "demos": null,
            "endcaps": null,
            "start": "2020-04-17",
            "end": "2020-04-17"
        }
    ]
}
```
> Example response (404):

```json
null
```

### HTTP Request
`DELETE v1/contracts/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | The ID of the contract.

<!-- END_9147df1e06095d45b549a1f00c002ff7 -->


