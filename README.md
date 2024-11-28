



Grade backend - для корректной работы необходим LDAP-сервер и поля -
'title','name','OU','extensionAttribute1','givenName','cn', 'telephoneNumber', 'mail'
Они отвечают за создание должностей с сервера LDAP на стороне Grade , авторизации по email и сохранению персональной информации о пользователе
В случае ошибок смотреть Http/Controllers/v1/AuthController - метод login
    
