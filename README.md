##Test Shop

### Run:
```shell script
$ docker-compose up -d
```

### UI
Very simple, just for test: http://127.0.0.1:80

### API Endpoints

##### Get Countries List:
```shell script
$ curl http://127.0.0.1:8080/api/v1/countries
```

##### Get Products by Country:
```shell script
$ curl http://127.0.0.1:8080/api/v1/products/fi
```

##### Create Order:
```shell script
$ curl -X POST http://127.0.0.1:8080/api/v1/orders -d '{
  "country_code":"fi",
  "invoice_format":1,
  "send_to_email":true,
  "email":"user@ex.com",
  "products":{
    "1":10,
    "3":2
  }
}'
```

### E-Mail
Set data of Your SMTP server to ```\Shop\Config\Mailer```