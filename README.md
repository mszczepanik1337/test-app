# App


baza do postawienia

```php
docker-compose up
```

migracja


```php
php bin/console doctrine:migrations:migrate
```

uruchomienie aplikacji

```php
symfony server:start
```

dodanie pracownika

```javascript
/employees POST
{
	"firstName": "Marek",
	"lastName": "Kowalski",
	"supplementType": "const",
	"department": "HR",
	"baseSalary": 1000
}
```

dodanie działu

```javascript
/departments POST
{
	"name": "HR",
	"salaryPercentageSupplement": 10,
	"salaryConstSupplement": 100
}
```

pobranie raportu

```javascript
/employees GET

paginacja: offset, limit
filtry : firstName, lastName, department
sort: firstName, lastName, department, baseSalary, totalSalary, supplementAmount, supplementType

przykładowy request
/employees?filters[firstName]=Marek&sortBy=baseSalary&order=asc
```
