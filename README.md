<h1>Documentacion KS API</h1>

<h5>Pequeña descripcion del proyecto:</h5>
<p>API realizada en Laravel 8.x.x con CRUD de dentistas, pacientes y tratamientos</p>
<p align="center">
    Postman con algunas URL'S y sus correspondientes datos : https://www.getpostman.com/collections/3f25418fedbf5e6205b4
</p>

<strong>Pasos para poder utilizarla</strong>
<ol>
    <li>Crear la Base de datos, la misma se encuentra en un archivo llamado 'changes.sql' y la configuración se encuentra en el archivo .env</li>
    <li>Correr el comando por consola 'composer install'</li>
    <li>Correr las migraciones para las creaciones de las tablas con el comando ' php artisan migrate '</li>
    <li>Rellenar la base de datos con el comando ' php artisan db:seed '</li>
    <li>Poner en marcha el servidor con el comando: ' php artisan serve '</li>
    <li>Listo! ya teniendo en marcha el proyecto solo quedá comenzar a probarlo</li>
</ol>

<h2>Notas:</h2>
<strong>Todos los controllers tienen los metodos HTTP más comunes a utilizar a excepción de ['create','edit']</strong>

<strong>Estos utilizan "Request" que se pueden encontrar dentro de la carpeta App/Http/Request donde se hacen ciertas comprobaciones antes de empezar a "ejecutar" las acciones dentro de los metodos del controller</strong>

<strong>Para hashear la contraseña se hace uso de un mutator: setPasswordAttribute dentro del modelo User</strong>

## Users Controllers

<bold>GET: http://127.0.0.1:8000/api/user</bold>
-- Trae todos los elementos que se encuentren en la tabla users
<p> Request: No lleva</p>
<p> Response : [
    {
        "id": 1,
        "name": "hv8qQ2qLq1",
        "surname": "IbY4Q03Aqhp",
        "gender": "o",
        "email": "rkdS0MFWD5@gmail.com",
        "password": "$2y$10$74kGZCCU0BU9j18FwScn/eJLwD7ZFBVgJAegAfsNE9inYjrb7YIme",
        "deleted_at": null,
        "created_at": null,
        "updated_at": null
    }]
</p>

<bold>GET: http://127.0.0.1:8000/api/user/[id]</bold><small>[id] = 5</small>
-- Busca al elemento por id de la tabla users
<p> Request: No lleva</p>
<p> Response : [
    {
        "id": 5,
        "name": "hv8qQ2qLq1",
        "surname": "IbY4Q03Aqhp",
        "gender": "o",
        "email": "rkdS0MFWD5@gmail.com",
        "password": "$2y$10$74kGZCCU0BU9j18FwScn/eJLwD7ZFBVgJAegAfsNE9inYjrb7YIme",
        "deleted_at": null,
        "created_at": null,
        "updated_at": null
    }]
</p>

<bold>PUT: http://127.0.0.1:8000/api/user/[id]</bold><small>[id] = 5</small>
-- Busca al elemento por id de la tabla users y actualiza el valor mandado en el request, en este ejemplo vamos a actualizar el nombre
<p> Request:
    {
        "name":"matias"
    }
</p>
<p> Response :
    {
        "id": 5,
        "name": "matias",
        "surname": "YRdsKmgfR6a",
        "gender": "o",
        "email": "8Wxg04oHxN@gmail.com",
        "password": "$2y$10$DlmOl3jxTZhOuGrjRcY27eyndbpmyvYJyj4BuWvIUQ8nSSRbytd0q",
        "deleted_at": null,
        "created_at": null,
        "updated_at": "2021-08-25 02:42:24"
    }
</p>

<bold>Delete: http://127.0.0.1:8000/api/user/[id]</bold><small>[id] = 5</small>
-- Busca al elemento por id de la tabla users y lo elimina de forma logica.
<p> Request: no lleva
</p>
<p> Response : null, HTTP code = 204 </p>

<bold>POST: http://127.0.0.1:8000/api/user/[id]</bold><small>[id] = 5</small>
-- Vamos a crear un elemento en base de datos mediante el metodo post
<p> Request:
    {
        "name":"matias",
        "surname":"gonzalez",
        "gender":"m",
        "email":"matias@sks.com",
        "password":"matias"
    }
</p>
<p> Response :
    {
        "name": "matias",
        "surname": "gonzalez",
        "gender": "m",
        "email": "matias@sks.com",
        "password": "$2y$10$qvZXDI2IMzDlgC1bRHZPbuPs/oOwbzlXTz573GOZJraIUojeWyvHK",
        "updated_at": "2021-08-25 02:19:21",
        "created_at": "2021-08-25 02:19:21",
        "id": 15
    }
</p>

<h5> De forma similar es con el resto de los endpoints para paciente,dentist,treatments.</h5>


<h2>El endpoint que trae las tratamientos</h2>
<p>Este endpoint es un GET que al no estar seguro de cuales serían los ultimos 10 tratamientos que se querian traer (en referencia al orden) se me ocurrió darle las opción mediante un parametro 'order' en el cual ustedes puedan elegir si ordernarlo por orden de creación, actualización y terminado. Estos van de forma descendiente es decir desde la fecha mas reciente a la mas antigua indistintamente de cual se elija.</p>

<p>Para traer el nombre completo se utiliza un Accessor</p>

<bold>GET: http://127.0.0.1:8000/api/treatments?order=created_at</bold>
<p> Request: (va en la url xxxx?order='created_at' o xxxx?order='updated_at' o xxxx?order='ended_at') estos 
</p>
<p> Response :
   [
    {
        "id": 5,
        "external_id": 7138,
        "created_at": "08/07/2021",
        "updated_at": "12/08/2021",
        "ended_at": "25/09/2020",
        "dentist": {
            "id": 10,
            "full_name": "TYWOc2oeL0 EZQFYk4NMYY",
            "email": "qYYtKtMnSC@gmail.com"
        },
        "patient": {
            "id": 10,
            "full_name": "TYWOc2oeL0 EZQFYk4NMYY",
            "email": "qYYtKtMnSC@gmail.com"
        }
    },
    {
        "id": 8,
        "external_id": 9152,
        "created_at": "22/05/2021",
        "updated_at": "19/04/2021",
        "ended_at": "19/01/2021",
        "dentist": {
            "id": 7,
            "full_name": "xjs8fBSDjq opWaYmurezP",
            "email": "EDVGhv9xVH@gmail.com"
        },
        "patient": {
            "id": 7,
            "full_name": "xjs8fBSDjq opWaYmurezP",
            "email": "EDVGhv9xVH@gmail.com"
        }
    },
    {
        "id": 4,
        "external_id": 6005,
        "created_at": "13/05/2021",
        "updated_at": "23/06/2021",
        "ended_at": "10/10/2020",
        "dentist": {
            "id": 11,
            "full_name": "wCzsJWiv4b AcNH1S8wQkM",
            "email": "0AMg2DuWFZ@gmail.com"
        },
        "patient": {
            "id": 11,
            "full_name": "wCzsJWiv4b AcNH1S8wQkM",
            "email": "0AMg2DuWFZ@gmail.com"
        }
    }
   ]
</p>

## Created by Matias Gonzalez