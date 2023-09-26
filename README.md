### sql

```
wget https://downloads.mysql.com/docs/world-db.zip
unzip world-db.zip
mv world-db/world.sql sql
rmdir world-db
rm world-db.zip
```

## local

```
docker compose build
docker compose up -d
```

http://localhost:8080/adminer/world.php

## sam

```
sam build
sam deploy --guided
sam deploy
sam delete
```