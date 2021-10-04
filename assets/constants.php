<?php

const ERROR_LOGIN_EXIST = 1;
const ERROR_IMAGE_LOAD = 2;

const SELECT_LOGIN = 'select * from users where login = :login';
const SELECT_USER = 'select * from users where login = :login and password = :password';
const INSERT_USER = 'insert into users values (null, :fullName, :login, :email, :path, :password)';