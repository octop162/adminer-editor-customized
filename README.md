## 用意

### SQL用意

```
wget https://downloads.mysql.com/docs/world-db.zip
unzip world-db.zip
mv world-db/world.sql sql
rmdir world-db
rm world-db.zip
```

### Adminer用意

```
wget https://github.com/vrana/adminer/releases/download/v4.8.1/editor-4.8.1.php -O adminer/public/editor.php
```

### スタイルシート（任意）

```
wget https://raw.githubusercontent.com/pepa-linha/Adminer-Design-Dark/master/adminer.css -O adminer/public/adminer.css
```

## 起動

```
docker compose up -d
```

## アクセス

http://localhost:8080/adminer/world.php
