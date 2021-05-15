
# envoyer des mails en php:

* j'utilise la fonction [mail de php](https://www.php.net/manual/fr/function.mail.php)
* Il faut configurer le fichier *C:\xampp\php\php.ini*

```
[mail function]
; For Win32 only.
; http://php.net/smtp
SMTP=smtp.gmail.com
; http://php.net/smtp-port
smtp_port=587

; For Win32 only.
; http://php.net/sendmail-from
sendmail_from=jeanpierre.mena@gmail.com
```

* à chaque envoi, j'obtiens une alerte de sécurité...