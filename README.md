# WHATSAPP CLOUD API PACKAGE v0.1.0

## Package for sending Whatsapp messages with the ManyContacts service.

### Supports
- Send whatsapp text messages.


## Configure
Before use, you must configure the following parameters

- In the `.env` file of the project copy and set the following environment variables

```
    MANYCONTACTS_API_HOST=
    MANYCONTACTS_API_TOKEN=
```

## Usage

- To send a message just call the Facade  `EmizorIpx\ManyContacts\Facades\ManyContacts` to method `sendTextMessage` and specify the required parameters

```php
    
    use EmizorIpx\ManyContacts\Facades\ManyContacts;

    $response = ManyContacts::sendTextMessage($number_phone, $data);


```
