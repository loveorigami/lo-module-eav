# Getting started with Lo-module-eav

### 1. Установка

```bash
  "repositories": [
    {
      "type": "vcs",
      "url": "http://loveorigami@bitbucket.org/loveorigami/lo-module-eav.git"
    }
  ],
  "minimum-stability": "dev",
  "require": {
       "loveorigami/lo-module-eav": "*"
  }
```

### 2. Update database schema

```bash
$ php yii migrate/up --migrationPath=@vendor/loveorigami/lo-module-eav/migrations
```

### 3. Create database schema
```bash
$ php yii migrate/create --migrationPath=@vendor/loveorigami/lo-module-eav/migration "eav-tbl..."

```