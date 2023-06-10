## 用意

### SQL用意

```
wget https://downloads.mysql.com/docs/world-db.zip
unzip world-db.zip
mv world/world.sql sql
```

### Adminer用意

```
wget https://github.com/vrana/adminer/releases/download/v4.8.1/editor-4.8.1.php -O adminer/editor.php
```

### スタイルシート（任意）

```
wget https://raw.githubusercontent.com/pepa-linha/Adminer-Design-Dark/master/adminer.css -O adminer/adminer.css
```

## 起動

```
docker compose up -d
```

## アクセス

http://localhost/adminer/world.php
